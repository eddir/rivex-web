<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\ {
    Models\BugComment,
    Models\Bug,
    Repositories\BugCommentRepository,
    Http\Controllers\Controller,
    Http\Requests\BugCommentRequest
};

class BugCommentController extends Controller
{
  use Indexable;

  /**
   * Create a new CommentController instance.
   *
   * @param  \App\Repositories\BugCommentRepository $repository
   */
  public function __construct(BugCommentRepository $repository)
  {
      $this->repository = $repository;

      $this->table = 'bug_comments';
  }

  /**
   * Store a newly created post in storage.
   *
   * @param  \App\Http\Requests\BugCommentRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(BugCommentRequest $request, Bug $bug)
  {
      $this->repository->store($request, $bug);
      return redirect(route('bugs.show', [$request->bug]))->with('bugcomment-ok', __('The comment has been successfully created'));
  }

}
