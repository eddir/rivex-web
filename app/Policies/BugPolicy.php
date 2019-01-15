<?php

namespace App\Policies;

use App\Models\ {User, Bug};

class BugPolicy extends Policy
{
    /**
     * Determine whether the user can manage the bug.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bug  $bug
     * @return mixed
     */
    public function manage(User $user, Bug $bug)
    {
        return $user->id === $bug->user_id;
    }
}
