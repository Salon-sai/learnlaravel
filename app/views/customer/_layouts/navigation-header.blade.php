<div id="navbar" class="navbar-collapse collapse">
	<ul class="nav navbar-nav navbar-right">
		<li><a href="#">Settings</a></li>
		<li class="{{Request::is('u/r/*')? 'active' : null}}">
			<a href="{{URL::route('u.r.index')}}">Restaurant</a>
		</li>
		<li class="{{Request::is('u/order/*')? 'active' : null}}">
			<a href="{{URL::route('u.order.index')}}">Order</a>
		</li>
		<ul class="dropdown-menu" role="menu">
			<li class="{{Request::is('u/contact/index')}}">
				<a href="{{URL::route('u.contact.index')}}">Index</a>
			</li>
			<li>
				<a href="{{URL::route('u.contact.create')}}">Create new Create</a>
			</li>
		</ul>
	</ul>
	<form class="navbar-form navbar-right">
		<input class="form-control" placeholder="Search..." type="text">
	</form>
</div>