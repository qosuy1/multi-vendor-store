@extends('layouts.dashboard')


@section('title', 'Categories')


@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
    <!-- <li class="breadcrumb-item active"><a href="#">Starter Page</a></li> -->
@endsection

@section('content')

    <form action="{{ route('dashboard.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('dashboard.categories._form', [
            'button_lable' => 'Update Category',
        ])


    </form>

@endsection
