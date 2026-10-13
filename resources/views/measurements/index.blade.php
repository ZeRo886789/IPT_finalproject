@extends('layouts.app')
@section('title','Measurements · TailorDesk')
@section('page-title','Measurements')
@section('content')
<div class="page-head">
    <div class="lead">Reusable body measurements kept for accurate fitting.</div>
    <a href="{{ route('measurements.create') }}" class="btn btn-primary">＋ Add Measurement</a>
</div>

<form class="filter-bar" method="GET" action="{{ route('measurements.index') }}">
    <input type="text" name="q" value="{{ $q }}" class="form-control" placeholder="Search customer…">
    <button type="submit" class="btn btn-outline-secondary">Search</button>
    @if($q) <a href="{{ route('measurements.index') }}" class="btn btn-ghost">Clear</a> @endif
</form>

<div class="panel table-panel">
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr><th>Customer</th><th>Order</th><th>Chest</th><th>Waist</th><th>Hip</th><th>Shoulder</th><th>Unit</th><th class="text-end">Actions</th></tr>
            </thead>
            <tbody>
            @forelse($measurements as $m)
                <tr>
                    <td><a href="{{ route('customers.show', $m->customer) }}" class="strong-link">{{ $m->customer->name }}</a></td>
                    <td>{{ $m->order?->order_code ?? 'General' }}</td>
                    <td>{{ $m->chest ?? '—' }}</td>
                    <td>{{ $m->waist ?? '—' }}</td>
                    <td>{{ $m->hip ?? '—' }}</td>
                    <td>{{ $m->shoulder ?? '—' }}</td>
                    <td>{{ $m->unit }}</td>
                    <td class="actions text-end">
                        <a href="{{ route('measurements.show', $m) }}" class="text-wine">View</a>
                        <a href="{{ route('measurements.edit', $m) }}" class="text-wine">Edit</a>
                        <form method="POST" action="{{ route('measurements.destroy', $m) }}" class="d-inline" onsubmit="return confirm('Delete this measurement?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-danger btn-link">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="8" class="empty">No measurement records found.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination-wrap">
        {{ $measurements->onEachSide(1)->links('partials.pagination') }}
    </div>
</div>
@endsection
