<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\ContactRequest;
use App\Models\User;

class ContactRequestPolicy
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
     * @param ContactRequest $contactRequest
     * @return bool
     */
    public function view(User $user, ContactRequest $contactRequest): bool
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
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param ContactRequest $contactRequest
     * @return bool
     */
    public function update(User $user, ContactRequest $contactRequest): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param ContactRequest $contactRequest
     * @return bool
     */
    public function delete(User $user, ContactRequest $contactRequest): bool
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param ContactRequest $contactRequest
     * @return bool
     */
    public function restore(User $user, ContactRequest $contactRequest): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param ContactRequest $contactRequest
     * @return bool
     */
    public function forceDelete(User $user, ContactRequest $contactRequest): bool
    {
        return false;
    }
}
