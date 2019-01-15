<?php

namespace App\Policies;

use App\Models\ {User, Score};

class ScorePolicy extends Policy
{
    /**
     * Determine whether the user can manage the bug.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Score  $score
     * @return mixed
     */
    public function manage(User $user, Score $score)
    {
        return $user->id == $score->user_id;
    }
}
