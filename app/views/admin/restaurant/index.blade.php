@extends('admin._layouts.default')
@section('main')

<h1 class="page-header">Restaurant List</h1>

<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Name</th>
				<th>E-mail</th>
				<th>Last Updated Time</th>
				<th>Last Login Time</th>
				<th><i class='icon-cog'></i></th>
			</tr>
		</thead>
		<tbody>
			@foreach($restaurants as $restaurant)
				@if($restaurant->description_id)
				<tr>
					<td>
						<a href="{{URL::route('admin.restaurant.show', $restaurant->id)}}">{{$restaurant->description->name}}</a>
					</td>
					<td>{{$restaurant->email}}</td>
					<td>{{$restaurant->updated_at}}</td>
					<td>{{$restaurant->last_login}}</td>
				</tr>
				@endif
			@endforeach
		</tbody>
	</table>
</div>

@stop