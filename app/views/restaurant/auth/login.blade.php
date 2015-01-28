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
		<div class="form-actions">
			{{Form::submit('Sign in', array(
				'class'		=> 'btn btn-lg btn-primary btn-block',
			))}}
			<a href="" class="btn btn-lg btn-link">Join with our</a>
		</div>
	{{Form::close()}}
</div>

@stop