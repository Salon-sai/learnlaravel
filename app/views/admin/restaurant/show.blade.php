@extends('admin._layouts.default')
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
				<td>{{$restaurant->description->name}}</td>
			</tr>
			<tr>
				<td>Description</td>
				<td>{{$restaurant->description->telephone}}</td>
			</tr>
			<tr>
				<td>Service Scale</td>
				<td>{{$restaurant->description->scale}}</td>
			</tr>
			<tr>
				<td>Loaction</td>
				<td>{{$restaurant->description->location_label}}</td>
			</tr>
			<tr>
				<td>Actived</td>
				<td>
				@if($restaurant->activated)
					Y
				@else N
				@endif
				</td>
			</tr>
			<tr>
				<td>Status</td>
				<td>
					@if($restaurant->description->status == -1)
						
					@elseif($restaurant->description->status == 0)
						Closed
					@elseif($restaurant->description->status == 1)
						Opening
					@endif
				</td>
			</tr>
			<tr>
				<td>Updated Time</td>
				<td>{{$restaurant->updated_at}}</td>
			</tr>			
			<tr>
				<td>Last Login Time</td>
				<td>{{$restaurant->last_login}}</td>
			</tr>
			<tr>
				<td>Created Time</td>
				<td>{{$restaurant->created_at}}</td>
			</tr>
			<tr>
				<td>Operation</td>
				<td>

				</td>
			</tr>
		</tbody>
	</table>
<!-- </div> -->
</div>

@stop