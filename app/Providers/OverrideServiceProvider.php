<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class OverrideServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->app->bind(\Illuminate\Routing\UrlGenerator::class,
            \App\Helpers\UrlGenerator::class);
    }
}
