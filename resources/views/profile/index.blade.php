@extends('master')

@section('title', 'Account')
@section('meta-description', 'Welcome to your account page')

@section('content')
{{-- ]Auth::user - when you know user is logged in. \blackslash - go to the root folder and start looking from there --}}
<h1>Hi there {{ \Auth::user()->name }}</h1>
<h2>Account stats</h2>
<ul>
	<li>Total Tweets: {{ $totalTweets }}</li>
</ul>

{{-- If user does not have a profile image run --}}
@if( !\Auth::user()->profileImage )

	<h2>Add a new profile image!</h2>

@endif
{{-- Must be post for binary files. Must incl enctype --}}
	<form action="/profile/new-profile-image" method="post" enctype="multipart/form-data">

	{!! csrf_field() !!}

		<input type="file" name="photo" required>
		<input type="submit" value="Upload!">
		

	</form>




<h2>Write a new Tweet</h2>

<form action="/profile/new-tweet" method="post">

	{!! csrf_field() !!}
	
	<div>
		<label for="content">Tweet:</label>
		<textarea name="content" id="content" cols="30" rows="10">{{ old('content') }}</textarea>
	</div>	

	<div>
		<label for="tags">Tags: </label>
		<textarea name="tags" id="tags" placeholder="#web #bro #mate #twitterclone">{{ old('tags') }}</textarea>
	</div>

	<input type="submit" value="Post">

</form>

@if(count($errors))
	<ul>
	@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
	@endforeach
	</ul>
@endif


@endsection