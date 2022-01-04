<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MinifyHtml
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
        $response = $next($request);

        if($this->IsResponseObject($response) && $this->IsHtmlResponse($response)) {
            $source = $response->getContent();
            $response->setContent(MinifyHtml($source));
        }

        return $response;
    }

    /**
     * @param $response
     * @return bool
     */
    protected function IsResponseObject($response): bool
    {
        return $response instanceof Response;
    }

    /**
     * @param Response $response
     * @return bool
     */
    protected function IsHtmlResponse(Response $response): bool
    {
        $type = $response->headers->get('Content-Type');

        return strtolower(strtok($type, ';')) === 'text/html';
    }
}
