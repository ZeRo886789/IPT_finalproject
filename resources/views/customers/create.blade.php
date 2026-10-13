@extends('layouts.app')
@section('title','Add Customer · TailorDesk')
@section('page-title','Add Customer')
@section('content')
<div class="form-card">
    <div class="form-intro">
        <span class="icon-circle">♙</span>
        <div>
            <h2>New customer profile</h2>
            <p>Keep contact information accurate so every order is easy to track.</p>
        </div>
    </div>
    <form method="POST" action="{{ route('customers.store') }}">
        @csrf
        @include('customers._form', ['submitLabel' => 'Save Customer', 'customer' => null])
    </form>
</div>
@endsection
