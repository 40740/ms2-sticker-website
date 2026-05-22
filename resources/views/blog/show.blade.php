@extends('layouts.app', ['transparentOnTop' => false])

@section('content')
    <div class="max-w-[1200px] mx-auto px-6">
        {{-- Breadcrumb --}}
        <x-breadcrumb :items="[['title' => 'Blog', 'url' => '/blog'], ['title' => $post->title]]" />

        {{-- Article Header --}}
        <article class="pb-12">
            {{-- Featured Image --}}
            @php
                $featuredImage = $post->image;
                if ($featuredImage && !str_starts_with($featuredImage, '/') && !str_starts_with($featuredImage, 'http')) {
                    $featuredImage = Storage::disk('uploads')->url($featuredImage);
                }
            @endphp
            @if($featuredImage)
                <div class="w-full max-h-[400px] overflow-hidden mb-8">
                    <img src="{{ $featuredImage }}"
                         alt="{{ $post->title }}"
                         class="w-full h-full object-cover">
                </div>
            @endif

            {{-- Title --}}
            <h1 class="text-page-title font-bold text-box-title mb-4">{{ $post->title }}</h1>

            {{-- Date & Category --}}
            <div class="flex items-center gap-4 mb-8 text-sm text-gray-400">
                @if($post->published_at)
                    <time datetime="{{ $post->published_at->format('Y-m-d') }}">
                        {{ $post->published_at->format('F d, Y') }}
                    </time>
                @endif
            </div>

            {{-- Article Content --}}
            <div class="prose-content max-w-none text-body leading-relaxed mb-10">
                {!! $post->content !!}
            </div>

            {{-- Share Buttons --}}
            <div class="border-t border-gray-200 pt-6 mb-10">
                <h3 class="text-feature font-semibold text-box-title mb-4">Share This Post</h3>
                <div class="flex items-center gap-3">
                    {{-- Facebook --}}
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       aria-label="Share on Facebook"
                       class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-[#1877F2] text-white hover:opacity-80 transition-all duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>

                    {{-- Twitter / X --}}
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->title) }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       aria-label="Share on Twitter"
                       class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-[#1DA1F2] text-white hover:opacity-80 transition-all duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                    </a>

                    {{-- LinkedIn --}}
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ urlencode($post->title) }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       aria-label="Share on LinkedIn"
                       class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-[#0A66C2] text-white hover:opacity-80 transition-all duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>

                    {{-- Pinterest --}}
                    <a href="https://pinterest.com/pin/create/button/?url={{ urlencode(url()->current()) }}&description={{ urlencode($post->title) }}@if($post->image)&media={{ urlencode(Storage::disk('uploads')->url($post->image)) }}@endif"
                       target="_blank"
                       rel="noopener noreferrer"
                       aria-label="Share on Pinterest"
                       class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-[#E60023] text-white hover:opacity-80 transition-all duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.162-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738a.36.36 0 01.083.345l-.333 1.36c-.053.22-.174.267-.402.161-1.499-.698-2.436-2.889-2.436-4.649 0-3.785 2.75-7.262 7.929-7.262 4.163 0 7.398 2.967 7.398 6.931 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.359-.631-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24 12.017 24c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641 0 12.017 0z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </article>

        {{-- Recent Posts --}}
        @if($recentPosts->count() > 0)
            <section class="pb-16">
                <h2 class="section-heading mb-8">You Might Also Like</h2>
                <div class="grid grid-cols-1 mobile:grid-cols-2 tablet:grid-cols-3 gap-6">
                    @foreach($recentPosts as $recentPost)
                        <x-blog-card :post="$recentPost" />
                    @endforeach
                </div>
            </section>
        @endif
    </div>

    {{-- Quote Form --}}
    <x-quote-form pageSource="blog-{{ $post->slug }}" />
@endsection

@push('inline-scripts')
@php
    $jsonLd = [
        '@context' => 'https://schema.org',
        '@type'    => 'Article',
        'headline' => $post->title,
        'author'   => ['@type' => 'Organization', 'name' => \App\Models\Setting::get('site_name', 'MeisaiPrinting')],
        'publisher' => [
            '@type' => 'Organization',
            'name'  => \App\Models\Setting::get('site_name', 'MeisaiPrinting'),
            'logo'  => ['@type' => 'ImageObject', 'url' => asset(\App\Models\Setting::get('site_logo', '/images/logo.png'))],
        ],
    ];
    if ($post->published_at) {
        $jsonLd['datePublished'] = $post->published_at->toIso8601String();
    }
    if ($featuredImage) {
        $jsonLd['image'] = $featuredImage;
    }
@endphp
<script type="application/ld+json">
{!! json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endpush

@push('styles')
<style>
    /* Prose content – typography-like styles for rich HTML */
    .prose-content h1 { font-size: 2rem; font-weight: 700; color: #1D2B36; margin-top: 2rem; margin-bottom: 1rem; }
    .prose-content h2 { font-size: 1.625rem; font-weight: 700; color: #1D2B36; margin-top: 1.75rem; margin-bottom: 0.875rem; }
    .prose-content h3 { font-size: 1.375rem; font-weight: 600; color: #1D2B36; margin-top: 1.5rem; margin-bottom: 0.75rem; }
    .prose-content h4 { font-size: 1.125rem; font-weight: 600; color: #1D2B36; margin-top: 1.25rem; margin-bottom: 0.625rem; }
    .prose-content p { margin-bottom: 1.25rem; line-height: 1.75; }
    .prose-content ul, .prose-content ol { margin-bottom: 1.25rem; padding-left: 1.5rem; }
    .prose-content ul { list-style-type: disc; }
    .prose-content ol { list-style-type: decimal; }
    .prose-content li { margin-bottom: 0.5rem; line-height: 1.75; }
    .prose-content a { color: #FF008A; text-decoration: underline; transition: color .3s ease; }
    .prose-content a:hover { color: #FF33A1; }
    .prose-content blockquote { border-left: 4px solid #FF008A; padding-left: 1rem; margin: 1.5rem 0; color: #666666; font-style: italic; }
    .prose-content img { max-width: 100%; height: auto; border-radius: 6px; margin: 1.5rem 0; }
    .prose-content figure { margin: 1.5rem 0; }
    .prose-content figcaption { text-align: center; font-size: 0.875rem; color: #999999; margin-top: 0.5rem; }
    .prose-content pre { background-color: #F3F3F3; padding: 1rem; border-radius: 6px; overflow-x: auto; margin-bottom: 1.25rem; }
    .prose-content code { font-size: 0.875rem; background-color: #F3F3F3; padding: 0.125rem 0.375rem; border-radius: 3px; }
    .prose-content pre code { background-color: transparent; padding: 0; }
    .prose-content table { width: 100%; border-collapse: collapse; margin-bottom: 1.25rem; }
    .prose-content th, .prose-content td { border: 1px solid #e5e7eb; padding: 0.75rem; text-align: left; }
    .prose-content th { background-color: #F3F3F3; font-weight: 600; color: #1D2B36; }
    .prose-content hr { border: none; border-top: 1px solid #e5e7eb; margin: 2rem 0; }
</style>
@endpush
