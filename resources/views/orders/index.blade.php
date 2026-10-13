@extends('layouts.app')
@section('title','Clothing Orders · TailorDesk')
@section('page-title','Clothing Orders')
@section('content')
<div class="page-head">
    <div class="lead">Track garments from intake to completion.</div>
    <a href="{{ route('orders.create') }}" class="btn btn-primary">＋ New Order</a>
</div>

<form class="filter-bar" method="GET" action="{{ route('orders.index') }}">
    <input type="text" name="q" value="{{ $q }}" class="form-control" placeholder="Search order, garment or customer…">
    <select name="status" class="form-select">
        <option value="">All statuses</option>
        @foreach(['Pending','In Progress','Ready','Completed','Cancelled'] as $s)
            <option value="{{ $s }}" {{ $status === $s ? 'selected' : '' }}>{{ $s }}</option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-outline-secondary">Filter</button>
    @if($q || $status) <a href="{{ route('orders.index') }}" class="btn btn-ghost">Clear</a> @endif
</form>

<div class="panel table-panel">
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Order</th><th>Customer</th><th>Garment</th><th>Due</th><th>Total</th><th>Status</th><th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($orders as $order)
                <tr>
                    <td><a href="{{ route('orders.show', $order) }}" class="strong-link">{{ $order->order_code }}</a><small class="table-sub">{{ $order->order_date->format('M d, Y') }}</small></td>
                    <td>{{ $order->customer->name }}</td>
                    <td>{{ $order->garment_type }} @if($order->color) <small class="table-sub">{{ $order->color }}</small> @endif</td>
                    <td>{{ $order->due_date?->format('M d, Y') ?? '—' }}@if($order->isOverdue) <span class="status status-cancelled ms-1">Overdue</span>@endif</td>
                    <td>₱{{ number_format($order->total_amount, 2) }}</td>
                    <td><span class="status status-{{ \Illuminate\Support\Str::slug($order->status) }}">{{ $order->status }}</span></td>
                    <td class="actions text-end">
                        <a href="{{ route('orders.show', $order) }}" class="text-wine">View</a>
                        <a href="{{ route('orders.edit', $order) }}" class="text-wine">Edit</a>
                        <form method="POST" action="{{ route('orders.destroy', $order) }}" class="d-inline" onsubmit="return confirm('Delete this order and its payments/measurements?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-danger btn-link">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="empty">No clothing orders found.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination-wrap">
        {{ $orders->onEachSide(1)->links('partials.pagination') }}
    </div>
</div>
@endsection
