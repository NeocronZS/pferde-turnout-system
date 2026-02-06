<?php

namespace App\Http\Controllers;

use App\Models\Duty;
use Illuminate\Http\Request;

class DutyController extends Controller
{
    public function index()
    {
        $duties = Duty::orderBy('date', 'desc')->get();
        return view('duties.index', compact('duties'));
    }

    public function create()
    {
        return view('duties.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'person_name' => 'required|string|max:255',
        ]);

        Duty::create([
            'date' => $validated['date'],
            'person_name' => $validated['person_name'],
        ]);

        return redirect()->route('duties.index')
            ->with('success', 'Dienst erfolgreich eingetragen.');
    }

    public function edit(Duty $duty)
    {
        return view('duties.edit', compact('duty'));
    }

    public function update(Request $request, Duty $duty)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'person_name' => 'required|string|max:255',
        ]);

        $duty->update([
            'date' => $validated['date'],
            'person_name' => $validated['person_name'],
        ]);

        return redirect()->route('duties.index')
            ->with('success', 'Dienst erfolgreich aktualisiert.');
    }

    public function destroy(Duty $duty)
    {
        $duty->delete();

        return redirect()->route('duties.index')
            ->with('success', 'Dienst erfolgreich gelöscht.');
    }
}