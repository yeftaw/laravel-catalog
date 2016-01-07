<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">

	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" rel="home" href="#">e-Catalog</a>
	</div>

	<div class="collapse navbar-collapse">

		<ul class="nav navbar-nav">
			<li><a href="#">Products</a></li>
			<li><a href="#">Categories</a></li>
		</ul>
		<div class="pull-right">
			<div class="navbar-text">Username (<a href="{{ url('auth/logout') }}">Sign out</a>)</div>
		</div>

	</div>
</div>
