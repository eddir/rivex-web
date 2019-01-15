<?php

namespace App\Http\Controllers\Back;

use Notification;
use App\ {
    Http\Requests\ScoreRequest,
    Models\Score,
    Models\User,
    Repositories\ScoreRepository,
    Http\Controllers\Controller
};

class ScoreController extends Controller
{
    use Indexable;

    /**
     * Create a new CommentController instance.
     *
     * @param  \App\Repositories\ScoreRepository $repository
     */
    public function __construct(ScoreRepository $repository)
    {
        $this->repository = $repository;
        $this->table = 'scores';
    }

    /**
     * Update "new" field for comment.
     *
     * @param  \App\Models\Score $score
     * @return \Illuminate\Http\Response
     */
    public function updateSeen(Score $comment)
    {
        $comment->ingoing->delete ();
        return response ()->json ();
    }

    /**
     * Update "active" field for Score.
     *
     * @param  \App\Models\Score $post
     * @param  bool $status
     * @return \Illuminate\Http\Response
     */
    public function updateActive(Score $Score, $status = false)
    {
        $Score->active = $status;
        $Score->save();
        return response ()->json ();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Score $score
     * @return \Illuminate\Http\Response
     */
    public function destroy(Score $score)
    {
        return response()->json();
    }

    /**
     * Show the form for creating a new Score suggestion.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('role', '!=', 'User')->pluck('name', 'id')->all();
        return view('back.scores.create', compact('users'));
    }
    /**
     * Store a newly created post in storage.
     *
     * @param  \App\Http\Requests\ScoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScoreRequest $request)
    {
        $score = $this->repository->store($request);
        return redirect(route('scores.index'))->with('score-ok', __('The score has been successfully created'));
    }


    /**
     * Display the Score.
     *
     * @param  \App\Models\Score $score
     * @return \Illuminate\Http\Response
     */
    public function show(Score $score)
    {
        return view('back.scores.show', compact('score'));
    }

    /**
     * Show the form for editing the Score.
     *
     * @param  \App\Models\Score $score
     * @return \Illuminate\Http\Response
     */
    public function edit(Score $score)
    {
        return null;
    }

    /**
     * Update the Score in storage.
     *
     * @param  \App\Http\Requests\ScoreRequest  $request
     * @param  \App\Models\Score $score
     * @return \Illuminate\Http\Response
     */
    public function update(ScoreRequest $request, Score $score)
    {
        return null;
    }
}
