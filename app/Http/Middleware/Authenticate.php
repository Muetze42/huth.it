<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  Request  $request
     * @return string|null
     */
    protected function redirectTo($request): ?string
    {
        $gatherMiddleware = $request->route()->gatherMiddleware();
        if (is_array($gatherMiddleware) && in_array('api', $gatherMiddleware)) {
            abort(Response::HTTP_UNAUTHORIZED, __(Response::$statusTexts[Response::HTTP_UNAUTHORIZED]));
        }

//        if (!$request->expectsJson()) {
//            return route('login');
//        }

        return null;
    }
}
