<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app.layout';

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
        $pageTitle = config('app.name');
        $routeName = Route::currentRouteName();
        if (!empty($routeName)) {
            $parts = explode('.', $routeName);
            if (!empty($parts[1])) {

            }
        }

        view()->share('pageTitle', $pageTitle);

        return array_merge(parent::share($request), [
            'pageTitle' => $pageTitle,
            'faIcon'    => config('this.fontawesome.set', 'fas'),
            'faClass'   => config('this.fontawesome.class', 'fa-fw'),
        ]);
    }
}
