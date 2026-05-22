@extends('layouts.app', [
    'seoTitle' => 'Custom Shapes – MeisaiPrinting',
    'seoDescription' => 'Custom die-cut, kiss-cut, and shaped stickers and labels. Circle, square, heart, and any custom shape you need.',
    'transparentOnTop' => false,
])

@section('content')
    {{-- 1. Breadcrumb --}}
    <div class="max-w-[1200px] mx-auto px-6">
        <x-breadcrumb :items="[
            ['title' => 'Shapes'],
        ]" />
    </div>

    {{-- 2. Hero Banner --}}
    <section class="relative w-full h-[400px] mobile:h-[500px] overflow-hidden">
        <div class="absolute inset-0">
            <img src="/images/shapes-hero.jpg"
                 alt="Custom Shapes"
                 class="w-full h-full object-cover"
                 loading="eager">
            <div class="absolute inset-0 bg-black/45"></div>
        </div>

        <div class="relative z-10 h-full flex items-center justify-center text-center">
            <div class="max-w-[800px] mx-auto px-6">
                <h1 class="text-white text-3xl mobile:text-4xl tablet:text-hero font-bold leading-tight mb-4">
                    Any Shape You Can Imagine
                </h1>
                <p class="text-white/85 text-lg mobile:text-xl mb-6 max-w-xl mx-auto">
                    From classic circles to custom die-cut shapes, bring your brand to life with perfectly shaped stickers and labels.
                </p>
                <a href="#quote-form" class="btn-primary inline-block text-base px-10 py-4">
                    Design Your Shape
                </a>
            </div>
        </div>
    </section>

    {{-- 3. Intro Text --}}
    <section class="py-16 bg-white">
        <div class="max-w-[1200px] mx-auto px-6">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-[58px] font-bold text-[#222] leading-tight mb-6">
                    Custom Shapes for Every Need
                </h2>
                <p class="text-body text-base leading-relaxed mb-8">
                    At MeisaiPrinting, we offer an incredible variety of shapes for your custom stickers and labels. Whether you need standard shapes like circles, squares, or ovals, or want something unique like custom die-cut shapes that match your logo, we have the capabilities to make it happen. Our advanced cutting technology ensures precise, professional results every time, while our variety of materials ensures your shaped stickers look great and last long.
                </p>
                <a href="#quote-form" class="btn-primary inline-block text-base px-10 py-4">
                    Get a Custom Quote
                </a>
            </div>
        </div>
    </section>

    {{-- 4. Trust Badges --}}
    <x-trust-badges />

    {{-- 5. Sticker Shapes Grid --}}
    @if($stickerShapes->count() > 0)
        <section class="py-16 bg-white">
            <div class="max-w-[1200px] mx-auto px-6">
                <div class="text-center mb-12">
                    <h2 class="section-heading mb-4">Sticker Shapes</h2>
                    <p class="text-body text-base max-w-2xl mx-auto">
                        Perfect for promotional stickers, product labels, and branding applications.
                    </p>
                </div>

                <div class="grid grid-cols-2 tablet:grid-cols-4 gap-6">
                    @foreach($stickerShapes as $category)
                        @php
                            $linkUrl = '/shapes/' . $category->slug;
                            $categoryImage = $category->image;
                            if ($categoryImage && !str_starts_with($categoryImage, '/') && !str_starts_with($categoryImage, 'http')) {
                                $categoryImage = '/' . ltrim($categoryImage, '/');
                            }
                            if (!$categoryImage) {
                                $categoryImage = '/images/category-placeholder.jpg';
                            }
                        @endphp
                        <a href="{{ $linkUrl }}" class="group block">
                            <div class="overflow-hidden rounded-lg bg-bg-form shadow-light hover:shadow-medium transition-all duration-300">
                                <div class="relative overflow-hidden aspect-square">
                                    <img src="{{ $categoryImage }}"
                                         alt="{{ $category->name }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                         loading="lazy">
                                </div>
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-black text-center truncate">
                                        {{ $category->name }}
                                    </h3>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- 6. Label Shapes Grid --}}
    @if($labelShapes->count() > 0)
        <section class="py-16 bg-bg-form">
            <div class="max-w-[1200px] mx-auto px-6">
                <div class="text-center mb-12">
                    <h2 class="section-heading mb-4">Label Shapes</h2>
                    <p class="text-body text-base max-w-2xl mx-auto">
                        Ideal for product labels, packaging, and industrial applications.
                    </p>
                </div>

                <div class="grid grid-cols-2 tablet:grid-cols-4 gap-6">
                    @foreach($labelShapes as $category)
                        @php
                            $linkUrl = '/shapes/' . $category->slug;
                            $categoryImage = $category->image;
                            if ($categoryImage && !str_starts_with($categoryImage, '/') && !str_starts_with($categoryImage, 'http')) {
                                $categoryImage = '/' . ltrim($categoryImage, '/');
                            }
                            if (!$categoryImage) {
                                $categoryImage = '/images/category-placeholder.jpg';
                            }
                        @endphp
                        <a href="{{ $linkUrl }}" class="group block">
                            <div class="overflow-hidden rounded-lg bg-white shadow-light hover:shadow-medium transition-all duration-300">
                                <div class="relative overflow-hidden aspect-square">
                                    <img src="{{ $categoryImage }}"
                                         alt="{{ $category->name }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                         loading="lazy">
                                </div>
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-black text-center truncate">
                                        {{ $category->name }}
                                    </h3>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- 7. Custom Shape CTA --}}
    <section class="py-16 bg-white">
        <div class="max-w-[1200px] mx-auto px-6">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-[58px] font-bold text-[#222] leading-tight mb-6">
                    Need a Custom Shape?
                </h2>
                <p class="text-body text-base leading-relaxed mb-8">
                    Don't see your perfect shape? Upload your design or describe your needs, and our team will create a custom die-cut shape just for you.
                </p>
                <a href="#quote-form" class="btn-primary inline-block text-base px-10 py-4">
                    Request Custom Shape Quote
                </a>
            </div>
        </div>
    </section>

    {{-- 8. Quote Form --}}
    <x-quote-form pageSource="shapes" />

@endsection
