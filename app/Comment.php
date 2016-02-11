<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	// finds what user the comment belongs to
    public function user() {
    	return $this->belongsTo('App\User');
    }
	// finds what tweet the comment belongs to
    public function tweet() {
    	return $this->belongsTo('App\Tweet');
    }
}
