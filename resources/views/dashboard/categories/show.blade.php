@extends('layouts.dashboard')


@section('title', $category->name)


@section('breadcrumb')
    @parent
    <li class="breadcrumb-item">Categories</li>
    <li class="breadcrumb-item active">{{ $category->name }}</li>

    {{-- <li class="breadcrumb-item active"><a href="#">Starter Page</a></li> --}}
@endsection

@section('content')

    <form action="{{ url()->current() }}" method="get" class="d-flex justify-content-between mb-4">
        <x-form.input name='name' placeholder="Name" :value="request('name')" />
        <select name="status" class="form-control mx-2" id="">
            <option value="">All</option>
            <option value="active" @selected(request('status') == 'active')>Active</option>
            <option value="archived" @selected(request('status') == 'archived')>Archived</option>
            <option value="archived" @selected(request('status') == 'drift')>Drift</option>

        </select>

        <button class='btn btn-dark '>Search</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>status</th>
                <th>store</th>
                <th>Created At</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            {{--
                $category->products             => collection of products
                $category->products()             => relation
             --}}
            @forelse ($products as $product)
                <tr>

                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->status }}</td>
                    <td>{{ $product->store->name }}</td>
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
                    <td colspan="6" class="text-center text-muted mt-5">No products found</td>
                </tr>
            @endforelse

        </tbody>
    </table>
    {{ $products->links() }}
@endsection
