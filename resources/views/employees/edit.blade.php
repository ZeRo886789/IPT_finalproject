@extends('layouts.app')
@section('title','Edit Employee · TailorDesk')
@section('page-title','Edit Employee')
@section('content')
<div class="form-card">
    <div class="form-intro">
        <span class="icon-circle">✦</span>
        <div>
            <h2>Update {{ $employee->name }}</h2>
            <p>Keep the staff record current.</p>
        </div>
    </div>
    <form method="POST" action="{{ route('employees.update', $employee) }}">
        @csrf @method('PUT')
        @include('employees._form', ['submitLabel' => 'Save Changes'])
    </form>
</div>
@endsection
