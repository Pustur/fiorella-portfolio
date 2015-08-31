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
		<script src="/js/app.min.js"></script>
		<script>
			$(document).ready(function(){
				$('[data-element="flash-message"]').delay(3000).fadeOut();
			});
		</script>
		@yield('footer')
	</body>
</html>
