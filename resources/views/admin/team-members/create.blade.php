@extends('layouts.admin')

@section('title', '创建成员')

@section('content')
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-900">创建新成员</h2>
    </div>

    <form action="{{ route('admin.team-members.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.team-members.form', ['teamMember' => null])
    </form>
@endsection
