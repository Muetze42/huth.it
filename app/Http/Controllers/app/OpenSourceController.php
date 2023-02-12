<?php

namespace App\Http\Controllers\app;

use App\Models\Package;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class OpenSourceController extends Controller
{
    protected ?string $tag;

    /**
     * @param Request $request
     * @return array
     */
    protected function indexData(Request $request): array
    {
        $this->tag = $request->input('tag', 0);

        $packages = Package::active()
            ->orderByDesc('github_pushed_at')
            ->when($this->tag, function (Builder|Package $package) {
                $package->whereHas('tags', function (Builder|Tag $tag) {
                    $tag->where('name', $this->tag);
                });
            })
            ->paginate(5)
            ->withQueryString()
            ->through(fn(Package $package) => [
                'name'           => $package->name,
                'description'    => $package->description,
                'homepage'       => $package->homepage,
                'stars'          => number_format($package->stars),
                'forks'          => number_format($package->forks),
                'watchers'       => number_format($package->watchers),
                'rating'         => $package->rating,
                'ratingCount'    => number_format($package->rating_count),
                'downloads'      => number_format($package->packagist_downloads),
                'topics'         => $package->topics,
                'novaPackageUrl' => $package->novapackages_url,
            ]);

        return [
            'packages'   => $packages,
            'tags'       => array_merge([0 => 'No Filter'], Tag::has('packages')->orderBy('name')->pluck('name', 'name')->toArray()),
            'currentTag' => $this->tag,
        ];
    }
}
