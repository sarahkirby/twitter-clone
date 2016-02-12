<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
	// table relationship
    public function user() {
    	// finds the user that owns the Tweet
    	return $this->belongsTo('App\User');
    }
    // 
    public function comments() {
    	return $this->hasMany('App\Comment');
    }

    public function tags() {
    	return $this->belongsToMany('App\Tag');

    }
}
