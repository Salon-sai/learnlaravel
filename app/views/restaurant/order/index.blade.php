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
						<p>Status	:
								@if($order->status == -1)
									<a class="btn btn-success btn-mini" name="acceptOrder">Accept</a>
									<a class="btn btn-danger btn-mini" name="refuseOrder">Refuse</a>
								@elseif($order->status == 0)
									Refuse the order
								@elseif($order->status == 1)
									Delivering
								@elseif($order->status == 2)
									Finished
								@endif
						</p>
						<p>Total 	: ${{$order->total}}</p>
						<p>
							@if($order->status < 2)
								<button class="btn btn-danger btn-mini pull-left" disabled='disabled'>Delete</button>
							@elseif($order->status == 0 || $order->status == 2)
								<button class="btn btn-danger btn-mini pull-left">Delete</button>
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
<script type="text/javascript">
	$("[name='acceptOrder']").on('click', function(){
		var td_field = $(this).parent().parent();
		var order_id = td_field.attr('order-id');
		$.ajax({
			url : 'order/accept',
			type: 'POST',
			dataType: 'json',
			data: { 'order_id': order_id },
			success: function(returnData){
				td_field.find('p:eq(1)').html('Status : Delivering');
			}
		});
	});

	$("[name='refuseOrder']").on('click', function(){
		var td_field = $(this).parent().parent();
		var order_id = td_field.attr('order_id');
		$.ajax({
			url : 'order/refuse',
			type: 'POST',
			dataType: 'json',
			data: { 'order_id': order_id },
			success: function(returnData){
				td_field.td_field.find('p:eq(1)').html('Status : Refuse the order');
			}
		});
	});
</script>
@stop