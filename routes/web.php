<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\HorseController;
use App\Http\Controllers\DutyController;
use App\Http\Controllers\TurnoutLogController;
use App\Http\Controllers\PastureController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TurnoutController;

// Dashboard als Startseite
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Turnout-Aktionen
Route::post('/turnout/{horse}/out', [TurnoutController::class, 'bringOut'])->name('turnout.out');
Route::post('/turnout/{horse}/in', [TurnoutController::class, 'bringIn'])->name('turnout.in');

Route::resource('owners', OwnerController::class);
Route::resource('horses', HorseController::class);
Route::resource('duties', DutyController::class);
Route::resource('turnout-logs', TurnoutLogController::class);
Route::resource('pastures', PastureController::class);