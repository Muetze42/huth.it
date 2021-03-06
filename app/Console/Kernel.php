<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('twitch:changelog')
            ->dailyAt('19:00');
        $schedule->command('repo:watch')
            ->dailyAt('12:00');

        $schedule->command('package:update')
            ->hourly()
            ->then(function () {
                $this->call('package:update:novapackages');
            });

        $schedule->command('queue:work --stop-when-empty --timeout=0')
            ->everyMinute()
            ->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
