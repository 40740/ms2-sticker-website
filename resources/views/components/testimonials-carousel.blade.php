@props(['testimonials' => []])

<section class="py-16 bg-bg-form">
    <div class="max-w-[1200px] mx-auto px-6">
        <h2 class="section-heading text-center mb-10">What Our Clients Say About Us</h2>

        <div class="relative" x-data="{}" x-init="
            document.addEventListener('DOMContentLoaded', function() {
                if (typeof window.initSwiper === 'function' && document.querySelector('#testimonials-carousel')) {
                    window.initSwiper('#testimonials-carousel', {
                        loop: true,
                        autoplay: {
                            delay: 5000,
                            disableOnInteraction: false,
                        },
                        slidesPerView: 1,
                        spaceBetween: 24,
                        pagination: {
                            el: '#testimonials-carousel .swiper-pagination',
                            clickable: true,
                        },
                        navigation: false,
                        breakpoints: {
                            768: { slidesPerView: 2 },
                            1000: { slidesPerView: 3 },
                        },
                    });
                }
            });
        ">
            <div class="swiper" id="testimonials-carousel">
                <div class="swiper-wrapper">
                    @foreach($testimonials as $testimonial)
                        <div class="swiper-slide">
                            <div class="bg-white p-6 mobile:p-8 rounded-lg shadow-light h-full flex flex-col">
                                {{-- Quote Icon --}}
                                <svg class="w-8 h-8 text-brand/30 mb-4 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10H14.017zM0 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151C7.546 6.068 5.983 8.789 5.983 11H10v10H0z"/>
                                </svg>

                                {{-- Review Text --}}
                                <p class="text-body text-sm leading-relaxed flex-1 mb-6">
                                    "{{ $testimonial['text'] ?? '' }}"
                                </p>

                                {{-- Author --}}
                                <div class="flex items-center gap-3 pt-4 border-t border-gray-100">
                                    {{-- Avatar --}}
                                    <div class="w-10 h-10 rounded-full bg-brand/10 flex items-center justify-center shrink-0 overflow-hidden">
                                        @isset($testimonial['avatar'])
                                            <img src="{{ $testimonial['avatar'] }}" alt="{{ $testimonial['name'] ?? '' }}" class="w-full h-full object-cover">
                                        @else
                                            <span class="text-brand font-bold text-sm">
                                                {{ strtoupper(substr($testimonial['name'] ?? 'U', 0, 1)) }}
                                            </span>
                                        @endisset
                                    </div>

                                    <div class="flex-1 min-w-0">
                                        <p class="text-box-title font-semibold text-sm truncate">{{ $testimonial['name'] ?? 'Anonymous' }}</p>
                                        <div class="flex items-center gap-1">
                                            @isset($testimonial['country_flag'])
                                                <img src="{{ $testimonial['country_flag'] }}" alt="" class="w-4 h-3 object-cover" loading="lazy">
                                            @endisset
                                            @isset($testimonial['country'])
                                                <span class="text-xs text-gray-400">{{ $testimonial['country'] }}</span>
                                            @endisset
                                        </div>
                                    </div>

                                    {{-- Stars --}}
                                    <div class="flex items-center gap-0.5 shrink-0">
                                        @for($i = 0; $i < ($testimonial['rating'] ?? 5); $i++)
                                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="swiper-pagination !relative mt-8"></div>
            </div>
        </div>
    </div>
</section>
