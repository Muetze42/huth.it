<?php

namespace App\Listeners\Schedule;

use Illuminate\Console\Events\ScheduledBackgroundTaskFinished;
use Illuminate\Support\Facades\Log;
//use Illuminate\Contracts\Queue\ShouldQueue;
//use Illuminate\Queue\InteractsWithQueue;

class LogScheduledBackgroundTaskFinished
{
    /**
     * Handle the event.
     *
     * @param ScheduledBackgroundTaskFinished $event
     * @return void
     */
    public function handle(ScheduledBackgroundTaskFinished $event): void
    {
        $infos = [
            'ScheduledBackgroundTaskFinished',
            $event->task->command,
            'output: '.$event->task->output,
            'exitCode: '.$event->task->exitCode,
            'memory: '.memory_get_usage(true),
        ];
        Log::channel('schedule')->info(implode(' | ', $infos));
    }
}
