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
			<li><a href="/register">Register</a></li>
			<li><a href="/login">Login</a></li>
		</ul>
	</nav>

	@yield('content')
</body>
</html>