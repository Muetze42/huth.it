<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        \Illuminate\Console\Events\ScheduledTaskStarting::class => [
            \App\Listeners\Schedule\LogScheduledTaskStarting::class,
        ],

        \Illuminate\Console\Events\ScheduledTaskFinished::class => [
            \App\Listeners\Schedule\LogScheduledTaskFinished::class,
        ],

        \Illuminate\Console\Events\ScheduledBackgroundTaskFinished::class => [
            \App\Listeners\Schedule\LogScheduledBackgroundTaskFinished::class,
        ],

        \Illuminate\Console\Events\ScheduledTaskSkipped::class => [
            \App\Listeners\Schedule\LogScheduledTaskSkipped::class,
        ],

        \Illuminate\Console\Events\ScheduledTaskFailed::class => [
            \App\Listeners\Schedule\LogScheduledTaskFailed::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
