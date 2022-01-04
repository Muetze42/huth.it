<?php

namespace App\Notifications\Telegram;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class Webhook extends Notification
{
    use Queueable;

    public string $message;
    public bool $disableWebPagePreview;

    /**
     * Create a new notification instance.
     *
     * @param string $message
     * @param bool $disableWebPagePreview
     */
    public function __construct(string $message, bool $disableWebPagePreview = true)
    {
        $this->message = $message;
        $this->disableWebPagePreview = $disableWebPagePreview;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array
     */
    public function via(): array
    {
        return [TelegramChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return TelegramMessage
     */
    public function toTelegram(mixed $notifiable): TelegramMessage
    {
        return TelegramMessage::create()
            ->to($notifiable->telegram_id)
            ->content($this->message)
            ->options([
                'parse_mode' => 'html',
                'disable_web_page_preview' => $this->disableWebPagePreview,
            ]);
    }
}
