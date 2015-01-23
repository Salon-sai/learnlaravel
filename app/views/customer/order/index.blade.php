@extends('customer._layouts.default')

@section('main')
<h1 class="page-header">Your Order</h1>
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Order Id</th>
				<th>Food Name</th>
				<th>Food Price</th>
				<th>Quantity</th>
				<th>Total</th>
				<th>Status</th>
				<th><i class="icon-cog"></i></th>
			</tr>
		</thead>
		<tbody>
			@foreach($orders as $order)
				@foreach($order->foods as $key => $food)
				<tr index="{{$key}}">
					@if($key == 0)
						<td rowspan="{{count($order->foods)}}">
							{{$order->id}}
						</td>
					@endif
					<td>{{$food->name}}</td>
					<td>{{$food->price}}</td>
					<td>{{$food->pivot->quantity}}</td>
					<td>0</td>
					@if($key == 0)
						<td rowspan="{{count($order->foods)}}">
							@if($order->status == -1)
								Waitting accepting
							@elseif($order->status == 0)
								Delivering
							@elseif($order->status == 1)
								Finished
							@endif
						</td>
						<td>
							<button order-id="{{$order->id}}" class="btn btn-danger btn-mini pull-left">Delete</button>
						</td>
					@endif
				</tr>
				@endforeach
				<hr>
			@endforeach
		</tbody>
	</table>
</div>
@stop