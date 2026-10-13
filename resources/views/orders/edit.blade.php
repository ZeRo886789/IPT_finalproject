@extends('layouts.app')
@section('title','Edit Order · TailorDesk')
@section('page-title','Edit Clothing Order')
@section('content')
<div class="form-card">
    <div class="form-intro">
        <span class="icon-circle">▣</span>
        <div>
            <h2>Update {{ $order->order_code }}</h2>
            <p>Adjust garment details, assignment, pricing or status.</p>
        </div>
    </div>
    <form method="POST" action="{{ route('orders.update', $order) }}">
        @csrf @method('PUT')
        @include('orders._form', ['submitLabel' => 'Save Changes'])
    </form>
</div>
@endsection
