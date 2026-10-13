@extends('layouts.app')
@section('title','Edit Measurement · TailorDesk')
@section('page-title','Edit Measurement')
@section('content')
<div class="form-card">
    <div class="form-intro">
        <span class="icon-circle">⌁</span>
        <div>
            <h2>Update measurements</h2>
            <p>Correct or update the customer's fitting record.</p>
        </div>
    </div>
    <form method="POST" action="{{ route('measurements.update', $measurement) }}">
        @csrf @method('PUT')
        @include('measurements._form', ['submitLabel' => 'Save Changes'])
    </form>
</div>
@endsection
