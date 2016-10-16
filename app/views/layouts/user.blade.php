<!doctype html>
<html>
	<head>
		<link rel="shortcut icon" type="image/x-icon" href="{{ URL::to('assets/img/favicon.png') }}" />
		
		<meta charset="utf-8">
		<link rel="stylesheet" href="{{ URL::asset('assets/css/normalize.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('assets/css/foundation.min.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('assets/css/site.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('assets/css/elements.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('assets/css/style.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('assets/css/foundation-datepicker.css') }}">
		
		<link rel="stylesheet" href="{{ URL::asset('assets/js/datatable/jquery.dataTables.css') }}">
		<title>EZ Estimate {{ Route::currentRouteName(); }}</title>
		<!-- new theme -->
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"> </script>

		<!-- new theme -->
		{{ HTML::script('assets/js/jquery-1.11.0.min.js') }}
		{{ HTML::script('assets/js/datatable/jquery-1.10.2.min.js') }}
		{{ HTML::script('assets/js/jquery.uniform.min.js') }}
		{{ HTML::script('assets/js/datatable/jquery.dataTables.js') }}
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
 <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script> -->
{{ HTML::script('assets/jquery/bootstrap-multiselect.js') }}
{{ HTML::script('assets/jquery/bootstrap-3.js') }}
<link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap-multiselect.css') }}" type="text/css"/>
<link rel="stylesheet" href="{{ URL::asset('assets/jscss/bootstrap-3.css') }}" type="text/css"/>

<script type="text/javascript">
						$(document).ready(function() {
						$('#example-getting-started').multiselect();
						});
						</script> 
	</head>

	<body>
	<div id="wrap" class="">
		<header>
		<?php $logo= Contractor::where('id',Auth::id())->get();
				 $ext = pathinfo($logo[0]->logo, PATHINFO_EXTENSION);
		?>
        <div class="main">
		@if($logo[0]->logo != "")
            <a href="{{{ URL::to('/dashboard') }}}" class="logo" title="{{ Contractor::where('id',Auth::id())->Pluck('businessname') }}"><img src="{{ URL::asset('uploads/logo/'.Auth::id().'.'.$ext) }}" alt=""  height="80px"/></a>
		@else
		<a href="{{{ URL::to('/dashboard') }}}" class="logo" title="{{ Contractor::where('id',Auth::id())->Pluck('businessname') }}"><img src="{{ URL::asset('assets/images/logo.png') }}" alt=""/></a>
		@endif
            <nav style="height:auto;" class="top-bar" data-topbar>
						<section class="top-bar-section">
							<ul class="right nav">
							<li><a href="{{{ URL::to('/dashboard') }}}" class="dashboard topMenu">Dashboard</a></li>
                 			<li><a href="{{{ URL::to('/projects') }}}" class="view-projects topMenu">View projects</a></li>
                 			<li><a href="{{{ URL::to('/clients/create') }}}" class="create-client topMenu">Create client</a></li>
                 			<li><a href="{{{ URL::to('/clients') }}}" class="view-clients topMenu">View clients</a></li>
							<li class="has-dropdown"><a href="{{{ URL::to('contractors/'.Auth::id()) }}}" class="account">Account</a>
								<ul class="dropdown">
									<li><a href="{{{ URL::to('contractors/'.Auth::id()) }}}">Profile</a></li>
									<li class="has-dropdown">
										<a href="#">Defaults</a>
										<ul class="dropdown">
											<li class="has-dropdown">
											{{ link_to_route('jobtypes.index', 'Job Types') }}
												<ul class="dropdown">
													<li>{{ link_to_route('jobtypes.index', 'View') }}</li>
													<li>{{ link_to_route('jobtypes.create', 'Create') }}</li>
													
												</ul>
											</li>
											<li class="has-dropdown">
											{{ link_to_route('taskcategories.index', 'Task Categories') }}
												<ul class="dropdown"> 
													<li>{{ link_to_route('taskcategories.index', 'View') }}</li>
													<li>{{ link_to_route('taskcategories.create', 'Create') }}</li>
												</ul>
											</li>
											<li class="has-dropdown">
												{{ link_to_route('tasks.index', 'Tasks') }}
												<ul class="dropdown">
													<li>{{ link_to_route('tasks.index', 'View') }}</li>
													<li>{{ link_to_route('tasks.create', 'Create') }}</li>
												</ul>
											</li>
											<li class="has-dropdown">
												{{ link_to_route('units.index', 'Units') }}
												<ul class="dropdown">
													<li>{{ link_to_route('units.index', 'View') }}</li>
													<li>{{ link_to_route('units.create', 'Create') }}</li>
												</ul>	
											</li>
										</ul>
									</li>
									<li class="has-dropdown">
										<a href="#">Account Setting</a>
										<ul class="dropdown">
											<li>
											<a href="{{{ URL::to('/changepassword') }}}">Change Password</a>
											</li>
											<li>
											<a href="{{{ URL::to('/billingifo') }}}">Billing Info</a>
											</li>
										</ul>	
									</li>	
									<li><a href="{{{ URL::to('/logout') }}}">Logout</a></li>
									</ul>
								</li>

								<li><a href="{{{ URL::to('/projects/create') }}}" class="add-project topMenu">Add project</a></li>
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
			
			
			
	<div style="clear:both;">		</div>
	<footer>
        <div class="main">
            <nav>
                <ul>
                    <li><a class="color_white" href="{{{ URL::to('/dashboard') }}}">Dashboard</a></li>
                    <li><a class="color_white" href="{{{ URL::to('/projects') }}}">Projects</a></li>
                    <li><a class="color_white" href="{{{ URL::to('/clients') }}}">Clients</a></li>
                    <li><a class="color_white" target="_blank" href="{{{ URL::to('/agreement') }}}">Terms & Agreements</a></li>
                </ul>
            </nav>
            <p class="copy">
                Copyright &copy; 2014
            </p>
			
        </div><!--main-->
		<div style="width: 100%; display: inline-table; padding: 0px 20px;"><a href="{{{ URL::to('/dashboard') }}}" class="logo" title="{{ Contractor::where('id',Auth::id())->Pluck('businessname') }}"><img src="{{ URL::asset('assets/images/logo.png') }}" alt="" style="float: right;"/></a></div>
		
    </footer>
	</div>	
		<!-- jsDelivr CDN -->
		
		{{ HTML::script('assets/js/vendor/modernizr.js') }}
		{{ HTML::script('assets/js/foundation.min.js') }}
		{{ HTML::script('assets/js/wireframe.js') }}
		{{ HTML::script('assets/js/foundation-datepicker.js') }}
		
		<script>
		$(document).ready(function () {
			$(document).foundation();
			});
		</script>
<style>header .logo img, footer .logo img {
    width: auto;
    height: 75px;
	max-width: initial;
}</style>
	</body>

</html>
