@extends('layouts.app')
@section('title','Record Payment · TailorDesk')
@section('page-title','Record Payment')
@section('content')
<div class="form-card">
    <div class="form-intro">
        <span class="icon-circle">₱</span>
        <div>
            <h2>Record a payment</h2>
            <p>Deposits and balances are linked directly to a clothing order.</p>
        </div>
    </div>
    <form method="POST" action="{{ route('payments.store') }}">
        @csrf
        @include('payments._form', ['submitLabel' => 'Save Payment', 'payment' => null])
    </form>
</div>
@endsection
