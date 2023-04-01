<?php

namespace App\Http\Controllers\app;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        return Inertia::render(
            str_replace('Controller', '', class_basename($this)).'/Index',
            $this->indexData($request)
        );
    }

    /**
     * @param Request $request
     * @return array
     */
    protected function indexData(Request $request): array
    {
        return [];
    }
}
