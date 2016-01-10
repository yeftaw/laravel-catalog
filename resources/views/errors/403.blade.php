@extends('errors._parent')

@section('content')
	<div class="container">
		<div class="well">
			<h1><div class="ion ion-alert-circled"></div> Error 403: Access Denied/Forbidden</p>
			<p>
				<a class="btn btn-default btn-lg" href="#" onclick="history.back(); return false;">Back</a>
				<a class="btn btn-default btn-lg" href="/">Homepage</a>
			</p>
		</div>
	</div>
@endsection
