<?php

namespace App\Policies;

use App\Models\LinkRealCount;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LinkRealCountPolicy
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
     * @param LinkRealCount $linkRealCount
     * @return bool
     */
    public function view(User $user, LinkRealCount $linkRealCount): bool
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
     * @param LinkRealCount $linkRealCount
     * @return bool
     */
    public function update(User $user, LinkRealCount $linkRealCount): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param LinkRealCount $linkRealCount
     * @return bool
     */
    public function delete(User $user, LinkRealCount $linkRealCount): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param LinkRealCount $linkRealCount
     * @return bool
     */
    public function restore(User $user, LinkRealCount $linkRealCount): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param LinkRealCount $linkRealCount
     * @return bool
     */
    public function forceDelete(User $user, LinkRealCount $linkRealCount): bool
    {
        return false;
    }
}
