<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\RepoWatch;
use App\Models\User;

class RepoWatchPolicy
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
     * @param RepoWatch $repoWatch
     * @return bool
     */
    public function view(User $user, RepoWatch $repoWatch): bool
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
     * @param RepoWatch $repoWatch
     * @return bool
     */
    public function update(User $user, RepoWatch $repoWatch): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param RepoWatch $repoWatch
     * @return bool
     */
    public function delete(User $user, RepoWatch $repoWatch): bool
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param RepoWatch $repoWatch
     * @return bool
     */
    public function restore(User $user, RepoWatch $repoWatch): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param RepoWatch $repoWatch
     * @return bool
     */
    public function forceDelete(User $user, RepoWatch $repoWatch): bool
    {
        return true;
    }
}
