@extends('layouts.dashboard')


@section('title', 'Orders')


@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Orders</li>
    {{-- <li class="breadcrumb-item active"><a href="#">Starter Page</a></li> --}}
@endsection

@section('content')

    <div class="mb-4">
        <a href="{{ route('dashboard.orders.create') }}" class="btn btn-outline-primary mr-2">Create</a>
        {{-- <a href="{{ route('dashboard.orders.trash') }}" class="btn btn-outline-dark">Trash</a> --}}

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
                {{-- <th>Image</th> --}}
                <th>ID</th>
                <th>Number</th>
                <th>Store id</th>

                <th>Payment method</th>
                <th>Payment status</th>
                <th>Status</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr>

                    <td>{{ $order->id }}</td>
                    <td>{{ $order->number }}</td>
                    <td>{{ $order->store_id }}</td>

                    <td class="text-muted">{{ $order->payment_method ?? 'null' }}</td>
                    <td class="text-muted">{{ $order->payment_status ?? 'null' }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                    <td>{{ $order->updated_at->format('Y-m-d') }}</td>

                    <td>
                        <div class="d-flex gap-x-2">
                            <div>
                                <a href="{{ route('dashboard.orders.show', $order->id) }}"
                                    class="btn btn-sm btn-outline-info">Show</a>
                            </div>
                            <div>
                                <a href="{{ route('dashboard.orders.edit', $order->id) }}"
                                    class="btn btn-sm btn-outline-primary">Edit</a>
                            </div>
                            <div>
                                <form action="{{ route('dashboard.orders.destroy', $order->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted mt-5">No orders found</td>
                </tr>
            @endforelse

        </tbody>
    </table>
    {{ $orders->withQueryString()->links() }}
@endsection
