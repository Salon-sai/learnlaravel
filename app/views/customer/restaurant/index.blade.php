@extends('customer._layouts.default')

@section('main')

@foreach($descriptions as $description)
	@if($description->status == 1)
		<a class="btn btn-lg btn-primary btn-block text-center" role="button" href="{{URL::route('u.r.show', $description->id)}}">{{$description->name}}</a>
	@else
		<a class="btn btn-lg btn-primary btn-block text-center" disabled="disabled" role="button" href="{{URL::route('u.r.show', $description->id)}}">{{$description->name}}</a>
	@endif
@endforeach

@stop