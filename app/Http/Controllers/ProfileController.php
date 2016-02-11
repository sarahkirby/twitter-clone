<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tweet;
use App\User;
use App\Comment;

class ProfileController extends Controller
{
    public function index() {

    	// Count the total amount of tweets by this user
    	$totalTweets = \Auth::user()->tweets()->count();
    	
    	return view('profile.index', compact('totalTweets'));
    }
// Request - capturing data from form
    public function newTweet(Request $request) {

    	$this->validate($request, [
    		'content'=>'required|min:2|max:140'
		]);

		$newTweet = new Tweet();
// point to columns in db
		$newTweet->content = $request->content;
		// user who is logged in take their id
		$newTweet->user_id = \Auth::user()->id;
// Save into database
		$newTweet->save();

    	return redirect('profile');

    }
    public function show($username) {

        // Find the user
        $user = User::where('username', '=', $username)->firstOrFail();

        $userPosts = $user->tweets()->get();

        return view('profile.show', compact('user', 'userPosts'));

    }
    // 'Request' data from form
    public function newComment(Request $request) {

        $this->validate($request, [
            'comment'=>'required|min:4|max:140',
            'tweet-id'=>'required|exists:tweets,id'
        ]);

        // Create new comment. (Need 'use App\Comment' at top for the object to instaniate)
        $comment = new Comment();

        // Inserting data into database
        // comment model->content table row = form data-> comment input field post data
        $comment->content = $request->comment;
        $comment->user_id = \Auth::user()->id;
        $comment->tweet_id = $request['tweet-id'];

        $comment->save();

// redirect user back to page they were on
        return back();
    }

    public function deleteTweet($id) {

        // Find the tweet
        $tweet = Tweet::findOrFail($id);

        // Check that the logged in user owns this tweet
        if( $tweet->user_id != \Auth::user()->id ) {

            return 'Not your tweet';

        }

        return view('profile.confirm_tweet_delete', compact('tweet'));

    }
    public function destroyTweet($id) {

        $tweet = Tweet::findOrFail($id);

        // Check that the logged in user owns this tweet
        if( $tweet->user_id != \Auth::user()->id ) {
            return 'Not your tweet';
        }
        $tweet->delete();

        return redirect('profile/'.$tweet->user->username);


    }







}
