<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tweet;
use App\User;
use App\Comment;
use Intervention\Image\ImageManager;

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

    public function newProfileImage(Request $request) {

        $this->validate($request, [
            // 'image' checks it is an image file eg. jpeg, png etc
            'photo'=>'required|image'
        ]);

        // Create instance of Image Intervention
        $manager = new ImageManager();

        $profileImage = $manager->make($request->photo);

        $profileImage->resize(240, null, function ($constraint) {
        $constraint->aspectRatio();
        });

        // save() automatically points to the public folder. number on the end is the file size (image quality)
        $profileImage->save('profiles/'.\Auth::user()->id.'.jpg', 90);

        // Save filename in the user's table.
        $user = User::find( \Auth::user()->id );

        $user->profileImage = \Auth::user()->id.'.jpg';

        $user->save();

        return redirect('profile/'.$user->username);



    }







}
