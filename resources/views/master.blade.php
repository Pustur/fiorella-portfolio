<html>
	<head>
		<meta charset="UTF-8">
		<title>{{ isset($title) ? $title . ' | Portfolio' : 'Portfolio' }}</title>
	</head>
	<body>
		@yield('content')
	</body>
</html>
