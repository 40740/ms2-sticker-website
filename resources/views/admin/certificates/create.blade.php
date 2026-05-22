@extends('layouts.admin')

@section('title', '创建证书')

@section('content')
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-900">创建新证书</h2>
    </div>

    <form action="{{ route('admin.certificates.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.certificates.form', ['certificate' => null])
    </form>
@endsection
