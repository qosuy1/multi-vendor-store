@extends('layouts.dashboard')


@section('title', 'Products')


@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Products</li>
    {{-- <li class="breadcrumb-item active"><a href="#">Starter Page</a></li> --}}
@endsection

@section('content')

    <div class="mb-4">
        <a href="{{ route('dashboard.products.create') }}" class="btn btn-outline-primary mr-2">Create</a>
        {{-- <a href="{{ route('dashboard.products.trash') }}" class="btn btn-outline-dark">Trash</a> --}}

    </div>

    <x-alert type='success' />
    <x-alert type='info' />

    <form action="{{ url()->current() }}" method="get" class="d-flex justify-content-between mb-4">
        <x-form.input name='name' placeholder="Name" :value="request('name')" />
        <select name="status" class="form-control mx-2" id="">
            <option value="">All</option>
            <option value="active" @selected(request('status') == 'active')>Active</option>
            <option value="archived" @selected(request('status') == 'archived')>Archived</option>
        </select>

        <button class='btn btn-dark '>Search</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Store</th>
                <th>Status</th>
                <th>Created At</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    @if (isset($product->image))
                        <td><img src="{{ asset('storage/' . $product->image) }}" height="45"> </td>
                    @else
                        <td></td>
                    @endif
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td class="text-muted">{{ $product->category_id ?? 'null' }}</td>
                    <td class="text-muted">{{ $product->store_id ?? 'null' }}</td>
                    <td>{{ $product->status }}</td>
                    <td>{{ $product->created_at->format('Y-m-d') }}</td>

                    <td>
                        <a href="{{ route('dashboard.products.edit', $product->id) }}"
                            class="btn btn-sm btn-outline-primary">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted mt-5">No products found</td>
                </tr>
            @endforelse

        </tbody>
    </table>
    {{ $products->withQueryString()->links() }}
@endsection
