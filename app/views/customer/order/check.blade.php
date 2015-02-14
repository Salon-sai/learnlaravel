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
			<tr>
				<td class="col-xs-12 col-lg-8 bg-success">
					<p>Order ID : {{$order->id}}</p>
					<p>Contact Telephone : {{$order->telephone}}</p>
					<p>Contact Address : {{$order->address}}</p>
					<p>Total : ${{$order->total}}</p>
				</td>
			</tr>
			@foreach($order->foods as $key => $food)
			<tr index='{{$key}}'>
				<td>{{$order->id}}</td>
				<td>{{$food->name}}</td>
				<td>{{$food->price}}</td>
				<td>
					<div class="input-group col-xs-2">
						<div class="input-group-btn">
							<button name="add" class="btn btn-default" onclick="changeQuantity('{{$food->pivot->quantity}}', '{{$key}}', 'add')"> + </button>
						</div>
						<input food-id="{{$food->id}}" type="text" value="{{$food->pivot->quantity}}" class="form-control" is-change='false' />
						<div class="input-group-btn">
							<button name="reduce" class="btn btn-default" onclick="changeQuantity('{{$food->pivot->quantity}}', '{{$key}}', 'reduce')"> - </button>
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

	<hr>

	<h1>Other Contacts</h1>
	<table class="table table-striped">
		<tbody>
			<tr>
				<td class="col-xs-12 col-lg-8">
					@foreach($contacts as $contact)
					<ul class="list-group">
						<li class="list-group-item">
							<span class="badge">
								{{$contact->telephone}}
							</span>Telephone
						</li>
						<li class="list-group-item">
							<span class="badge">
								{{$contact->address}}
							</span>address
						</li>
						<li class="list-group-item">
							@if(!$contact->isDefault)
								<button class="btn btn-success" chosed="false" name="setting-contact">chose</button>
							@else
								<span class="badge" chosed="true">
									Chose
								</span>
							@endif
						</li>
					</ul>
					@endforeach
				</td>
			</tr>
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
		<input order-id="{{$order->id}}" id="submit_order" type="submit" class="btn btn-primary btn-lg btn-block" value="submit the order">
	{{Form::close()}}
</nav>
<script type="text/javascript">

	function deleteFood(index, orderId, foodId){
		$.ajax({
			url : "{{URL::route('u.order.food.delete')}}",
			type: 'DELETE',
			dataType: 'json',
			data: {
				'order_id' : orderId,
				'food_id'  : foodId
				},
			success : function(returnData){
				if(returnData.type == 'success'){
					alert(returnData.message);
					$("[index='"+index+"']").remove();
				}
			}
		});
	}

	function changeQuantity(quantity, index, type){
		var quantity_text 		= $("tr[index='"+index+"']").find(':text');
		if(type == 'add'){
			var change_quantity 		= parseInt(quantity_text.val()) + 1;
			if(change_quantity > 20)
				change_quantity 		= change_quantity - 1;
			quantity_text.val(change_quantity);
		}
		else{
			var change_quantity 		= parseInt(quantity_text.val()) - 1;
			if(change_quantity < 1)
				change_quantity 		= 1;
			quantity_text.val(change_quantity);
		}
		if(quantity == quantity_text.val()){
			quantity_text.attr('is-change', 'false');
		}
		else{
			quantity_text.attr('is-change', 'true');
		}
	}

	$('#submit_order').on('click', function(){
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

	$("[name='setting-contact']").on('click', function(){
		var span_field = $(this).parent();
		$(this).remove();
		span_field.html("<span class='badge'chosed='true'>Chose</span>");
		span_field = $("[chosed='true']").parent();
		$("[chosed='true']").remove();
		span_field.html("<button class='btn btn-success' chosed='false' name='setting-contact'>chose</button>");
	});
</script>
@stop