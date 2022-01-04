<?php


namespace App\Traits\Nova;

trait TrendMetric
{
    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges(): array
    {
        return [
            7 => __(':days Days', ['days' => 7]),
            2 => __(':days Days', ['days' => 2]),
            3 => __(':days Days', ['days' => 3]),
            4 => __(':days Days', ['days' => 4]),
            5 => __(':days Days', ['days' => 5]),
            30 => __(':days Days', ['days' => 30]),
            60 => __(':days Days', ['days' => 60]),
        ];
    }
}
