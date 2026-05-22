@extends('layouts.admin')

@section('title', '订阅者管理')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-semibold text-gray-900">订阅者管理</h2>
        <a href="{{ route('admin.subscribers.export') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-lg text-sm font-semibold hover:bg-green-700 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
            </svg>
            导出Excel
        </a>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">全部订阅者</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1">{{ $totalAll }}</p>
                </div>
                <div class="w-12 h-12 bg-pink-50 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-[#FF008A]" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">活跃订阅</p>
                    <p class="text-2xl font-bold text-green-600 mt-1">{{ $totalActive }}</p>
                </div>
                <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">已退订</p>
                    <p class="text-2xl font-bold text-gray-400 mt-1">{{ $totalInactive }}</p>
                </div>
                <div class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter Tabs --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-6">
        <div class="flex border-b border-gray-200">
            <a href="{{ route('admin.subscribers.index', ['filter' => 'all']) }}"
               class="px-6 py-3 text-sm font-medium {{ $filter === 'all' ? 'border-b-2 border-[#FF008A] text-[#FF008A]' : 'text-gray-500 hover:text-gray-700' }}">
                全部
            </a>
            <a href="{{ route('admin.subscribers.index', ['filter' => 'active']) }}"
               class="px-6 py-3 text-sm font-medium {{ $filter === 'active' ? 'border-b-2 border-[#FF008A] text-[#FF008A]' : 'text-gray-500 hover:text-gray-700' }}">
                活跃
            </a>
            <a href="{{ route('admin.subscribers.index', ['filter' => 'inactive']) }}"
               class="px-6 py-3 text-sm font-medium {{ $filter === 'inactive' ? 'border-b-2 border-[#FF008A] text-[#FF008A]' : 'text-gray-500 hover:text-gray-700' }}">
                已退订
            </a>
        </div>
    </div>

    {{-- Subscribers Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">邮箱</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">来源</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">订阅时间</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">状态</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">操作</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($subscribers as $subscriber)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $subscriber->id }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $subscriber->email }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                @if($subscriber->source === 'newsletter')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-700">Newsletter</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-700">{{ $subscriber->source }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $subscriber->subscribed_at?->format('Y-m-d H:i') ?? '-' }}</td>
                            <td class="px-6 py-4">
                                @if($subscriber->is_active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">活跃</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500">已退订</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <form action="{{ route('admin.subscribers.destroy', $subscriber) }}" method="POST" onsubmit="return confirm('确定要删除此订阅者吗？')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                        </svg>
                                        删除
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-sm text-gray-500">暂无订阅者</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($subscribers->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $subscribers->links() }}
            </div>
        @endif
    </div>

    {{-- Usage Tips --}}
    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-5">
        <h3 class="text-sm font-semibold text-blue-800 mb-2">💡 使用提示</h3>
        <ul class="text-sm text-blue-700 space-y-1">
            <li>• 点击「导出Excel」可将订阅者邮箱导出为 Excel 文件，方便导入到邮件营销平台</li>
            <li>• 支持的邮件营销平台：Mailchimp、SendGrid、阿里云邮件推送、Mailgun 等</li>
            <li>• 同一邮箱重复订阅不会重复记录，已退订用户重新订阅会自动激活</li>
        </ul>
    </div>
@endsection
