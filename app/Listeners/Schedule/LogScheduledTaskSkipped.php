<?php

namespace App\Listeners\Schedule;

use Illuminate\Console\Events\ScheduledTaskSkipped;
use Illuminate\Support\Facades\Log;
//use Illuminate\Contracts\Queue\ShouldQueue;
//use Illuminate\Queue\InteractsWithQueue;

class LogScheduledTaskSkipped
{
    /**
     * Handle the event.
     *
     * @param ScheduledTaskSkipped $event
     * @return void
     */
    public function handle(ScheduledTaskSkipped $event): void
    {
        $infos = [
            'ScheduledTaskSkipped',
            $event->task->command,
        ];
        Log::channel('schedule')->notice(implode(' | ', $infos));
    }
}
