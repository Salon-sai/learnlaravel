@extends('customer._layouts.default')

@section('main')

<div class="jumbotron text-center">
	<h1>{{$description->name}}</h1>
	<p>{{$description->description}}</p>
</div>
<div class="row">
	@foreach($foods as $food)
		<div class="col-xs-6 col-lg-4">
			<h2>{{$food->name}}</h2>
			<p>Total Sell : {{$food->current_sell}}</p>
			<p>
				@if($food->status)
					<a name='price' class="btn btn-info btn-md col-md-2" role="button">${{$food->price}}</a>
					<div class='input-group col-md-2 hidden'>
						<input food-id="{{$food->id}}" name='quantity' type='text' value='0' class='form-control'/>
						<div class='input-group-btn'>
							<button type='button' name='reduce' class='btn btn-default'> - </button>
						</div>
					</div>
				@else
					<a name='price' class="btn btn-info btn-md col-md-2" disabled="disabled" role="button">${{$food->price}}</a>
				@endif
			</p>
		</div>
	@endforeach
</div>
<nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
	{{Form::open(array(
		'id' 	=> 'total_form',
		'url'	=> URL::route('u.order.store'),
		'method'=> 'post'
	))}}
	<input id='total_ids' name='food_ids' type="hidden" />
	<input id="quantity_s" name='quantity_s' type='hidden'/>
	<input id='total' type="submit" class="btn btn-primary btn-lg btn-block" value="$0">
	{{Form::close()}}
</nav>
<script type="text/javascript">
	$("[name='quantity']").val(0);

	$("[name='price']").on('click', function(){
		var add_price 		= parseInt($(this).html().substr(1));
		var past_total 		= parseInt($('#total').val().substr(1));
		var current_total 	= add_price + past_total;
		$('#total').val('$'+current_total);

		var btn_group 		= $(this).parent().next();
		var quantity 		= parseInt(btn_group.children(':text').val()) + 1;
		btn_group.children(':text').val(quantity);
		if(quantity > 0 && btn_group.has('.hidden')){
			btn_group.removeClass('hidden');
			btn_group.addClass('visible');
		}
	});
	$("[name='reduce']").on('click', function(){
		var btn_group 		= $(this).parent().parent();
		var price 			= parseInt(btn_group.prev().children().html().substr(1));
		var past_total 		= parseInt($('#total').val().substr(1));
		var text_field 		= $(this).parent().prev();
		var quantity 		= parseInt(text_field.val()) - 1;
		text_field.val(quantity);
		var current_total 	= past_total - price;
		$('#total').val('$'+current_total);
		if(quantity < 1 && btn_group.has('.visible')){
			btn_group.removeClass('visible');
			btn_group.addClass('hidden');
		}
	});
	$('#total_form').on('submit',function(){
		var food_ids 	= new Array();
		var quantity_s 	= new Array();
		$("[name='quantity']").each(function(){
			if($(this).val() != 0){
				food_ids.push($(this).attr('food-id'));
				quantity_s.push($(this).val());
			}
		});
		id_list		 = food_ids.join(',');
		quantity_list= quantity_s.join(',');
		$('#total_ids').val(id_list);
		$('#quantity_s').val(quantity_list);
	});
</script>
@stop