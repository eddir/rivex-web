<?php

namespace App\Repositories;

use App\Models\ {
    Bug,
    User
};

class BugRepository
{
    /**
     * Get comments paginate.
     *
     * @param  int  $nbrPages
     * @param  array  $parameters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll($nbrPages, $parameters)
    {
        return Bug::with ([
                'ingoing',
                'user',
                'confirm_user',
                'important',
                'type'
            ])
            ->latest()
            ->when ($parameters['new'], function ($query) {
                $query->has ('ingoing');
            })
            ->when ($parameters['new'], function ($query) {
                $query->has ('important');
            })->paginate($nbrPages);
    }

    /**
     * Store post.
     *
     * @param  \App\Http\Requests\BugRequest  $request
     * @return void
     */
    public function store($request)
    {
        $request->merge(['user_id' => auth()->id()]);
        $request->merge(['active' => $request->has('active')]);

        return Bug::create($request->all());
    }

    /**
     * Update bug.
     *
     * @param  \App\Models\Bug  $bug
     * @param  \App\Http\Requests\BugRequest  $request
     * @return void
     */
    public function update($bug, $request)
    {
        $request->merge(['active' => $request->has('active')]);
        $bug->update($request->all());
    }

}
