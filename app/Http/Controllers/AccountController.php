<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tweet;

class AccountController extends Controller
{
    public function index() {

    	// Count the total amount of tweets by this user
    	$totalTweets = \Auth::user()->tweets()->count();
    	
    	return view('account.index', compact('totalTweets'));
    }
// Request - capturing data from form
    public function newTweet(Request $request) {

    	$this->validate($request, [
    		'content'=>'required|max:140'
		]);

		$newTweet = new Tweet();
// point to columns in db
		$newTweet->content = $request->content;
		// user who is logged in take their id
		$newTweet->user_id = \Auth::user()->id;
// Save into database
		$newTweet->save();

    	return redirect('account');

    }
}
