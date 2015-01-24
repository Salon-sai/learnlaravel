@extends('customer._layouts.default')

@section('main')
<h1 class="page-header">Your Order</h1>
{{Notification::showAll()}}
<div class="col-xs-12 col-lg-8 bg-success">
	<p>Order ID : {{$order->id}}</p>
	<p>Status 	: @if($order->status == -2)
			<a href="{{URL::route('u.order.edit', $order->id)}}">Need Confirm</a>
		@elseif($order->status == -1)
			Waitting accepting
		@elseif($order->status == 0)
			Delivering
		@elseif($order->status == 1)
			Finished
		@endif
	</p>
	<p>Total 	: ${{$order->total}}</p>
	<p>
		@if($order->status == 0)
			<button order-id="{{$order->id}}" class="btn btn-danger btn-mini pull-left" disabled='disabled'>Delete</button>
		@else
			<button order-id="{{$order->id}}" class="btn btn-danger btn-mini pull-left">Delete</button>
		@endif
	</p>
</div>
<div class="col-xs-12 col-lg-8">
	<ul class="list-group">
		@foreach($order->foods as $food)
		<li class="list-group-item">
			<span class="badge">{{$food->pivot->quantity}}</span>
			<span class="badge">${{$food->price}}</span>
			{{$food->name}}
		</li>
		@endforeach
	</ul>
</div>
@stop