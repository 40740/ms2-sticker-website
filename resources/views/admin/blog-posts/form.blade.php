{{-- Blog Post Form Partial --}}
{{-- Expects: $blogPost (optional, for edit) --}}

<div class="space-y-6" x-data="{ slugManuallyEdited: false }">
    {{-- Basic Info --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-md font-semibold text-gray-800 mb-4">文章详情</h3>
        <div class="space-y-6">
            {{-- Title --}}
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">标题 <span class="text-red-500">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title', $blogPost->title ?? '') }}"
                       x-on:input="if(!slugManuallyEdited) { $refs.slugInput.value = $event.target.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '') }"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]"
                       required>
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Slug --}}
            <div>
                <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">URL标识</label>
                <input type="text" id="slug" name="slug" value="{{ old('slug', $blogPost->slug ?? '') }}"
                       x-ref="slugInput"
                       x-on:input="slugManuallyEdited = true"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]"
                       placeholder="auto-generated-from-title">
                @error('slug')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Excerpt --}}
            <div>
                <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-1">摘要</label>
                <textarea id="excerpt" name="excerpt" rows="3"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]">{{ old('excerpt', $blogPost->excerpt ?? '') }}</textarea>
                @error('excerpt')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Content (Quill Editor) --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">内容 <span class="text-red-500">*</span></label>
                <div id="content-editor" class="border border-gray-300 rounded-lg bg-white" style="min-height: 400px;">
                    {!! old('content', $blogPost->content ?? '') !!}
                </div>
                <input type="hidden" name="content" value="{{ old('content', $blogPost->content ?? '') }}">
                @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    {{-- Featured Image --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-md font-semibold text-gray-800 mb-4">封面图片</h3>
        @if(isset($blogPost) && $blogPost->image)
            <div class="mb-3">
                @php
                    $adminBlogImg = $blogPost->image;
                    if ($adminBlogImg && !str_starts_with($adminBlogImg, '/') && !str_starts_with($adminBlogImg, 'http')) {
                        $adminBlogImg = Storage::disk('uploads')->url($adminBlogImg);
                    }
                @endphp
                <img src="{{ $adminBlogImg }}" alt="Featured image" class="h-32 w-auto rounded-lg object-cover">
            </div>
        @endif
        <input type="file" name="image" accept="image/*"
               class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-pink-50 file:text-[#FF008A] hover:file:bg-pink-100">
        @error('image')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    {{-- SEO & Publishing --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-md font-semibold text-gray-800 mb-4">SEO与发布</h3>
        <div class="space-y-6">
            <div>
                <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-1">SEO标题</label>
                <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title', $blogPost->meta_title ?? '') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]">
            </div>
            <div>
                <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-1">SEO描述</label>
                <textarea id="meta_description" name="meta_description" rows="3"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]">{{ old('meta_description', $blogPost->meta_description ?? '') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Published At --}}
                <div>
                    <label for="published_at" class="block text-sm font-medium text-gray-700 mb-1">发布时间</label>
                    <input type="datetime-local" id="published_at" name="published_at"
                           value="{{ old('published_at', isset($blogPost) && $blogPost->published_at ? $blogPost->published_at->format('Y-m-d\TH:i') : '') }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]">
                </div>

                {{-- Is Published --}}
                <div class="flex items-center">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_published" value="1"
                               {{ old('is_published', isset($blogPost) ? $blogPost->is_published : false) ? 'checked' : '' }}
                               class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-[#FF008A]/30 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#FF008A]"></div>
                        <span class="ms-3 text-sm font-medium text-gray-700">发布</span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    {{-- Submit --}}
    <div class="flex items-center gap-4">
        <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-[#FF008A] text-white rounded-lg text-sm font-semibold hover:bg-[#FF33A1] transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
            </svg>
            {{ isset($blogPost) ? '更新博客' : '创建博客' }}
        </button>
        <a href="{{ route('admin.blog-posts.index') }}" class="px-6 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">取消</a>
    </div>
</div>

@push('scripts')
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var quill = new Quill('#content-editor', {
                theme: 'snow',
                placeholder: '请输入文章内容...',
                modules: {
                    toolbar: [
                        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'color': [] }, { 'background': [] }],
                        [{ 'align': [] }],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        [{ 'indent': '-1'}, { 'indent': '+1' }],
                        ['link', 'image', 'video'],
                        ['blockquote', 'code-block'],
                        ['clean']
                    ]
                }
            });

            var form = document.querySelector('#content-editor').closest('form');
            if (form) {
                form.addEventListener('submit', function() {
                    var hiddenInput = document.querySelector('input[name="content"]') || document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'content';
                    hiddenInput.value = quill.root.innerHTML;
                    if (!document.querySelector('input[name="content"]')) {
                        form.appendChild(hiddenInput);
                    }
                });
            }
        });
    </script>
@endpush
