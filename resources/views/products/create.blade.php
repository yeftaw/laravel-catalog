@extends('layouts.app')

@section('assets')
	<link rel="stylesheet" type="text/css" href="{{ asset('packages/select2/css/select2.min.css') }}">
@endsection

@section('scripts')
	<script type="text/javascript" src="{{ asset('packages/select2/js/select2.min.js') }}"></script>
@endsection

@section('content')
<div class="container spark-screen">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<ol class="breadcrumb">
				<li><a href="/">Home</a></li>
				<li><a href="{{ route('products.index') }}">Products</a></li>
				<li class="active">Create Product</li>
			</ol>

			<div class="panel panel-default">
				<div class="panel-heading">Create Product</div>
				<div class="panel-body">
					<form class="form-horizontal" method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
						@include('products._form')
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('script')
	<script type="text/javascript">
	$(function() {
		$(".multiselect").select2();
	});
	</script>
@endpush()

