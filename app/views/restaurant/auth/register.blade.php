@extends('restaurant._layouts.default')
@section('login')

<h1 class="page-header text-center">Register Restaurant</h1>

@if ($errors->any())
	<div class="alert alert-error">
		{{ implode('<br>', $errors->all()) }}
	</div>
@endif

<div class="container">
	{{Form::open(array(
		'url'	=> URL::route('register.store'),
		'class'	=> 'form-horizontal',
		'role'	=> 'form',
		'method'=> 'post'
	))}}
		<div class="form-group form-group-lg">
			<label class="col-sm-2 control-label">E-mail</label>
			<div class="col-sm-10">
				{{Form::email('email', null, array(
					'class'			=> 'form-control',
					'placeholder'	=> 'E-mail'
				))}}
			</div>
		</div>
		<div class="form-group form-group-lg">
			<label class="col-sm-2 control-label">Password</label>
			<div class="col-sm-10">
				{{Form::password('password', array(
					'class'			=> 'form-control',
					'placeholder'	=> 'Password'
				))}}
			</div>
		</div>
		<div class="form-group form-group-lg">
			<label class="col-sm-2 control-label">Password</label>
			<div class="col-sm-10">
				{{Form::password('password_confirmation', array(
					'class'			=> 'form-control',
					'placeholder'	=> 'Again Password'
				))}}
			</div>
		</div>
		<div class="form-actions text-center">
			{{Form::submit('Submit and Check the E-mail',array(
				'class'				=> 'btn btn-lg btn-primary'
			))}}
		</div>
	{{Form::close()}}
</div>

@stop