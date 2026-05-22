@extends('layouts.admin')

@section('title', '询盘管理')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-semibold text-gray-900">询盘管理</h2>
        <a href="{{ route('admin.inquiries.export') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-lg text-sm font-semibold hover:bg-green-700 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
            </svg>
            导出Excel
        </a>
    </div>

    {{-- Filter Tabs --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-6">
        <div class="flex border-b border-gray-200">
            <a href="{{ route('admin.inquiries.index', ['filter' => 'all']) }}"
               class="px-6 py-3 text-sm font-medium {{ $filter === 'all' ? 'border-b-2 border-[#FF008A] text-[#FF008A]' : 'text-gray-500 hover:text-gray-700' }}">
                全部
            </a>
            <a href="{{ route('admin.inquiries.index', ['filter' => 'unread']) }}"
               class="px-6 py-3 text-sm font-medium {{ $filter === 'unread' ? 'border-b-2 border-[#FF008A] text-[#FF008A]' : 'text-gray-500 hover:text-gray-700' }}">
                未读
            </a>
            <a href="{{ route('admin.inquiries.index', ['filter' => 'read']) }}"
               class="px-6 py-3 text-sm font-medium {{ $filter === 'read' ? 'border-b-2 border-[#FF008A] text-[#FF008A]' : 'text-gray-500 hover:text-gray-700' }}">
                已读
            </a>
        </div>
    </div>

    {{-- Inquiries Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">姓名</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">邮箱</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">电话</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">留言</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">来源页面</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">日期</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">状态</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">操作</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($inquiries as $inquiry)
                        <tr class="hover:bg-gray-50 {{ !$inquiry->is_read ? 'bg-blue-50/30' : '' }}">
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $inquiry->id }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="hover:text-[#FF008A]">
                                    {{ $inquiry->name }}
                                </a>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $inquiry->email }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $inquiry->phone ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">{{ Str::limit($inquiry->message, 50) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $inquiry->page_source ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $inquiry->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4">
                                @if($inquiry->is_read)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-700">已读</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-700">未读</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-[#FF008A] bg-pink-50 rounded-lg hover:bg-pink-100 transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        查看
                                    </a>
                                    <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST" onsubmit="return confirm('确定要删除此询盘吗？')">
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
                            <td colspan="9" class="px-6 py-8 text-center text-sm text-gray-500">暂无询盘记录</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($inquiries->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $inquiries->links() }}
            </div>
        @endif
    </div>
@endsection
