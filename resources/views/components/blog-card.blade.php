@props(['post'])

@php
    $blogImage = $post->image;
    if ($blogImage && !str_starts_with($blogImage, '/') && !str_starts_with($blogImage, 'http')) {
        $blogImage = Storage::disk('uploads')->url($blogImage);
    }
    if (!$blogImage) {
        $blogImage = '/images/blog-placeholder.jpg';
    }
@endphp

<a href="/blog/{{ $post->slug }}" class="group block">
    <div class="overflow-hidden bg-white shadow-light hover:shadow-medium transition-all duration-300 rounded-lg">
        {{-- Image with hover effect --}}
        <div class="relative overflow-hidden aspect-[16/10] bg-bg-form">
            <img src="{{ $blogImage }}"
                 alt="{{ $post->title }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                 onerror="this.src='/images/product-placeholder.jpg'"
                 loading="lazy">
        </div>

        {{-- Content --}}
        <div class="p-5">
            {{-- Date --}}
            <time class="text-sm text-gray-400 mb-2 block"
                  datetime="{{ $post->published_at?->format('Y-m-d') }}">
                {{ $post->published_at?->format('M d, Y') }}
            </time>

            {{-- Title --}}
            <h3 class="text-feature font-bold text-box-title mb-2 line-clamp-2 group-hover:text-brand transition-colors duration-300">
                {{ $post->title }}
            </h3>

            {{-- Excerpt --}}
            <p class="text-body text-sm leading-relaxed line-clamp-3">
                {{ $post->excerpt }}
            </p>

            {{-- Read More --}}
            <span class="inline-flex items-center gap-1 text-accent text-sm font-semibold mt-3 group-hover:gap-2 transition-all duration-300">
                Read More
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                </svg>
            </span>
        </div>
    </div>
</a>
