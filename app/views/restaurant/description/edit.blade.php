@extends('restaurant._layouts.default')

@section('main')

<h1 class="page-header">Edit Restaurant Information</h1>

@if ($errors->any())
	<div class="alert alert-error">
		{{ implode('<br>', $errors->all()) }}
	</div>
@endif

<div class="container">
	{{ Form::open(array(
		'url'	=> URL::route('r.description.update', $restaurant->description->id),
		'class' => 'form-horizontal',
		'role'	=> 'form',
		'method'=> 'put'
	))}}
		<div class="form-group form-group-lg">
			<label class="col-sm-2 control-label">Restaurants Name</label>
			<div class="col-sm-10">
				{{Form::text('name',$restaurant->description->name, array(
					'class'			=> 'form-control',
					'placeholder'	=> 'Restaurant Name'
				))}}
			</div>
		</div>
		<div class="form-group form-group-lg">
			<label class="col-sm-2 control-label">Telephone</label>
			<div class="col-sm-10">
				{{Form::text('telephone',$restaurant->description->telephone, array(
					'class'			=> 'form-control',
					'placeholder'	=> 'Telephone'
				))}}
			</div>
		</div>
		<div class="form-group form-group-lg">
			<label class="col-sm-2 control-label">Service Scale</label>
			<div class="col-sm-10">
				{{Form::text('scale',$restaurant->description->scale, array(
					'class'			=> 'form-control',
					'placeholder'	=> 'Scale'
				))}}
			</div>
		</div>
		<div class="form-group form-group-lg">
			<label class="col-sm-2 control-label">Location</label>
			<div class="col-sm-10">
				{{Form::text('location_label',$restaurant->description->location_label, array(
					'class'			=> 'form-control',
					'placeholder'	=> 'Location'
				))}}
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Description</label>
			<div class="col-sm-10">
				{{Form::textarea('description', $restaurant->description->description, array(
					'rows'			=> '5',
					'class'			=> 'form-control',
					'placeholder'	=> 'Description'
				))}}
			</div>
		</div>
		<div class="form-actions text-center">
			{{Form::submit('Update', array(
				'class'		=> 'btn btn-lg btn-info',
			))}}
			<a href="{{URL::route('r.advanced')}}" class="btn btn-link">Advanced Setting</a>
		</div>
	{{Form::close()}}
</div>
<script type="text/javascript">
	$("[name='status']").bootstrapSwitch();

	$("[name='status']").on('switch-change', function(e, data){
			    var $el = $(data.el)
  				, value = data.value;
				console.log(e, $el, value);
	});
	
</script>
@stop
