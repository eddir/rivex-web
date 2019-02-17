<?php

namespace App\Repositories;

use App\Models\ {
    BugComment,
    User
};

class BugCommentRepository
{
    /**
     * Get comments of bugs paginate.
     *
     * @param  int  $nbrPages
     * @param  array  $parameters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll($nbrPages)
    {
        return BugComment::with ([
                'user',
            ])
            ->latest()
            ->paginate($nbrPages);
    }
    /**
     * Store post.
     *
     * @param  \App\Http\Requests\BugCommentRequest  $request
     * @return void
     */
    public function store($request, $bug)
    {
        $request->merge(['user_id' => auth()->id()]);
        $request->merge(['bug_id' => $bug->id]);
        return BugComment::create($request->all());
    }

}
