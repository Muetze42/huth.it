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
                ->orderByDesc('github_updated_at')
                ->whereJsonContains('topics', 'laravel-nova')
                ->paginate(50)
                ->withQueryString()
                ->through(fn(Repository $repository) => [
                    'name'           => $repository->name,
                    'description'    => $repository->description,
                    'homepage'       => $repository->homepage,
                    'stars'          => $repository->stars,
                    'forks'          => $repository->forks,
                    'watchers'       => $repository->watchers,
                    'rating'         => $repository->rating,
                    'ratingCount'    => $repository->rating_count,
                    'downloads'      => $repository->packagist_downloads,
                    'topics'         => $repository->topics,
                    'novaPackageUrl' => $repository->novapackages_url,
                ])
        ];
    }
}
