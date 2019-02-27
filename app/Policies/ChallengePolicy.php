<?php

namespace App\Policies;

use App\Models\Challenge;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChallengePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the app models challenge.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Challenge  $challenge
     * @return mixed
     */
    public function view(User $user, Challenge $challenge)
    {
        if(\App\Helpers\User::isBrand($user)){
            return $user->id === $challenge->brand_id;
        }
        if(\App\Helpers\User::isAdmin($user)){
            return true === $challenge->published;
        }
        if(\App\Helpers\User::isCustomer($user)){
            return true === $challenge->published;
        }
        return false;
    }

    /**
     * Determine whether the user can create app models challenges.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return \App\Helpers\User::isBrand($user);
    }

    /**
     * Determine whether the user can update the app models challenge.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Challenge  $appModelsChallenge
     * @return mixed
     */
    public function update(User $user, Challenge $challenge)
    {
        //
    }

    /**
     * Determine whether the user can delete the app models challenge.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Challenge  $appModelsChallenge
     * @return mixed
     */
    public function delete(User $user, Challenge $challenge)
    {
        //
    }

    /**
     * Determine whether the user can restore the app models challenge.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Challenge  $appModelsChallenge
     * @return mixed
     */
    public function restore(User $user, Challenge $challenge)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the app models challenge.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Challenge $appModelsChallenge
     * @return mixed
     */
    public function forceDelete(User $user, Challenge $challenge)
    {
        //
    }
}
