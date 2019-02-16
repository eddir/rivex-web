<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\ModelCreated;
use App\Models\Score;
use Notification;
use App\Notifications\BugCreate;

class Bug extends Model
{
  use IngoingTrait;

  /**
   * The event map for the model.
   *
   * @var array
   */
  protected $dispatchesEvents = [
      'created' => ModelCreated::class,
  ];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['title', 'body', 'user_id', 'confirm_user_id', 'bug_important', 'bug_type', 'progress'];

  public static function boot()
  {
    parent::boot();
    self::created(function ($model) {
      $score = new Score;
      $score->user_id = $model->user->id;
      $model->bug_type == 1 ? $score->score = 3 : $score->score = 1;
      $score->description = 'Bug:'.$model->id;
      $score->save();
      Notification::send($model, new BugCreate($model->user));
      BugComment::create([
          'body' => $model->title,
          'type' => 1,
          'user_id' => $model->user->id,
          'bug_id' => $model->id
      ]);
    });
  }

  /**
   * One to Many relation
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function user()
  {
      return $this->belongsTo(User::class);
  }

  /**
   * One to Many relation
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function confirm_user()
  {
      return $this->belongsTo (User::class, 'confirm_user_id');
  }

  /**
   * One to Many relation
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function important()
  {
      return $this->belongsTo(BugImportant::class, 'bug_important');
  }

  /**
   * One to Many relation
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function type()
  {
      return $this->belongsTo(BugType::class, 'bug_type');
  }

  /**
   * One to Many relation
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function comments()
  {
      return $this->hasMany(BugComment::class);
  }

}
