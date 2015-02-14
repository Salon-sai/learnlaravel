@if(Sentry::getUser())
	@if(Sentry::check() && Sentry::getUser()->hasAccess('manager'))
		<div class="col-sm-3 col-md-2 sidebar">
			<ul class="nav nav-sidebar">
				<li class="{{Request::is('admin/restaurant') ? 'active' : null}}">	<a href="{{URL::route('admin.restaurant.index')}}">Restaurant</a>
				</li>
				<li class="{{Request::is('admin/restaurant/findapplication') ? 'active' : null}}">
					<a href="{{URL::route('admin.r.findapplication')}}">Check The Application</a>
				</li>
			</ul>
<!-- 			<ul class="nav nav-sidebar">
				<li><a href="">Nav item</a></li>
				<li><a href="">Nav item again</a></li>
				<li><a href="">One more nav</a></li>
				<li><a href="">Another nav item</a></li>
				<li><a href="">More navigation</a></li>
			</ul>
			<ul class="nav nav-sidebar">
				<li><a href="">Nav item again</a></li>
				<li><a href="">One more nav</a></li>
				<li><a href="">Another nav item</a></li>
			</ul> -->
		</div>
	@endif
@endif