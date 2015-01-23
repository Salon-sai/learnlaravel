@extends('customer._layouts.default')

@section('main')

<div class="jumbotron text-center">
	<h1>Your Contacts</h1>
</div>

<div class='row'>
	@foreach($contacts as $contact)
		<div class="col-xs-6 col-lg-4">
			@if($contact->isDefault)
				<p>Default</p>
			@endif
			<p>{{$contact->address}}</p>
			<p>{{$contact->telephone}}</p>
			<p><a name="default_setting" class="btn btn-info btn-md col-md-2"  role="button">Set Default Contact</a></p>
		</div>
	@endforeach
</div>
@stop