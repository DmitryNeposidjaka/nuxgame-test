<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Middleware\EnsureRegistrationLinkIsActive;
use App\Http\Controllers\PageAController;
use App\Http\Controllers\LuckyController;
use App\Http\Controllers\RegistrationLinkController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::post('/register', [RegistrationController::class, 'store'])
    ->name('registration.store');

Route::middleware(EnsureRegistrationLinkIsActive::class)
    ->prefix('page-a/{token}')
    ->group(function () {
        Route::get('/', [PageAController::class, 'show'])
            ->name('page-a.show');

        Route::post('/play', [LuckyController::class, 'store'])
            ->name('page-a.play');

        Route::post('/regenerate', [RegistrationLinkController::class, 'regenerate'])
            ->name('page-a.regenerate');

        Route::post('/deactivate', [RegistrationLinkController::class, 'deactivate'])
            ->name('page-a.deactivate');
    });
