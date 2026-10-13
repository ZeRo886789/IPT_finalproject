@extends('layouts.app')
@section('title','Measurement · TailorDesk')
@section('page-title','Measurement Details')
@section('content')
<div class="detail-head">
    <div>
        <span class="code">{{ $measurement->customer->customer_code }}</span>
        <h2>{{ $measurement->customer->name }}</h2>
        <p class="text-muted">Recorded {{ $measurement->created_at->format('M d, Y') }} · {{ $measurement->unit }}</p>
    </div>
    <div class="head-actions">
        <a href="{{ route('measurements.edit', $measurement) }}" class="btn btn-outline-secondary">Edit</a>
    </div>
</div>

<div class="measurement-big">
@foreach(['chest'=>'Chest','waist'=>'Waist','hip'=>'Hip','shoulder'=>'Shoulder','sleeve'=>'Sleeve','neck'=>'Neck','length'=>'Length'] as $key => $label)
    <div><span>{{ $label }}</span><strong>{{ $measurement->$key ?? '—' }}</strong><small>{{ $measurement->unit }}</small></div>
@endforeach
</div>

@if($measurement->order)
<div class="panel">
    <div class="panel-head">
        <div class="head-title"><span class="eyebrow">LINKED ORDER</span><h3>{{ $measurement->order->order_code }}</h3></div>
        <a href="{{ route('orders.show', $measurement->order) }}" class="text-link">View order →</a>
    </div>
    <p class="text-muted">{{ $measurement->order->garment_type }} · {{ $measurement->order->customer->name }}</p>
</div>
@endif

<div class="panel">
    <div class="panel-head"><div class="head-title"><span class="eyebrow">NOTES</span><h3>Fitting notes</h3></div></div>
    <p class="long-text">{{ $measurement->notes ?: 'No notes.' }}</p>
</div>
@endsection
