<?php

namespace App\Nova\Metrics\Browser;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;
use Laravel\Nova\Metrics\PartitionResult;
use App\Models\Browser;

class DeviceOs extends Partition
{
    /**
     * Get the displayable name of the metric.
     *
     * @return string
     */
    public function name(): string
    {
        return __('Device OS');
    }

    /**
     * Calculate the value of the metric.
     *
     * @param NovaRequest $request
     * @return PartitionResult
     */
    public function calculate(NovaRequest $request): PartitionResult
    {
        $result = $this->count($request, Browser::class, 'os')->label(function ($os) {
            switch ($os) {
                case Browser::OS_WINDOWS:
                    return 'Windows';
                case Browser::OS_LINUX:
                    return 'Linux';
                case Browser::OS_MAC:
                    return 'Mac';
                case Browser::OS_ANDROID:
                    return 'Android';
            };
            return __('Unknown');
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
        return 'browser-device-os';
    }
}
