<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="uft-8">
	<title>@yield('title') - Twitter Clone</title>
	<meta name="description" content="@yield('meta-description')">
</head>
<body>
	<nav>
		<ul>
			<li><a href="/">Home</a></li>
			<li><a href="/contact">Contact</a></li>
			@if(\Auth::check())
			<li><a href="/logout">Logout</a></li>
			@else
			<li><a href="/register">Register</a></li>
			<li><a href="/login">Login</a></li>
			@endif
		</ul>
	</nav>

	@yield('content')
</body>
</html>