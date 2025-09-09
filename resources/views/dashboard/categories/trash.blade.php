@extends('layouts.dashboard')


@section('title', 'trashed categories')


@section('breadcrumb')
    @parent
    <li class="breadcrumb-item ">Categories</li>
    <li class="breadcrumb-item active">Trash</li>
    {{-- <li class="breadcrumb-item active"><a href="#">Starter Page</a></li> --}}
@endsection

@section('content')

    <div class="mb-4">
        <a href="{{ route('dashboard.categories.index') }}" class="btn btn-outline-primary">Back</a>
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
                <th>Parent name</th>
                <th>Deleted At</th>
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
                    <td class="text-muted">{{ $category->parents_name ?? 'null' }}</td>
                    <td>{{ $category->deleted_at->format('Y-m-d') }}</td>
                    <td>{{ $category->status }}</td>


                    <td>
                        <form action="{{ route('dashboard.categories.restore', $category->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm btn-outline-primary">Restore</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('dashboard.categories.force-delete', $category->id) }}" method="POST">
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
