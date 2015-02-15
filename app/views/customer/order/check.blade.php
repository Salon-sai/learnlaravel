@extends('customer._layouts.default')

@section('main')
<h1 class="page-header">Check Your Order</h1>
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<th><h1 class="text-center">Food List</h1></th>
		</thead>
		<tbody>
			@foreach($order->foods as $key => $food)
			<tr index='{{$key}}'>
				<td>
					<ul class="list-group">
						<li class="list-group-item ">
							<span class="badge">${{$food->price}}</span>
							{{$food->name}}
							<div class="input-group">
								<div class="input-group-btn">
									<button name="add" class="btn btn-default" onclick="changeQuantity('{{$food->pivot->quantity}}', '{{$key}}', 'add')"> + </button>
								</div>
								<input food-id="{{$food->id}}" type="text" value="{{$food->pivot->quantity}}" class="form-control" is-change='false' />
								<div class="input-group-btn">
									<button name="reduce" class="btn btn-default" onclick="changeQuantity('{{$food->pivot->quantity}}', '{{$key}}', 'reduce')"> - </button>
									<input type="button" class="btn btn-danger btn-mini" onclick="deleteFood('{{$key}}', '{{$order->id}}', '{{$food->id}}')" value="delete">
								</div>
							</div>
							
						</li>
					</ul>
				</td>
<!-- 				<td>{{$order->id}}</td>
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
				</td> -->
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

<hr>

<h1>Other Contacts</h1>

@foreach($contacts as $contact)
<ul class="list-group" contact-id="{{$contact->id}}">
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
				Chosed
			</span>Chose
		@endif
	</li>
</ul>
@endforeach

<nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
	{{Form::open(array(
		'url' 	=> URL::route('u.order.update',$order->id),
		'method'=> 'PUT',
	))}}
		<input type="hidden" id='change_id_list' name="change_ids">
		<input type="hidden" id='change_quantity_list' name="change_quantity">
		<input type="hidden" id="order_id" name="order_id" value="{{$order->id}}">
		<input type="hidden" id="contact_id" name="contact_id" value="">
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
		settingContact($(this));
	});

	function settingContact(btn){
		var click_span_field = btn.parent();
		var contact_id = btn.parents("ul").attr("contact-id");
		$("#contact_id").val(contact_id);
		var chosed_span_field = $("[chosed='true']").parent();
		click_span_field.html("<span class='badge' chosed='true'>Chosed</span>Chose");
		chosed_span_field.html("<button class='btn btn-success' chosed='false' name='setting-contact'>chose</button>");
		var not_chosed_span_field = $("[chosed='false']");
		not_chosed_span_field.unbind('click');
		not_chosed_span_field.bind({
			click : function(){
				settingContact($(this));
			}
		});
	}
</script>
@stop