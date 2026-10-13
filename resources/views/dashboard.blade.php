@extends('layouts.app')
@section('title','Dashboard · TailorDesk')
@section('page-title','Dashboard')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div>
        <span class="badge bg-wine-subtle text-wine">DAILY WORKSPACE</span>
        <h2 class="playfair mb-1 mt-2 fw-bold">Welcome to your tailoring desk.</h2>
        <p class="text-muted mb-0">Manage customers, orders, measurements and payments in one clean workflow.</p>
    </div>
    <a href="{{ route('orders.create') }}" class="btn btn-primary">＋ New Clothing Order</a>
</div>

<div class="stats-grid">
@php
$cards = [
    ['customers','Customers','♙'],
    ['employees','Active Employees','✦'],
    ['orders','Clothing Orders','▣'],
    ['measurements','Measurements','⌁'],
    ['payments','Paid Transactions','₱'],
];
@endphp
@foreach($cards as [$key, $label, $icon])
    <div class="stat-card">
        <div class="stat-icon icon-{{ $key }}">{{ $icon }}</div>
        <div><strong>{{ $counts[$key] }}</strong><span>{{ $label }}</span></div>
    </div>
@endforeach
</div>

<div class="panel table-panel">
    <div class="panel-head">
        <div class="head-title"><span class="eyebrow">ORDER STATUS</span><h3>Breakdown</h3></div>
    </div>
    <div class="row g-3 text-center">
        <div class="col-3 col-md"><div class="stat-card"><div class="stat-icon icon-order">▣</div><div><strong>{{ $orderStats['pending'] }}</strong><span>Pending</span></div></div></div>
        <div class="col-3 col-md"><div class="stat-card"><div class="stat-icon icon-order">▣</div><div><strong>{{ $orderStats['in_progress'] }}</strong><span>In Progress</span></div></div></div>
        <div class="col-3 col-md"><div class="stat-card"><div class="stat-icon icon-order">✓</div><div><strong>{{ $orderStats['completed'] }}</strong><span>Completed</span></div></div></div>
        <div class="col-3 col-md"><div class="stat-card"><div class="stat-icon icon-order">⚠</div><div><strong>{{ $orderStats['overdue'] }}</strong><span>Overdue</span></div></div></div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-7">
        <div class="panel table-panel">
            <div class="panel-head">
                <div class="head-title"><span class="eyebrow">LATEST ACTIVITY</span><h3>Recent clothing orders</h3></div>
                <a href="{{ route('orders.index') }}" class="text-link">View all →</a>
            </div>
            <div class="table-wrap">
                <table class="table">
                    <thead>
                        <tr><th>Order</th><th>Customer</th><th>Garment</th><th>Due</th><th>Status</th></tr>
                    </thead>
                    <tbody>
                    @forelse($recentOrders as $order)
                        <tr>
                            <td><a href="{{ route('orders.show', $order) }}" class="strong-link">{{ $order->order_code }}</a></td>
                            <td>{{ $order->customer->name }}</td>
                            <td>{{ $order->garment_type }}</td>
                            <td>{{ $order->due_date?->format('M d, Y') ?? '—' }}</td>
                            <td><span class="status status-{{ \Illuminate\Support\Str::slug($order->status) }}">{{ $order->status }}</span></td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="empty">No orders yet.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="panel money-panel">
            <div class="panel-head"><span class="eyebrow">FINANCIAL SNAPSHOT</span></div>
            <div class="money">₱{{ number_format($revenue, 2) }}</div>
            <p class="text-muted small mb-0">Collected payments</p>
            <div class="balance"><span>Outstanding</span><strong>₱{{ number_format($outstanding, 2) }}</strong></div>
            <a href="{{ route('payments.create') }}" class="btn btn-outline-light w-100 mt-3">Record Payment</a>
        </div>

        <div class="panel">
            <div class="panel-head">
                <div class="head-title"><span class="eyebrow">UPCOMING</span><h3>Due soon</h3></div>
            </div>
            @forelse($dueSoon as $order)
                <div class="due-row">
                    <div><strong>{{ $order->order_code }}</strong> <span class="text-muted small">{{ $order->customer->name }}</span></div>
                    <b>{{ $order->due_date?->format('M d') }}</b>
                </div>
            @empty
                <div class="empty">No upcoming deadlines.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
