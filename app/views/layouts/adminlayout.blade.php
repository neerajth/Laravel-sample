<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<!--link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css" rel="stylesheet"-->
		<link rel="stylesheet" href="{{ URL::asset('assets/css/normalize.min.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('assets/css/foundation.min.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('assets/css/site.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('assets/css/elements.min.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('assets/css/foundation-datepicker.css') }}">
		<link rel="shortcut icon" type="image/x-icon" href="{{ URL::to('assets/img/favicon.png') }}" />
		<title>EZ Estimate {{ Route::currentRouteName(); }}</title>
		<!-- new theme -->
		<link rel="stylesheet" href="{{ URL::asset('assets/css/style.css') }}">
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"> </script>
		{{ HTML::script('assets/js/jquery-1.11.0.min.js') }}
		{{ HTML::script('assets/js/jquery.uniform.min.js') }}
		{{ HTML::script('assets/js/script.js') }}
		
		<script>
			$(function () {
    			setNavigation();
			});
			function setNavigation() {
			
   		//var path = window.location.pathname;
		var path = document.URL;
   		path = path.replace(/\/$/, "");
    		path = decodeURIComponent(path);
	    	$(".nav a.topMenu").each(function () {
        		var href = $(this).attr('href');
				
        		//if (path.substring(0, href.length) === href) {
				if (path == href) {
         	   $(this).closest('li').addClass('active');
        		}
    		});
		}		
		</script>
		<!--[if IE]>
        <script>
            document.createElement('header');
            document.createElement('section');
            document.createElement('footer');
            document.createElement('nav');
            document.createElement('article');
            document.createElement('aside');
        </script>
		<![endif]-->
	</head>
	<body>
		<div id="wrap">
			<header style="display: inline-table; width: 100%;">
				<?php 
				$logo= Contractor::where('id',Auth::id())->get();
				$ext = pathinfo($logo[0]->logo, PATHINFO_EXTENSION);
				?>
				<div class="main">
					@if($logo[0]->logo != "")
					<a href="{{{ URL::to('/admin') }}}" class="logo"><img src="{{ URL::asset('uploads/logo/'.Auth::id().'.'.$ext) }}" alt="" height="80"/></a>
					@else
					<a href="{{{ URL::to('/admin') }}}" class="logo"><img src="{{ URL::asset('assets/images/logo.png') }}" alt=""/></a>
					@endif
					<nav style="height:auto;" class="top-bar" data-topbar>
						<section class="top-bar-section">
							<ul class="right nav">
								<li><a href="{{{ URL::to('/admin') }}}" class="dashboard topMenu">Dashboard</a></li>
								<li><a href="{{{ URL::to('/contractors/create') }}}" class="create-client topMenu">Create Contractor</a></li>
								<li><a href="{{{ URL::to('/contractors') }}}" class="view-clients topMenu">View Contractors</a></li>
								<li class="has-dropdown"><a href="#" class="account topMenu">Account</a>
									<ul class="dropdown">
										<li class="has-dropdown">
											<a href="#">Defaults</a>
											<ul class="dropdown">
												<li class="has-dropdown">
													<a href="{{{ URL::to('/projecttypes') }}}">Project Types</a>
													<ul class="dropdown">
														<li><a href="{{{ URL::to('/projecttypes') }}}">View Project Types</a></li>
														<li><a href="{{{ URL::to('/projecttypes/create') }}}">Create Project Types</a></li>
													</ul>
												</li>
											</ul>
										</li>
										<li><a href="{{{ URL::to('/logout') }}}">Logout</a></li>
									</ul>
								</li>
							</ul>
						</section>	
					</nav>
					<span class="menu-click">
						<em></em>
						<em></em>
						<em></em>
					</span>
				</div><!--main-->
			</header>	
			<!--div class="container"-->
			@if (Session::has('message'))
				<div class="flash alert">
					<p>{{ Session::get('message') }}</p>
				</div>
			@endif

			@yield('main')
			
			
			<footer>
				<div class="main">
					<nav>
						<ul>
							<li><a class="color_white" href="{{{ URL::to('/admin') }}}">Dashboard</a></li>
						</ul>
					</nav>
					<p class="copy">
						Copyright &copy; 2014
					</p>
				</div><!--main-->
			</footer>
		</div>
		<!-- jsDelivr CDN -->
	</body>
	{{ HTML::script('assets/js/vendor/modernizr.js') }}
	{{ HTML::script('assets/js/foundation.min.js') }}
	{{ HTML::script('assets/js/wireframe.js') }}
	{{ HTML::script('assets/js/foundation-datepicker.js') }}
		
	<script>
		$(document).foundation();
	</script>
	<style>
	header .logo img {
		width: auto;
		height: 75px;
	}
	</style>		
</html>
