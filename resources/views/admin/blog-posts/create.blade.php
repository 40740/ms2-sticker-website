@extends('layouts.admin')

@section('title', '创建博客')

@section('content')
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-900">创建新博客</h2>
    </div>

    <form action="{{ route('admin.blog-posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.blog-posts.form', ['blogPost' => null])
    </form>
@endsection
