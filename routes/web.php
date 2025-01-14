<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\GameController;

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

// Rotta /home
Route::get('/home', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Rotte per l'avventura
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function() {
    // Start dell'avventura
    Route::get('/game/start', [GameController::class, 'start'])->name('game.start');

    // Visualizza il capitolo corrente
    Route::get('/game/current', [GameController::class, 'showCurrentChapter'])->name('game.current');

    // Processa la scelta
    Route::post('/game/choice', [GameController::class, 'processChoice'])->name('game.processChoice');
});