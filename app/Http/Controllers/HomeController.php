<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Link;
use App\Models\Page;

class HomeController extends Controller
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        $links = Link::where('active', true)->orderBy('order')->get();

        return Inertia::render('Home/Index', [
            'links' => $links,
        ]);
    }
}
