@extends('customer._layouts.default')

@section('main')
<div class="container">
@foreach($restaurants as $restaurant)
	<button type="button" class="btn btn-link"></button>
@endforeach
</div>
@stop