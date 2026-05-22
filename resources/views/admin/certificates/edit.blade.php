@extends('layouts.admin')

@section('title', '编辑证书')

@section('content')
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-900">编辑证书：{{ $certificate->name }}</h2>
    </div>

    <form action="{{ route('admin.certificates.update', $certificate) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.certificates.form', ['certificate' => $certificate])
    </form>
@endsection
