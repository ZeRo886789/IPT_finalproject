@extends('layouts.app')
@section('title','Payments · TailorDesk')
@section('page-title','Payments')
@section('content')
<div class="page-head">
    <div class="lead">Deposits, balances and payment references.</div>
    <a href="{{ route('payments.create') }}" class="btn btn-primary">＋ Record Payment</a>
</div>

<form class="filter-bar" method="GET" action="{{ route('payments.index') }}">
    <input type="text" name="q" value="{{ $q }}" class="form-control" placeholder="Search order, customer or reference…">
    <button type="submit" class="btn btn-outline-secondary">Search</button>
    @if($q) <a href="{{ route('payments.index') }}" class="btn btn-ghost">Clear</a> @endif
</form>

<div class="panel table-panel">
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr><th>Date</th><th>Order</th><th>Customer</th><th>Method</th><th>Reference</th><th class="text-end">Amount</th><th>Status</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
            @forelse($payments as $p)
                <tr>
                    <td>{{ $p->payment_date->format('M d, Y') }}</td>
                    <td><a href="{{ route('orders.show', $p->order) }}" class="strong-link">{{ $p->order->order_code }}</a></td>
                    <td>{{ $p->order->customer->name }}</td>
                    <td>{{ $p->payment_method }}</td>
                    <td>{{ $p->reference_no ?: '—' }}</td>
                    <td class="text-end">₱{{ number_format($p->amount, 2) }}</td>
                    <td><span class="status status-{{ \Illuminate\Support\Str::slug($p->status) }}">{{ $p->status }}</span></td>
                    <td class="actions text-end">
                        <a href="{{ route('payments.show', $p) }}" class="text-wine">View</a>
                        <a href="{{ route('payments.edit', $p) }}" class="text-wine">Edit</a>
                        <form method="POST" action="{{ route('payments.destroy', $p) }}" class="d-inline" onsubmit="return confirm('Delete this payment?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-danger btn-link">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8" class="empty">No payments found.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination-wrap">
        {{ $payments->onEachSide(1)->links('partials.pagination') }}
    </div>
</div>
@endsection
