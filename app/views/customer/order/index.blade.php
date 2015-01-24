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
					@if($key == 0)
						<td rowspan="{{count($order->foods)}}">0</td>
						<td rowspan="{{count($order->foods)}}">
							@if($order->status == -2)
								<a href="{{URL::route('u.order.confirm', $order->id)}}">Need Confirm</a>
							@elseif($order->status == -1)
								Waitting accepting
							@elseif($order->status == 0)
								Delivering
							@elseif($order->status == 1)
								Finished
							@endif
						</td>
						<td rowspan="{{count($order->foods)}}">
							@if($order->status == 0)
								<button order-id="{{$order->id}}" class="btn btn-danger btn-mini pull-left" disabled='disabled'>Delete</button>
							@else
								<button order-id="{{$order->id}}" class="btn btn-danger btn-mini pull-left">Delete</button>
							@endif
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