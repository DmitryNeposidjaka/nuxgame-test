<?php

namespace App\Providers;

use App\Contracts\RegistrationLinkGenerator;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
