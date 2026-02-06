<?php

namespace App\Http\Controllers;

use App\Models\Pasture;
use Illuminate\Http\Request;

class PastureController extends Controller
{
    public function index()
    {
        $pastures = Pasture::all();
        return view('pastures.index', compact('pastures'));
    }

    public function create()
    {
        return view('pastures.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
        ]);

        Pasture::create($validated);

        return redirect()->route('pastures.index')
            ->with('success', 'Koppel erfolgreich angelegt.');
    }

    public function edit(Pasture $pasture)
    {
        return view('pastures.edit', compact('pasture'));
    }

    public function update(Request $request, Pasture $pasture)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
        ]);

        $pasture->update($validated);

        return redirect()->route('pastures.index')
            ->with('success', 'Koppel erfolgreich aktualisiert.');
    }

    public function destroy(Pasture $pasture)
    {
        $pasture->delete();

        return redirect()->route('pastures.index')
            ->with('success', 'Koppel erfolgreich gelöscht.');
    }
}