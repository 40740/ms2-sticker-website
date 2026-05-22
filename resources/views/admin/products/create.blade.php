@extends('layouts.admin')

@section('title', '创建产品')

@section('content')
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-900">创建新产品</h2>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.products.form', ['product' => null, 'categories' => $categories])
    </form>
@endsection
