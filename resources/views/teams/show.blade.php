@extends('layouts.app')

@section('content')
<h1>Team Details</h1>

<table class="table table-bordered w-50">
    <tr>
        <th>ID</th><td>{{ $team->team_id }}</td>
    </tr>
    <tr>
        <th>Coach</th><td>{{ $team->coach->coach_name ?? 'N/A' }}</td>
    </tr>
    <tr>
        <th>Team Name</th><td>{{ $team->team_name }}</td>
    </tr>
    <tr>
        <th>City</th><td>{{ $team->city }}</td>
    </tr>
    <tr>
        <th>Tel No</th><td>{{ $team->tel_no }}</td>
    </tr>
    <tr>
        <th>Founded Year</th><td>{{ $team->founded_year }}</td>
    </tr>
</table>

<a href="{{ route('teams.edit', $team) }}" class="btn btn-warning">Edit</a>
<form action="{{ route('teams.destroy', $team) }}" method="POST" style="display:inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this team?')">Delete</button>
</form>
@endsection
