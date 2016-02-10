<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    public function user() {
    	// finds the user that owns the Tweet
    	return $this->belongsTo('App\User');

    }
}
