<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MeisaiPrinting – Build Pipeline Test</title>

    @fonts

    <!-- Vite assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col">

    <!-- ═══════════════════════════════════════════
         HEADER / NAV
         ═══════════════════════════════════════════ -->
    <header class="w-full bg-white shadow-light sticky top-0 z-50">
        <nav class="max-w-6xl mx-auto flex items-center justify-between px-6 py-4"
             x-data="{ open: false }">
            <!-- Logo -->
            <a href="/" class="flex items-center gap-2 text-brand font-bold text-2xl">
                🐴 MeisaiPrinting
            </a>

            <!-- Desktop nav -->
            <div class="hidden tablet:flex items-center gap-6">
                <a href="#" class="nav-link">Home</a>
                <a href="#" class="nav-link">Shop</a>
                <a href="#" class="nav-link">About</a>
                <a href="#" class="btn-primary">Get Stickers</a>
            </div>

            <!-- Mobile hamburger -->
            <button class="tablet:hidden text-body" @click="open = !open">
                <svg x-show="!open" class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="open" x-transition class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </nav>

        <!-- Mobile menu (Alpine toggle) -->
        <div x-show="open"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="tablet:hidden bg-white px-6 pb-4 space-y-3 shadow-light">
            <a href="#" class="nav-link block py-2">Home</a>
            <a href="#" class="nav-link block py-2">Shop</a>
            <a href="#" class="nav-link block py-2">About</a>
            <a href="#" class="btn-primary block mt-2">Get Stickers</a>
        </div>
    </header>

    <!-- ═══════════════════════════════════════════
         HERO SECTION
         ═══════════════════════════════════════════ -->
    <section class="bg-brand py-20 text-white text-center">
        <div class="max-w-4xl mx-auto px-6">
            <h1 class="text-hero font-bold mb-4">MeisaiPrinting</h1>
            <p class="text-xl mb-8 opacity-90">Premium stickers for every surface. Express yourself.</p>
            <a href="#" class="bg-white text-brand font-semibold rounded-[35px] px-8 py-3 hover:bg-brand-hover hover:text-white transition-all duration-300 inline-block">
                Browse Collection
            </a>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════
         SWIPER CAROUSEL TEST
         ═══════════════════════════════════════════ -->
    <section class="py-16 bg-bg-body">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="section-heading text-center mb-10">Featured Stickers</h2>

            <div class="swiper" id="featured-carousel">
                <div class="swiper-wrapper">
                    <!-- Slide 1 -->
                    <div class="swiper-slide">
                        <div class="bg-white rounded-lg shadow-light p-6 text-center">
                            <div class="w-full h-48 bg-bg-form rounded flex items-center justify-center text-6xl mb-4">🎨</div>
                            <h3 class="product-title mb-2">Art Pack</h3>
                            <p class="text-body text-sm">12 premium art stickers</p>
                        </div>
                    </div>
                    <!-- Slide 2 -->
                    <div class="swiper-slide">
                        <div class="bg-white rounded-lg shadow-light p-6 text-center">
                            <div class="w-full h-48 bg-bg-form rounded flex items-center justify-center text-6xl mb-4">🚀</div>
                            <h3 class="product-title mb-2">Space Pack</h3>
                            <p class="text-body text-sm">15 galactic stickers</p>
                        </div>
                    </div>
                    <!-- Slide 3 -->
                    <div class="swiper-slide">
                        <div class="bg-white rounded-lg shadow-light p-6 text-center">
                            <div class="w-full h-48 bg-bg-form rounded flex items-center justify-center text-6xl mb-4">🐾</div>
                            <h3 class="product-title mb-2">Animal Pack</h3>
                            <p class="text-body text-sm">10 cute animal stickers</p>
                        </div>
                    </div>
                    <!-- Slide 4 -->
                    <div class="swiper-slide">
                        <div class="bg-white rounded-lg shadow-light p-6 text-center">
                            <div class="w-full h-48 bg-bg-form rounded flex items-center justify-center text-6xl mb-4">🎮</div>
                            <h3 class="product-title mb-2">Gamer Pack</h3>
                            <p class="text-body text-sm">8 gaming stickers</p>
                        </div>
                    </div>
                </div>
                <!-- Pagination -->
                <div class="swiper-pagination mt-6"></div>
                <!-- Navigation -->
                <div class="swiper-button-prev text-brand"></div>
                <div class="swiper-button-next text-brand"></div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════
         ALPINE.JS INTERACTIVE TEST
         ═══════════════════════════════════════════ -->
    <section class="py-16 bg-bg-form"
             x-data="{
                 stickers: [
                     { name: 'Rainbow Dash', price: 3.99, emoji: '🌈' },
                     { name: 'Star Burst', price: 2.99, emoji: '⭐' },
                     { name: 'Fire Flame', price: 4.49, emoji: '🔥' },
                     { name: 'Ocean Wave', price: 3.49, emoji: '🌊' },
                 ],
                 cart: [],
                 addToCart(sticker) {
                     this.cart.push(sticker);
                 },
                 get cartCount() { return this.cart.length; },
                 get cartTotal() { return this.cart.reduce((sum, s) => sum + s.price, 0).toFixed(2); }
             }">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="section-heading text-center mb-4">Sticker Picker <span class="text-brand">✨</span></h2>
            <p class="text-center text-body mb-10">Alpine.js interactive demo – click to add stickers to your cart!</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                <template x-for="sticker in stickers" :key="sticker.name">
                    <div class="bg-white rounded-lg shadow-light p-6 text-center hover:shadow-medium transition-all duration-300">
                        <div class="text-5xl mb-3" x-text="sticker.emoji"></div>
                        <h3 class="product-title text-lg mb-1" x-text="sticker.name"></h3>
                        <p class="text-brand font-bold mb-4">$<span x-text="sticker.price.toFixed(2)"></span></p>
                        <button class="btn-primary w-full" @click="addToCart(sticker)">Add to Cart</button>
                    </div>
                </template>
            </div>

            <!-- Cart summary -->
            <div class="bg-white rounded-lg shadow-medium p-6 text-center"
                 x-show="cartCount > 0"
                 x-transition>
                <h3 class="product-title mb-2">
                    🛒 Cart: <span x-text="cartCount"></span> item(s)
                </h3>
                <p class="text-brand text-2xl font-bold">$<span x-text="cartTotal"></span></p>
                <div class="mt-4 flex flex-wrap gap-2 justify-center">
                    <template x-for="(item, index) in cart" :key="index">
                        <span class="bg-brand/10 text-brand px-3 py-1 rounded-full text-sm" x-text="item.emoji + ' ' + item.name"></span>
                    </template>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════
         TAILWIND DESIGN TOKEN TEST
         ═══════════════════════════════════════════ -->
    <section class="py-16 bg-bg-body">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="section-heading text-center mb-10">Design Token Preview</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
                <div class="text-center">
                    <div class="w-full aspect-square rounded-lg bg-brand mb-2"></div>
                    <p class="text-xs text-body">Brand<br>#FF008A</p>
                </div>
                <div class="text-center">
                    <div class="w-full aspect-square rounded-lg bg-brand-hover mb-2"></div>
                    <p class="text-xs text-body">Brand Hover<br>#FF33A1</p>
                </div>
                <div class="text-center">
                    <div class="w-full aspect-square rounded-lg bg-brand-secondary-hover mb-2"></div>
                    <p class="text-xs text-body">Secondary<br>#0095F4</p>
                </div>
                <div class="text-center">
                    <div class="w-full aspect-square rounded-lg bg-accent mb-2"></div>
                    <p class="text-xs text-body">Accent<br>#0095F4</p>
                </div>
                <div class="text-center">
                    <div class="w-full aspect-square rounded-lg bg-dot-active mb-2"></div>
                    <p class="text-xs text-body">Dot Active<br>#C6E53A</p>
                </div>
                <div class="text-center">
                    <div class="w-full aspect-square rounded-lg bg-dot-inactive mb-2"></div>
                    <p class="text-xs text-body">Dot Inactive<br>#E6E6E6</p>
                </div>
            </div>

            <!-- Typography samples -->
            <div class="mt-10 space-y-4">
                <p class="text-hero font-bold text-box-title">Hero Title – 54px</p>
                <p class="text-page-title font-bold text-box-title">Page Title – 40px</p>
                <p class="text-section font-bold text-box-title">Section Heading – 28px</p>
                <p class="text-product font-semibold text-product-title">Product Title – 24px</p>
                <p class="text-feature font-semibold text-box-title">Feature Title – 20px</p>
                <p class="text-nav font-semibold text-body" style="font-family: var(--font-nav)">Nav Link – 18px Open Sans Semibold</p>
                <p class="text-base text-body">Body text at 16px using Muli font family for comfortable reading.</p>
                <p class="text-cta font-semibold">CTA Button Text – 14px</p>
            </div>

            <!-- Button samples -->
            <div class="mt-10 flex flex-wrap gap-4 items-center">
                <button class="btn-primary">Primary Pill Button</button>
                <button class="btn-submit">Submit Button</button>
                <span class="ml-4 text-sm text-body">
                    Shadow Light →
                    <span class="inline-block w-16 h-16 bg-white shadow-light rounded ml-2 align-middle"></span>
                </span>
                <span class="ml-4 text-sm text-body">
                    Shadow Medium →
                    <span class="inline-block w-16 h-16 bg-white shadow-medium rounded ml-2 align-middle"></span>
                </span>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════════════════════
         FOOTER
         ═══════════════════════════════════════════ -->
    <footer class="footer mt-auto">
        <div class="max-w-6xl mx-auto px-6 py-12">
            <div class="grid grid-cols-1 mobile:grid-cols-3 gap-8">
                <div>
                    <h4 class="footer-title text-lg mb-4">🐴 MeisaiPrinting</h4>
                    <p class="text-sm">Premium stickers for every surface. Express yourself with our curated collections.</p>
                </div>
                <div>
                    <h4 class="footer-title text-lg mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-brand transition-all duration-300">Home</a></li>
                        <li><a href="#" class="hover:text-brand transition-all duration-300">Shop</a></li>
                        <li><a href="#" class="hover:text-brand transition-all duration-300">About</a></li>
                        <li><a href="#" class="hover:text-brand transition-all duration-300">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="footer-title text-lg mb-4">Newsletter</h4>
                    <p class="text-sm mb-4">Get the latest sticker drops in your inbox.</p>
                    <form class="flex">
                        <input type="email" placeholder="Your email"
                               class="flex-1 px-4 py-3 bg-white/10 border border-footer-line text-white placeholder:text-footer-text rounded-none focus:outline-none focus:border-brand transition-all duration-300">
                        <button class="btn-submit">Subscribe</button>
                    </form>
                </div>
            </div>
            <hr class="footer-line my-8">
            <p class="text-center text-sm">&copy; 2025 MeisaiPrinting. All rights reserved.</p>
        </div>
    </footer>

    <!-- ═══════════════════════════════════════════
         SWIPER INIT
         ═══════════════════════════════════════════ -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof window.initSwiper === 'function') {
                window.initSwiper('#featured-carousel', {
                    slidesPerView: 1,
                    spaceBetween: 20,
                    breakpoints: {
                        640: { slidesPerView: 2 },
                        1024: { slidesPerView: 4 },
                    },
                });
            }
        });
    </script>

</body>
</html>
