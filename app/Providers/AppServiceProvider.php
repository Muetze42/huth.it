<?php

namespace App\Providers;

use Illuminate\Support\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->app->extend('url', function (\Illuminate\Routing\UrlGenerator $urlGenerator) {
            return new \App\Helpers\UrlGenerator(
                $this->app->make('router')->getRoutes(),
                $urlGenerator->getRequest(),
                $this->app->make('config')->get('app.asset_url')
            );
        });

        JsonResource::withoutWrapping();

        Password::defaults(static function () {
            return Password::min(12)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised();
        });

        Carbon::macro('responseToDateTimeString', function (string $datetime): string {
            $carbon = Carbon::createFromFormat('Y-m-d\TH:i:s\Z', $datetime, 'UTC')
                ->setTimezone(config('app.timezone', 'Europe/Berlin'))
                ->toDateTimeString();
            return !$carbon ? $datetime : $carbon;
        });
    }
}
