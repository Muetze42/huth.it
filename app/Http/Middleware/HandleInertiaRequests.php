<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param Request $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param Request $request
     * @return array
     */
    public function share(Request $request): array
    {
        $route = Route::currentRouteName();
        $routePart = explode('.', $route)[0];
        $pageTitle = config('app.name');
        if ($routePart && $routePart != 'home') {
            $routePart = str_replace('-', ' ', $routePart);
            $pageTitle = ucwords($routePart).' « '.$pageTitle;
        }

        view()->share('pageTitle', $pageTitle);

        return array_merge(parent::share($request), [
            'csrf_token'    => csrf_token(),
            'pageTitle'     => $pageTitle,
            'authed'        => auth()->check(),
        ]);
    }
}
