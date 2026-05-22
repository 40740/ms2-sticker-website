@extends('layouts.app', ['transparentOnTop' => false])

@section('content')
    <div class="max-w-[1200px] mx-auto px-6">
        {{-- Breadcrumb --}}
        <x-breadcrumb :items="[['title' => 'Blog', 'url' => '/blog']]" />

        {{-- Page Header --}}
        <div class="text-center py-10">
            <h1 class="text-page-title font-bold text-box-title mb-3">Blog</h1>
            <p class="text-body text-base max-w-2xl mx-auto">Latest news and insights about custom stickers and labels</p>
        </div>

        {{-- Blog Grid --}}
        <div class="grid grid-cols-1 mobile:grid-cols-2 tablet:grid-cols-3 gap-6 mb-12">
            @foreach($posts as $post)
                <x-blog-card :post="$post" />
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($posts->hasPages())
            <div class="flex justify-center mb-16">
                {{ $posts->links() }}
            </div>
        @endif
    </div>

    {{-- Quote Form --}}
    <x-quote-form pageSource="blog" />
@endsection

@push('styles')
<style>
    /* Pagination – purple brand theme */
    .pagination { display: flex; align-items: center; gap: 6px; flex-wrap: wrap; }
    .pagination > span,
    .pagination > a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        padding: 0 12px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 600;
        font-family: var(--font-body);
        transition: all .3s ease;
        text-decoration: none;
        border: 1px solid #e5e7eb;
        color: #333333;
        background-color: #ffffff;
    }
    .pagination > a:hover {
        background-color: #FF008A;
        color: #ffffff;
        border-color: #FF008A;
    }
    .pagination > span.active {
        background-color: #FF008A;
        color: #ffffff;
        border-color: #FF008A;
        cursor: default;
    }
    .pagination > span.disabled {
        color: #d1d5db;
        border-color: #e5e7eb;
        cursor: not-allowed;
        background-color: #f9fafb;
    }
</style>
@endpush
