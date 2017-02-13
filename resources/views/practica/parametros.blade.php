<!DOCTYPE html>
<html>
<head>
	<title>{{ $title }}</title>
</head>
<body>

@if($flag)
	{{ $description }}
@else
	No vino variable
@endif


<br/>

@foreach($array as $item)
		{{ $item }} <br/>
@endforeach


<?php foreach($array  as $item){?>
	<?php echo $item; ?> <br/>
<?php } ?>

</body>
</html>