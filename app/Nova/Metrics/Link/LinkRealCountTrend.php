<?php

namespace App\Nova\Metrics\Link;

use App\Models\LinkRealCount;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\TrendResult;

class LinkRealCountTrend extends LinkCountTrend
{
    /**
     * Calculate the value of the metric.
     *
     * @param NovaRequest $request
     * @return TrendResult
     */
    public function calculate(NovaRequest $request): TrendResult
    {
        return $this->countByDays($request, LinkRealCount::where('link_id', $request->resourceId), 'created_at')
            ->showSumValue();
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey(): string
    {
        return 'link-real-count-trend';
    }
}
