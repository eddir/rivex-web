<?php

namespace App\Policies;

use App\Models\ {User, Violation};

class ViolationPolicy
{
    /**
     * Determine whether the user can manage the violation.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Violation  $violation
     * @return mixed
     */
    public function manage(User $user, Violation $violation)
    {
        return $user->id == $violation->user_id;
    }

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
