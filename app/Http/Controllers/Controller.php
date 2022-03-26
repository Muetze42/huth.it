<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Inertia\Inertia;
use Inertia\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render(str_replace('Controller', '', class_basename($this)).'/Index', $this->indexData());
    }

    /**
     * @return array
     */
    public function indexData(): array
    {
        return [];
    }
}
