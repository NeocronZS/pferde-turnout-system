<?php

namespace App\Http\Controllers;

use App\Models\TurnoutLog;
use Illuminate\Http\Request;

class TurnoutLogController extends Controller
{
    public function index(Request $request)
    {
        // Filter nach Datum (optional)
        $query = TurnoutLog::with(['horse.owner', 'duty']);

        if ($request->has('date')) {
            $query->whereDate('brought_out_at', $request->date);
        }

        // Sortierung: Neueste zuerst
        $logs = $query->orderBy('brought_out_at', 'desc')->paginate(20);

        return view('turnout_logs.index', compact('logs'));
    }

    public function bringOut(TurnoutLog $turnoutLog)
    {
        $turnoutLog->update([
            'brought_out_at' => now(),
        ]);

        return back()->with('success', $turnoutLog->horse->name . ' wurde rausgebracht.');
    }

    public function bringIn(TurnoutLog $turnoutLog)
    {
        $turnoutLog->update([
            'brought_in_at' => now(),
        ]);

        return back()->with('success', $turnoutLog->horse->name . ' wurde reingebracht.');
    }

    public function skip(TurnoutLog $turnoutLog, Request $request)
    {
        $validated = $request->validate([
            'notes' => 'nullable|string',
        ]);

        $turnoutLog->update([
            'skipped' => true,
            'notes' => $validated['notes'] ?? 'Übersprungen',
        ]);

        return back()->with('success', $turnoutLog->horse->name . ' wurde übersprungen.');
    }

    public function reset(TurnoutLog $turnoutLog)
    {
        $turnoutLog->update([
            'brought_out_at' => null,
            'brought_in_at' => null,
            'skipped' => false,
            'notes' => null,
        ]);

        return back()->with('success', 'Eintrag für ' . $turnoutLog->horse->name . ' wurde zurückgesetzt.');
    }
}