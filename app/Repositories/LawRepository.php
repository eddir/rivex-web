<?php

namespace App\Repositories;

use App\Models\Law;

class LawRepository
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
        return Law::with([
              'ingoing',
              'user'
            ])
            ->latest()
            ->when ($parameters['new'], function ($query) {
                $query->has ('ingoing');
            })
            ->paginate($nbrPages);
    }

    /**
     * Store post.
     *
     * @param  \App\Http\Requests\LawRequest  $request
     * @return void
     */
    public function store($request)
    {
        $request->merge(['user_id' => auth()->id()]);
        return Law::create($request->all());
    }

    /**
     * Update bug.
     *
     * @param  \App\Models\Law  $law
     * @param  \App\Http\Requests\LawRequest  $request
     * @return void
     */
    public function update($law, $request)
    {
        $request->merge(['active' => $request->has('active')]);
        $law->update($request->all());
    }

}
