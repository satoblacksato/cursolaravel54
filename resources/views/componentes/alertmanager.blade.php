<div class="container">
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="alert alert-{{ session('alertmanager.type')}}" role="alert">
			{{ session('alertmanager.data') }}
		</div>
	</div>
</div>
</div>