@extends('layouts.app')

@section('content')
<h1>Edit Coach</h1>
<form action="{{ route('coaches.update', $coach) }}" method="POST" class="mt-4">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">Coach Name</label>
        <input type="text" name="coach_name" class="form-control" value="{{ old('coach_name', $coach->coach_name) }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Contact No</label>
        <input type="text" name="contact_no" class="form-control" value="{{ old('contact_no', $coach->contact_no) }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Experience Year</label>
        <input type="number" name="experience_year" class="form-control" value="{{ old('experience_year', $coach->experience_year) }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Specialization</label>
        <input type="text" name="specialization" class="form-control" value="{{ old('specialization', $coach->specialization) }}">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('coaches.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection