<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Validation\Rules\Password;
use NormanHuth\Helpers\Macros\CarbonTrait;

class AppServiceProvider extends ServiceProvider
{
    use CarbonTrait;

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
        $this->responseToDateTimeString();

        JsonResource::withoutWrapping();

        Password::defaults(static function () {
            return Password::min(12)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols()
                ->uncompromised();
        });
    }
}
