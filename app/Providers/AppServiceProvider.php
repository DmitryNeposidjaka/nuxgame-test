<?php

namespace App\Providers;

use App\Contracts\RandomNumberGenerator;
use App\Contracts\RegistrationLinkGenerator;
use App\Services\RandomNumberService;
use App\Services\RegistrationLinkService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            RegistrationLinkGenerator::class,
            RegistrationLinkService::class,
        );
        $this->app->bind(
            RandomNumberGenerator::class,
            RandomNumberService::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
