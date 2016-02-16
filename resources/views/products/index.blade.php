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
				<li class="active">Products</li>
			</ol>

			@if(Session::has('successMsg'))
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Success!</strong> {{ Session::get('successMsg') }}
			</div>
			@endif

			@if(Session::has('errorMsg'))
			<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Woops!</strong> {{ Session::get('errorMsg') }}
			</div>
			@endif

			<div class="panel panel-default">
				<div class="panel-heading">Products&nbsp;&nbsp;&nbsp;&nbsp;
				@if(Auth::user()->role_id == 1)
					<a href="{{ route('products.create') }}" class="btn btn-xs btn-success">&nbsp;&nbsp;Create&nbsp;&nbsp;</a>
				@endif
				</div>
				<div class="panel-body">
					<div class="col-xs-offset-8 col-xs-4" style="margin-bottom: 15px;">
						<form id="filter" action="{{route('products.index')}}" method="get">{!! csrf_field() !!}<select name="filter[]" data-placeholder="Filter Category" class="form-control multiselect" multiple="multiple">
							{!! recursiveArraySelect2($categories, $filter) !!}
						</select></form>
					</div>
					<table class="table table-hover table-condensed">
						<thead>
							<tr>
								<th class="col-md-2">Picture</th>
								@if(Auth::user()->role_id == 1)
								<th class="col-md-3">Name</th>
								@elseif(Auth::user()->role_id == 2)
								<th class="col-md-5">Name</th>
								@endif
								<th class="col-md-3">Model</th>
								<th class="col-md-2">Category(ies)</th>
								@if(Auth::user()->role_id == 1)
								<th class="col-md-2 text-center">Actions</th>
								@endif

							</tr>
						</thead>
						<tbody>
							@foreach($products as $product)
							<tr>
								<td>
									<img src="{{ isset($product->photo) ? asset('img/'.$product->photo) : asset('img/not_available.png') }}" width="130" class="img-responsive img-rounded" alt="{{ $product->name }}">
								</td>
								<td>{{ $product->name }}</td>
								<td>{{ $product->model }}</td>
								<td>
									@foreach($product->categories as $index => $category)
										{{ $category->title }}@if($index+1 < count($product->categories)),@endif
									@endforeach
								</td>
								@if(Auth::user()->role_id == 1)
								<td class="text-center">
									<form class="form-inline">
										<a href="{{ route('products.edit', ['products' => $product->id]) }}" class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="top" title="Edit">
											<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
										</a>
										<a href="{{ route('products.destroy', ['products' => $product->id]) }}" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" data-delete="{{ csrf_token() }}" title="Delete">
											<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
										</a>
									</form>
								</td>
								@endif
							</tr>
							@endforeach
						</tbody>
					</table>
					{!! $products->links() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('script')
	<script type="text/javascript">
	$(function() {
		$('[data-toggle="tooltip"]').tooltip();

		$(".multiselect").select2();

		$('.multiselect').on("change", function() {
			var categories = $('.multiselect').val();
			console.log(categories);

			$("#filter").submit();
		});

		$('[data-delete]').click(function(e){
			e.preventDefault();
			// If the user confirm the delete
			if (confirm('Do you really want to delete this product?')) {
				// Get the route URL
				var url = $(this).prop('href');
				// Get the token
				var token = $(this).data('delete');
				// Create a form element
				var $form = $('<form/>', {action: url, method: 'post'});
				// Add the DELETE hidden input method
				var $inputMethod = $('<input/>', {type: 'hidden', name: '_method', value: 'delete'});
				// Add the token hidden input
				var $inputToken = $('<input/>', {type: 'hidden', name: '_token', value: token});
				// Append the inputs to the form, hide the form, append the form to the <body>, SUBMIT !
				$form.append($inputMethod, $inputToken).hide().appendTo('body').submit();
			}
}		);
	});
	</script>
@endpush()
