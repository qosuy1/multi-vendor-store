@extends('layouts.dashboard')


@section('title', 'Categories')


@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
    {{-- <li class="breadcrumb-item active"><a href="#">Starter Page</a></li> --}}
@endsection

@section('content')

    <div class="mb-2">
        <a href="{{ route('dashboard.categories.create') }}" class="btn btn-outline-primary">Create</a>
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
                <th>Parent</th>
                <th>status</th>
                <th>Created At</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    @if (isset($category->image))
                        <td><img src="{{ asset('storage/' . $category->image) }}" height="45"> </td>
                    @else
                        <td></td>
                    @endif
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td class="text-muted">{{ $category->parent_id ?? 'null' }}</td>
                    <td>{{ $category->created_at->format('Y-m-d') }}</td>
                    <td>{{ $category->status }}</td>

                    <td>
                        <a href="{{ route('dashboard.categories.edit', $category->id) }}"
                            class="btn btn-sm btn-outline-primary">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted mt-5">No categories found</td>
                </tr>
            @endforelse

        </tbody>
    </table>
    {{ $categories->withQueryString()->links() }}
@endsection
