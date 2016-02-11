@extends('master')

@section('title', '')
@section('meta-description', '')

@section('content')

	<header id="user-profile">
		<img src="" alt="" width="120" height="120">
		<h1>{{ $user->name }}</h1>
		<p>{{ $user->description }}</p>
		<ul>
			<li>Total Tweets: {{ $user->tweets->count() }}</li>
			<li></li>
			<li></li>
		</ul>
	</header>

	{{-- count function good for arrays --}}
	@if(count($errors))

	Comment form invalid

	@endif

	@foreach( $userPosts as $tweet )

		<article class="tweet">
			<hr>
			<p>{{ $tweet->content }}</p>
			{{-- grabbing the user through the tweet model though the user function  --}}
			<small>Posted: {{ $tweet->created_at }} by {{ $tweet->user->name }}</small>
			{{-- if user is logged in (Y/N) if yes check if the user id of the tweet is the same as the logged in user --}}
			@if( \Auth::check() && $tweet->user->id == \Auth::user()->id )
				<a href="/profile/delete-tweet/{{ $tweet->id }}">Delete</a>
			@endif

			<h3>Comments: </h3>
			{{-- Check if person is logged in --}}
			@if(\Auth::check())
			{{-- route data is sent to --}}
				<form action="/profile/new-comment" method="post">

					{!! csrf_field() !!}
					<input type="hidden" name="tweet-id" value="{{ $tweet->id }}">
					<label for="comment">Comment: </label>
					<textarea name="comment" id="comment" cols="50" rows="3"></textarea>

					<input type="submit" value="Reply">

				</form>
				@endif



			@forelse( $tweet->comments as $comment )
				<article class="comment">
					<p>{{ $comment->content }}</p>
					{{-- Go through Comment model, go to the user function, find the name of user through User model --}}
					<small>{{ $comment->user->name }}</small>
				</article>
				@empty
				<p>Be the first to reply!</p>
			@endforelse
			
		</article>


	@endforeach


@endsection