<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Link;

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

    /**
     * Handle the count stat for a link
     *
     * @param Link $link
     * @param Request $request
     */
    public function count(Link $link, Request $request)
    {
        $link->update(['real_count' => DB::raw('real_count+1')]);

        $delay = config('muetze-site.count_delay', 240);

        $data = [
            'link_id' => $link->id,
            'os'      => getClientOS(),
            'client'  => request()->userAgent(),
            'ip'      => md5(getClientIp()),
        ];

        $link->realCounts()->create($data);

        $count = $link->counts()->where($data)->where('created_at', '>', now()->subMinutes($delay))->first();

        if (!$count) {
            $link->update(['count' => DB::raw('count+1')]);

            $link->counts()->create($data);
        }
    }
}
