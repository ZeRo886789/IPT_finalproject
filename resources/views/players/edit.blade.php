@extends('layouts.app')

@section('content')
<h1>Edit Player</h1>
<form action="{{ route('players.update', $player) }}" method="POST" class="mt-4">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="form-label">Team ID</label>
        <input type="number" name="team_id" class="form-control" value="{{ old('team_id', $player->team_id) }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $player->name) }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Jersey No</label>
        <input type="number" name="jersey_no" class="form-control" value="{{ old('jersey_no', $player->jersey_no) }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Position</label>
        <input type="text" name="position" class="form-control" value="{{ old('position', $player->position) }}">
    </div>
    <div class="mb-3">
        <label class="form-label">Age</label>
        <input type="number" name="age" class="form-control" value="{{ old('age', $player->age) }}">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('players.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection