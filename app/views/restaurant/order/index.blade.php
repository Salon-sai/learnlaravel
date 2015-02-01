@extends('restaurant._layouts.default')

@section('main')

<h1 class="page-header">Order List</h1>
{{Notification::showAll()}}
<div class="table-responsive">
	<table class="table table-striped">
		<tbody>
			@foreach($orders as $order)
				<tr order-id="{{$order->id}}">
					<td class="col-xs-12 col-lg-8">
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
						<p>Submit Date : {{$order->created_at}}</p>
						<p>Customer Telephone : {{$order->telephone }}</p>
						<p>Customer Address : {{$order->address}}</p>
						<p>Total 	: ${{$order->total}}</p>
						<p>
							@if($order->status < 2)
								<button name="delete-order" class="btn btn-danger btn-mini pull-left" disabled='disabled'>Delete</button>
							@elseif($order->status == 0 || $order->status == 2)
								<button name="delete-order" class="btn btn-danger btn-mini pull-left">Delete</button>
							@endif
						</p>
					</td>
				</tr>
				<tr order-id="{{$order->id}}">
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
		var tr_field = $(this).parents('tr');
		var order_id = tr_field.attr('order-id');
		$.ajax({
			url : "{{URL::route('r.order.status.change')}}",
			type: 'POST',
			dataType: 'json',
			data: {
				'order_id'	: order_id,
				'type'		: 'accept'
			},
			success: function(returnData){
				if(returnData.type == 'success'){
					alert(returnData.message);
					tr_field.find('p:eq(1)').html('Status : Delivering');
				}
			}
		});
	});

	$("[name='refuseOrder']").on('click', function(){
		var tr_field = $(this).parents('tr');
		var order_id = tr_field.attr('order-id');
		$.ajax({
			url : "{{URL::route('r.order.status.change')}}",
			type: 'POST',
			dataType: 'json',
			data: {
				'order_id'	: order_id,
				'type'		: 'refuse'
			},
			success: function(returnData){
				if(returnData.type == 'success'){
					alert(returnData.message);
					tr_field.find('p:eq(1)').html('Status : Refuse the order');
					tr_field.find('p:eq(3)').children('button').attr('disabled', false);
				}
			}
		});
	});

	$("[name='delete-order']").on('click', function(){
		var tr_field = $(this).parents('tr');
		var order_id = tr_field.attr('order-id');
		$.ajax({
			url : '/r/order/'+order_id,
			type: 'DELETE',
			dataType: 'json',
			success: function(returnData){
				if(returnData.type == 'success'){
					alert(returnData.message);
					$("[order-id='"+order_id+"']").remove();
				}
			}
		});		
	});
</script>
@stop