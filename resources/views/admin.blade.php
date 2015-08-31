<!DOCTYPE html>
<html lang="it">
	<head>
		@include('partials.meta')
	</head>
	<body class="admin-body">
		<a class="home-button" href="{{ route('home') }}">← Home</a>
		<div class="admin-wrapper">
			<div class="panel padding">
				@include('partials.flash-message')
				@yield('content')
			</div>
		</div>
		@yield('footer')
	</body>
</html>
