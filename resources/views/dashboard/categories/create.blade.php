@extends('layouts.dashboard')


@section('title', 'Create Category')


@section('breadcrumb')
    @parent
    {{-- <li class="breadcrumb-item active">Categories</li> --}}
    <a class="breadcrumb-item" href="{{ route('dashboard.categories.index') }}">Categories</a>
    <li class="breadcrumb-item active">Create Category</li>

    <!-- <li class="breadcrumb-item active"><a href="#">Starter Page</a></li> -->
@endsection

@section('content')

    <form action="{{ route('dashboard.categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('dashboard.categories._form')

        {{-- <button type="submit" class="btn btn-primary">Create Category</button> --}}
    </form>


@endsection
