<?php

namespace App\Http\Controllers\Back;

use App\laws;
use Notification;
use App\ {
    Http\Requests\LawRequest,
    Models\Law,
    Models\Violate,
    Repositories\LawRepository,
    Http\Controllers\Controller,
    Notifications\LawCreate
};

class LawController extends Controller
{
  use Indexable;

  /**
   * Create a new CommentController instance.
   *
   * @param  \App\Repositories\LawRepository $repository
   */
  public function __construct(LawRepository $repository)
  {
      $this->repository = $repository;
      $this->table = 'laws';
  }

  /**
   * Update "new" field for comment.
   *
   * @param  \App\Models\Law $law
   * @return \Illuminate\Http\Response
   */
  public function updateSeen(Law $comment)
  {
      $comment->ingoing->delete ();
      return response ()->json ();
  }

  /**
   * Update "active" field for Law.
   *
   * @param  \App\Models\Law $post
   * @param  bool $status
   * @return \Illuminate\Http\Response
   */
  public function updateActive(Law $Law, $status = false)
  {
      $Law->active = $status;
      $Law->save();
      return response ()->json ();
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Law $law
   * @return \Illuminate\Http\Response
   */
  public function destroy(Law $law)
  {
      if (auth()->user()->role == "admin" || auth()->user()->id == $law->user->id) {
        $law->delete ();
      }
      return response()->json();
  }

  /**
   * Show the form for creating a new Law suggestion.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('back.laws.create');
  }
  /**
   * Store a newly created post in storage.
   *
   * @param  \App\Http\Requests\LawRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(LawRequest $request)
  {
      $law = $this->repository->store($request);
      Notification::send($law, new LawCreate(auth()->user()));
      return redirect(route('laws.index'))->with('law-ok', __('The post has been successfully created'));
  }


  /**
   * Display the Law.
   *
   * @param  \App\Models\Law $law
   * @return \Illuminate\Http\Response
   */
  public function show(Law $law)
  {
      return view('back.laws.show', compact('law'));
  }

  /**
   * Show the form for editing the Law.
   *
   * @param  \App\Models\Law $law
   * @return \Illuminate\Http\Response
   */
  public function edit(Law $law)
  {
      $this->authorize('manage', $law);
      return view('back.laws.edit', compact('law'));
  }

  /**
   * Update the Law in storage.
   *
   * @param  \App\Http\Requests\LawRequest  $request
   * @param  \App\Models\Law $law
   * @return \Illuminate\Http\Response
   */
  public function update(LawRequest $request, Law $law)
  {
      $this->authorize('manage', $law);
      $this->repository->update($law, $request);
      return back()->with('law-ok', __('The law has been successfully updated'));
  }

}
