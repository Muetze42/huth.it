<?php

namespace App\Listeners\Schedule;

use Illuminate\Console\Events\ScheduledTaskStarting;
use Illuminate\Support\Facades\Log;
//use Illuminate\Contracts\Queue\ShouldQueue;
//use Illuminate\Queue\InteractsWithQueue;

class LogScheduledTaskStarting
{
    /**
     * Handle the event.
     *
     * @param ScheduledTaskStarting $event
     * @return void
     */
    public function handle(ScheduledTaskStarting $event): void
    {
        $infos = [
            'ScheduledTaskStarting',
            $event->task->command,
            'expression: '.$event->task->expression,
        ];
        Log::channel('schedule')->info(implode(' | ', $infos));
    }
}
