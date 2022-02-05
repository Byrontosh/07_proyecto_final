<?php

namespace App\Policies;

use App\Models\Report;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReportPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     */
    public function viewAny(User $user)
    {
        return $user->role->name === 'guard';
    }

    /**
     * Determine whether the user can view the model.
     *
     */
    public function view(User $user, Report $report)
    {
        return $user->id === $report->user_id
            ? Response::allow()
            : Response::deny("You don't own this report.");
    }

    /**
     * Determine whether the user can create models.
     *
     */
    public function create(User $user)
    {
        return $user->role->name === 'guard';
    }

    /**
     * Determine whether the user can update the model.
     *
     */
    public function update(User $user, Report $report)
    {
        return $user->id === $report->user_id
            ? Response::allow()
            : Response::deny("You don't own this report.");
    }

    /**
     * Determine whether the user can delete the model.
     *
     */
    public function delete(User $user, Report $report)
    {
        return $user->id === $report->user_id
            ? Response::allow()
            : Response::deny("You don't own this report.");
    }
}
