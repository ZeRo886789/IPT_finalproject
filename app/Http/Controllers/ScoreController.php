<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('scores.index', ['scores' => Score::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('scores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'game_id' => 'required|exists:games,game_id',
            'team_id' => 'required|exists:teams,team_id',
            'points' => 'required|integer|min:0',
            'quarter' => 'required|integer|min:1|max:4',
            'score_type' => 'required|string|max:255',
            'score_time' => 'required|date_format:H:i:s',
        ]);

        Score::create($data);

        return redirect()->route('scores.index')->with('success', 'Score created.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Score $score)
    {
        return view('scores.edit', compact('score'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Score $score)
    {
        $data = $request->validate([
            'game_id' => 'sometimes|exists:games,game_id',
            'team_id' => 'sometimes|exists:teams,team_id',
            'points' => 'sometimes|integer|min:0',
            'quarter' => 'sometimes|integer|min:1|max:4',
            'score_type' => 'sometimes|string|max:255',
            'score_time' => 'sometimes|date_format:H:i:s',
        ]);

        $score->update($data);

        return redirect()->route('scores.index')->with('success', 'Score updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Score $score)
    {
        $score->delete();

        return redirect()->route('scores.index')->with('success', 'Score deleted.');
    }
}