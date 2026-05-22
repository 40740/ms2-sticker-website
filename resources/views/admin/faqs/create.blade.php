@extends('layouts.admin')

@section('title', '创建FAQ')

@section('content')
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-900">创建新FAQ</h2>
    </div>

    <form action="{{ route('admin.faqs.store') }}" method="POST">
        @csrf
        @include('admin.faqs.form', ['faq' => null, 'categories' => $categories, 'products' => $products])
    </form>
@endsection
