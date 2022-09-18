<?php

namespace App\Http\Controllers\app;

//use Illuminate\Http\Request;

use App\Models\Repository;

class NovaPackagesController extends Controller
{
    /**
     * @return array
     */
    protected function indexData(): array
    {
        return [
            'repositories' => Repository::query()
                ->orderByDesc('github_pushed_at')
                ->where('name', '!=', 'lura')
                ->where('fork', false)
                ->whereJsonContains('topics', 'laravel-nova')
                ->paginate(50)
                ->withQueryString()
                ->through(fn(Repository $repository) => [
                    'name'           => $repository->name,
                    'description'    => $repository->description,
                    'homepage'       => $repository->homepage,
                    'stars'          => number_format($repository->stars),
                    'forks'          => number_format($repository->forks),
                    'watchers'       => number_format($repository->watchers),
                    'rating'         => $repository->rating,
                    'ratingCount'    => number_format($repository->rating_count),
                    'downloads'      => number_format($repository->packagist_downloads),
                    'topics'         => $repository->topics,
                    'novaPackageUrl' => $repository->novapackages_url,
                ])
        ];
    }
}
