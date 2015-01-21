<div id="navbar" class="navbar-collapse collapse">
	<ul class="nav navbar-nav navbar-right">
		<li><a href="#">Settings</a></li>
		<li class="{{Request::is('u/r/*')? 'active' : null}}">
			<a href="{{URL::route('u.r.index')}}">Restaurant</a>
		</li>
		<li class="{{Request::is('u/order/*')? 'active' : null}}">
			<a href="{{URL::route('u.order.index')}}">Order</a>
		</li>
		<li class="{{Request::is('u/contact/*')}}">
			<a href="{{URL::route('u.contact.index')}}">Contact</a>
		</li>
	</ul>
	<form class="navbar-form navbar-right">
		<input class="form-control" placeholder="Search..." type="text">
	</form>
</div>