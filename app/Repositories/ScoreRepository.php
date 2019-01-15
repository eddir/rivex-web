<?php

namespace App\Repositories;

use App\Models\Score;

class ScoreRepository
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
        return Score::with([
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
     * @param  \App\Http\Requests\ScoreRequest  $request
     * @return void
     */
    public function store($request)
    {
        $request->merge(['user_id' => auth()->id()]);
        return Score::create($request->all());
    }

    /**
     * Update score.
     *
     * @param  \App\Models\Score  $score
     * @param  \App\Http\Requests\ScoreRequest  $request
     * @return void
     */
    public function update($score, $request)
    {
        $request->merge(['active' => $request->has('active')]);
        $score->update($request->all());
    }

}
