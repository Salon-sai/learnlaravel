@if(Sentry::getUser())
	@if(Sentry::check() && Sentry::getUser()->hasAccess('restaurant'))
		<div class="col-sm-3 col-md-2 sidebar">
			<ul class="nav nav-sidebar">
				<li class="{{Request::is('r/order') ? 'active' : null}}"><a href="{{URL::route('r.order.index')}}">Order List</a></li>
				<li class="{{Request::is('r/order/check') ? 'active' : null}}"><a href="{{URL::route('r.order.check')}}">Check The Orders</a></li>
				<li class="{{Request::is('r/order/finshed') ? 'active' : null}}"><a href="{{URL::route('r.order.finshed')}}">Finshed Orders</a></li>
			</ul>
			<ul class="nav nav-sidebar">
				<li class="{{Request::is('r/food') ? 'active' : null}}"><a href="{{URL::route('r.food.index')}}">Foods List</a></li>
				<li class="{{Request::is('*/edit') ? 'active' : null}}"><a href="{{URL::route('r.food.index')}}">Foods Edit</a></li>
				<li class="{{Request::is('r/food/create') ? 'active' : null}}"><a href="{{URL::route('r.food.create')}}">Create</a></li>
			</ul>
			<ul class="nav nav-sidebar">
				<li class="{{Request::is('r/category/') ? 'active' : null}}"><a href="{{URL::route('r.category.index')}}">Categories List</a></li>
			</ul>
		</div>
	@endif
@endif