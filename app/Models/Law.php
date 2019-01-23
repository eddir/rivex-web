<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Violation;

class Law extends Model
{

    use IngoingTrait;

     /**
      * The attributes that are mass assignable.
      *
      * @var array
      */
      protected $fillable = [
          'title', 'description', 'location', 'user_id'
      ];

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
       * Many to Many relation
       *
       * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
       */
    public function violations()
    {
      return $this->hasMany(Violation::class);
    }
}
