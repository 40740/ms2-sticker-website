@extends('layouts.admin')

@section('title', '询盘 #' . $inquiry->id)

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-lg font-semibold text-gray-900">询盘 #{{ $inquiry->id }}</h2>
        <a href="{{ route('admin.inquiries.index') }}" class="inline-flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
            </svg>
            返回询盘列表
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Main Content --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Contact Info --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-md font-semibold text-gray-800 mb-4">联系信息</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-medium text-gray-500 uppercase">姓名</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $inquiry->name }}</p>
                    </div>
                    <div>
                        <label class="text-xs font-medium text-gray-500 uppercase">邮箱</label>
                        <p class="mt-1 text-sm text-gray-900">
                            <a href="mailto:{{ $inquiry->email }}" class="text-[#FF008A] hover:text-[#FF33A1]">{{ $inquiry->email }}</a>
                        </p>
                    </div>
                    <div>
                        <label class="text-xs font-medium text-gray-500 uppercase">电话</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $inquiry->phone ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="text-xs font-medium text-gray-500 uppercase">来源页面</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $inquiry->page_source ?? '-' }}</p>
                    </div>
                </div>
            </div>

            {{-- Message --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-md font-semibold text-gray-800 mb-4">留言内容</h3>
                <div class="prose prose-sm max-w-none">
                    <p class="text-sm text-gray-700 whitespace-pre-wrap">{{ $inquiry->message }}</p>
                </div>
            </div>

            {{-- File Attachment --}}
            @if($inquiry->file_path)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-md font-semibold text-gray-800 mb-4">附件</h3>
                    <a href="{{ Storage::disk('uploads')->url($inquiry->file_path) }}" target="_blank"
                       class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                        </svg>
                        下载文件
                    </a>
                </div>
            @endif
        </div>

        {{-- Sidebar --}}
        <div class="space-y-6">
            {{-- Status --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-md font-semibold text-gray-800 mb-4">状态</h3>
                <div class="space-y-4">
                    <div>
                        <label class="text-xs font-medium text-gray-500 uppercase">提交时间</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $inquiry->created_at->format('M d, Y g:i A') }}</p>
                    </div>
                    <div>
                        <label class="text-xs font-medium text-gray-500 uppercase">阅读状态</label>
                        @if($inquiry->is_read)
                            <p class="mt-1">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">已读</span>
                            </p>
                        @else
                            <p class="mt-1">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-700">未读</span>
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-md font-semibold text-gray-800 mb-4">操作</h3>
                <div class="space-y-3">
                    @if(!$inquiry->is_read)
                        <form action="{{ route('admin.inquiries.update', $inquiry) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="is_read" value="1">
                            <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                                </svg>
                                标记为已读
                            </button>
                        </form>
                    @endif
                    <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST" onsubmit="return confirm('确定要删除此询盘吗？')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 bg-red-600 text-white rounded-lg text-sm font-semibold hover:bg-red-700 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                            </svg>
                            删除询盘
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
