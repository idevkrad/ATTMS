<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/myrequests', [App\Http\Controllers\HomeController::class, 'myrequests']);
Route::post('registration', [App\Http\Controllers\HomeController::class, 'store']);
Route::get('search', [App\Http\Controllers\HomeController::class, 'index']);
Route::post('/pdf', [App\Http\Controllers\HomeController::class, 'pdf']);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function () {  return inertia('Modules/Home/Index'); });
    Route::resource('registrants', App\Http\Controllers\RegistrationController::class);
    Route::resource('requests', App\Http\Controllers\RequestController::class);
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::resource('policies', App\Http\Controllers\PolicyController::class);
    Route::resource('theses', App\Http\Controllers\ThesisController::class);
    Route::resource('names', App\Http\Controllers\NameController::class);
});

require __DIR__.'/auth.php';