<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Bug;

class BugType extends Model {

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'title'
    ];

	/**
     * Many to Many relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
	public function bugs()
	{
		return $this->hasMany(Bug::class);
	}
}
