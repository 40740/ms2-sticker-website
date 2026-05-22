@extends('layouts.admin')

@section('title', '编辑博客')

@section('content')
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-900">编辑博客：{{ $blogPost->title }}</h2>
    </div>

    <form action="{{ route('admin.blog-posts.update', $blogPost) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.blog-posts.form', ['blogPost' => $blogPost])
    </form>
@endsection
