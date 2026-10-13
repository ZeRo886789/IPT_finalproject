<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use Illuminate\Http\Request;

class CoachController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('coaches.index', ['coaches' => Coach::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('coaches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'coach_name' => 'required|string|max:255',
            'contact_no' => 'required|string|max:255',
            'experience_year' => 'required|integer|min:1',
            'specialization' => 'required|string|max:255',
        ]);

        Coach::create($data);

        return redirect()->route('coaches.index')->with('success', 'Coach created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Coach $coach)
    {
        return view('coaches.show', compact('coach'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coach $coach)
    {
        return view('coaches.edit', compact('coach'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Coach $coach)
    {
        $data = $request->validate([
            'coach_name' => 'sometimes|string|max:255',
            'contact_no' => 'sometimes|string|max:255',
            'experience_year' => 'sometimes|integer|min:1',
            'specialization' => 'sometimes|string|max:255',
        ]);

        $coach->update($data);

        return redirect()->route('coaches.index')->with('success', 'Coach updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coach $coach)
    {
        $coach->delete();

        return redirect()->route('coaches.index')->with('success', 'Coach deleted.');
    }
}