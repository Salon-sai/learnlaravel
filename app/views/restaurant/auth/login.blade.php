@extends('restaurant._layouts.default')
@section('login')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/signin.css')}}">
<div class="container">
	{{ Form::open(array(
		'class' => 'form-signin',
		'role'	=> 'form'
	))}}
		@if($errors->has('login'))
			<div class="alert alert-error">
				{{$errors->first('login', ':message')}}
			</div>
		@endif
		<h2 class="form-signin-heading">Restaurant sign in</h2>
		{{Form::email('email',null,array(
			'class'			=> 'form-control',
			'placeholder'	=> 'Email'
		))}}
		{{Form::password('password', array(
			'class'			=> 'form-control',
			'placeholder'	=> 'Password'
		))}}
		<div class="checkbox">
			<label>
				<input type="checkbox" value="remember-me">
				Remember me
			</label>
		</div>
		<div class="form-actions btn-group btn-group-justified" role="group">
			<div class="btn-group" role="group">
				{{Form::submit('Sign in', array(
					'class'		=> 'btn btn-lg btn-primary',
				))}}
			</div>
			<div class="btn-group" role="group">
				<a href="{{URL::route('register.create')}}" class="btn btn-lg btn-warning">Join with us</a>
			</div>
		</div>
	{{Form::close()}}
</div>

@stop