@extends('admin._layouts.default')
@section('main')

<h1 class="page-header">Application List</h1>
{{Notification::showAll()}}
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Name</th>
				<th>E-mail</th>
				<th>Location Label</th>
				<th><i class='icon-cog'></i></th>
			</tr>
		</thead>
		<tbody>
			@foreach($restaurants as $restaurant)
				<tr>
					<td>
						<a href="{{URL::route('admin.r.checkdetail', $restaurant->id)}}">{{$restaurant->name}}</a>
					</td>
					<td>{{$restaurant->email}}</td>
					<td>{{$restaurant->location_label}}</td>
					<td><a href="">Detail</a></td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>

@stop