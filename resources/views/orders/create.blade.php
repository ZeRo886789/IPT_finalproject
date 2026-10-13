@extends('layouts.app')
@section('title','New Clothing Order · TailorDesk')
@section('page-title','New Clothing Order')
@section('content')
<div class="form-card">
    <div class="form-intro">
        <span class="icon-circle">▣</span>
        <div>
            <h2>Create a clothing order</h2>
            <p>Record the garment details, assigned staff and expected completion date.</p>
        </div>
    </div>
    <form method="POST" action="{{ route('orders.store') }}">
        @csrf
        @include('orders._form', ['submitLabel' => 'Create Order', 'order' => null])
    </form>
</div>
@endsection
