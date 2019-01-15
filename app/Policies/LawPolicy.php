<?php

namespace App\Policies;

use App\Models\ {User, Law};

class LawPolicy extends Policy
{
    /**
     * Determine whether the user can manage the bug.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Law  $law
     * @return mixed
     */
    public function manage(User $user, Law $law)
    {
        return $user->id == $law->user_id;
    }
}
