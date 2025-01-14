<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return redirect()->route('home');
});


Auth::routes();


Route::get('/home', [HomeController::class, 'index'])->name('home');