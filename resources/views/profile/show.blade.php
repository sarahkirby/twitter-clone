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

	@foreach( $userPosts as $tweet )

		<article class="tweet">
			<hr>
			<p>{{ $tweet->content }}</p>
			{{-- grabbing the user through the tweet model though the user function  --}}
			<small>Posted: {{ $tweet->created_at }} by {{ $tweet->user->name }}</small>

			<h3>Comments: </h3>
			@forelse( $tweet->comments as $comment )
				<article class="comment">
					<p>{{ $comment->content }}</p>
					{{-- Go through Comment model, go to the user function, find the name of user through User model --}}
					<small>{{ $comment->user->name }}</small>
				</article>
				@empty
				<p>Be the first to reply!</p>
			@endforelse
			<hr>
		</article>


	@endforeach


@endsection