@extends('layouts.app')
@section('title','Edit Customer · TailorDesk')
@section('page-title','Edit Customer')
@section('content')
<div class="form-card">
    <div class="form-intro">
        <span class="icon-circle">♙</span>
        <div>
            <h2>Update {{ $customer->name }}</h2>
            <p>Edit contact information, address or notes for this customer.</p>
        </div>
    </div>
    <form method="POST" action="{{ route('customers.update', $customer) }}">
        @csrf @method('PUT')
        @include('customers._form', ['submitLabel' => 'Save Changes'])
    </form>
</div>
@endsection
