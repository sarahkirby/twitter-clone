@extends('master')

@section('title', 'Login')
@section('meta-description', 'Login to your account')

@section('content')
<h1>Login</h1>

<form action="/login" method="post">

{!! csrf_field() !!}

	<div>
		<label for="email">Email: </label>
		<input type="email" name="email" value="{{ old('email') }}" id="email" placeholder="example@example.com">
	</div>

	<div>
		<label for="password">Password: </label>
		<input type="password" name="password" id="password">
	</div>

	<input type="submit" value="Login">
	
</form>

@if(count($errors))
	<ul>
	@foreach($errors->all() as $error)
		<li>{{ $error }}</li>
	@endforeach
	</ul>
@endif

@endsection