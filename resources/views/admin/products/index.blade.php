@extends('layouts.admin')

@section('title', '产品管理')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-semibold text-gray-900">全部产品</h2>
        <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-[#FF008A] text-white rounded-lg text-sm font-semibold hover:bg-[#FF33A1] transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
            </svg>
            添加产品
        </a>
    </div>

    {{-- Filters --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-6">
        <form method="GET" action="{{ route('admin.products.index') }}" class="flex flex-wrap gap-4 items-end">
            <div>
                <label class="block text-xs font-medium text-gray-500 mb-1">类型</label>
                <select name="type" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]">
                    <option value="">全部类型</option>
                    <option value="sticker" {{ request('type') === 'sticker' ? 'selected' : '' }}>Sticker</option>
                    <option value="label" {{ request('type') === 'label' ? 'selected' : '' }}>Label</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-500 mb-1">分类</label>
                <select name="category_id" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#FF008A]/30 focus:border-[#FF008A]">
                    <option value="">全部分类</option>
                    @foreach(\App\Models\Category::active()->ordered()->get() as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200 transition-colors">筛选</button>
            <a href="{{ route('admin.products.index') }}" class="px-4 py-2 text-sm text-gray-500 hover:text-gray-700">重置</a>
        </form>
    </div>

    {{-- Products Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">图片</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">名称</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">分类</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">类型</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">状态</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">操作</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($products as $product)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $product->id }}</td>
                            <td class="px-6 py-4">
                                @if($product->image)
                                    @php
                                        $prodIndexImg = $product->image;
                                        if ($prodIndexImg && !str_starts_with($prodIndexImg, '/') && !str_starts_with($prodIndexImg, 'http')) {
                                            $prodIndexImg = '/' . ltrim($prodIndexImg, '/');
                                        }
                                    @endphp
                                    <img src="{{ $prodIndexImg }}" alt="{{ $product->name }}" class="h-10 w-10 rounded-lg object-cover"
                                         onerror="this.src='/images/product-placeholder.jpg'">
                                @else
                                    <div class="h-10 w-10 rounded-lg bg-gray-100 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3.75 21h16.5a2.25 2.25 0 002.25-2.25V5.25a2.25 2.25 0 00-2.25-2.25H3.75a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 003.75 21z"/>
                                        </svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $product->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $product->category?->name ?? '-' }}</td>
                            <td class="px-6 py-4">
                                @if($product->type === 'sticker')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-pink-100 text-pink-700">Sticker</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-700">Label</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($product->is_active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">启用</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500">停用</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-[#FF008A] bg-pink-50 rounded-lg hover:bg-pink-100 transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                        </svg>
                                        编辑
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('确定要删除此产品吗？')">
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
                            <td colspan="7" class="px-6 py-8 text-center text-sm text-gray-500">暂无产品</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($products->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $products->links() }}
            </div>
        @endif
    </div>
@endsection
