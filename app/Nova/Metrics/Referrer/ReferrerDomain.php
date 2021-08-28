<?php

namespace App\Nova\Metrics\Referrer;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;
use Laravel\Nova\Metrics\PartitionResult;
use App\Models\Referrer;
use App\Models\ReferrerHost;

class ReferrerDomain extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param NovaRequest $request
     * @return PartitionResult
     */
    public function calculate(NovaRequest $request): PartitionResult
    {
        $result = $this->count($request, Referrer::class, 'referrer_host_id')->label(function ($id) {
            return ReferrerHost::withTrashed()->find($id)->name;
        });

        arsort($result->value);

        return $result;
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  void
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
        return 'referrer-referrer-domain';
    }
}
