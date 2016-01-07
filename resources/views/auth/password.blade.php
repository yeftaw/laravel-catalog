@extends('layouts.master')

@section('css_assets')
	<link href="{{ asset('css/login.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">

			<div class="panel panel-login">
				<div class="panel-heading">
					<div class="row">
						<div class="col-xs-12">
							<h2>Register Form</h2>
						</div>
					</div>
					<hr>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-12">
							<form id="register-form" action="/password/email" method="post" role="form" style="display: block;">
								{!! csrf_field() !!}
								<div class="form-group">
									<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address">
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-sm-6 col-sm-offset-3">
											<button type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register">Send Password Reset Link</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js_assets')
	@parent
@endsection
