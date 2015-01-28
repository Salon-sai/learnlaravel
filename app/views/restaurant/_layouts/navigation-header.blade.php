@if(Sentry::getUser())
	@if(Sentry::check() && Sentry::getUser()->hasAccess('restaurant'))
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#">Settings</a></li>
				<li><a href="{{URL::route('r.description.edit',Sentry::getUser()->id)}}">Profile</a></li>
				<li><a href="{{URL::route('logout')}}">Logout</a></li>
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