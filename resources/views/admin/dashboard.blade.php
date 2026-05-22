@extends('layouts.admin')

@section('title', '控制面板')

@section('content')
    {{-- Stat Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
        {{-- Total Inquiries --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">总询盘数</p>
                    <p class="mt-2 text-3xl font-bold text-gray-900">{{ $totalInquiries }}</p>
                </div>
                <div class="h-12 w-12 rounded-lg bg-blue-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Unread Inquiries --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">未读询盘</p>
                    <p class="mt-2 text-3xl font-bold text-red-600">{{ $unreadInquiries }}</p>
                </div>
                <div class="h-12 w-12 rounded-lg bg-red-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Total Products --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">总产品数</p>
                    <p class="mt-2 text-3xl font-bold text-gray-900">{{ $totalProducts }}</p>
                </div>
                <div class="h-12 w-12 rounded-lg bg-green-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Total Blog Posts --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">总博客数</p>
                    <p class="mt-2 text-3xl font-bold text-gray-900">{{ $totalBlogPosts }}</p>
                </div>
                <div class="h-12 w-12 rounded-lg bg-pink-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-[#FF008A]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Active Subscribers --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">活跃订阅者</p>
                    <p class="mt-2 text-3xl font-bold text-[#FF008A]">{{ $totalSubscribers }}</p>
                </div>
                <div class="h-12 w-12 rounded-lg bg-pink-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-[#FF008A]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Inquiries & Quick Actions --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Recent Inquiries --}}
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-900">最新询盘</h2>
                <a href="{{ route('admin.inquiries.index') }}" class="text-sm text-[#FF008A] hover:text-[#FF33A1] font-medium">查看全部</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">姓名</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">邮箱</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">日期</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">状态</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($recentInquiries as $inquiry)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                    <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="hover:text-[#FF008A]">
                                        {{ $inquiry->name }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $inquiry->email }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $inquiry->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4">
                                    @if($inquiry->is_read)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-700">已读</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-700">未读</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-sm text-gray-500">暂无询盘</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="text-lg font-semibold text-gray-900">快捷操作</h2>
            </div>
            <div class="p-6 space-y-3">
                <a href="{{ route('admin.products.create') }}" class="flex items-center gap-3 p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                    <svg class="w-5 h-5 text-[#FF008A]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                    <span class="text-sm font-medium text-gray-700">添加产品</span>
                </a>
                <a href="{{ route('admin.categories.create') }}" class="flex items-center gap-3 p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                    <svg class="w-5 h-5 text-[#FF008A]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                    <span class="text-sm font-medium text-gray-700">添加分类</span>
                </a>
                <a href="{{ route('admin.blog-posts.create') }}" class="flex items-center gap-3 p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                    <svg class="w-5 h-5 text-[#FF008A]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                    <span class="text-sm font-medium text-gray-700">写博客</span>
                </a>
                <a href="{{ route('admin.faqs.create') }}" class="flex items-center gap-3 p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                    <svg class="w-5 h-5 text-[#FF008A]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                    <span class="text-sm font-medium text-gray-700">添加FAQ</span>
                </a>
                <a href="{{ route('admin.inquiries.index') }}" class="flex items-center gap-3 p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                    <svg class="w-5 h-5 text-[#FF008A]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="text-sm font-medium text-gray-700">查看询盘</span>
                    @if($unreadInquiries > 0)
                        <span class="ml-auto inline-flex items-center justify-center h-5 min-w-5 px-1.5 rounded-full bg-red-500 text-white text-xs font-bold">{{ $unreadInquiries }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.subscribers.index') }}" class="flex items-center gap-3 p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                    <svg class="w-5 h-5 text-[#FF008A]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75"/>
                    </svg>
                    <span class="text-sm font-medium text-gray-700">订阅者管理</span>
                    @if($totalSubscribers > 0)
                        <span class="ml-auto inline-flex items-center justify-center h-5 min-w-5 px-1.5 rounded-full bg-[#FF008A] text-white text-xs font-bold">{{ $totalSubscribers }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 p-3 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                    <svg class="w-5 h-5 text-[#FF008A]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 010 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 010-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="text-sm font-medium text-gray-700">网站设置</span>
                </a>
            </div>
        </div>
    </div>
@endsection
