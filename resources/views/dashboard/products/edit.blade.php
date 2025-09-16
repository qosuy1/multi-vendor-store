@extends('layouts.dashboard')


@section('title', 'Edit Category')


@section('breadcrumb')
    @parent
    <a class="breadcrumb-item " href="{{ route('dashboard.products.index') }}">Products</a>
    <li class="breadcrumb-item active">Edit Product</li>
    <!-- <li class="breadcrumb-item active"><a href="#">Starter Page</a></li> -->
@endsection

@section('content')

    <form action="{{ route('dashboard.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('dashboard.products._form', [
            'button_lable' => 'Update Product',
        ])


    </form>

@endsection
