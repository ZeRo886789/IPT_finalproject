@extends('layouts.app')
@section('title','Edit Payment · TailorDesk')
@section('page-title','Edit Payment')
@section('content')
<div class="form-card">
    <div class="form-intro">
        <span class="icon-circle">₱</span>
        <div>
            <h2>Update payment</h2>
            <p>Correct payment details or status.</p>
        </div>
    </div>
    <form method="POST" action="{{ route('payments.update', $payment) }}">
        @csrf @method('PUT')
        @include('payments._form', ['submitLabel' => 'Save Changes'])
    </form>
</div>
@endsection
