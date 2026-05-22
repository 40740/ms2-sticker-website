@extends('layouts.admin')

@section('title', '编辑分类')

@section('content')
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-900">编辑分类：{{ $category->name }}</h2>
    </div>

    <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.categories.form', ['category' => $category])
    </form>
@endsection
