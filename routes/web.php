<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {return inertia('Welcome');});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {  return inertia('Home/Index'); });
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::resource('policies', App\Http\Controllers\PolicyController::class);
    Route::resource('theses', App\Http\Controllers\ThesisController::class);
    Route::resource('names', App\Http\Controllers\NameController::class);
});

require __DIR__.'/auth.php';