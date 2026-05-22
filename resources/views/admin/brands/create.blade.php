@extends('layouts.admin')

@section('title', '创建品牌')

@section('content')
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-900">创建新品牌</h2>
    </div>

    <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.brands.form', ['brand' => null])
    </form>
@endsection
