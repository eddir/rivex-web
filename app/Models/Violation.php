<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\ModelCreated;

class Violation extends Model
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
  protected $fillable = ['location', 'violator', 'user_id', 'law_id', 'cause', 'term_start', 'term_end'];

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
  public function law()
  {
      return $this->belongsTo(Law::class, 'law_id');
  }

}
