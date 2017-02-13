<!DOCTYPE html>
<html>
<head>
	<title>{{$title }}</title>
</head>
<body>
		@component('componentes.children')
			@slot('title','MAtematicas')
			@slot('description')
				<h1>Hola</h1>
			@endslot
		@endcomponent

<br/>
		@component('componentes.children')
			@slot('title','Fisica')
			@slot('description','libro fisica')
		@endcomponent
		

<br/>
@include('componentes.children',['title'=>'para components','description'=>'para components description'])

</body>
</html>