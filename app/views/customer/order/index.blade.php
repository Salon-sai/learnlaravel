@extends('customer._layouts.default')

@section('main')
<h1 class="page-header">Your Order</h1>
<div class="table-responsive">
	<table class="table">
		<tbody>
			@foreach($orders as $order)
				<tr>
					<td class="col-xs-12 col-lg-8 bg-success">
						<p>Order ID : {{$order->id}}</p>
						<p>Status 	: 							@if($order->status == -2)
								<a href="{{URL::route('u.order.edit', $order->id)}}">Need Confirm</a>
							@elseif($order->status == -1)
								Waitting accepting
							@elseif($order->status == 0)
								Delivering
							@elseif($order->status == 1)
								Finished
							@endif
						</p>
						<p>Submit Date : {{$order->created_at}}</p>
						<p>Customer Telephone : {{$order->telephone }}</p>
						<p>Customer Address : {{$order->address}}</p>
						<p>Total 	: ${{$order->total}}</p>
						<p>
							@if($order->status == 0)
								<button order-id="{{$order->id}}" class="btn btn-danger btn-mini pull-left" disabled='disabled'>Delete</button>
							@else
								<button order-id="{{$order->id}}" class="btn btn-danger btn-mini pull-left">Delete</button>
							@endif
						</p>
					</td>
				</tr>
				<tr>
					<td class="col-xs-12 col-lg-8">
						<ul class="list-group">
							@foreach($order->foods as $food)
							<li class="list-group-item">
								<span class="badge">{{$food->pivot->quantity}}</span>
								<span class="badge">${{$food->price}}</span>
								{{$food->name}}
							</li>
							@endforeach
						</ul>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
@stop