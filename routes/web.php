<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::post('/register', [RegistrationController::class, 'store'])
    ->name('registration.store');
