@if(Sentry::getUser())
	@if(Sentry::check() && Sentry::getUser()->hasAccess('restaurant'))
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#">Settings</a></li>
				<li><a href="{{URL::route('r.description.edit',Sentry::getUser()->id)}}">Profile</a></li>
				<li><a href="{{URL::route('logout')}}">Logout</a></li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						Order
						<span class='caret'></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						<li class="{{Request::is('r/order') ? 'active' : null}}"><a href="{{URL::route('r.order.index')}}">Order List</a></li>
						<li class="{{Request::is('r/order/find/check') ? 'active' : null}}">
							<a href="{{URL::route('r.order.find','check')}}">Check The Orders</a>
						</li>
						<li class="{{Request::is('r/order/find/deliver') ? 'active' : null}}">
							<a href="{{URL::route('r.order.find', 'deliver')}}">Delivering The Orders</a>
						</li>
						<li class="{{Request::is('r/order/find/finished') ? 'active' : null}}">
							<a href="{{URL::route('r.order.find', 'finished')}}">Finshed The Orders</a>
						</li>
						<li class="{{Request::is('r/order/find/refuse') ? 'active' : null}}">
							<a href="{{URL::route('r.order.find','refuse')}}">Refuse The Orders</a>
						</li>
					</ul>
				</li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						Food
						<span class='caret'></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						<li class="{{Request::is('r/food') ? 'active' : null}}"><a href="{{URL::route('r.food.index')}}">Foods List</a></li>
						<li class="{{Request::is('*/edit') ? 'active' : null}}"><a href="{{URL::route('r.food.index')}}">Foods Edit</a></li>
						<li class="{{Request::is('r/food/create') ? 'active' : null}}"><a href="{{URL::route('r.food.create')}}">Create</a></li>
					</ul>
				</li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						Category
						<span class='caret'></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						<li class="{{Request::is('r/category/') ? 'active' : null}}"><a href="{{URL::route('r.category.index')}}">Categories List</a></li>
					</ul>
				</li>
				<li>
					<form class="navbar-form navbar-left">
						@if(Sentry::getUser()->description)
							@if(Sentry::getUser()->description->status)
								<input data-on-color="primary" data-off-color="danger" data-on-text="Open" data-off-text="Close" type="checkbox" name="restaurant_status" checked />
							@else
								<input data-on-color="primary" data-off-color="danger" data-on-text="Open" data-off-text="Close" type="checkbox" name="restaurant_status" />
							@endif
						@endif
					</form>
				</li>
			</ul>
			<form class="navbar-form navbar-right">
				<input class="form-control" placeholder="Search..." type="text">
			</form>
		</div>
	@endif
@endif