<?php

namespace App\Http\Controllers;

use App\Models\Horse;
use App\Models\TurnoutLog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TurnoutController extends Controller
{
    /**
     * Pferd rausbringen
     */
    public function bringOut(Request $request, Horse $horse)
    {
        $request->validate([
            'pasture_id' => 'required|exists:pastures,id',
        ]);

        // WICHTIG: Boxenruhe-Check
        if ($horse->box_rest) {
            return redirect()->route('dashboard')
                ->with('error', $horse->name . ' hat Boxenruhe und darf nicht raus!');
        }

        // Prüfen ob Pferd bereits draußen ist
        $existingLog = TurnoutLog::where('horse_id', $horse->id)
            ->whereDate('brought_out_at', Carbon::today())
            ->whereNull('brought_in_at')
            ->first();

        if ($existingLog) {
            return redirect()->route('dashboard')
                ->with('error', $horse->name . ' ist bereits draußen!');
        }

        // Heutigen Dienst finden (optional)
        $todayDuty = \App\Models\Duty::whereDate('date', Carbon::today())->first();

        // Log-Eintrag erstellen
        TurnoutLog::create([
            'horse_id' => $horse->id,
            'duty_id' => $todayDuty ? $todayDuty->id : null,
            'pasture_id' => $request->pasture_id,
            'brought_out_at' => Carbon::now(),
            'brought_in_at' => null,
        ]);

        return redirect()->route('dashboard')
            ->with('success', $horse->name . ' wurde rausgebracht!');
    }

    /**
     * Pferd reinholen
     */
    public function bringIn(Horse $horse)
    {
        // Letzten Log-Eintrag von heute finden
        $log = TurnoutLog::where('horse_id', $horse->id)
            ->whereDate('brought_out_at', Carbon::today())
            ->whereNull('brought_in_at')
            ->latest('brought_out_at')
            ->first();

        if (!$log) {
            return redirect()->route('dashboard')
                ->with('error', $horse->name . ' ist nicht draußen!');
        }

        // brought_in_at setzen
        $log->update([
            'brought_in_at' => Carbon::now(),
        ]);

        return redirect()->route('dashboard')
            ->with('success', $horse->name . ' wurde reingeholt!');
    }
}