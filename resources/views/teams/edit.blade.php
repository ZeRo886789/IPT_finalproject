@extends('layouts.app')

@section('content')
<h1>Edit Team</h1>
<form action="{{ route('teams.update', $team) }}" method="POST" class="mt-4">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">Coach ID</label>
        <input type="number" name="coach_id" class="form-control" value="{{ old('coach_id', $team->coach_id) }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Team Name</label>
        <input type="text" name="team_name" class="form-control" value="{{ old('team_name', $team->team_name) }}">
    </div>
    <div class="mb-3">
        <label class="form-label">City</label>
        <input type="text" name="city" class="form-control" value="{{ old('city', $team->city) }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Phone</label>
        <input type="text" name="tel_no" class="form-control" value="{{ old('tel_no', $team->tel_no) }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Founded Year</label>
        <input type="number" name="founded_year" class="form-control" value="{{ old('founded_year', $team->founded_year) }}">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('teams.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection