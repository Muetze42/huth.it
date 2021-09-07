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
     * @return void
     */
    protected function redirectTo($request): void
    {
        if (! $request->expectsJson()) {
//            return route('login');
            abort(Response::HTTP_UNAUTHORIZED);
        }
    }
}
