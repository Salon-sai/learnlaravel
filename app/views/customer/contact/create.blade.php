@extends('customer._layouts.default')

@section('main')

<div class="jumbotron text-center">
	<h1>Create New Contact</h1>
</div>
<div class="row">
	{{Notification::showAll()}}
	{{Form::open(array(
		'url' 	=> URL::route('u.contact.store'),
		'method'=> 'post',
		'role'	=> 'form',
		'class'	=> 'form-horizontal'
	))}}
		<label class="col-sm-2 control-label">Address</label>
		<div class="col-sm-10">
			{{Form::text('address',null, array(
				'class'			=> 'form-control',
				'placeholder'	=> 'Address'
			))}}
		</div>
		<label class="col-sm-2 control-label">Telephone</label>
		<div class="col-sm-10">
			{{Form::text('telephone',null, array(
				'class'			=> 'form-control',
				'placeholder'	=> 'Telephone'
			))}}
		</div>
		<input type="hidden" value="{{$RedirectPage}}" name="nextRedirect">
		<div class="form-actions text-center">
			{{Form::submit('Create New Contact', array(
				'class'		=> 'btn btn-lg btn-info',
			))}}
		</div>
	{{Form::close()}}
</div>

@stop