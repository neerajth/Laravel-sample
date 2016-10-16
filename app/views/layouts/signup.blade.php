<!doctype html>
<html>
	<head>
	<link rel="shortcut icon" type="image/x-icon" href="{{ URL::to('assets/img/favicon.png') }}" />

		
		<meta charset="utf-8">
		<!--link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css" rel="stylesheet"-->
		<link rel="stylesheet" href="{{ URL::asset('assets/css/normalize.min.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('assets/css/foundation.min.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('assets/css/site.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('assets/css/elements.min.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('assets/css/foundation-datepicker.css') }}">
		<title>EZ Estimate {{ Route::currentRouteName(); }}</title>
		<!-- new theme -->
		<link rel="stylesheet" href="{{ URL::asset('assets/css/style.css') }}">
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"> </script>
		{{ HTML::script('assets/js/jquery-1.11.0.min.js') }}
		{{ HTML::script('assets/js/jquery.uniform.min.js') }}
		{{ HTML::script('assets/js/script.js') }}
		
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
		
			
		<!--div class="container"-->
			@if (Session::has('message'))
				<div class="flash alert">
					<p>{{ Session::get('message') }}</p>
				</div>
			@endif

			@yield('main')
	</div>				
		<!-- jsDelivr CDN -->
		
		{{ HTML::script('assets/js/vendor/modernizr.js') }}
		{{ HTML::script('assets/js/foundation.min.js') }}
		{{ HTML::script('assets/js/wireframe.js') }}
		{{ HTML::script('assets/js/foundation-datepicker.js') }}
		
		<script>
			$(document).foundation();
		</script>
		
	</body>

</html>