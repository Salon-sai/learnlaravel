@if(Sentry::getUser())
	@if(Sentry::check() && Sentry::getUser()->hasAccess('manager'))
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#">Settings</a></li>
				<li class="{{Request::is('admin/profile') ? 'active' : null}}"><a href="{{URL::route('admin.profile.edit',Sentry::getUser()->id)}}">Profile</a></li>
				<li class="{{Request::is('logout') ? 'active' : null}}"><a href="{{URL::route('logout')}}">Logout</a></li>
			</ul>
			<form class="navbar-form navbar-right">
				<input class="form-control" placeholder="Search..." type="text">
			</form>
		</div>
	@endif
@endif