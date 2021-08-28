<?php

namespace App\Nova\Metrics\Browser;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;
use Laravel\Nova\Metrics\PartitionResult;
use App\Models\Browser;

class MobileGrade extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param NovaRequest $request
     * @return PartitionResult
     */
    public function calculate(NovaRequest $request): PartitionResult
    {
        return $this->count($request, Browser::where('mobile_grade', '!=', ''), 'mobile_grade');
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
        return 'browser-mobile-grade';
    }
}
