@extends('layouts.app')
@section('title', $customer->name . ' · Customer')
@section('page-title', 'Customer Profile')
@section('content')
<div class="detail-head">
    <div>
        <span class="code">{{ $customer->customer_code }}</span>
        <h2>{{ $customer->name }}</h2>
        <p class="text-muted">{{ $customer->phone }} · {{ $customer->email ?: 'No email' }}</p>
    </div>
    <div class="head-actions">
        <a href="{{ route('customers.edit', $customer) }}" class="btn btn-outline-secondary">Edit</a>
        <a href="{{ route('orders.create', ['customer_id' => $customer->id]) }}" class="btn btn-primary">＋ New Order</a>
    </div>
</div>

<div class="detail-grid">
    <div class="panel">
        <div class="panel-head">
            <span class="eyebrow">PROFILE</span>
            <h3>Contact details</h3>
        </div>
        <dl class="details">
            <dt>Phone</dt><dd>{{ $customer->phone }}</dd>
            <dt>Email</dt><dd>{{ $customer->email ?: '—' }}</dd>
            <dt>Address</dt><dd>{{ $customer->address ?: '—' }}</dd>
            <dt>Notes</dt><dd>{{ $customer->notes ?: '—' }}</dd>
        </dl>
    </div>
    <div class="panel">
        <div class="panel-head d-flex justify-content-between">
            <div><span class="eyebrow">MEASUREMENTS</span><h3>Latest records</h3></div>
            <a href="{{ route('measurements.create', ['customer_id' => $customer->id]) }}" class="text-link">Add →</a>
        </div>
        @forelse($customer->measurements->take(5) as $m)
            <div class="due-row">
                <div><strong>{{ $m->created_at->format('M d, Y') }}</strong> <span class="text-muted small">Chest {{ $m->chest ?? '—' }} · Waist {{ $m->waist ?? '—' }} · {{ $m->unit }}</span></div>
                <a href="{{ route('measurements.show', $m) }}" class="text-wine small">View</a>
            </div>
        @empty
            <div class="empty">No measurements yet.</div>
        @endforelse
    </div>
</div>

<div class="panel table-panel">
    <div class="panel-head">
        <span class="eyebrow">ORDER HISTORY</span>
        <h3>{{ $customer->orders->count() }} orders</h3>
    </div>
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr><th>Order</th><th>Garment</th><th>Order Date</th><th>Due</th><th>Total</th><th>Status</th></tr>
            </thead>
            <tbody>
            @forelse($customer->orders as $order)
                <tr>
                    <td><a href="{{ route('orders.show', $order) }}" class="strong-link">{{ $order->order_code }}</a></td>
                    <td>{{ $order->garment_type }} <small class="table-sub">{{ $order->color }}</small></td>
                    <td>{{ $order->order_date->format('M d, Y') }}</td>
                    <td>{{ $order->due_date?->format('M d, Y') ?? '—' }}</td>
                    <td>₱{{ number_format($order->total_amount, 2) }}</td>
                    <td><span class="status status-{{ \Illuminate\Support\Str::slug($order->status) }}">{{ $order->status }}</span></td>
                </tr>
            @empty
                <tr><td colspan="6" class="empty">No orders.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
