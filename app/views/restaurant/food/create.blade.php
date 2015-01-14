@extends('restaurant._layouts.default')

@section('main')

<h1 class="page-header">Create New Food</h1>

@if ($errors->any())
	<div class="alert alert-error">
		{{ implode('<br>', $errors->all()) }}
	</div>
@endif

<div class="container">
	{{ Form::open(array(
		'url'	=> URL::route('r.food.store'),
		'class' => 'form-horizontal',
		'role'	=> 'form',
		'method'=> 'POST'
	))}}
		<div class="form-group form-group-lg">
			<label class="col-sm-2 control-label">Food Name</label>
			<div class="col-sm-10">
				{{Form::text('name',null, array(
					'class'			=> 'form-control',
					'placeholder'	=> 'Food Name'
				))}}
			</div>
		</div>
		<div class="form-group form-group-lg">
			<label class="col-sm-2 control-label">Price</label>
			<div class="col-sm-10">
				{{Form::text('price',null, array(
					'class'			=> 'form-control',
					'placeholder'	=> 'Price'
				))}}
			</div>
		</div>
		<div class="form-group form-group-lg">
			<label class="col-sm-2 control-label">Store</label>
			<div class="col-sm-10">
				{{Form::text('store', null, array(
					'class'			=> 'form-control',
					'placeholder'	=> 'Store'
				))}}
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Description</label>
			<div class="col-sm-10">
				{{Form::textarea('description',null, array(
					'rows'			=> '5',
					'class'			=> 'form-control',
					'placeholder'	=> 'Description'
				))}}
			</div>
		</div>
		<div class="form-group form-group-lg">
			<label class="col-sm-2 control-label">Food Picture</label>
			<div class="col-sm-10">
				{{Form::file('picture')}}
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Status</label>
			<div class="col-sm-10">
				<div class="switch">
					<input data-on-color="success"  data-on-text="UP" data-off-text="DOWN" type="checkbox" name="status" checked />
				</div>
			</div>
		</div>
		<div class="form-group form-group-lg">
			<label class="col-sm-2 control-label">Categories</label>
			<div class="checkbox col-sm-10">
				@foreach($categories as $category)
					<label class="checkbox-inline">
						<input type="checkbox" name="categoriesId[]" value="{{$category->id}}"/>{{$category->name}}
					</label>
				@endforeach
			</div>
		</div>
		<div class="form-actions text-center">
			{{Form::submit('Create New Food', array(
				'class'		=> 'btn btn-lg btn-primary',
			))}}
		</div>
	{{Form::close()}}
</div>
<script type="text/javascript">
	$("[name='status']").bootstrapSwitch();
</script>
@stop