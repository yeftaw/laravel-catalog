@extends('layouts.app')

@section('content')

<div class="container spark-screen">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<ol class="breadcrumb">
				<li><a href="/">Home</a></li>
				<li class="active">Categories</li>
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
				<strong>Woops!</strong> {!! Session::get('errorMsg') !!}
			</div>
			@endif

			<div class="panel panel-default">
				<div class="panel-heading">Categories&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ route('categories.create') }}" class="btn btn-xs btn-success" style="font-weight: bold;">&nbsp;&nbsp;Create&nbsp;&nbsp;</a></div>
				<div class="panel-body">
					<div>
						<table class="table table-hover table-condensed">
							<thead>
								<tr>
									<th class="col-md-10">Category</th>
									<th class="col-md-2 text-center">Actions</th>
								</tr>
							</thead>
							<tbody>
								{!! recursiveArrayTable($categories) !!}
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('script')
<script type="text/javascript">
	$( document ).ready(function() {
		$('[data-toggle="tooltip"]').tooltip();

		$('[data-delete]').click(function(e){
			e.preventDefault();
			// If the user confirm the delete
			if (confirm('Do you really want to delete this category?')) {
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
@endpush
