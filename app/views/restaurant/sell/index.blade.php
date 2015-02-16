@extends('restaurant._layouts.default')

@section('main')
<script type="text/javascript" src="{{URL::asset('js/Chart.min.js')}}"></script>
<h1 class="page-header">Sales status</h1>
<div class="row">
	<div class="col-md-6">
		<canvas id="total_sell_chart" width="300" height="300"/>
	</div>
	<div class="col-md-6">
		<canvas id="sell_money_chart" width="300" height="300"/>
	</div>
</div>
<h2>Detail Data</h2>
<hr>
<table class="table table-striped text-center">
	<thead>
		<th class="text-center">Food name</th>
		<th class="text-center">Price</th>
		<th class="text-center">Total Sell Quantity</th>
		<th class="text-center">Total Money</th>
	</thead>
	<tbody>
		@foreach($foods as $food)
			<tr>
				<td>
					<a href="{{URL::route('r.food.show',$food->id)}}">{{$food->name}}</a>
				</td>
				<td>${{$food->price}}</td>
				<td>{{$food->total_sell}}</td>
				<td>${{$food->price * $food->total_sell}}</td>
			</tr>
		@endforeach
	</tbody>
</table>
<table></table>
<script type="text/javascript">
	var total_sell_Data = [
		@foreach($foods as $food)
		{
			value:{{$food->total_sell}},
			label:"{{$food->name}}",
			color:"#F7464A",
			highlight: "#FF5A5E",
		},
		@endforeach
	];

	var sell_money_Data = [
		@foreach ($foods as $food)
		{
			value:{{$food->total_sell * $food->total_sell}},
			label:"{{$food->name}}",
			color:"#F7464A",
			highlight: "#FF5A5E",
		},
		@endforeach
	];

	$(function(){
		var total_sell_chart = document.getElementById("total_sell_chart").getContext("2d");
		var sell_money_chart = document.getElementById("sell_money_chart").getContext("2d");
		window.myPie = new Chart(total_sell_chart).Pie(total_sell_Data);
		window.myPie = new Chart(sell_money_chart).Pie(sell_money_Data)
	});
</script>
@stop