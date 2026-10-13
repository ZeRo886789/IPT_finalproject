<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('players.index', ['players' => Player::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('players.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'team_id' => 'required|exists:teams,team_id',
            'name' => 'required|string|max:255',
            'jersey_no' => 'required|integer|min:1|max:99',
            'position' => 'required|string|max:255',
            'age' => 'required|integer|min:18|max:35',
        ]);

        Player::create($data);

        return redirect()->route('players.index')->with('success', 'Player created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Player $player)
    {
        return view('players.show', compact('player'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Player $player)
    {
        return view('players.edit', compact('player'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Player $player)
    {
        $data = $request->validate([
            'team_id' => 'sometimes|exists:teams,team_id',
            'name' => 'sometimes|string|max:255',
            'jersey_no' => 'sometimes|integer|min:1|max:99',
            'position' => 'sometimes|string|max:255',
            'age' => 'sometimes|integer|min:18|max:35',
        ]);

        $player->update($data);

        return redirect()->route('players.index')->with('success', 'Player updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Player $player)
    {
        $player->delete();

        return redirect()->route('players.index')->with('success', 'Player deleted.');
    }
}