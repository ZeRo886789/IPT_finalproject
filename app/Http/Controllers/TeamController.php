<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('teams.index', ['teams' => Team::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'coach_id' => 'required|exists:coaches,coach_id',
            'team_name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'tel_no' => 'required|string|max:255',
            'founded_year' => 'required|integer|min:1900|max:2100',
        ]);

        Team::create($data);

        return redirect()->route('teams.index')->with('success', 'Team created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        return view('teams.show', compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        return view('teams.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        $data = $request->validate([
            'coach_id' => 'sometimes|exists:coaches,coach_id',
            'team_name' => 'sometimes|string|max:255',
            'city' => 'sometimes|string|max:255',
            'tel_no' => 'sometimes|string|max:255',
            'founded_year' => 'sometimes|integer|min:1900|max:2100',
        ]);

        $team->update($data);

        return redirect()->route('teams.index')->with('success', 'Team updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        $team->delete();

        return redirect()->route('teams.index')->with('success', 'Team deleted.');
    }
}