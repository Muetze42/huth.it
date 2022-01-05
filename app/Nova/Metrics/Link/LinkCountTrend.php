<?php

namespace App\Nova\Metrics\Link;

use App\Traits\Nova\TrendMetric;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Trend;
use Laravel\Nova\Metrics\TrendResult;
use App\Models\LinkCount;

class LinkCountTrend extends Trend
{
    use TrendMetric;

    /**
     * Calculate the value of the metric.
     *
     * @param NovaRequest $request
     * @return TrendResult
     */
    public function calculate(NovaRequest $request): TrendResult
    {
        return $this->countByDays($request, LinkCount::where('link_id', $request->resourceId), 'created_at')
            ->showSumValue();
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
        return 'link-count-trend';
    }
}
