@extends('restaurant._layouts.default')

@section('main')

<h1 class="page-header">Food Detail</h1>
{{Notification::showAll()}}
<div class="containter">
<!-- <div class="table-responsive"> -->
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Tag</th>
				<th>Content</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Name</td>
				<td>{{$food->name}}</td>
			</tr>
			<tr>
				<td>Price</td>
				<td>{{$food->price}}</td>
			</tr>
			<tr>
				<td>The Store of Food in Last Update Time</td>
				<td>{{$food->current_total_store}}</td>
			</tr>
			<tr>
				<td>The Number of Selling {{$food->name}} after Last Update Time</td>
				<td>{{$food->current_sell}}</td>
			</tr>
			<tr>
				<td>The Total Number of selling {{$food->name}}</td>
				<td>{{$food->total_sell}}</td>
			</tr>
			<tr>
				<td>Description</td>
				<td>{{$food->description}}</td>
			</tr>
			<tr>
				<td>Status</td>
				<td>{{$food->status}}</td>
			</tr>
			<tr>
				<td>Operation</td>
				<td>
					<a href="{{URL::route('r.food.edit', $food->id)}}" class="btn btn-success btn-mini pull-left">Edit</a>
					{{Form::open(array(
						'route'			=> array('r.food.destroy', $food->id),
						'methor'		=> 'delete',
						'data-confirm'	=> 'Are you sure?'
					))}}
					{{Form::submit('Delete', array(
						 "class" 		=>	"btn btn-danger btn-mini"
					))}}
					{{Form::close()}}
				</td>
			</tr>
		</tbody>
	</table>
<!-- </div> -->
</div>

@stop