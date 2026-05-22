<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO Meta Tags --}}
    <title>{{ $seoTitle ?? \App\Models\Setting::get('site_title', \App\Models\Setting::get('site_name', 'MeisaiPrinting') . ' – Custom Sticker & Label Printing') }}</title>
    <meta name="description" content="{{ $seoDescription ?? \App\Models\Setting::get('site_description', 'Professional custom sticker and label printing. 24 years of experience. FSC, UL, CSA certified. Factory direct pricing.') }}">
    <meta name="keywords" content="{{ $seoKeywords ?? \App\Models\Setting::get('site_keywords', 'custom stickers, custom labels, sticker printing, label printing, adhesive stickers') }}">

    {{-- Open Graph --}}
    <meta property="og:title" content="{{ $seoTitle ?? \App\Models\Setting::get('site_title', 'MeisaiPrinting') }}">
    <meta property="og:description" content="{{ $seoDescription ?? \App\Models\Setting::get('site_description', '') }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $canonicalUrl ?? url()->current() }}">
    <meta property="og:image" content="{{ $ogImage ?? asset(\App\Models\Setting::get('site_logo', '/images/logo.png')) }}">
    <meta property="og:site_name" content="{{ \App\Models\Setting::get('site_name', 'MeisaiPrinting') }}">
    <meta property="og:locale" content="en_US">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoTitle ?? \App\Models\Setting::get('site_title', 'MeisaiPrinting') }}">
    <meta name="twitter:description" content="{{ $seoDescription ?? \App\Models\Setting::get('site_description', '') }}">
    <meta name="twitter:image" content="{{ $ogImage ?? asset(\App\Models\Setting::get('site_logo', '/images/logo.png')) }}">

    {{-- Canonical --}}
    <link rel="canonical" href="{{ $canonicalUrl ?? url()->current() }}">

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    {{-- Google Fonts (self-hosted via Vite Bunny plugin — CDN link removed to avoid duplicate loading) --}}

    {{-- Alpine x-cloak: hide elements until Alpine initializes (must be before Vite CSS to prevent flash) --}}
    <style>[x-cloak] { display: none !important; }</style>

    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Organization Structured Data (JSON-LD) --}}
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "Organization",
        "name": "{{ \App\Models\Setting::get('site_name', 'MeisaiPrinting') }}",
        "url": "{{ url('/') }}",
        "logo": "{{ asset(\App\Models\Setting::get('site_logo', '/images/logo.png')) }}",
        "description": "{{ \App\Models\Setting::get('site_description', 'Professional custom sticker and label printing manufacturer.') }}",
        "contactPoint": {
            "@@type": "ContactPoint",
            "telephone": "{{ \App\Models\Setting::get('contact_phone', '') }}",
            "email": "{{ \App\Models\Setting::get('contact_email', '') }}",
            "contactType": "sales"
        }
    }
    </script>

    @stack('styles')
</head>
<body class="min-h-screen flex flex-col">

    {{-- Header --}}
    <x-header :transparent-on-top="$transparentOnTop ?? true" />

    {{-- Main Content --}}
    {{-- When header is not transparent (fixed solid navbar), push content down to avoid being hidden behind it --}}
    @php $needsHeaderOffset = !($transparentOnTop ?? true); @endphp

    @if($needsHeaderOffset)
    {{-- Measure actual header height right after the header is in the DOM, before main content renders --}}
    <script>
    (function() {
        var header = document.querySelector('header');
        if (header) {
            document.documentElement.style.setProperty('--header-height', header.offsetHeight + 'px');
        }
        // Keep in sync with resize (e.g. window resize changes topbar visibility)
        window.addEventListener('resize', function() {
            var h = document.querySelector('header');
            if (h) document.documentElement.style.setProperty('--header-height', h.offsetHeight + 'px');
        });
        // Final pass after everything loads (fonts may shift layout)
        window.addEventListener('load', function() {
            var h = document.querySelector('header');
            if (h) document.documentElement.style.setProperty('--header-height', h.offsetHeight + 'px');
        });
    })();
    </script>
    @endif

    <main class="flex-1 {{ $needsHeaderOffset ? 'main-with-header-offset' : '' }}">
        @yield('content')
    </main>

    {{-- Footer --}}
    <x-footer />

    {{-- Floating Action Buttons --}}
    @php
        $chatAppType = \App\Models\Setting::get('chat_app_type', 'whatsapp');
        $chatAppNumber = \App\Models\Setting::get('chat_app_number', '');
        $chatAppUrl = '#';
        $chatAppLabel = 'Chat';
        if ($chatAppNumber) {
            switch ($chatAppType) {
                case 'whatsapp':
                    $chatAppUrl = 'https://wa.me/' . preg_replace('/[^0-9]/', '', $chatAppNumber);
                    $chatAppLabel = 'WhatsApp';
                    break;
                case 'messenger':
                    $chatAppUrl = 'https://m.me/' . $chatAppNumber;
                    $chatAppLabel = 'Messenger';
                    break;
                case 'telegram':
                    $chatAppUrl = 'https://t.me/' . ltrim($chatAppNumber, '@');
                    $chatAppLabel = 'Telegram';
                    break;
                case 'wechat':
                    $chatAppUrl = '#';
                    $chatAppLabel = 'WeChat';
                    break;
                case 'line':
                    $chatAppUrl = 'https://line.me/ti/p/' . $chatAppNumber;
                    $chatAppLabel = 'LINE';
                    break;
            }
        }
    @endphp
    <div id="floating-actions" class="fixed bottom-6 right-6 z-50 flex flex-col gap-3"
         x-data="{ showTop: window.scrollY > 400 }"
         x-init="window.addEventListener('scroll', () => { showTop = window.scrollY > 400 })">

        {{-- Back to Top --}}
        <button x-show="showTop"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-2"
                x-cloak
                @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
                class="bg-white w-14 h-14 rounded-full flex items-center justify-center shadow-medium hover:scale-110 transition-all duration-300 text-body hover:text-brand border border-gray-200"
                aria-label="Back to Top">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/>
            </svg>
        </button>

        {{-- Chat / Messaging App Button --}}
        @if($chatAppNumber)
            @if($chatAppType === 'wechat')
                <button x-data="{ wechatTip: false }"
                        @click="wechatTip = !wechatTip"
                        class="btn-primary w-14 h-14 rounded-full flex items-center justify-center shadow-medium hover:scale-110 transition-all duration-300 relative"
                        aria-label="{{ $chatAppLabel }}">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M8.691 2.188C3.891 2.188 0 5.476 0 9.53c0 2.212 1.17 4.203 3.002 5.55a.59.59 0 01.213.665l-.39 1.48c-.019.07-.048.141-.048.213 0 .163.13.295.29.295a.326.326 0 00.167-.054l1.903-1.114a.864.864 0 01.717-.098 10.16 10.16 0 002.837.403c.276 0 .543-.027.811-.05-.857-2.578.157-4.972 1.932-6.446 1.703-1.415 3.882-1.98 5.853-1.838-.576-3.583-4.196-6.348-8.596-6.348zM5.785 5.991c.642 0 1.162.529 1.162 1.18a1.17 1.17 0 01-1.162 1.178A1.17 1.17 0 014.623 7.17c0-.651.52-1.18 1.162-1.18zm5.813 0c.642 0 1.162.529 1.162 1.18a1.17 1.17 0 01-1.162 1.178 1.17 1.17 0 01-1.162-1.178c0-.651.52-1.18 1.162-1.18zm3.2 4.127c-3.997 0-7.242 2.697-7.242 6.03 0 3.334 3.245 6.03 7.242 6.03.67 0 1.32-.073 1.942-.21a.717.717 0 01.59.082l1.558.913a.27.27 0 00.136.045c.131 0 .238-.108.238-.243 0-.059-.023-.117-.039-.174l-.319-1.212a.488.488 0 01.175-.546C20.424 19.825 21.398 18.067 21.398 16.148c0-3.333-3.245-6.03-7.242-6.03h.642zm-2.24 3.132c.526 0 .952.434.952.965a.959.959 0 01-.952.966.959.959 0 01-.952-.966c0-.531.426-.965.952-.965zm4.482 0c.526 0 .952.434.952.965a.959.959 0 01-.952.966.959.959 0 01-.952-.966c0-.531.426-.965.952-.965z"/>
                    </svg>
                    {{-- WeChat tip (since there's no direct URL) --}}
                    <div x-show="wechatTip"
                         x-transition
                         @click.away="wechatTip = false"
                         class="absolute bottom-full right-0 mb-2 bg-white text-body text-sm px-4 py-3 rounded-lg shadow-medium whitespace-nowrap border border-gray-100">
                        微信号: <strong>{{ $chatAppNumber }}</strong>
                        <div class="absolute -bottom-1 right-5 w-2 h-2 bg-white border-r border-b border-gray-100 transform rotate-45"></div>
                    </div>
                </button>
            @else
                <a href="{{ $chatAppUrl }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="btn-primary w-14 h-14 rounded-full flex items-center justify-center shadow-medium hover:scale-110 transition-all duration-300"
                   aria-label="{{ $chatAppLabel }}">
                    @if($chatAppType === 'whatsapp')
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                    @elseif($chatAppType === 'messenger')
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M.001 11.639C.001 4.949 5.241 0 12.001 0S24 4.95 24 11.639c0 6.689-5.24 11.638-12 11.638-1.21 0-2.38-.16-3.47-.46a.96.96 0 00-.64.05l-2.39 1.05a.96.96 0 01-1.35-.85l-.07-2.14a.97.97 0 00-.32-.68A11.39 11.389 0 01.002 11.64zm8.32-2.19l-3.52 5.6c-.35.53.32 1.139.82.75l3.79-2.87c.26-.2.6-.2.87 0l2.8 2.1c.84.63 2.04.4 2.6-.48l3.52-5.6c.35-.53-.32-1.13-.82-.75l-3.79 2.87c-.25.2-.6.2-.86 0l-2.8-2.1a1.8 1.8 0 00-2.61.48z"/>
                        </svg>
                    @elseif($chatAppType === 'telegram')
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M11.944 0A12 12 0 000 12a12 12 0 0012 12 12 12 0 0012-12A12 12 0 0012 0a12 12 0 00-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 01.171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
                        </svg>
                    @elseif($chatAppType === 'line')
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19.365 9.863c.349 0 .63.285.63.631 0 .345-.281.63-.63.63H17.61v1.125h1.755c.349 0 .63.283.63.63 0 .344-.281.629-.63.629h-2.386c-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.63-.63h2.386c.346 0 .627.285.627.63 0 .349-.281.63-.63.63H17.61v1.125h1.755zm-3.855 3.016c0 .27-.174.51-.432.596-.064.021-.133.031-.199.031-.194 0-.378-.104-.484-.27l-1.897-2.607v2.25c0 .349-.281.63-.63.63-.345 0-.627-.281-.627-.63V8.108c0-.27.173-.51.43-.595.06-.023.136-.033.194-.033.195 0 .378.106.484.272l1.9 2.61V8.108c0-.345.282-.63.63-.63.345 0 .63.285.63.63v4.771zm-5.741 0c0 .349-.282.63-.631.63-.345 0-.627-.281-.627-.63V8.108c0-.345.282-.63.63-.63.346 0 .628.285.628.63v4.771zm-2.466.63H4.917c-.345 0-.63-.281-.63-.63V8.108c0-.345.285-.63.63-.63.348 0 .63.285.63.63v4.141h1.756c.348 0 .629.283.629.63 0 .344-.282.629-.629.629M24 10.314C24 4.943 18.615.572 12 .572S0 4.943 0 10.314c0 4.811 4.27 8.842 10.035 9.608.391.082.923.258 1.058.59.12.301.079.766.038 1.08l-.164 1.02c-.045.301-.24 1.186 1.049.645 1.291-.539 6.916-4.078 9.436-6.975C23.176 14.393 24 12.458 24 10.314"/>
                        </svg>
                    @else
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    @endif
                </a>
            @endif
        @else
            <a href="#"
               class="btn-primary w-14 h-14 rounded-full flex items-center justify-center shadow-medium hover:scale-110 transition-all duration-300 opacity-50 cursor-not-allowed"
               aria-label="Chat"
               title="请在后台设置即时通讯号码">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
            </a>
        @endif
    </div>

    {{-- Cookie Consent Banner --}}
    <x-cookie-consent />

    @stack('scripts')
    @stack('inline-scripts')
</body>
</html>
