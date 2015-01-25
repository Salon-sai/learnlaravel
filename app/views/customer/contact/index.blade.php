@extends('customer._layouts.default')

@section('main')

<div class="jumbotron text-center">
	<h1>Your Contacts</h1>
</div>

<div class='list-group'>
	<ul class="list-group text-primary">
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
			<a name="edit" href="{{URL::route('u.contact.edit',$default_contact->id)}}" class="btn btn-info">Edit</a>
			<button name="delete" class="btn btn-danger">Delete</button>
		</li>
	</ul>
	@foreach($contacts as $contact)
		<ul class="list-group">
			<li class="list-group-item">
				Address : {{$contact->address}}
			</li>
			<li class="list-group-item">
				Telephone : {{$contact->telephone}}
			</li>
			<li class="list-group-item">
				<a name="edit" href="{{URL::route('u.contact.edit',$contact->id)}}" class="btn btn-info">Edit</a>
				<button name="delete" class="btn btn-danger">Delete</button>
			</li>
		</ul>
	@endforeach
</div>
<nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
	<a class="btn btn-primary btn-lg btn-block" href="{{URL::route('u.contact.create')}}">Create new Contact</a>
</nav>
<script type="text/javascript">
	
</script>
@stop