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
				<td class="text-danger">
					Not Check
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
					{{Form::open(array(
						"url" => URL::route('admin.r.agree'),
						"method" => "post",
					))}}
					<input type="hidden" name="r_id" value="{{$restaurant->id}}">
					<input type="submit" class="btn btn-success" value="Agree" />
					{{Form::close()}}
				</td>
			</tr>
		</tbody>
	</table>
<!-- </div> -->
</div>
@stop