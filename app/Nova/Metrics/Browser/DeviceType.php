<?php

namespace App\Nova\Metrics\Browser;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;
use Laravel\Nova\Metrics\PartitionResult;
use App\Models\Browser;

class DeviceType extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param NovaRequest $request
     * @return PartitionResult
     */
    public function calculate(NovaRequest $request): PartitionResult
    {
        $result = $this->count($request, Browser::class, 'device_type')->label(function ($type) {
            switch ($type) {
                case Browser::DEVICE_TYPE_MOBILE:
                    return 'Mobile';
                case Browser::DEVICE_TYPE_TABLET:
                    return 'Tablet';
                case Browser::DEVICE_TYPE_DESKTOP:
                    return 'Desktop';
            };
            return __('Unknown');
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
        return 'browser-device-type';
    }
}
