<?php

namespace App\Notifications\Channels\Webhook;


class WebhookMessage
{
    protected string $case;

    /**
     * @param string $case
     *
     * @return self
     */
    public static function create(string $case = ''): self
    {
        return new self($case);
    }

    /**
     * @param string $case
     */
    public function __construct(string $case = '')
    {
        $this->case = $case;
    }

    /**
     * @param string $case
     * @return $this
     */
    public function case(string $case): static
    {
        $this->case = $case;

        return $this;
    }

    /**
     * @return string
     */
    public function getCase(): string
    {
        return $this->case;
    }
}
