<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="mobile-only-brand pull-left">
		<div class="nav-header pull-left">
			<div class="logo-wrap">
				<a href="{{ route('home.index') }}">
					<img class="brand-img" src="{{ asset('img/logo.png') }}" alt="brand"/>
				</a>
			</div>
		</div> 
		<a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
		<a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a>
	</div>
	<div id="mobile_only_nav" class="mobile-only-nav pull-right">
		<ul class="nav navbar-right top-nav pull-right">
			<li class="dropdown auth-drp">
				
				<a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown"><span class="user-auth-name inline-block">Boveda / {{app('auth')->user()->name}}</span></a>
			</li>
		</ul>
	</div> 
</nav>