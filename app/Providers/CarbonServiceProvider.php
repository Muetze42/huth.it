<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Carbon;

class CarbonServiceProvider extends ServiceProvider
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
        Carbon::macro('createFromApi', function (string $datetime) {
            return Carbon::createFromFormat('Y-m-d\TH:i:s\Z', $datetime, 'UTC');
        });
        Carbon::macro('fromApiToDateTimeString', function (string $datetime) {
            $carbon = Carbon::createFromFormat('Y-m-d\TH:i:s\Z', $datetime, 'UTC')
                ->setTimezone(config('app.timezone', 'Europe/Berlin'))
                ->toDateTimeString();
            return !$carbon ? $datetime : $carbon;
        });
    }
}
