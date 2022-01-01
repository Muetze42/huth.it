<?php

namespace App\Nova\Metrics\Link;

use App\Models\Link;
use App\Models\LinkRealCount;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;
use Laravel\Nova\Metrics\PartitionResult;

class LinkRealCounts extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param NovaRequest $request
     * @return PartitionResult
     */
    public function calculate(NovaRequest $request): PartitionResult
    {
        $result = $this->count($request, LinkRealCount::class, 'link_id')->label(function ($id) {
            return Link::withTrashed()->find($id)->name;
        });

        arsort($result->value);

        return $result;
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return void
     */
    public function cacheFor(): void
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey(): string
    {
        return 'link-real-counts';
    }
}
