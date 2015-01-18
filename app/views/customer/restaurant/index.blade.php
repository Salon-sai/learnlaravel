@extends('customer._layouts.default')

@section('main')
<div class="container">
@foreach($restaurants as $restaurant)
	<button type="button" class="btn btn-lg btn-link btn-block">{{$restaurant->description->name}}</button>
@endforeach
</div>
@stop