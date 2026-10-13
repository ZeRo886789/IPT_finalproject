@extends('layouts.app')
@section('title','Customers · TailorDesk')
@section('page-title','Customers')
@section('content')
<div class="page-head">
    <div class="lead">Customer profiles and order history.</div>
    <a href="{{ route('customers.create') }}" class="btn btn-primary">＋ Add Customer</a>
</div>

<form class="filter-bar" method="GET" action="{{ route('customers.index') }}">
    <input type="text" name="q" value="{{ $q }}" class="form-control" placeholder="Search name, code or phone…">
    <button type="submit" class="btn btn-outline-secondary">Search</button>
    @if($q) <a href="{{ route('customers.index') }}" class="btn btn-ghost">Clear</a> @endif
</form>

<div class="panel table-panel">
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Code</th><th>Customer</th><th>Phone</th><th>Email</th><th>Orders</th><th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($customers as $customer)
                <tr>
                    <td><span class="code">{{ $customer->customer_code }}</span></td>
                    <td><a href="{{ route('customers.show', $customer) }}" class="strong-link">{{ $customer->name }}</a></td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->email ?: '—' }}</td>
                    <td><span class="count-badge">{{ $customer->orders_count }}</span></td>
                    <td class="actions text-end">
                        <a href="{{ route('customers.show', $customer) }}" class="text-wine">View</a>
                        <a href="{{ route('customers.edit', $customer) }}" class="text-wine">Edit</a>
                        <form method="POST" action="{{ route('customers.destroy', $customer) }}" class="d-inline" onsubmit="return confirm('Delete this customer? Its orders and related measurements/payments will be deleted too.')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-danger btn-link">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="empty">No customers found.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination-wrap">
        {{ $customers->onEachSide(1)->links('partials.pagination') }}
    </div>
</div>
@endsection
