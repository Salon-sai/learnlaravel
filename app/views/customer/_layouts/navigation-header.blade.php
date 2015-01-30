<div id="navbar" class="navbar-collapse collapse">
	<ul class="nav navbar-nav navbar-right">
		<li><a href="#">Settings</a></li>
		<li class="{{Request::is('u/r/*')? 'active' : null}}">
			<a href="{{URL::route('u.r.index')}}">Restaurant</a>
		</li>
		<li class="{{Request::is('u/order/*')? 'active' : null}}">
			<a href="{{URL::route('u.order.index')}}">Order</a>
		</li>
		<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
				Contact
				<span class='caret'></span>
			</a>
			<ul class="dropdown-menu" role="menu">
				<li class="{{Request::is('u/contact/index')}}">
					<a href="{{URL::route('u.contact.index')}}">Index</a>
				</li>
				<li>
					<a href="{{URL::route('u.contact.create')}}">Create new Create</a>
				</li>
			</ul>
		</li>
		<li>
			{{Form::open(
				'url'	=> '/u/restaurant/locationIndex',
				'method'=> 'get'
			)}}
				<input type="hidden" id="locationX" name="locationX" >
				<input type="hidden" id="locationY" name="locationY">
				<input type="submit" id="getLocation" class="btn-link">
			{{Form::close()}}
		</li>
	</ul>
	<form class="navbar-form navbar-right">
		<input class="form-control" placeholder="Search..." type="text">
	</form>
</div>