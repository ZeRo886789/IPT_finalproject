@extends('layouts.app')
@section('title','Payment · TailorDesk')
@section('page-title','Payment Details')
@section('content')
<div class="detail-head">
    <div>
        <span class="code">PAY-{{ str_pad($payment->id, 5, '0', STR_PAD_LEFT) }}</span>
        <h2>₱{{ number_format($payment->amount, 2) }}</h2>
        <p class="text-muted">{{ $payment->payment_method }} · {{ $payment->payment_date->format('M d, Y') }}</p>
    </div>
    <div class="head-actions">
        <span class="status status-{{ \Illuminate\Support\Str::slug($payment->status) }}">{{ $payment->status }}</span>
        <a href="{{ route('payments.edit', $payment) }}" class="btn btn-outline-secondary">Edit</a>
    </div>
</div>

<div class="detail-grid">
    <div class="panel">
        <div class="panel-head">
            <div class="head-title"><span class="eyebrow">TRANSACTION</span><h3>Payment information</h3></div>
        </div>
        <dl class="details">
            <dt>Order</dt><dd><a href="{{ route('orders.show', $payment->order) }}" class="strong-link">{{ $payment->order->order_code }}</a></dd>
            <dt>Customer</dt><dd>{{ $payment->order->customer->name }}</dd>
            <dt>Method</dt><dd>{{ $payment->payment_method }}</dd>
            <dt>Reference</dt><dd>{{ $payment->reference_no ?: '—' }}</dd>
            <dt>Notes</dt><dd>{{ $payment->notes ?: '—' }}</dd>
        </dl>
    </div>
    <div class="panel money-panel">
        <div class="panel-head">
            <span class="eyebrow">ORDER BALANCE</span>
        </div>
        <div class="money">₱{{ number_format($payment->order->balance, 2) }}</div>
        <p class="text-muted small mb-0">Remaining after this order's recorded paid transactions.</p>
        <a href="{{ route('orders.show', $payment->order) }}" class="btn btn-outline-light w-100 mt-3">View Order</a>
    </div>
</div>
@endsection
