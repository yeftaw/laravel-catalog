@extends('layouts.app')

@section('content')
<div class="container spark-screen">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<ol class="breadcrumb">
				<li><a href="/">Home</a></li>
				<li><a href="{{ route('categories.index') }}">Categories</a></li>
				<li class="active">Create Category</li>
			</ol>

			<div class="panel panel-default">
				<div class="panel-heading">Create Category</div>
				<div class="panel-body">
					<form class="form-horizontal" method="post" action="{{ route('categories.store') }}">
						@include('categories._form')
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
