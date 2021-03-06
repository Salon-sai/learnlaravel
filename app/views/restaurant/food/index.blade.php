@extends('restaurant._layouts.default')

@section('main')


<h1 class="page-header">Food List</h1>
{{Notification::showAll()}}
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Name</th>
				<th>price</th>
				<th>picture</th>
				<th>Status</th>
				<th>Update Time</th>
				<th><i class="icon-cog"></i></th>
			</tr>
		</thead>
		<tbody>
			@foreach($foods as $key => $food)
			<tr index="{{$key}}">
				<td>
					<a href="{{URL::route('r.food.show', $food->id)}}">{{$food->name}}</a>
				</td>
				<td>{{$food->price}}</td>
				<td>{{$food->picture}}</td>
				<td>
					<div class="switch">
						@if($food->status)
							<input change-id="{{$food->id}}" data-on-color="success"  data-on-text="UP" data-off-text="DOWN" type="checkbox" name="status" checked />
						@else
							<input change-id="{{$food->id}}" data-on-color="success" data-on-text="UP" data-off-text="DOWN" type="checkbox" name="status" />
						@endif
					</div>
				</td>
				<td>{{$food->updated_at}}</td>
				<td>
					<a href="{{URL::route('r.food.edit', $food->id)}}" class="btn btn-success btn-mini pull-left">Edit</a>
					<input type="button" class="btn btn-danger btn-mini" onclick="deleteFood('{{$key}}','{{$food->id}}')" value="Delete"/>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<link rel="stylesheet" href="{{URL::asset('css/bootstrap-switch.min.css')}}">
<script type="text/javascript" src="{{URL::asset('js/bootstrap-switch.min.js')}}"></script>
<script type="text/javascript">
	
	$("[name='status']").bootstrapSwitch();

	$("[name='status']").on('switchChange.bootstrapSwitch',function(event, status){
			// alert($(this).attr('change-id'));
			if(!status){
				alert('Are you sure undercarrgies the food');
			}
			$.ajax({
				url : "food/change",
				type: "POST",
				data: {'id': $(this).attr('change-id')},
				dataType: "json",
				success : function(returnData){
					if(returnData.type == 'success'){
						alert(returnData.message);
					}else if(returnData.type == 'error'){
						alert(returnData.message);

					}
				}
			});

	});

	function deleteFood(index, id){
		$.ajax({
			url : "food/"+id,
			type: "DELETE",
			dataType: "json",
			success : function(returnData){
				if(returnData.type == 'success'){
					alert(returnData.message);
					$("[index="+index+"]").remove();
				}else{
					alert(returnData.message);
				}
			},
			error	: function(XMLHttpRequest, textStatus, errorThrown){
					alert(XMLHttpRequest.error);
			}
		});
	}
</script>
@stop