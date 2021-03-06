<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class NovaPackagesController extends Controller
{
    /**
     * @return array
     */
    public function indexData(): array
    {
        $packages = Package::query()
            ->orderBy('released_at', 'desc')
            ->orderBy('pushed_at', 'desc')
            ->whereHas('tags', function ($query) {
                $query->where('name', 'laravel-nova');
            })
            ->paginate(6)
            ->withQueryString()
            ->through(fn($package) => [
                'name'        => $package->name,
                'description' => $package->description,
                'github'      => $package->github,
                'packagist'   => $package->packagist,
                'version'     => $package->version,
                'downloads'   => number_format($package->downloads),
                'parent'      => $package->parent,
                'stars'       => number_format($package->stars),
                'forks'       => number_format($package->forks),
                'homepage'    => $package->homepage,
                'rating'      => preg_replace('/\.?0+$/', '', $package->np_rating),
                'rates'       => number_format($package->np_rates),
                'released_at' => $package->released_at ? str_replace('T', ' ', $package->released_at->toIso8601ZuluString()) : null,
                'pushed_at'   => str_replace('T', ' ', $package->pushed_at->toIso8601ZuluString()),
                'tags'        => $package->tags->pluck('name')->toArray(),
            ]);

        return [
            'packages' => $packages,
        ];
    }
}
