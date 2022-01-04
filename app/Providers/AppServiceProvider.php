<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Paginator\LengthAwarePaginator;
use Illuminate\Pagination\LengthAwarePaginator as BaseBaseLengthAwarePaginator;
use Illuminate\Http\Resources\Json\JsonResource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        app()->bind(BaseBaseLengthAwarePaginator::class, LengthAwarePaginator::class);
        JsonResource::withoutWrapping();
    }
}
