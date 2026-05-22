@extends('layouts.admin')

@section('title', '博客管理')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-semibold text-gray-900">全部博客</h2>
        <a href="{{ route('admin.blog-posts.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-[#FF008A] text-white rounded-lg text-sm font-semibold hover:bg-[#FF33A1] transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
            添加博客
        </a>
    </div>

    {{-- Filter --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-6">
        <div class="flex border-b border-gray-200">
            <a href="{{ route('admin.blog-posts.index') }}"
               class="px-6 py-3 text-sm font-medium {{ !request('filter') ? 'border-b-2 border-[#FF008A] text-[#FF008A]' : 'text-gray-500 hover:text-gray-700' }}">
                全部
            </a>
            <a href="{{ route('admin.blog-posts.index', ['filter' => 'published']) }}"
               class="px-6 py-3 text-sm font-medium {{ request('filter') === 'published' ? 'border-b-2 border-[#FF008A] text-[#FF008A]' : 'text-gray-500 hover:text-gray-700' }}">
                已发布
            </a>
            <a href="{{ route('admin.blog-posts.index', ['filter' => 'draft']) }}"
               class="px-6 py-3 text-sm font-medium {{ request('filter') === 'draft' ? 'border-b-2 border-[#FF008A] text-[#FF008A]' : 'text-gray-500 hover:text-gray-700' }}">
                草稿
            </a>
        </div>
    </div>

    {{-- Blog Posts Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">图片</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">标题</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">状态</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">发布时间</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">操作</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($posts as $post)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $post->id }}</td>
                            <td class="px-6 py-4">
                                @if($post->image)
                                    <img src="{{ Storage::disk('uploads')->url($post->image) }}" alt="{{ $post->title }}" class="h-10 w-16 rounded-lg object-cover">
                                @else
                                    <div class="h-10 w-16 rounded-lg bg-gray-100 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5a2.25 2.25 0 002.25-2.25V5.25a2.25 2.25 0 00-2.25-2.25H3.75a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 003.75 21z"/>
                                        </svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $post->title }}</td>
                            <td class="px-6 py-4">
                                @if($post->is_published)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">已发布</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">草稿</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $post->published_at?->format('M d, Y') ?? '-' }}</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.blog-posts.edit', $blogPost ?? $post) }}" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-[#FF008A] bg-pink-50 rounded-lg hover:bg-pink-100 transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                        </svg>
                                        编辑
                                    </a>
                                    <form action="{{ route('admin.blog-posts.destroy', $blogPost ?? $post) }}" method="POST" onsubmit="return confirm('确定要删除此博客吗？')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                            </svg>
                                            删除
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-sm text-gray-500">暂无博客</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($posts->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
@endsection
