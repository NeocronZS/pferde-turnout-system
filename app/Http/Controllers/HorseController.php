<?php

namespace App\Http\Controllers;

use App\Models\Horse;
use App\Models\Owner;
use Illuminate\Http\Request;

class HorseController extends Controller
{
    public function index()
    {
        $horses = Horse::with('owner')->get();
        return view('horses.index', compact('horses'));
    }

    public function create()
    {
        $owners = Owner::all();
        return view('horses.create', compact('owners'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'owner_id' => 'required|exists:owners,id',
            'box_number' => 'nullable|string|max:50',
            'gender' => 'nullable|in:Stute,Wallach',
            'box_rest' => 'boolean',
        ]);

        $validated['box_rest'] = $request->has('box_rest') ? 1 : 0;

        Horse::create($validated);

        return redirect()->route('horses.index')
            ->with('success', 'Pferd erfolgreich angelegt.');
    }

    public function edit(Horse $horse)
    {
        $owners = Owner::all();
        return view('horses.edit', compact('horse', 'owners'));
    }

    public function update(Request $request, Horse $horse)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'owner_id' => 'required|exists:owners,id',
            'box_number' => 'nullable|string|max:50',
            'gender' => 'nullable|in:Stute,Wallach',
        ]);

        // WICHTIG: Checkbox-Handling
        $validated['box_rest'] = $request->has('box_rest') ? 1 : 0;

        $horse->update($validated);

        return redirect()->route('horses.index')
            ->with('success', 'Pferd erfolgreich aktualisiert.');
    }

    public function destroy(Horse $horse)
    {
        $horse->delete();

        return redirect()->route('horses.index')
            ->with('success', 'Pferd erfolgreich gelöscht.');
    }

}