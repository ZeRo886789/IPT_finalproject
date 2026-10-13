@extends('layouts.app')
@section('title','Add Measurement · TailorDesk')
@section('page-title','Add Measurement')
@section('content')
<div class="form-card">
    <div class="form-intro">
        <span class="icon-circle">⌁</span>
        <div>
            <h2>Record body measurements</h2>
            <p>Measurements are stored in inches or centimeters and can be reused for future orders.</p>
        </div>
    </div>
    <form method="POST" action="{{ route('measurements.store') }}">
        @csrf
        @include('measurements._form', ['submitLabel' => 'Save Measurement', 'measurement' => null])
    </form>
</div>
@endsection
