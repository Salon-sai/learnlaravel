@extends('restaurant._layouts.default')

@section('main')


<h1 class="page-header">Category List</h1>
{{Notification::showAll()}}
<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Name</th>
				<th><i class="icon-cog"></i></th>
			</tr>
		</thead>
		<tbody>
			@foreach($categories as $key => $category)
			<tr index="{{$key}}">
				<td>
					<a href="{{URL::route('r.category.show', $category->id)}}">{{$category->name}}</a>
				</td>
				<td>
					<a href="{{URL::route('r.category.edit', $category->id)}}" class="btn btn-success btn-mini pull-left">Edit</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>

@stop