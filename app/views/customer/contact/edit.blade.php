@extends('customer._layouts.default')

@section('main')

<div class="jumbotron text-center">
	<h1>Edit Contact</h1>
</div>
<div class="row">
	<div class="alert alert-error">
		{{ implode("<br>", $errors->all())}}
	</div>
	{{Form::open(array(
		'url' 	=> URL::route('u.contact.update',$id),
		'method'=> 'put',
		'role'	=> 'form',
		'class'	=> 'form-horizontal'
	))}}
		<label class="col-sm-2 control-label">Address</label>
		<div class="col-sm-10">
			{{Form::text('address',$address, array(
				'class'			=> 'form-control',
				'placeholder'	=> 'Address',
				'init'			=> $address
			))}}
		</div>
		<label class="col-sm-2 control-label">Telephone</label>
		<div class="col-sm-10">
			{{Form::text('telephone',$telephone, array(
				'class'			=> 'form-control',
				'placeholder'	=> 'Telephone',
				'init'			=> $telephone
			))}}
		</div>
		<div class="form-actions text-center">
			{{Form::submit('Update Contact', array(
				'id'		=> 'update',
				'class'		=> 'btn btn-lg btn-info',
			))}}
		</div>
	{{Form::close()}}
</div>
<script type="text/javascript">
	// $(':text').on('change', function(){
	// 	if($(this).val() == $(this).attr('init'))

	// })
</script>
@stop