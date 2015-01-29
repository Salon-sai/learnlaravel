@extends('restaurant._layouts.default')

@section('main')
<h1 class="page-header">Deliver Order List</h1>
{{Notification::showAll()}}
<div class="table-responsive">
	<table class="table table-striped">
		<tbody>
			@foreach($orders as $order)
				<tr order-id="{{$order->id}}">
					<td class="col-xs-12 col-lg-8" order-id="{{$order->id}}">
						<p>Order ID : {{$order->id}}</p>
						<p>
							Status	: Delivering
							<button class="btn btn-lg btn-success" onclick="orderFinished('{{$order->id}}')">Finished</button>
						</p>
						<p>Total 	: ${{$order->total}}</p>
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
	function orderFinished(id){
		$.ajax({
			url : 'r/order/finished',
			type: 'post',
			dataType: 'json',
			data: {'id' : id},
			success : function(returnData){
				if(returnData.type == 'success'){
					alert(returnData.message);
					$("[order-id='"+id+"']").remove();
				}
			}
		});
	}
</script>
@stop