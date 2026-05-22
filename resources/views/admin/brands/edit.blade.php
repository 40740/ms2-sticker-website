@extends('layouts.admin')

@section('title', '编辑品牌')

@section('content')
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-900">编辑品牌：{{ $brand->name }}</h2>
    </div>

    <form action="{{ route('admin.brands.update', $brand) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.brands.form', ['brand' => $brand])
    </form>
@endsection
