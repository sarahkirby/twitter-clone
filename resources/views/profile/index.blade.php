@extends('master')

@section('title', 'Account')
@section('meta-description', 'Welcome to your account page')

@section('content')
{{-- ]Auth::user - when you know user is logged in. \blackslash - go to the root folder and start looking from there --}}
<h1>Hi there {{ \Auth::user()->name }}</h1>
<h2>Account stats</h2>
<ul>
	<li>{{ $totalTweets }}</li>
</ul>

<h2>Write a new Tweet</h2>

<form action="/profile/new-tweet" method="post">

	{!! csrf_field() !!}
	
	<div>
		<label for="content">Tweet:</label>
		<textarea name="content" id="content" cols="30" rows="10">{{ old('content') }}</textarea>
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