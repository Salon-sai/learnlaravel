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
					<a class="btn btn-info btn-lg" role="button" href="#">${{$food->price}}</a>
				@else
					<a class="btn btn-info btn-lg" disabled="disabled" role="button" href="#">${{$food->price}}</a>
				@endif
			</p>
		</div>
	@endforeach
</div>
<nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
	<input type="button" class="btn btn-primary btn-lg btn-block" value="$0">
</nav>
@stop