<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
	<title>Food Order</title>
	@include('default._partials.assets')
	<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<script type="text/javascript">
		wx.config({
			debug: true,
			appId: "{{$signPackage[appId]}}",
			timestamp: "{{$signPackage[timestamp]}}",
			nonceStr: "{{$signPackage[nonceStr]}}",
			signature: "{{$signPackage[signature]}}",
			jsApiList: [
				'checkJsApi',
				'getNetworkType',
				'previewImage'
			]
		});
		wx.ready(function(){
			wx.checkJsApi({
				jsApiList: [
					'getNetworkType',
					'previewImage'
				],
				success :function(result){
					alert(JSON.stringify(result));
				}
			});
			wx.hideOptionMenu();
		});
	</script>
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
			@include('customer._layouts.navigation-header')
		</div>
	</nav>
	<div class="container-fluid">
		@yield('main')
	</div>
</body>
</html>