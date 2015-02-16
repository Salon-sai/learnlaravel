@extends('restaurant._layouts.default')

@section('main')
<script type="text/javascript" src="{{URL::asset('js/Chart.min.js')}}"></script>
<h1 class="page-header">Sales status</h1>
<div class="row">
	<div class="col-md-6">
		<div class="text-center">
			<canvas id="total_sell_chart" width="300" height="300"/>
		</div>
		<h4 class="text-center">Total Sell Quantity</h4>
	</div>
	<div class="col-md-6">
		<div class="text-center">
			<canvas id="sell_money_chart" width="300" height="300"/>
		</div>
		<h4 class="text-center">Sum of Memoy</h4>
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
	var color_Data = ["#F7464A", "#FF5A5E", "#46BFBD", "#5AD3D1", "#FDB45C", "#FFC870", "#949FB1", "#A8B3C5", "#4D5360", "#616774"];

	var total_sell_Data = [
		@foreach($foods as $key => $food)
		{
			value: {{$food->total_sell}},
			label: "{{$food->name}}",
			color: color_Data[{{2 * $key}}],
			highlight: color_Data[{{2 * $key + 1}}],
		},
		@endforeach
	];

	var sell_money_Data = [
		@foreach ($foods as $key => $food)
		{
			value: {{$food->total_sell * $food->total_sell}},
			label: "{{$food->name}}",
			color: color_Data[{{2 * $key}}],
			highlight: color_Data[{{2 * $key + 1}}],
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