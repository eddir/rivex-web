<?php

namespace App\Http\Controllers\Back;

use Notification;
use App\ {
    Http\Requests\ViolationRequest,
    Models\Violation,
    Models\Law,
    Repositories\ViolationRepository,
    Http\Controllers\Controller,
    Notifications\ViolationCreate
};

class ViolationController extends Controller
{
  use Indexable;

  /**
   * Create a new ViolationController instance.
   *
   * @param  \App\Repositories\ViolationRepository $repository
   */
  public function __construct(ViolationRepository $repository)
  {
      $this->repository = $repository;
      $this->table = 'violations';
  }

  /**
   * Update "new" field for violation.
   *
   * @param  \App\Models\Violation $comment
   * @return \Illuminate\Http\Response
   */
  public function updateSeen(Violation $comment)
  {
      $comment->ingoing->delete ();
      return response ()->json ();
  }

  /**
   * Update "active" field for violation.
   *
   * @param  \App\Models\Violation $violation
   * @param  bool $status
   * @return \Illuminate\Http\Response
   */
  public function updateActive(Violation $violation, $status = false)
  {
      $violation->active = $status;
      $violation->save();
      return response ()->json ();
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Violation $violation
   * @return \Illuminate\Http\Response
   */
  public function destroy(Violation $violation)
  {
      if (auth()->user()->role == "admin" || auth()->user()->id == $violation->user->id) {
        $violation->delete ();
      }
      return response()->json();
  }

  /**
   * Show the form for creating a new violation suggestion.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      $laws = Law::all()->pluck('title', 'id');
      return view('back.violations.create', compact('laws'));
  }
  /**
   * Store a newly created violation in storage.
   *
   * @param  \App\Http\Requests\ViolationRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(ViolationRequest $request)
  {
      $violation = $this->repository->store($request);
      Notification::send($violation, new ViolationCreate(auth()->user()));
      return redirect(route('violations.index'))->with('violation-ok', __('The post has been successfully created'));
  }


  /**
   * Display the violation.
   *
   * @param  \App\Models\Violation $post
   * @return \Illuminate\Http\Response
   */
  public function show(Violation $violation)
  {
      return view('back.violations.show', compact('violation'));
  }

  /**
   * Show the form for editing the violation.
   *
   * @param  \App\Models\Violation $violation
   * @return \Illuminate\Http\Response
   */
  public function edit(Violation $violation)
  {
      $laws = Law::all()->pluck('title', 'id');
      $this->authorize('manage', $violation);
      return view('back.violations.edit', compact('violation', 'laws'));
  }

  /**
   * Update the violation in storage.
   *
   * @param  \App\Http\Requests\ViolationRequest  $request
   * @param  \App\Models\Violation $violation
   * @return \Illuminate\Http\Response
   */
  public function update(ViolationRequest $request, Violation $violation)
  {
      $this->authorize('manage', $violation);
      $this->repository->update($violation, $request);
      return back()->with('violation-ok', __('The violation has been successfully updated'));
  }
}
