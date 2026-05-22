<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', '控制面板') – MeisaiPrinting 管理后台</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="min-h-screen bg-gray-100" x-data="{ sidebarOpen: false }">

    {{-- Mobile overlay --}}
    <div class="fixed inset-0 z-30 bg-black/50 lg:hidden"
         x-show="sidebarOpen"
         x-transition:enter="transition-opacity ease-linear duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="sidebarOpen = false"
         x-cloak></div>

    {{-- Sidebar --}}
    <aside class="fixed top-0 left-0 z-40 h-screen w-[250px] transition-transform lg:translate-x-0"
           :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
           style="background-color: #1D2B36;">

        {{-- Logo --}}
        <div class="flex h-16 items-center px-6 border-b border-white/10">
            <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold text-white tracking-wide">
                MS <span class="text-[#FF008A]">管理后台</span>
            </a>
        </div>

        {{-- Navigation --}}
        <nav class="mt-6 px-3 space-y-1 overflow-y-auto" style="max-height: calc(100vh - 140px);">
            @php
                $navItems = [
                    ['route' => 'admin.dashboard', 'label' => '控制面板', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/>'],
                    ['route' => 'admin.settings.index', 'label' => '网站设置', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 010 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 010-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>'],
                    ['route' => 'admin.categories.index', 'label' => '分类管理', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 010 3.75H5.625a1.875 1.875 0 010-3.75z"/>'],
                    ['route' => 'admin.products.index', 'label' => '产品管理', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/>'],
                    ['route' => 'admin.faqs.index', 'label' => 'FAQ管理', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"/>'],
                    ['route' => 'admin.inquiries.index', 'label' => '询盘管理', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>'],
                    ['route' => 'admin.subscribers.index', 'label' => '订阅者管理', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75"/>'],
                    ['route' => 'admin.blog-posts.index', 'label' => '博客管理', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z"/>'],
                    ['route' => 'admin.certificates.index', 'label' => '证书管理', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>'],
                    ['route' => 'admin.brands.index', 'label' => '品牌管理', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.15c0 .415.336.75.75.75z"/>'],
                    ['route' => 'admin.team-members.index', 'label' => '团队成员', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>'],
                ];
            @endphp

            @foreach ($navItems as $item)
                @php $isActive = request()->routeIs($item['route']) || request()->routeIs($item['route'] . '.*') @endphp
                <a href="{{ route($item['route']) }}"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors duration-150
                          {{ $isActive ? 'bg-white/15 text-white' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        {!! $item['icon'] !!}
                    </svg>
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

        {{-- Bottom links --}}
        <div class="absolute bottom-0 left-0 right-0 p-3 border-t border-white/10 space-y-1">
            <a href="{{ url('/') }}" target="_blank"
               class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-300 hover:bg-white/10 hover:text-white transition-colors duration-150">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/>
                </svg>
                查看网站
            </a>
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit"
                        class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-gray-300 hover:bg-white/10 hover:text-red-400 transition-colors duration-150">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/>
                    </svg>
                    退出登录
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Content --}}
    <div class="lg:ml-[250px]">

        {{-- Top Bar --}}
        <header class="sticky top-0 z-20 flex h-16 items-center justify-between border-b border-gray-200 bg-white px-4 lg:px-8">
            {{-- Mobile menu button --}}
            <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 rounded-lg text-gray-500 hover:bg-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                </svg>
            </button>

            <h1 class="text-lg font-semibold text-gray-800">@yield('title', '控制面板')</h1>

            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-500">{{ auth()->user()?->name ?? '管理员' }}</span>
                <div class="h-8 w-8 rounded-full bg-[#FF008A] flex items-center justify-center text-white text-sm font-bold">
                    {{ strtoupper(substr(auth()->user()?->name ?? '管', 0, 1)) }}
                </div>
            </div>
        </header>

        {{-- Flash Messages --}}
        <div class="px-4 lg:px-8 pt-4">
            @if(session('success'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                     class="mb-4 flex items-center gap-2 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-800">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                     class="mb-4 flex items-center gap-2 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-800">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif
        </div>

        {{-- Page Content --}}
        <main class="p-4 lg:p-8">
            @yield('content')
        </main>

        {{-- Global Footer Disclaimer --}}
        <footer class="border-t border-gray-200 bg-white px-4 py-4 lg:px-8">
            <div class="flex flex-col items-center gap-1 text-center">
                <p class="text-xs text-gray-400 leading-relaxed">
                    ⚠️ 本网站后台仅供 MeisaiPrinting 内部人员使用，未经许可擅自入侵是违法行为。若非法入侵，系统将自动记录入侵信息并提交相关司法机关。
                </p>
                <p class="text-xs text-gray-500">
                    如遇技术问题请联系：微信 <span class="font-medium text-gray-600">bmsslin</span>
                </p>
            </div>
        </footer>
    </div>

    @stack('scripts')
</body>
</html>
