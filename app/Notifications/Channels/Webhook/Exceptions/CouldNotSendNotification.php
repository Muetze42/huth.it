<?php

namespace App\Notifications\Channels\Webhook\Exceptions;

class CouldNotSendNotification extends \Exception
{
    /**
     * @param $response
     * @param string $domain
     * @param string $case
     * @return static
     */
    public static function serviceRespondedWithAnError($response, string $domain, string $case): static
    {
        return new static("Webhook request failed;\nDomain: ".$domain.";\nCase: ".$case.";\nResponse:\n".$response);
    }
}
