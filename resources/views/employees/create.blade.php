@extends('layouts.app')
@section('title','Add Employee · TailorDesk')
@section('page-title','Add Employee')
@section('content')
<div class="form-card">
    <div class="form-intro">
        <span class="icon-circle">✦</span>
        <div>
            <h2>New employee</h2>
            <p>Add a team member who can be assigned to clothing orders.</p>
        </div>
    </div>
    <form method="POST" action="{{ route('employees.store') }}">
        @csrf
        @include('employees._form', ['submitLabel' => 'Save Employee', 'employee' => null])
    </form>
</div>
@endsection
