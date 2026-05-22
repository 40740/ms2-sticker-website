{{-- Category Form Partial --}}
{{-- Expects: $category (optional, for edit) --}}

<div class="space-y-6" x-data="{ slugManuallyEdited: false }">
    {{-- Basic Info --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-md font-semibold text-gray-800 mb-4">基本信息</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Name --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">名称 <span class="text-red-500">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name', $category->name ?? '') }}"
                       x-on:input="if(!slugManuallyEdited) { $refs.slugInput.value = $event.target.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '') }"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]"
                       required>
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Type --}}
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">类型 <span class="text-red-500">*</span></label>
                <select id="type" name="type"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]"
                        required>
                    <option value="sticker" {{ old('type', $category->type ?? '') === 'sticker' ? 'selected' : '' }}>Sticker</option>
                    <option value="label" {{ old('type', $category->type ?? '') === 'label' ? 'selected' : '' }}>Label</option>
                </select>
                @error('type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Slug --}}
            <div>
                <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">URL标识</label>
                <input type="text" id="slug" name="slug" value="{{ old('slug', $category->slug ?? '') }}"
                       x-ref="slugInput"
                       x-on:input="slugManuallyEdited = true"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]"
                       placeholder="auto-generated-from-name">
                @error('slug')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Sort Order --}}
            <div>
                <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-1">排序</label>
                <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $category->sort_order ?? 0) }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]">
            </div>
        </div>

        {{-- Description --}}
        <div class="mt-6">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">描述</label>
            <textarea id="description" name="description" rows="3"
                      class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]">{{ old('description', $category->description ?? '') }}</textarea>
            @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Is Active --}}
        <div class="mt-6 flex items-center gap-3">
            <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" name="is_active" value="1"
                       {{ old('is_active', isset($category) ? $category->is_active : true) ? 'checked' : '' }}
                       class="sr-only peer">
                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-[#FF008A]/30 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#FF008A]"></div>
                <span class="ms-3 text-sm font-medium text-gray-700">启用</span>
            </label>
        </div>
    </div>

    {{-- Images --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-md font-semibold text-gray-800 mb-4">图片</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Main Image --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">分类图片</label>
                @if(isset($category) && $category->image)
                    <div class="mb-2">
                        @php
                            $catAdminImg = $category->image;
                            if ($catAdminImg && !str_starts_with($catAdminImg, '/') && !str_starts_with($catAdminImg, 'http')) {
                                $catAdminImg = '/' . ltrim($catAdminImg, '/');
                            }
                        @endphp
                        <img src="{{ $catAdminImg }}" alt="Category image" class="h-24 w-auto rounded-lg object-cover"
                             onerror="this.src='/images/category-placeholder.jpg'">
                    </div>
                @endif
                <input type="file" name="image" accept="image/*"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-pink-50 file:text-[#FF008A] hover:file:bg-pink-100">
                @error('image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Hero Image --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Hero图片</label>
                @if(isset($category) && $category->hero_image)
                    <div class="mb-2">
                        @php
                            $catHeroAdminImg = $category->hero_image;
                            if ($catHeroAdminImg && !str_starts_with($catHeroAdminImg, '/') && !str_starts_with($catHeroAdminImg, 'http')) {
                                $catHeroAdminImg = '/' . ltrim($catHeroAdminImg, '/');
                            }
                        @endphp
                        <img src="{{ $catHeroAdminImg }}" alt="Hero image" class="h-24 w-auto rounded-lg object-cover"
                             onerror="this.src='/images/product-placeholder.jpg'">
                    </div>
                @endif
                <input type="file" name="hero_image" accept="image/*"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-pink-50 file:text-[#FF008A] hover:file:bg-pink-100">
                @error('hero_image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    {{-- Hero Section --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-md font-semibold text-gray-800 mb-4">Hero区域</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="hero_title" class="block text-sm font-medium text-gray-700 mb-1">Hero标题</label>
                <input type="text" id="hero_title" name="hero_title" value="{{ old('hero_title', $category->hero_title ?? '') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]">
            </div>
            <div>
                <label for="hero_subtitle" class="block text-sm font-medium text-gray-700 mb-1">Hero副标题</label>
                <input type="text" id="hero_subtitle" name="hero_subtitle" value="{{ old('hero_subtitle', $category->hero_subtitle ?? '') }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]">
            </div>
        </div>
    </div>

    {{-- Submit --}}
    <div class="flex items-center gap-4">
        <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-[#FF008A] text-white rounded-lg text-sm font-semibold hover:bg-[#FF33A1] transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
            </svg>
            {{ isset($category) ? '更新分类' : '创建分类' }}
        </button>
        <a href="{{ route('admin.categories.index') }}" class="px-6 py-2.5 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">取消</a>
    </div>
</div>
