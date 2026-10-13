@extends('layouts.app')
@section('title', $employee->name . ' · Employee')
@section('page-title','Employee Profile')
@section('content')
<div class="detail-head">
    <div>
        <span class="code">{{ $employee->employee_code }}</span>
        <h2>{{ $employee->name }}</h2>
        <p class="text-muted">{{ $employee->role }} · {{ $employee->phone }}</p>
    </div>
    <div class="head-actions">
        <a href="{{ route('employees.edit', $employee) }}" class="btn btn-outline-secondary">Edit</a>
    </div>
</div>

<div class="detail-grid">
    <div class="panel">
        <div class="panel-head">
            <span class="eyebrow">STAFF DETAILS</span>
            <h3>Profile</h3>
        </div>
        <dl class="details">
            <dt>Role</dt><dd>{{ $employee->role }}</dd>
            <dt>Phone</dt><dd>{{ $employee->phone }}</dd>
            <dt>Email</dt><dd>{{ $employee->email ?: '—' }}</dd>
            <dt>Hire Date</dt><dd>{{ $employee->hire_date?->format('M d, Y') ?? '—' }}</dd>
            <dt>Status</dt><dd><span class="status {{ $employee->status === 'Active' ? 'status-completed' : 'status-cancelled' }}">{{ $employee->status }}</span></dd>
        </dl>
    </div>
    <div class="panel">
        <div class="panel-head">
            <span class="eyebrow">ASSIGNED WORK</span>
            <h3>{{ $employee->orders->count() }} orders</h3>
        </div>
        <div class="big-number">{{ $employee->orders->whereIn('status', ['Pending', 'In Progress'])->count() }}</div>
        <p class="text-muted">Active orders assigned</p>
    </div>
</div>

<div class="panel table-panel">
    <div class="panel-head">
        <span class="eyebrow">ORDER ASSIGNMENTS</span>
        <h3>Recent orders</h3>
    </div>
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr><th>Order</th><th>Customer</th><th>Garment</th><th>Status</th></tr>
            </thead>
            <tbody>
            @forelse($employee->orders as $order)
                <tr>
                    <td><a href="{{ route('orders.show', $order) }}" class="strong-link">{{ $order->order_code }}</a></td>
                    <td>{{ $order->customer->name }}</td>
                    <td>{{ $order->garment_type }}</td>
                    <td><span class="status status-{{ \Illuminate\Support\Str::slug($order->status) }}">{{ $order->status }}</span></td>
                </tr>
            @empty
                <tr><td colspan="4" class="empty">No orders assigned.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
