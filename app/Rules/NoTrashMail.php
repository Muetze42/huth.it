<?php

namespace App\Rules;

use App\Models\TrashMail;
use Illuminate\Contracts\Validation\Rule;

class NoTrashMail implements Rule
{
    protected string $provider;

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $parts = explode('@', $value);

        $provider = $parts[1] ?? null;

        if (!$provider) {
            $this->provider = __('Unknown');
            return false;
        }

        if (TrashMail::where('provider', $provider)->first()) {
            $this->provider = $provider;
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return __('The email provider „:provider“ is not allowed', ['provider' => $this->provider]);
    }
}
