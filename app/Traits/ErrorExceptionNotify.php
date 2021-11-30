<?php

namespace App\Traits;

use App\Notifications\Telegram\ErrorReport;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Notification;

trait ErrorExceptionNotify
{
    /**
     * Get the URI key for the notification remember cache.
     *
     * @var string
     */
    protected string $cacheNotificationKey = 'error-report-notification';

    protected function sendTelegramMessage($exception)
    {
        $status = Cache::get($this->cacheNotificationKey);

        if ($status != 'send') {
            Notification::send(config('services.telegram-bot-api.receiver'), new ErrorReport($exception));

            if(!$status) {
                Cache::add($this->cacheNotificationKey, 'send', config('site.error-report.throttle', 3600));
            }
        }
    }
}
