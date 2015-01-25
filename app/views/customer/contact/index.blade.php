@extends('customer._layouts.default')

@section('main')

<div class="jumbotron text-center">
	<h1>Your Contacts</h1>
</div>
{{Notification::showAll()}}
<div class='list-group'>
	<ul class="list-group text-primary" contact-id="{{$default_contact->id}}">
		<li class="list-group-item">
			Default
		</li>
		<li class="list-group-item">
			Address : {{$default_contact->address}}
		</li>
		<li class="list-group-item">
			Telephone : {{$default_contact->telephone}}
		</li>
		<li class="list-group-item">
				{{Form::open(array(
					'url'	=> URL::route('u.contact.edit',$default_contact->id),
					'method'=> 'GET',
					'style' => 'float: left;margin-right: 3px'
				))}}
					<input name="address" type="hidden" value="{{$default_contact->address}}">
					<input name="telephone" type="hidden" value="{{$default_contact->telephone}}">
					<input type="submit" class="btn btn-info" value="Edit" />
				{{Form::close()}}
			<button name="delete" class="btn btn-danger">Delete</button>
		</li>
	</ul>
	@foreach($contacts as $contact)
		<ul class="list-group" contact-id="{{$contact->id}}">
			<li class="list-group-item">
				Address : {{$contact->address}}
			</li>
			<li class="list-group-item">
				Telephone : {{$contact->telephone}}
			</li>
			<li class="list-group-item">
				{{Form::open(array(
					'url'	=> URL::route('u.contact.edit',$contact->id),
					'method'=> 'GET',
					'style' => 'float: left;margin-right: 3px'
				))}}
					<input name="address" type="hidden" value="{{$contact->address}}">
					<input name="telephone" type="hidden" value="{{$contact->telephone}}">
					<input type="submit" class="btn btn-info" value="Edit" />
				{{Form::close()}}
				<button name="delete" class="btn btn-danger" onclick="deleteContact('{{$contact->id}}')">Delete</button>
				<button class="btn btn-success">Set Default</button>
			</li>
		</ul>
	@endforeach
</div>
<nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
	<a class="btn btn-primary btn-lg btn-block" href="{{URL::route('u.contact.create')}}">Create new Contact</a>
</nav>
<script type="text/javascript">
	function deleteContact(contactId){
		$.ajax({
			url : 'contact/'+contactId,
			type: 'DELETE',
			success: function(returnData){
				if(returnData.type == 'success')
					$("[contact-id='"+contactId+"']").remove();
			}
		});
	}
</script>
@stop