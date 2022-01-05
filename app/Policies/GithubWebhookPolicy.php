<?php

namespace App\Policies;

use App\Models\GithubWebhook;
use App\Models\TelegramReceiver;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class GithubWebhookPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param GithubWebhook $githubWebhook
     * @return bool
     */
    public function view(User $user, GithubWebhook $githubWebhook): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param GithubWebhook $githubWebhook
     * @return bool
     */
    public function update(User $user, GithubWebhook $githubWebhook): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param GithubWebhook $githubWebhook
     * @return bool
     */
    public function delete(User $user, GithubWebhook $githubWebhook): bool
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param GithubWebhook $githubWebhook
     * @return bool
     */
    public function restore(User $user, GithubWebhook $githubWebhook): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param GithubWebhook $githubWebhook
     * @return bool
     */
    public function forceDelete(User $user, GithubWebhook $githubWebhook): bool
    {
        return true;
    }

    /**
     * Determine whether the user can attach any Telegram receiver to the webhook.
     *
     * @param User $user
     * @param GithubWebhook $githubWebhook
     * @return bool
     */
    public function attachAnyTelegramReceiver(User $user, GithubWebhook $githubWebhook): bool
    {
        return $githubWebhook->telegramReceivers()->count() < TelegramReceiver::count();
    }
}
