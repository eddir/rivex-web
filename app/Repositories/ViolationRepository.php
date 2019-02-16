<?php

namespace App\Repositories;

use App\Models\Violation;

class ViolationRepository
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
        return Violation::with ([
                'ingoing',
                'user',
                'law'
            ])
            ->when ($parameters['new'], function ($query) {
                $query->has ('ingoing');
            })
            ->paginate($nbrPages);
    }

    /**
     * Store post.
     *
     * @param  \App\Http\Requests\ViolationRequest  $request
     * @return void
     */
    public function store($request)
    {
        $data = $request->all();
        $data['term_start'] = date("Y-m-d H:i:s", strtotime($data['term_start']));
        $data['term_end'] = date("Y-m-d H:i:s", strtotime($data['term_end']));
        $data['user_id'] = auth()->id();
        return Violation::create($data);
    }

    /**
     * Update bug.
     *
     * @param  \App\Models\Violation  $violation
     * @param  \App\Http\Requests\ViolationRequest  $request
     * @return void
     */
    public function update($violation, $request)
    {
        $request->merge(['active' => $request->has('active')]);
        $violation->update($request->all());
    }

}
