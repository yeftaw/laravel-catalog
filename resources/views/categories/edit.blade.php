@extends('layouts.app')

@section('content')
<div class="container spark-screen">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<ol class="breadcrumb">
				<li><a href="/">Home</a></li>
				<li><a href="{{ route('categories.index') }}">Categories</a></li>
				<li class="active">Edit: {{ $category->title }}</li>
			</ol>

			@if(Session::has('errorMsg'))
			<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Woops!</strong> {{ Session::get('errorMsg') }}
			</div>
			@endif

			<div class="panel panel-default">
				<div class="panel-heading">Edit: </div>
				<div class="panel-body">
					<form class="form-horizontal" method="post" action="{{ route('categories.update', ['categories' => $category->id]) }}">
						{{ method_field('PATCH') }}
						@include('categories._form')
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
