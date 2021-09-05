<?php

namespace App\Notifications\Telegram;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class HtmlText extends Notification implements ShouldQueue
{
    use Queueable;

    public string $content;
    public bool $disableWebPagePreview;

    /**
     * Create a new notification instance.
     *
     * @param string $content
     * @param bool $disableWebPagePreview
     */
    public function __construct(string $content, bool $disableWebPagePreview = false)
    {
        $this->content = $content;
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
            ->to($notifiable)
            ->content($this->content)
            ->options([
                'parse_mode' => 'html',
                'disable_web_page_preview' => $this->disableWebPagePreview,
            ]);
    }
}
