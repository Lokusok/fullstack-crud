<?php

use App\Http\Controllers\CinemaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/cinemas/search', [CinemaController::class, 'search'])->name('cinemas.search');
Route::resource('cinemas', CinemaController::class);
