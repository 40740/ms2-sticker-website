<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['transparentOnTop' => true]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['transparentOnTop' => true]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<header class="w-full fixed top-0 left-0 z-50 transition-all duration-300"
        :class="scrolled || !<?php echo e($transparentOnTop ? 'true' : 'false'); ?> ? 'bg-white shadow-light' : 'bg-transparent'"
        x-data="{ mobileOpen: false, searchOpen: false, quoteModalOpen: false, scrolled: window.scrollY > 50 }"
        x-init="
            window.addEventListener('scroll', () => { scrolled = window.scrollY > 50 });
            $nextTick(() => { document.documentElement.style.setProperty('--header-height', $el.offsetHeight + 'px') });
            new ResizeObserver(() => { document.documentElement.style.setProperty('--header-height', $el.offsetHeight + 'px') }).observe($el);
        "
        x-ref="headerEl"
        @open-quote-modal.window="quoteModalOpen = true">

    
    <div class="hidden tablet:block border-b transition-all duration-300"
         :class="scrolled || !<?php echo e($transparentOnTop ? 'true' : 'false'); ?> ? 'border-gray-100 bg-white' : 'border-transparent bg-transparent'">
        <div class="max-w-[1200px] mx-auto px-6 py-2 flex items-center justify-between text-sm">
            <div class="flex items-center gap-4" :class="scrolled || !<?php echo e($transparentOnTop ? 'true' : 'false'); ?> ? 'text-body' : 'text-white'">
                <a href="mailto:<?php echo e(\App\Models\Setting::get('contact_email', 'info@meisaiprinting.com')); ?>" class="flex items-center gap-1 hover:text-brand transition-all duration-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span><?php echo e(\App\Models\Setting::get('contact_email', 'info@meisaiprinting.com')); ?></span>
                </a>
                <a href="tel:<?php echo e(\App\Models\Setting::get('contact_phone', '+1-800-123-4567')); ?>" class="flex items-center gap-1 hover:text-brand transition-all duration-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    <span><?php echo e(\App\Models\Setting::get('contact_phone', '+1-800-123-4567')); ?></span>
                </a>
            </div>
            <div class="flex items-center gap-3" :class="scrolled || !<?php echo e($transparentOnTop ? 'true' : 'false'); ?> ? 'text-body' : 'text-white'">
                <a href="<?php echo e(\App\Models\Setting::get('social_facebook', '#')); ?>" class="hover:text-brand transition-all duration-300" aria-label="Facebook">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
                <a href="<?php echo e(\App\Models\Setting::get('social_instagram', '#')); ?>" class="hover:text-brand transition-all duration-300" aria-label="Instagram">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                </a>
                <a href="<?php echo e(\App\Models\Setting::get('social_youtube', '#')); ?>" class="hover:text-brand transition-all duration-300" aria-label="YouTube">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                </a>
                <a href="<?php echo e(\App\Models\Setting::get('social_tiktok', '#')); ?>" class="hover:text-brand transition-all duration-300" aria-label="TikTok">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                </a>
            </div>
        </div>
    </div>

    
    <nav class="max-w-[1200px] mx-auto px-6 py-4 flex items-center justify-between">
        
        <a href="/" class="flex items-center gap-2 shrink-0" aria-label="<?php echo e(\App\Models\Setting::get('site_name', 'MeisaiPrinting')); ?> Home">
            <?php
                $siteLogo = \App\Models\Setting::get('site_logo', '/images/logo.png');
                $siteName = \App\Models\Setting::get('site_name', 'MeisaiPrinting');
            ?>
            <?php if($siteLogo && $siteLogo !== '/images/logo.png'): ?>
                <img src="<?php echo e($siteLogo); ?>" alt="<?php echo e($siteName); ?>" class="h-10 w-auto transition-all duration-300"
                     onerror="this.onerror=null;this.src='/images/logo.png';">
            <?php else: ?>
                <img src="/images/logo.png" alt="<?php echo e($siteName); ?>" class="h-10 w-auto transition-all duration-300"
                     onerror="this.style.display='none';this.nextElementSibling.style.display='block';">
                <span class="text-2xl font-bold transition-colors duration-300"
                      :class="scrolled || !<?php echo e($transparentOnTop ? 'true' : 'false'); ?> ? 'text-brand' : 'text-white'"
                      style="display:none;">
                    <?php echo e($siteName); ?>

                </span>
            <?php endif; ?>
        </a>

        
        <div class="hidden tablet:flex items-center gap-8">
            
            <div class="relative" x-data="{ open: false, timer: null }"
                 @mouseenter="clearTimeout(timer); open = true" @mouseleave="timer = setTimeout(() => { open = false }, 150)">
                <button class="nav-link flex items-center gap-1 transition-colors duration-300"
                        :class="scrolled || !<?php echo e($transparentOnTop ? 'true' : 'false'); ?> ? 'text-body' : 'text-white'">
                    Material
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open"
                     x-cloak
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="absolute left-0 top-full mt-2 w-48 bg-white rounded-lg shadow-medium py-2 z-50">
                    <a href="/materials" class="block px-4 py-2 text-body hover:bg-bg-form hover:text-brand transition-colors">All Materials</a>
                    <a href="/materials/vinyl-stickers" class="block px-4 py-2 text-body hover:bg-bg-form hover:text-brand transition-colors">Vinyl Stickers</a>
                    <a href="/materials/pet-labels" class="block px-4 py-2 text-body hover:bg-bg-form hover:text-brand transition-colors">PET Labels</a>
                    <a href="/materials/pp-labels" class="block px-4 py-2 text-body hover:bg-bg-form hover:text-brand transition-colors">PP Labels</a>
                    <a href="/materials/kraft-labels" class="block px-4 py-2 text-body hover:bg-bg-form hover:text-brand transition-colors">Kraft Labels</a>
                    <a href="/materials/foil-labels" class="block px-4 py-2 text-body hover:bg-bg-form hover:text-brand transition-colors">Foil Labels</a>
                    <a href="/materials/transparent-labels" class="block px-4 py-2 text-body hover:bg-bg-form hover:text-brand transition-colors">Transparent</a>
                </div>
            </div>

            
            <div class="relative" x-data="{ open: false, timer: null }"
                 @mouseenter="clearTimeout(timer); open = true" @mouseleave="timer = setTimeout(() => { open = false }, 150)">
                <button class="nav-link flex items-center gap-1 transition-colors duration-300"
                        :class="scrolled || !<?php echo e($transparentOnTop ? 'true' : 'false'); ?> ? 'text-body' : 'text-white'">
                    Industry
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open"
                     x-cloak
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="absolute left-0 top-full mt-2 w-56 bg-white rounded-lg shadow-medium py-2 z-50">
                    <a href="/industries" class="block px-4 py-2 text-body hover:bg-bg-form hover:text-brand transition-colors">All Industries</a>
                    <a href="/industries/brewery-labels" class="block px-4 py-2 text-body hover:bg-bg-form hover:text-brand transition-colors">Breweries</a>
                    <a href="/industries/cosmetic-labels" class="block px-4 py-2 text-body hover:bg-bg-form hover:text-brand transition-colors">Cosmetics</a>
                    <a href="/industries/food-beverage-labels" class="block px-4 py-2 text-body hover:bg-bg-form hover:text-brand transition-colors">Food & Beverage</a>
                    <a href="/industries/pharma-labels" class="block px-4 py-2 text-body hover:bg-bg-form hover:text-brand transition-colors">Pharmaceutical</a>
                    <a href="/industries/cannabis-labels" class="block px-4 py-2 text-body hover:bg-bg-form hover:text-brand transition-colors">Cannabis</a>
                    <a href="/industries/amazon-labels" class="block px-4 py-2 text-body hover:bg-bg-form hover:text-brand transition-colors">Amazon Sellers</a>
                </div>
            </div>

            
            <div class="relative" x-data="{ open: false, timer: null }"
                 @mouseenter="clearTimeout(timer); open = true" @mouseleave="timer = setTimeout(() => { open = false }, 150)">
                <button class="nav-link flex items-center gap-1 transition-colors duration-300"
                        :class="scrolled || !<?php echo e($transparentOnTop ? 'true' : 'false'); ?> ? 'text-body' : 'text-white'">
                    Shape
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="open"
                     x-cloak
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     class="absolute left-0 top-full mt-2 w-48 bg-white rounded-lg shadow-medium py-2 z-50">
                    <a href="/shapes" class="block px-4 py-2 text-body hover:bg-bg-form hover:text-brand transition-colors">All Shapes</a>
                    <a href="/shapes/die-cut-stickers" class="block px-4 py-2 text-body hover:bg-bg-form hover:text-brand transition-colors">Die Cut</a>
                    <a href="/shapes/kiss-cut-stickers" class="block px-4 py-2 text-body hover:bg-bg-form hover:text-brand transition-colors">Kiss Cut</a>
                    <a href="/shapes/circle-stickers" class="block px-4 py-2 text-body hover:bg-bg-form hover:text-brand transition-colors">Circle</a>
                    <a href="/shapes/rectangle-stickers" class="block px-4 py-2 text-body hover:bg-bg-form hover:text-brand transition-colors">Rectangle</a>
                    <a href="/shapes/square-stickers" class="block px-4 py-2 text-body hover:bg-bg-form hover:text-brand transition-colors">Square</a>
                    <a href="/shapes/custom-shape-stickers" class="block px-4 py-2 text-body hover:bg-bg-form hover:text-brand transition-colors">Custom Shape</a>
                </div>
            </div>

            <a href="/pages/custom-stickers" class="nav-link transition-colors duration-300"
               :class="scrolled || !<?php echo e($transparentOnTop ? 'true' : 'false'); ?> ? 'text-body' : 'text-white'"
               aria-label="Custom Stickers">Custom Stickers</a>
            <a href="/pages/blank-labels" class="nav-link transition-colors duration-300"
               :class="scrolled || !<?php echo e($transparentOnTop ? 'true' : 'false'); ?> ? 'text-body' : 'text-white'"
               aria-label="Blank Labels">Blank Labels</a>
            <a href="/blog" class="nav-link transition-colors duration-300"
               :class="scrolled || !<?php echo e($transparentOnTop ? 'true' : 'false'); ?> ? 'text-body' : 'text-white'"
               aria-label="Blog">Blog</a>
            <a href="/pages/MeisaiPrinting" class="nav-link transition-colors duration-300"
               :class="scrolled || !<?php echo e($transparentOnTop ? 'true' : 'false'); ?> ? 'text-body' : 'text-white'"
               aria-label="About Us">About Us</a>
        </div>

        
        <div class="hidden tablet:flex items-center gap-4">
            
            <button @click="searchOpen = !searchOpen" class="transition-colors duration-300"
                    :class="scrolled || !<?php echo e($transparentOnTop ? 'true' : 'false'); ?> ? 'text-body hover:text-brand' : 'text-white hover:text-brand-hover'"
                    aria-label="Search">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </button>

            
            <button @click="quoteModalOpen = true"
                    class="cursor-pointer px-5 py-2 text-sm font-semibold rounded-lg bg-[#D3E945] text-[#1D2B36] hover:bg-[#c5dd3a] hover:shadow-md hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300">
                Custom Stickers
            </button>
        </div>

        
        <button class="tablet:hidden transition-colors duration-300"
                :class="scrolled || !<?php echo e($transparentOnTop ? 'true' : 'false'); ?> ? 'text-body' : 'text-white'"
                @click="mobileOpen = !mobileOpen"
                aria-label="Toggle mobile menu">
            <svg x-show="!mobileOpen" class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            <svg x-show="mobileOpen" x-transition class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </nav>

    
    <div x-show="mobileOpen"
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="tablet:hidden bg-white px-6 pb-6 space-y-3 shadow-medium"
         @click.away="mobileOpen = false">
        <a href="/" class="nav-link block py-3 border-b border-gray-100">Home</a>
        <a href="/materials" class="nav-link block py-3 border-b border-gray-100">Material</a>
        <a href="/industries" class="nav-link block py-3 border-b border-gray-100">Industry</a>
        <a href="/shapes" class="nav-link block py-3 border-b border-gray-100">Shape</a>
        <a href="/pages/custom-stickers" class="nav-link block py-3 border-b border-gray-100">Custom Stickers</a>
        <a href="/pages/blank-labels" class="nav-link block py-3 border-b border-gray-100">Blank Labels</a>
        <a href="/pages/MeisaiPrinting" class="nav-link block py-3 border-b border-gray-100">About Us</a>
        <a href="/blog" class="nav-link block py-3 border-b border-gray-100">Blog</a>
        <button @click="quoteModalOpen = true; mobileOpen = false" class="w-full mt-4 px-5 py-3 text-sm font-semibold rounded-lg bg-[#D3E945] text-[#1D2B36] hover:bg-[#c5dd3a] hover:shadow-md text-center cursor-pointer transition-all duration-300">Get a Quote</button>
    </div>

    
    <div x-show="searchOpen"
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="absolute top-full left-0 w-full bg-white shadow-medium py-6 z-50"
         @click.away="searchOpen = false">
        <div class="max-w-[1200px] mx-auto px-6">
            <form action="/search" method="GET" class="flex items-center gap-4">
                <div class="flex-1 relative">
                    <input type="text"
                           name="q"
                           placeholder="Search for stickers, labels, and more..."
                           class="w-full px-5 py-3 bg-bg-form border-0 rounded-none text-body focus:outline-none focus:ring-2 focus:ring-brand text-base"
                           x-ref="searchInput"
                           @keydown.escape="searchOpen = false"
                           autofocus>
                </div>
                <button type="submit" class="btn-primary px-6 py-3">Search</button>
                <button type="button" @click="searchOpen = false" class="text-body hover:text-brand transition-all duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>

    
    <div x-show="quoteModalOpen"
         x-effect="document.body.style.overflow = quoteModalOpen ? 'hidden' : ''"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         x-cloak
         class="fixed inset-0 z-[9999] flex items-center justify-center p-4"
         @keydown.escape.window="quoteModalOpen = false">

        
        <div class="absolute inset-0 bg-black/50" @click="quoteModalOpen = false"></div>

        
        <div x-show="quoteModalOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="relative bg-white w-full max-w-2xl max-h-[90vh] overflow-y-auto shadow-medium z-10"
             @click.stop>

            
            <button @click="quoteModalOpen = false"
                    class="absolute top-4 right-4 text-gray-400 hover:text-body transition-all duration-300 z-10"
                    aria-label="Close">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            
            <div class="p-8 mobile:p-10" x-data="quoteForm('custom-stickers-button')">

                
                <div class="text-center mb-8 pr-8">
                    <h2 class="section-heading mb-3">Expects To Provide You With Perfect Service</h2>
                    <p class="text-body text-base max-w-xl mx-auto">Fill out the form below and our team will get back to you within 24 hours with a custom quote tailored to your needs.</p>
                </div>

                
                <div x-show="success" x-transition class="mb-6 p-4 bg-dot-active/10 border border-dot-active/30 text-green-800 text-center">
                    <div class="flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="font-semibold">Thank you! Your inquiry has been submitted successfully. We'll get back to you soon.</span>
                    </div>
                </div>

                
                <div x-show="error" x-transition class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 text-center">
                    <span x-text="error"></span>
                </div>

                <div class="grid grid-cols-1 mobile:grid-cols-2 gap-6">
                    
                    <div>
                        <label for="modal-quote-name" class="block text-sm font-semibold text-box-title mb-2">
                            Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               id="modal-quote-name"
                               x-model="form.name"
                               class="w-full px-4 py-3 bg-bg-form border border-gray-200 text-body focus:outline-none focus:border-brand focus:ring-1 focus:ring-brand transition-all duration-300"
                               placeholder="Your full name"
                               required>
                        <p x-show="errors.name" x-text="errors.name" class="text-red-500 text-xs mt-1"></p>
                    </div>

                    
                    <div>
                        <label for="modal-quote-email" class="block text-sm font-semibold text-box-title mb-2">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email"
                               id="modal-quote-email"
                               x-model="form.email"
                               class="w-full px-4 py-3 bg-bg-form border border-gray-200 text-body focus:outline-none focus:border-brand focus:ring-1 focus:ring-brand transition-all duration-300"
                               placeholder="your@email.com"
                               required>
                        <p x-show="errors.email" x-text="errors.email" class="text-red-500 text-xs mt-1"></p>
                    </div>

                    
                    <div>
                        <label for="modal-quote-phone" class="block text-sm font-semibold text-box-title mb-2">
                            Phone Number
                        </label>
                        <input type="tel"
                               id="modal-quote-phone"
                               x-model="form.phone"
                               class="w-full px-4 py-3 bg-bg-form border border-gray-200 text-body focus:outline-none focus:border-brand focus:ring-1 focus:ring-brand transition-all duration-300"
                               placeholder="+1 (555) 000-0000">
                        <p x-show="errors.phone" x-text="errors.phone" class="text-red-500 text-xs mt-1"></p>
                    </div>

                    
                    <div>
                        <label for="modal-quote-design" class="block text-sm font-semibold text-box-title mb-2">
                            Upload Design
                        </label>
                        <div class="relative w-full">
                            <input type="file"
                                   id="modal-quote-design"
                                   @change="handleFileSelect($event)"
                                   accept=".ai,.eps,.pdf,.png,.jpg,.jpeg,.svg,.psd,.cdr"
                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            <div class="w-full px-4 py-3 bg-bg-form border border-gray-200 border-dashed text-body flex items-center justify-between cursor-pointer hover:border-brand transition-all duration-300">
                                <span class="truncate text-sm" :class="fileName ? 'text-box-title' : 'text-gray-400'" x-text="fileName || 'Choose file (AI, EPS, PDF, PNG, JPG, SVG)'"></span>
                                <svg class="w-5 h-5 text-gray-400 shrink-0 ml-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    
                    <div class="mobile:col-span-2">
                        <label for="modal-quote-message" class="block text-sm font-semibold text-box-title mb-2">
                            Message
                        </label>
                        <textarea id="modal-quote-message"
                                  x-model="form.message"
                                  rows="4"
                                  class="w-full px-4 py-3 bg-bg-form border border-gray-200 text-body focus:outline-none focus:border-brand focus:ring-1 focus:ring-brand transition-all duration-300 resize-vertical"
                                  placeholder="Tell us about your project – size, quantity, material, special requirements..."></textarea>
                    </div>
                </div>

                
                <div class="mt-8 text-center">
                    <button type="button"
                            @click="submitForm()"
                            class="btn-submit px-12 py-4 text-base"
                            :disabled="loading"
                            :class="loading ? 'opacity-70 cursor-not-allowed' : ''">
                        <span x-show="!loading">Submit Inquiry</span>
                        <span x-show="loading" class="flex items-center justify-center gap-2">
                            <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Submitting...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>

<?php if (! $__env->hasRenderedOnce('c57a5c0c-6549-4adc-b357-7862ebd235d4')): $__env->markAsRenderedOnce('c57a5c0c-6549-4adc-b357-7862ebd235d4'); ?>
<?php $__env->startPush('inline-scripts'); ?>
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('quoteForm', (source) => ({
        form: {
            name: '',
            email: '',
            phone: '',
            message: '',
            design: null,
            page_source: source
        },
        fileName: '',
        loading: false,
        success: false,
        error: '',
        errors: {},
        validate() {
            this.errors = {};
            if (!this.form.name.trim()) this.errors.name = 'Name is required';
            if (!this.form.email.trim()) {
                this.errors.email = 'Email is required';
            } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.form.email)) {
                this.errors.email = 'Please enter a valid email address';
            }
            if (this.form.phone.trim() && !/^[0-9+\-\(\)\s]+$/.test(this.form.phone.trim())) {
                this.errors.phone = 'Phone number must contain only numbers and valid phone characters';
            }
            return Object.keys(this.errors).length === 0;
        },
        submitForm() {
            if (!this.validate()) return;
            this.loading = true;
            this.error = '';
            this.success = false;

            const data = new FormData();
            data.append('name', this.form.name);
            data.append('email', this.form.email);
            data.append('phone', this.form.phone);
            data.append('message', this.form.message);
            data.append('page_source', this.form.page_source);
            if (this.form.design) data.append('design', this.form.design);

            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            fetch('/inquiry', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken ? csrfToken.getAttribute('content') : '',
                    'Accept': 'application/json'
                },
                body: data
            })
            .then(response => {
                this.loading = false;
                if (response.ok) {
                    this.success = true;
                    this.form = { name: '', email: '', phone: '', message: '', design: null, page_source: source };
                    this.fileName = '';
                } else {
                    return response.json().then(data => {
                        if (data.errors) {
                            this.errors = data.errors;
                        } else {
                            this.error = data.message || 'Something went wrong. Please try again.';
                        }
                    });
                }
            })
            .catch(() => {
                this.loading = false;
                this.error = 'Network error. Please check your connection and try again.';
            });
        },
        handleFileSelect(event) {
            const file = event.target.files[0];
            if (file) {
                this.form.design = file;
                this.fileName = file.name;
            }
        }
    }));
});
</script>
<?php $__env->stopPush(); ?>
<?php endif; ?>
<?php /**PATH D:\laragon\www\ms2\resources\views/components/header.blade.php ENDPATH**/ ?>