@extends('layouts.app')

@section('content')
<h1>Teams</h1>
<a href="{{ route('teams.create') }}" class="btn btn-primary mb-3">Add New Team</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Team Name</th>
            <th>City</th>
            <th>Phone</th>
            <th>Founded</th>
            <th>Coach</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($teams as $team)
        <tr>
            <td>{{ $team->team_id }}</td>
            <td>{{ $team->team_name }}</td>
            <td>{{ $team->city }}</td>
            <td>{{ $team->tel_no }}</td>
            <td>{{ $team->founded_year }}</td>
            <td>{{ $team->coach->coach_name ?? 'N/A' }}</td>
            <td>
                <a href="{{ route('teams.edit', $team) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('teams.destroy', $team) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this team?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection