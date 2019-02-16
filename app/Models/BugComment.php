<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BugComment extends Model
{
  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
      'body', 'type', 'user_id', 'bug_id'
  ];

  /**
   * Many to Many relation
   *
   * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
   */
  public function bug()
  {
    return $this->belongsTo(Bug::class);
  }

  /**
   * Many to Many relation
   *
   * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
   */
  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
