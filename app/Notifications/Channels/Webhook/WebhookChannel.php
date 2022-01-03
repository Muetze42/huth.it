<?php

namespace App\Notifications\Channels\Webhook;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Notifications\Notification;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Exception;
use App\Notifications\Channels\Webhook\Exceptions\CouldNotSendNotification;
use Psr\Http\Message\ResponseInterface;

class WebhookChannel
{
    protected Client $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param mixed $notifiable
     * @param Notification $notification
     * @return ResponseInterface
     * @throws CouldNotSendNotification
     * @throws GuzzleException
     * @noinspection PhpPossiblePolymorphicInvocationInspection
     */
    public function send(mixed $notifiable, Notification $notification): ResponseInterface
    {
        $case = $notification->toWebhook($notifiable)->getCase();

        $url = $notifiable->url.'/api/huth-api/'.$notifiable->client->client_id;
        $data = [
            'headers' => [
                'Authorization' => 'Bearer '.$notifiable->client->token,
                'User-Agent'    => request()->server('SERVER_NAME').' Webhook Services',
            ],
            'form_params' => [
                'case' => $case,
            ],
        ];

        try {
            $response = $this->client->post($url, $data);
        } catch (ClientException | Exception $exception) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($exception, $notifiable->url, $case);
        }

        return $response;
    }
}
