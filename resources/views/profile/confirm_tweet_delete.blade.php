@extends('master')

@section('title', 'Are you sure you want to delete tweet?')
@section('meta-description', 'Later Tweet')

@section('content')

<h1>Are ou sure?</h1>
<p>You are about to <em>permanently</em> delete the following tweet: </p>

<article class="tweet">
	<p>{{ $tweet->content }}</p>
	<small>Written by {{ $tweet->user->name }} on {{ $tweet->created_at }}</small>
</article>

<a href="/profile/delete-tweet/{{ $tweet->id }}/confirm">Yes</a> | <a href="/profile/{{ $tweet->user->username }}">No, go back</a>


@endsection