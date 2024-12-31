<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FilmController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(AuthController::class)->group(function () {
    Route::post('/admin/auth', 'authenticate')->name('admin.auth');
});

Route::controller(FilmController::class)->group(function () {
    Route::get('/films/search', 'search')->name('films.search');

    Route::post('/films', 'store')->name('films.store')->middleware('is_admin');
    Route::get('/films', 'index')->name('films.index');
    Route::get('/films/{id}', 'show')->name('films.show');
    Route::put('/films/{id}', 'update')->name('films.update')->middleware('is_admin');
    Route::delete('/films/{id}', 'destroy')->name('films.destroy')->middleware('is_admin');
});
