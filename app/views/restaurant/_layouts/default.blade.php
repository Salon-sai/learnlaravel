<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
	<title>Food Order</title>
	@include('default._partials.assets')
	<link rel="stylesheet" href="{{URL::asset('css/bootstrap-switch.min.css')}}">
	<script type="text/javascript" src="{{URL::asset('js/bootstrap-switch.min.js')}}"></script>

</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Food Order</a>
			</div>
			@include('restaurant._layouts.navigation-header')
		</div>
	</nav>
	<div class="container-fluid">
		<div class="row">
			@include('restaurant._layouts.navigation-operation')
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				@yield('main')
			</div>
		</div>
		@yield('login')
	</div>
</body>
<script type="text/javascript">

	$("[name='restaurant_status']").bootstrapSwitch();

	$("[name='restaurant_status']").on('switchChange.bootstrapSwitch', function(event, status){
			if(!status){
				alert('Are you sure close you store. However, you must finish the order customers submited!!!');
			}
			$.ajax({
				url : "{{Route('r.status.change')}}",
				type : "POST",
				dataType : 'json',
				success : function(returnData){
					if(returnData.type == 'success'){
						alert(returnData.message);
					}else{
						alert(returnData.message);
					}
				}
			});
	});
</script>
</html>