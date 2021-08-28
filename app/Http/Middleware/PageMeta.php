<?php

namespace App\Http\Middleware;

use App\Models\Page;
use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

class PageMeta
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $route = Route::currentRouteName();
        $page = null;
        if ($route) {
            $route = explode('.', $route)[0];

            $page = Page::where('route', $route)->first();

            if ($page) {
                $page['imageUrl'] = $page->getFirstMediaUrl('og', 'og');
                $page['imagePath'] = $page->getFirstMediaPath('og', 'og');
                $page = $page->toArray();
                $page['robots'] = Page::ROBOTS[$page['robots']];
                unset($page['media']);
            }

            Inertia::share('metaTitle', $page['title']);
            Inertia::share('currentRoute', $page['route']);
        }

        view()->share('pageMeta', $page);

        return $next($request);
    }
}
