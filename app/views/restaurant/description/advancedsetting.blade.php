@extends('restaurant._layouts.default')

@section('main')

<h1 class="page-header">Advanced Setting</h1>

@if ($errors->any())
	<div class="alert alert-error">
		{{ implode('<br>', $errors->all()) }}
	</div>
@endif

<div class="container">
	{{ Form::open(array(
		'url'	=> URL::route('r.description.update'),
		'class' => 'form-horizontal',
		'role'	=> 'form',
		'method'=> 'put'
	))}}
		<div class="form-group form-group-lg">
			<label class="col-sm-2 control-label">Current E-mail</label>
			<div class="col-sm-10">
				{{Form::email('current_email',null, array(
					'class'			=> 'form-control',
					'placeholder'	=> 'Current E-mail'
				))}}
			</div>
		</div>
		<div class="form-group form-group-lg">
			<label class="col-sm-2 control-label">Current password</label>
			<div class="col-sm-10">
				{{Form::password('current_password', array(
					'class'			=> 'form-control',
					'placeholder'	=> 'Current Password'
				))}}
			</div>
		</div>
		<div class="form-group form-group-lg">
			<label class="col-sm-2 control-label">New E-mail</label>
			<div class="col-sm-10">
				{{Form::email('new_email', null, array(
					'class'			=> 'form-control',
					'placeholder'	=> 'New E-mail'
				))}}
			</div>
		</div>
		<div class="form-group form-group-lg">
			<label class="col-sm-2 control-label">New password</label>
			<div class="col-sm-10">
				{{Form::text('new_password', null, array(
					'id'			=> 'new_password',
					'class'			=> 'form-control',
					'placeholder'	=> 'New Password'
				))}}
			</div>
		</div>
		<div class="form-group form-group-lg">
			<label class="col-sm-2 control-label">New password</label>
			<div class="col-sm-10">
				{{Form::text('re_password', null, array(
					'id'			=> 're_password',
					'class'			=> 'form-control',
					'placeholder'	=> 'Again New Password'
				))}}
			</div>
		</div>
		<div class="form-actions text-center">
			{{Form::submit('Update', array(
				'class'		=> 'btn btn-lg btn-info',
			))}}
		</div>
	{{Form::close()}}
</div>
<link rel="stylesheet" href="{{ URL::asset('css/bootstrap-switch.min.css')}}">

</script>
@stop
