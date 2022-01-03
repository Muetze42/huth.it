<?php

namespace App\Notifications\ConsumerApi;

use App\Notifications\Channels\Webhook\WebhookChannel;
use App\Notifications\Channels\Webhook\WebhookMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class WebhookNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public string $case;

    /**
     * Create a new notification instance.
     *
     * @param string $case
     */
    public function __construct(string $case)
    {
        $this->case = $case;
    }

    /**
     * Get the notification channels.
     *
     * @return array
     */
    public function via(): array
    {
        return [WebhookChannel::class];
    }

    /**
     * @return WebhookMessage
     */
    public function toWebhook(): WebhookMessage
    {
        return WebhookMessage::create()
            ->case($this->case);
    }
}
