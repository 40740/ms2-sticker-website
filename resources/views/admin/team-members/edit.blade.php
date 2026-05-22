@extends('layouts.admin')

@section('title', '编辑成员')

@section('content')
    <div class="mb-6">
        <h2 class="text-lg font-semibold text-gray-900">编辑成员：{{ $teamMember->name }}</h2>
    </div>

    <form action="{{ route('admin.team-members.update', $teamMember) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.team-members.form', ['teamMember' => $teamMember])
    </form>
@endsection
