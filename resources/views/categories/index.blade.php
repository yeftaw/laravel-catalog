@extends('layouts.app')

@section('content')
<div class="container spark-screen">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Categories&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-xs btn-success" style="font-weight: bold;">&nbsp;&nbsp;Create&nbsp;&nbsp;</button></div>
				<div class="panel-body">
					<div id="OrderPackages">
						<table id="tableSearchResults" class="table table-hover table-striped table-condensed">
							<thead>
								<tr>
									<th width="2%"></th>
									<th class="col-md-6">Category</th>
									<th class="col-md-2">Total Sub Category</th>
									<th class="col-md-2">Total Products</th>
									<th class="col-md-2 text-center">Actions</th>
								</tr>
							</thead>
							<tbody>
								<tr id="package1" class="accordion-toggle" data-toggle="collapse" data-parent="#OrderPackages" data-target=".packageDetails1">
									<td><i class="indicator glyphicon glyphicon-chevron-up"></i>
									</td><td>123456</td>
									<td>2</td>
									<td>10</td>
									<td class="text-center">
										<button type="button" class="btn btn-xs btn-default">
											<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
										</button>
										<button type="button" class="btn btn-xs btn-default">
											<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
										</button>
									</td>
								</tr>
								<tr>
									<td colspan="5" class="hiddenRow">
										<div class="accordion-body collapse packageDetails1" id="accordion1">
											<table>
												<tr>
													<td>Revealed item 1</td>
												</tr>
												<tr>
													<td>Revealed item 2</td>
												</tr>
											</table>
										</div>
									</td>
								</tr>
								<tr id="package2" class="accordion-toggle" data-toggle="collapse" data-parent="#OrderPackages" data-target=".packageDetails2">
									<td><i class="indicator glyphicon glyphicon-chevron-up"></i>
									</td>
									<td>654321</td>
									<td>2</td>
									<td>3</td>
									<td class="text-center">
										<button type="button" class="btn btn-xs btn-default">
											<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
										</button>
										<button type="button" class="btn btn-xs btn-default">
											<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
										</button>
									</td>
								</tr>
								<tr>
									<td colspan="5">
										<div class="accordion-body collapse packageDetails2" id="accordion2">
											<table>
												<tr>
													<td>Revealed item 1</td>
												</tr>
												<tr>
													<td>Revealed item 2</td>
												</tr>
												<tr>
													<td>Revealed item 3</td>
												</tr>
											</table>
										</div>
									</td>
								</tr>
								<tr></tr>
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
	$('#accordion1').on('shown.bs.collapse', function () {
		$("#package1 i.indicator").removeClass("glyphicon-chevron-up").addClass("glyphicon-chevron-down");
	});
	$('#accordion1').on('hidden.bs.collapse', function () {
		$("#package1 i.indicator").removeClass("glyphicon-chevron-down").addClass("glyphicon-chevron-up");
	});

	$('#accordion2').on('shown.bs.collapse', function () {
		$("#package2 i.indicator").removeClass("glyphicon-chevron-up").addClass("glyphicon-chevron-down");
	});
	$('#accordion2').on('hidden.bs.collapse', function () {
		$("#package2 i.indicator").removeClass("glyphicon-chevron-down").addClass("glyphicon-chevron-up");
	});
</script>
@endpush
