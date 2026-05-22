@props(['slides' => []])

@if(count($slides) > 0)
<section class="relative w-full" x-data="{}" x-init="
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof window.initSwiper === 'function' && document.querySelector('#hero-carousel')) {
            window.initSwiper('#hero-carousel', {
                @if(count($slides) > 1)
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                @else
                loop: false,
                autoplay: false,
                @endif
                pagination: {
                    el: '#hero-carousel .swiper-pagination',
                    clickable: true,
                },
                navigation: false,
                effect: 'fade',
                fadeEffect: {
                    crossFade: true,
                },
            });
        }
    });
">
    <div class="swiper" id="hero-carousel">
        <div class="swiper-wrapper">
            @foreach($slides as $slide)
                <div class="swiper-slide">
                    <div class="relative w-full h-[500px] mobile:h-[600px] tablet:h-[700px] overflow-hidden">
                        {{-- Background Image --}}
                        <div class="absolute inset-0">
                            <img src="{{ $slide['image'] ?? '/images/hero-default.jpg' }}"
                                 alt="{{ $slide['title'] ?? 'Hero Slide' }}"
                                 class="w-full h-full object-cover"
                                 loading="lazy">
                            {{-- Dark Overlay --}}
                            <div class="absolute inset-0 bg-black/0"></div>
                        </div>

                        {{-- Content --}}
                        <div class="relative z-10 h-full flex items-center">
                            <div class="max-w-[1200px] mx-auto px-6 w-full">
                                <div class="max-w-2xl mx-auto text-center">
                                    @if(isset($slide['subtitle']))
                                        <p class="text-white/90 text-lg mobile:text-xl mb-4 font-semibold uppercase tracking-wide">
                                            {{ $slide['subtitle'] }}
                                        </p>
                                    @endif
                                    <h2 class="text-white text-3xl mobile:text-4xl tablet:text-hero font-bold leading-tight mb-6">
                                        {{ $slide['title'] ?? '' }}
                                    </h2>
                                    @if(isset($slide['cta_text']))
                                        <a href="{{ $slide['cta_link'] ?? '#' }}"
                                           class="inline-flex items-center gap-2 bg-brand text-white text-base font-semibold px-8 py-4 rounded-lg shadow-lg hover:shadow-xl hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300">
                                            {{ $slide['cta_text'] }}
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if(count($slides) > 1)
        {{-- Dots Pagination --}}
        <div class="swiper-pagination !bottom-8"></div>
        @endif
    </div>
</section>
@endif
