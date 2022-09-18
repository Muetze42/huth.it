<?php

namespace App\Listeners\Schedule;

use Illuminate\Console\Events\ScheduledTaskFailed;
use Illuminate\Support\Facades\Log;
//use Illuminate\Contracts\Queue\ShouldQueue;
//use Illuminate\Queue\InteractsWithQueue;

class LogScheduledTaskFailed
{
    /**
     * Handle the event.
     *
     * @param ScheduledTaskFailed $event
     * @return void
     */
    public function handle(ScheduledTaskFailed $event): void
    {
        $infos = [
            'ScheduledTaskFailed',
            $event->task->command,
            'exitCode: '.$event->task->exitCode,
            'message: '.optional($event->exception)->getMessage(),
            'memory: '.memory_get_usage(true),
        ];
        Log::channel('schedule')->error(implode(' | ', $infos));
    }
}
