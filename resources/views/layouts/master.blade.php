<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Simple Laravel 5.2 Catalog</title>

	<!-- Bootstrap core CSS -->
	<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

	<link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">

	@yield('css_assets')

	<script src="{{ asset('js/jquery.min.js') }}"></script>

</head>
<body>

@yield('content')

@section('js_assets')
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
@show

@stack('script')

</body>
</html>
