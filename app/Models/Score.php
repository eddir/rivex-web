<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class score extends Model
{
      use IngoingTrait;

      /**
        * The attributes that are mass assignable.
        *
        * @var array
        */
        protected $fillable = [
            'description', 'score', 'user_id'
        ];

        public static function boot()
        {
          parent::boot();
          self::created(function ($model) {
            $model->user->score += $model->score;
            $model->user->save();
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
}
