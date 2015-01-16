<div id="navbar" class="navbar-collapse collapse">
	<ul class="nav navbar-nav navbar-right">
		<li><a href="#">Settings</a></li>
		<li class="{{Request::is('')? 'active' : null}}">
			<a href="{{URL::route('u.r.index')}}">Restaurant</a>
		</li>
		<li class="{{Request::is('logut') ? 'active' : null}}">
			<a href="{{URL::route('u.order.index')}}">Order</a>
		</li>
	</ul>
	<form class="navbar-form navbar-right">
		<input class="form-control" placeholder="Search..." type="text">
	</form>
</div>