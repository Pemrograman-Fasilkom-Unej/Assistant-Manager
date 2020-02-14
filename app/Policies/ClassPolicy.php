<?php

namespace App\Policies;

use App\Classes;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClassPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any classes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAn('admin');
    }

    /**
     * Determine whether the user can view the classes.
     *
     * @param  \App\User  $user
     * @param  \App\Classes  $classes
     * @return mixed
     */
    public function view(User $user, Classes $classes)
    {
        return $classes->assistants->pluck('assistant_id')->contains($user->id) || $user->isAn('admin');
    }

    /**
     * Determine whether the user can create classes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAn('admin');
    }

    /**
     * Determine whether the user can update the classes.
     *
     * @param  \App\User  $user
     * @param  \App\Classes  $classes
     * @return mixed
     */
    public function update(User $user, Classes $classes)
    {
        return $user->isAn('admin');
    }

    /**
     * Determine whether the user can delete the classes.
     *
     * @param  \App\User  $user
     * @param  \App\Classes  $classes
     * @return mixed
     */
    public function delete(User $user, Classes $classes)
    {
        return $user->isAn('admin');
    }

    /**
     * Determine whether the user can restore the classes.
     *
     * @param  \App\User  $user
     * @param  \App\Classes  $classes
     * @return mixed
     */
    public function restore(User $user, Classes $classes)
    {
        return $user->isAn('admin');
    }

    /**
     * Determine whether the user can permanently delete the classes.
     *
     * @param  \App\User  $user
     * @param  \App\Classes  $classes
     * @return mixed
     */
    public function forceDelete(User $user, Classes $classes)
    {
        return $user->isAn('admin');
    }
}
