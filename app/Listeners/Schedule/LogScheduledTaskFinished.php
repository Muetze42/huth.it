<?php

namespace App\Listeners\Schedule;

use Illuminate\Console\Events\ScheduledTaskFinished;
use Illuminate\Support\Facades\Log;
//use Illuminate\Contracts\Queue\ShouldQueue;
//use Illuminate\Queue\InteractsWithQueue;

class LogScheduledTaskFinished
{
    /**
     * Handle the event.
     *
     * @param ScheduledTaskFinished $event
     * @return void
     */
    public function handle(ScheduledTaskFinished $event): void
    {
        $infos = [
            'ScheduledTaskFinished',
            $event->task->command,
            'exitCode: '.$event->task->exitCode,
            'output: '.$event->task->output,
            'memory: '.memory_get_usage(true),
        ];
        Log::channel('schedule')->info(implode(' | ', $infos));
    }
}
