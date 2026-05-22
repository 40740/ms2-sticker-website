@extends('layouts.admin')

@section('title', '创建分类')

@section('content')
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-900">创建新分类</h2>
    </div>

    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.categories.form', ['category' => null])
    </form>
@endsection
