@extends('restaurant._layouts.default')

@section('main')

<h1 class="page-header">Order List</h1>
{{Notification::showAll()}}
<div class="table-responsive">
	<table class="table table-striped">
		<tbody>
			@foreach($orders as $order)
				<tr>
					<td class="col-xs-12 col-lg-8" order-id="{{$order->id}}">
						<p>Order ID : {{$order->id}}</p>
						<p>Status	: Refuse the order</p>
						<p>Total 	: ${{$order->total}}</p>
						<p>
							<button class="btn btn-danger btn-mini pull-left">Delete</button>
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