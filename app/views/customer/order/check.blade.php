@extends('customer._layouts.default')

@section('main')
<h1 class="page-header">Check Your Order</h1>
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
					<div class="input-group col-xs-2">
						<div class="input-group-btn">
							<button name="add" class="btn btn-default" onclick="changeQuantity('{{$food->pivot->quantity}}', 'add')"> + </button>
						</div>
						<input food-id="{{$food->id}}" type="text" value="{{$food->pivot->quantity}}" class="form-control" is-change='false' />
						<div class="input-group-btn">
							<button name="reduce" class="btn btn-default" onclick="changeQuantity('{{$food->pivot->quantity}}', 'reduce')"> - </button>
						</div>
					</div>
				</td>
				<td>
					<input type="button" class="btn btn-danger btn-mini" onclick="deleteFood('{{$key}}', '{{$order->id}}', '{{$food->id}}')" value="delete">
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
	{{Form::open(array(
		'url' 	=> URL::route('u.order.update',$order->id),
		'method'=> 'PUT',
	))}}
		<input type="hidden" id='change_id_list' name="change_ids">
		<input type="hidden" id='change_quantity_list' name="change_quantity">
		<input type="hidden" id="order_id" name="order_id" value="{{$order->id}}">
		<input order-id="{{$order->id}}" id="submit_order" type="button" class="btn btn-primary btn-lg btn-block" value="submit the order">
	{{Form::close()}}
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

	function changeQuantity(quantity ,type){
		var quantity_text = $(this).parent().parent().children(':text');
		alert(quantity_text.val());
		alert($(this).parent().parent().html());
		if(type == 'add'){
			alert('add method invoke');
			quantity_text.val(parseInt(quantity_text.val())+1);
		}
		else{
			alert('reduce method invoke');
			quantity_text.val(parseInt(quantity_text.val())-1);
		}
		if(quantity == quantity_text.val()){
			quantity_text.attr('is-change') = 'false';
			alert('quantity is change');
		}
		else{
			quantity_text.attr('is-change') = 'true';
			alert('quantity is not change');
		}
		alert(quantity_text.val());
	}

	$('#submit_order').on('submit', function(){
		var change_foood_ids 	= new Array();
		var change_quantity 	= new Array();
		$("[is-change='true']").each(function(){
			change_foood_ids.push($(this).attr('food-id'));
			change_quantity.push($(this).val());
		});
		var change_id_list			= change_foood_ids.join(',');
		var change_quantity_list	= change_quantity.join(',');
		$('#change_id_list').val(change_id_list);
		$('#change_quantity_list').val(change_quantity_list);
	});
</script>
@stop