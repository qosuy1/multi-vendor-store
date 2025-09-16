@extends('layouts.dashboard')


@section('title', 'Create Category')


@section('breadcrumb')
    @parent
    <a class="breadcrumb-item " href="{{ route('dashboard.products.index') }}">Products</a>
    <li class="breadcrumb-item active">Create Product</li>
    <!-- <li class="breadcrumb-item active"><a href="#">Starter Page</a></li> -->
@endsection

@section('content')

    <form action="{{ route('dashboard.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @include('dashboard.products._form', [
            'button_lable' => 'Create Product',
        ])


    </form>

@endsection
