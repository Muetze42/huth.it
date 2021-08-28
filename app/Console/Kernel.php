<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('ip:clear')
            ->everyMinute();
        $schedule->command('trash-mail:update')
            ->weeklyOn(1, '5:00');
        $schedule->command('trash:notification')
            ->everyFiveMinutes()
            ->between('18:00', '18:30');
//         $schedule->command('queue:work --stop-when-empty --timeout=0')->everyMinute()->withoutOverlapping();
    }

    /**
     * Run the console application.
     *
     * @param  InputInterface $input
     * @param  OutputInterface|null $output
     * @return int
     */
//    public function handle($input, $output = null): int
//    {
//        try {
//            $this->bootstrap();
//
//            return $this->getArtisan()->run($input, $output);
//        } catch (Throwable $e) {
//            if (!str_starts_with($e, 'Symfony\Component\Console\Exception\CommandNotFoundException') &&
//                !str_starts_with($e, 'Symfony\Component\Console\Exception\NamespaceNotFoundException')) {
//                $this->reportException($e);
//            }
//
//            $this->renderException($output, $e);
//
//            return 1;
//        }
//    }

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
