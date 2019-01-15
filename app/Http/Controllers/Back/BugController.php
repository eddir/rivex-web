<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\ {
    Http\Requests\BugRequest,
    Models\Bug,
    Models\BugImportant,
    Models\BugType,
    Models\Score,
    Repositories\BugRepository,
    Http\Controllers\Controller
};

class BugController extends Controller
{
  use Indexable;

  /**
   * Create a new CommentController instance.
   *
   * @param  \App\Repositories\BugRepository $repository
   */
  public function __construct(BugRepository $repository)
  {
      $this->repository = $repository;

      $this->table = 'bugs';
  }

  /**
   * Update "new" field for comment.
   *
   * @param  \App\Models\Bug $comment
   * @return \Illuminate\Http\Response
   */
  public function updateSeen(Bug $comment)
  {
      $comment->ingoing->delete ();

      return response ()->json ();
  }

  /**
   * Update "active" field for bug.
   *
   * @param  \App\Models\Bug $post
   * @param  bool $status
   * @return \Illuminate\Http\Response
   */
  public function updateActive(Bug $bug, $status = false)
  {
      $bug->active = $status;
      $bug->save();

      return response ()->json ();
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Bug $bug
   * @return \Illuminate\Http\Response
   */
  public function destroy(Bug $bug)
  {
      if (auth()->user()->role == "admin" || auth()->user()->id == $bug->user->id) {
        $bug->delete ();
      }
      return response()->json();
  }

  /**
   * Show the form for creating a new bug suggestion.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      $types = BugType::all()->pluck('title', 'id');
      $importants = BugImportant::all()->pluck('title', 'id');

      return view('back.bugs.create', compact('types', 'importants'));

  }
  /**
   * Store a newly created post in storage.
   *
   * @param  \App\Http\Requests\BugRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(BugRequest $request)
  {
      $bug = $this->repository->store($request);
      return redirect(route('bugs.index'))->with('bug-ok', __('The post has been successfully created'));
  }


  /**
   * Display the bug.
   *
   * @param  \App\Models\Bug $post
   * @return \Illuminate\Http\Response
   */
  public function show(Bug $bug)
  {
      return view('back.bugs.show', compact('bug'));
  }

  /**
   * Show the form for editing the bug.
   *
   * @param  \App\Models\Bug $bug
   * @return \Illuminate\Http\Response
   */
  public function edit(Bug $bug)
  {
      $this->authorize('manage', $bug);

      $types = BugType::all()->pluck('title', 'id');
      $importants = BugImportant::all()->pluck('title', 'id');

      return view('back.bugs.edit', compact('bug', 'types', 'importants'));
  }

  /**
   * Update the bug in storage.
   *
   * @param  \App\Http\Requests\BugRequest  $request
   * @param  \App\Models\Bug $bug
   * @return \Illuminate\Http\Response
   */
  public function update(BugRequest $request, Bug $bug)
  {
      $this->authorize('manage', $bug);

      $this->repository->update($bug, $request);

      return back()->with('bug-ok', __('The bug has been successfully updated'));
  }

}
