@extends('layouts.admin')

@section('title', '编辑FAQ')

@section('content')
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-900">编辑FAQ #{{ $faq->id }}</h2>
    </div>

    <form action="{{ route('admin.faqs.update', $faq) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.faqs.form', ['faq' => $faq, 'categories' => $categories, 'products' => $products])
    </form>
@endsection
