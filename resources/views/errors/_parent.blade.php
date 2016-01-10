<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Simple Laravel 5.2 Catalog</title>

	<!-- Fonts -->
	<link href="{{ asset('css/font-awesome.min.css') }}" rel='stylesheet' type='text/css'>

	<!-- Styles -->
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

	<style type="text/css">
		body {
			background: #fbfbfb;
			font-family: 'Source Sans Pro', sans-serif;
		}
		.well {
			margin: 50px auto;
			text-align: center;
			padding: 25px;
			max-width: 600px;
		}
		h1, h2, h3, p {
			margin: 0;
		}
		p {
			font-size: 17px;
			margin-top: 25px;
		}
		p a.btn {
			margin: 0 5px;
		}
		h1 .ion {
			vertical-align: -5%;
			margin-right: 5px;
		}
		</style>


</head>
<body id="app-layout">

	@yield('content')

	<!-- JavaScripts -->
	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>

</body>
</html>
