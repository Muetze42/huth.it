<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use ScssPhp\ScssPhp\Exception\SassException;

class AdditionalExists
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws SassException
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (!file_exists(public_path('css/buttons.css'))) {
            gerateAdditionalStylesheet();
        }

        if (!file_exists(public_path('sitemap.xml'))) {
            Artisan::call('sitemap');
        }

        if (!file_exists(public_path('js/ziggy.js'))) {
            Artisan::call('ziggy:production');
        }

        return $next($request);
    }
}
