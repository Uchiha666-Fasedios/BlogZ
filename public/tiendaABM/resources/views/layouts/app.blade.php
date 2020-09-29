<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Bootstrap 4 Admin &amp; Dashboard Template">
	<meta name="author" content="Bootlab">

	<title>Ecommerce Laravel</title>

	<style>
		body {
			opacity: 0;
		}
	</style>
	<script src="{{asset('js/settings.js')}}"></script>

</head>
<!-- SET YOUR THEME -->

<body class="theme-blue">
	<div class="splash active">
		<div class="splash-icon"></div>
	</div>

	@yield('auth')

	
	<script src="{{asset('js/app.js')}}"></script>

</body>

</html>