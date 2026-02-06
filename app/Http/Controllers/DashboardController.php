<?php

namespace App\Http\Controllers;

use App\Models\Horse;
use App\Models\Owner;
use App\Models\Pasture;
use App\Models\Duty;
use App\Models\TurnoutLog;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // Heutiger Dienst
        $todayDuty = Duty::whereDate('date', Carbon::today())->first();

        // Pferde die aktuell draußen sind (brought_out_at gesetzt, brought_in_at noch NULL)
        $horsesOutside = Horse::whereHas('turnoutLogs', function ($query) use ($today) {
            $query->whereDate('brought_out_at', $today)
                ->whereNull('brought_in_at');
        })->with('owner')->get();

        // Pferde die drinnen sind (kein Log heute ODER brought_in_at ist gesetzt)
        $horsesInside = Horse::whereDoesntHave('turnoutLogs', function ($query) use ($today) {
            $query->whereDate('brought_out_at', $today)
                ->whereNull('brought_in_at');
        })->with('owner')->get();

        // Statistiken
        $stats = [
            'total_horses' => Horse::count(),
            'total_owners' => Owner::count(),
            'total_pastures' => Pasture::count(),
            'horses_outside' => $horsesOutside->count(),
            'horses_inside' => $horsesInside->count(),
        ];

        // Verfügbare Koppeln
        $pastures = Pasture::all();

        return view('dashboard', compact(
            'todayDuty',
            'horsesOutside',
            'horsesInside',
            'stats',
            'pastures'
        ));
    }
}