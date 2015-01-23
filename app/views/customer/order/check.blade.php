@extends('customer._layouts.default')

@section('main')
<h1 class="page-header"></h1>
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Order ID</th>
				<th>Food Name</th>
				<th>Food Price</th>
				<th>Quantity</th>
				<th><i class="icon-cog"></i></th>
			</tr>
		</thead>
		<tbody>
			@foreach($order->foods as $key => $food)
			<tr index='{{$key}}'>
				<td>{{$order->id}}</td>
				<td>{{$food->name}}</td>
				<td>{{$food->price}}</td>
				<td>
					<div class="input-group col-md-2">
						<div class="input-group-btn">
							<button name="add" class="btn btn-default" onclick="changeQuantity('{{$food->pivot->quantity}}')"> + </button>
						</div>
						<input food-id="{{$food->id}}" type="text" value="{{$food->pivot->quantity}}" class="form-control" is-change='false' />
						<div class="input-group-btn">
							<button name="reduce" class="btn btn-default" onclick="changeQuantity('{{$food->pivot->quantity}}')"> - </button>		
						</div>
					</div>
				</td>
				<td>
					<input type="button" class="btn btn-danger btn-mini" onclick="deleteFood('{{$key}}', '{{$order->id}}', '{{$food->id}}')">
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
	<input order-id="{{$order->id}}" id="submit_order" type="button" class="btn btn-primary btn-lg btn-block" value="submit the order">
</nav>
<script type="text/javascript">

	function deleteFood(index, orderId, foodId){
		$.ajax({
			url : "{{URL::route('u.order.food.delete')}}"
			type: 'DELETE',
			dataType: 'json',
			data: {
				'order_id' : orderId,
				'food_id'  : foodId
				}
			success : function(returnData){
				if(returnData.type == 'success'){
					alert(returnData.message);
					$("[index='"+index+"']").remove();
				}
			}
		});
	}

	function changeQuantity(quantity){
		var quantity_text = $(this).parent().parent().children(':text');
		if(quantity == quantity_text.val())
			quantity_text.attr('is-change') = 'false';
		else
			quantity_text.attr('is-change') = 'true';
	}

	$('#submit_order').on('click', function(){
		var order_id = $(this).attr('order-id');
		var $change_foood_ids 	= new Array();
		var $change_quantity 	= new Array();
		$("[is-change='true']").each(function(){
			$change_foood_ids.push($(this).attr('food-id'));
			$change_quantity.push($(this).val());
		});
		$.ajax({
			url : "{{URL::route('u.order.food.update')}}",
			type: 'PUT',
			dataType: 'json',
			data: {
				'change_ids' : $change_foood_ids,
				'change_quantity' : $change_quantity,
				'order_id'	: $order_id
			}
			success : function(returnData){
				alert('return success');
			}
		});
	});
</script>
@stop