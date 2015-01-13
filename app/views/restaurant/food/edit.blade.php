@extends('restaurant._layouts.default')

@section('main')

<h1 class="page-header">Edit Food</h1>

@if ($errors->any())
	<div class="alert alert-error">
		{{ implode('<br>', $errors->all()) }}
	</div>
@endif

<div class="container">
	{{ Form::open(array(
		'url'	=> URL::route('r.food.update', $food->id),
		'class' => 'form-horizontal',
		'role'	=> 'form',
		'method'=> 'put'
	))}}
		<div class="form-group form-group-lg">
			<label class="col-sm-2 control-label">Food Name</label>
			<div class="col-sm-10">
				{{Form::text('name',$food->name, array(
					'class'			=> 'form-control',
					'placeholder'	=> 'Food Name'
				))}}
			</div>
		</div>
		<div class="form-group form-group-lg">
			<label class="col-sm-2 control-label">Price</label>
			<div class="col-sm-10">
				{{Form::text('price',$food->price, array(
					'class'			=> 'form-control',
					'placeholder'	=> 'Price'
				))}}
			</div>
		</div>
		<div class="form-group form-group-lg">
			<label class="col-sm-2 control-label">Store</label>
			<div class="col-sm-10">
				{{Form::text('store',$food->store, array(
					'class'			=> 'form-control',
					'placeholder'	=> 'Store'
				))}}
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Description</label>
			<div class="col-sm-10">
				{{Form::textarea('description', $food->description, array(
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
				@if($food->status)
					<label>
					<input type="radio" name="status" value="Grounding" checked />Grounding
					</label>
					<label>
					<input type="radio" name="status" value="undercarriage"/>undercarriage
					</label>
				@else
					<label>
					<input type="radio" name="status" value="Grounding" />Grounding
					</label>
					<label>
					<input type="radio" name="status" value="undercarriage" checked/>undercarriage
					</label>
				@endif
			</div>
		</div>
		<div class="form-group form-group-lg">
			<label class="col-sm-2 control-label">Categories</label>
			<div class="checkbox col-sm-10">
				@foreach($categories as $category)
					<label class="checkbox-inline">
						@if(true)
							<input type="checkbox" name="categoriesId[]" value="{{$category->id}}"/>{{$category->name}}
						@endif
					</label>
				@endforeach
			</div>
		</div>
		<div class="form-actions text-center">
			{{Form::submit('Update Food', array(
				'class'		=> 'btn btn-lg btn-info',
			))}}
		</div>
	{{Form::close()}}
</div>
<link rel="stylesheet" href="{{URL::asset('css/bootstrap-switch.min.css')}}">
<script type="text/javascript" src="{{URL::asset('js/bootstrap-switch.min.js')}}"></script>
<script type="text/javascript">
	
</script>
@stop