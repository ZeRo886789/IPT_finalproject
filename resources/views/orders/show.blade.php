@extends('layouts.app')
@section('title', $order->order_code . ' · Order')
@section('page-title','Order Details')
@section('content')
@php
$statusClass = 'status-'.\Illuminate\Support\Str::slug($order->status);
@endphp
<div class="detail-head">
    <div>
        <span class="code">{{ $order->order_code }}</span>
        <h2>{{ $order->garment_type }} for {{ $order->customer->name }}</h2>
        <p class="text-muted">Placed {{ $order->order_date->format('M d, Y') }} · Due {{ $order->due_date?->format('M d, Y') ?? 'No due date' }}</p>
    </div>
    <div class="head-actions">
        <span class="status {{ $statusClass }}">{{ $order->status }}</span>
        <a href="{{ route('orders.edit', $order) }}" class="btn btn-outline-secondary">Edit</a>
        <a href="{{ route('payments.create', ['order_id' => $order->id]) }}" class="btn btn-primary">＋ Payment</a>
    </div>
</div>

<div class="stats-grid compact">
    <div class="stat-card"><div class="stat-icon icon-order">₱</div><div><strong>₱{{ number_format($order->total_amount, 2) }}</strong><span>Order Total</span></div></div>
    <div class="stat-card"><div class="stat-icon icon-payment">✓</div><div><strong>₱{{ number_format($order->paid_amount, 2) }}</strong><span>Paid</span></div></div>
    <div class="stat-card"><div class="stat-icon icon-measurement">◌</div><div><strong>₱{{ number_format($order->balance, 2) }}</strong><span>Balance</span></div></div>
</div>

<div class="detail-grid">
    <div class="panel">
        <div class="panel-head">
            <span class="eyebrow">GARMENT</span>
            <h3>Order specifications</h3>
        </div>
        <dl class="details">
            <dt>Customer</dt><dd><a href="{{ route('customers.show', $order->customer) }}" class="strong-link">{{ $order->customer->name }}</a></dd>
            <dt>Employee</dt><dd>{{ $order->employee?->name ?? 'Unassigned' }}</dd>
            <dt>Fabric</dt><dd>{{ $order->fabric ?: '—' }}</dd>
            <dt>Color</dt><dd>{{ $order->color ?: '—' }}</dd>
            <dt>Size</dt><dd>{{ $order->size ?: '—' }}</dd>
            <dt>Instructions</dt><dd>{{ $order->special_instructions ?: '—' }}</dd>
        </dl>
    </div>
    <div class="panel">
        <div class="panel-head d-flex justify-content-between">
            <div><span class="eyebrow">MEASUREMENTS</span><h3>Order measurements</h3></div>
            <a href="{{ route('measurements.create', ['customer_id' => $order->customer_id, 'order_id' => $order->id]) }}" class="text-link">Add →</a>
        </div>
        @forelse($order->measurements as $m)
            <div class="measurement-big">
                <div><span>Chest</span><strong>{{ $m->chest ?? '—' }}</strong><small>{{ $m->unit }}</small></div>
                <div><span>Waist</span><strong>{{ $m->waist ?? '—' }}</strong><small>{{ $m->unit }}</small></div>
                <div><span>Hip</span><strong>{{ $m->hip ?? '—' }}</strong><small>{{ $m->unit }}</small></div>
                <div><span>Shoulder</span><strong>{{ $m->shoulder ?? '—' }}</strong><small>{{ $m->unit }}</small></div>
                <div><span>Sleeve</span><strong>{{ $m->sleeve ?? '—' }}</strong><small>{{ $m->unit }}</small></div>
                <div><span>Length</span><strong>{{ $m->length ?? '—' }}</strong><small>{{ $m->unit }}</small></div>
            </div>
        @empty
            <div class="empty">No measurement linked to this order.</div>
        @endforelse
    </div>
</div>

<div class="panel table-panel">
    <div class="panel-head">
        <span class="eyebrow">PAYMENTS</span>
        <h3>Payment history</h3>
        <a href="{{ route('payments.create', ['order_id' => $order->id]) }}" class="text-link">Record →</a>
    </div>
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr><th>Date</th><th>Method</th><th>Reference</th><th>Amount</th><th>Status</th></tr>
            </thead>
            <tbody>
            @forelse($order->payments as $p)
                <tr>
                    <td>{{ $p->payment_date->format('M d, Y') }}</td>
                    <td>{{ $p->payment_method }}</td>
                    <td>{{ $p->reference_no ?: '—' }}</td>
                    <td>₱{{ number_format($p->amount, 2) }}</td>
                    <td><span class="status status-{{ \Illuminate\Support\Str::slug($p->status) }}">{{ $p->status }}</span></td>
                </tr>
            @empty
                <tr><td colspan="5" class="empty">No payments recorded.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
