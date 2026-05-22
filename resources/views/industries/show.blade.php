@extends('layouts.app', [
    'seoTitle' => $category->hero_title ?? "{$category->name} Labels – MeisaiPrinting",
    'seoDescription' => $category->description ?? "Custom labels for {$category->name}. Industry-specific solutions from MeisaiPrinting.",
    'transparentOnTop' => false,
])

@section('content')
    {{-- 1. Breadcrumb --}}
    <div class="max-w-[1200px] mx-auto px-6">
        <x-breadcrumb :items="[
            ['title' => 'Industries', 'url' => '/industries'],
            ['title' => $category->name],
        ]" />
    </div>

    {{-- 2. Hero Banner --}}
    <section class="relative w-full h-[400px] mobile:h-[500px] overflow-hidden">
        <div class="absolute inset-0">
            @if($category->hero_image)
                <img src="{{ $category->hero_image }}"
                     alt="{{ $category->hero_title ?? $category->name }}"
                     class="w-full h-full object-cover"
                     loading="eager">
            @else
                <img src="/images/industries-hero.jpg"
                     alt="{{ $category->name }}"
                     class="w-full h-full object-cover"
                     loading="eager">
            @endif
            <div class="absolute inset-0 bg-black/45"></div>
        </div>

        <div class="relative z-10 h-full flex items-center justify-center text-center">
            <div class="max-w-[800px] mx-auto px-6">
                <h1 class="text-white text-3xl mobile:text-4xl tablet:text-hero font-bold leading-tight mb-4">
                    {{ $category->hero_title ?? "Labels for {$category->name}" }}
                </h1>
                <p class="text-white/85 text-lg mobile:text-xl mb-6 max-w-xl mx-auto">
                    {{ $category->hero_subtitle ?? "Industry-specific labeling solutions for {$category->name} businesses." }}
                </p>
                <a href="#quote-form" class="btn-primary inline-block text-base px-10 py-4">
                    Get Custom Quote
                </a>
            </div>
        </div>
    </section>

    {{-- 3. Intro Text --}}
    <section class="py-8 bg-white">
        <div class="max-w-[1200px] mx-auto px-6">
            <p class="text-body text-base leading-relaxed max-w-3xl mx-auto text-center">
                {{ $category->description ?? "Discover our custom labeling solutions designed specifically for {$category->name}. From product labels to packaging, we provide high-quality labels that meet industry standards." }}
            </p>
        </div>
    </section>

    {{-- 4. Trust Badges --}}
    <x-trust-badges />

    {{-- 5. Products Grid --}}
    <section class="py-16 bg-bg-form">
        <div class="max-w-[1200px] mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="section-heading mb-4">Recommended Products</h2>
                <p class="text-body text-base max-w-2xl mx-auto">
                    Browse our selection of custom labels and stickers suitable for {{ $category->name }}.
                </p>
            </div>

            <div class="grid grid-cols-2 tablet:grid-cols-4 gap-6">
                @foreach($category->products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        </div>
    </section>

    {{-- 6. Related Products --}}
    @if($relatedProducts->count() > 0)
        <section class="py-16 bg-white">
            <div class="max-w-[1200px] mx-auto px-6">
                <div class="text-center mb-12">
                    <h2 class="section-heading mb-4">More Industry Solutions</h2>
                    <p class="text-body text-base max-w-2xl mx-auto">
                        Explore other industry-specific solutions.
                    </p>
                </div>

                <div class="grid grid-cols-2 tablet:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- 7. Quote Form --}}
    <x-quote-form pageSource="industry-{$category->slug}" />

    {{-- 8. FAQ Accordion --}}
    @if($faqs->count() > 0)
        <x-faq-accordion :faqs="$faqs" :title="$category->name . ' FAQ'" />
    @endif

@endsection
