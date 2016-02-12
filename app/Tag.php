<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	protected $fillable = ['name'];
	// related through a pivot table
	public function tweets() {
    	return $this->belongsToMany('App\Tweet');

    }
}
