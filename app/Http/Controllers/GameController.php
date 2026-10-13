<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('games.index', ['games' => Game::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('games.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'team_id' => 'required|exists:teams,team_id',
            'game_date' => 'required|date',
            'venue' => 'required|string|max:255',
            'time' => 'required|date_format:H:i:s',
            'game_status' => 'required|string|max:255',
        ]);

        Game::create($data);

        return redirect()->route('games.index')->with('success', 'Game created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        $game->load('team');
        return view('games.show', compact('game'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        return view('games.edit', compact('game'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        $data = $request->validate([
            'team_id' => 'sometimes|exists:teams,team_id',
            'game_date' => 'sometimes|date',
            'venue' => 'sometimes|string|max:255',
            'time' => 'sometimes|date_format:H:i:s',
            'game_status' => 'sometimes|string|max:255',
        ]);

        $game->update($data);

        return redirect()->route('games.index')->with('success', 'Game updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        $game->delete();

        return redirect()->route('games.index')->with('success', 'Game deleted.');
    }
}