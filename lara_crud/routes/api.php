<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CinemaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(AuthController::class)->group(function () {
    Route::post('/admin/auth', 'authenticate')->name('admin.auth');
});

Route::controller(CinemaController::class)->group(function () {
    Route::get('/cinemas/search', 'search')->name('cinemas.search');

    Route::post('/cinemas', 'store')->name('cinemas.store')->middleware('is_admin');
    Route::get('/cinemas', 'index')->name('cinemas.index');
    Route::get('/cinemas/{id}', 'show')->name('cinemas.show');
    Route::put('/cinemas/{id}')->name('cinemas.update')->middleware('is_admin');
    Route::delete('/cinemas/{id}')->name('cinemas.delete')->middleware('is_admin');
});
