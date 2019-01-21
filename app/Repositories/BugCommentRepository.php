<?php

namespace App\Repositories;

use App\Models\ {
    BugComment,
    User
};

class BugCommentRepository
{
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
