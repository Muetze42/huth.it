<?php

namespace App\Helpers;

use App\Models\Page;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\View;

class Sitemap
{
    public function create()
    {
        $pages = Page::whereIn('robots', [2, 3])->get();

        $fs = new Filesystem;
        $fs->put(public_path('sitemap.xml'), View::make('xml.sitemap', ['pages' => $pages]));
    }
}
