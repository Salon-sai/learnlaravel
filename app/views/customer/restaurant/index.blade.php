@extends('customer._layouts.default')

@section('main')
<div class="container">
@foreach($restaurants as $restaurant)
	<div class="col-md-12">{{$restaurant->description->name}}</div>
@endforeach
</div>
@stop