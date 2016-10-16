@extends('layouts.signup')
<header>
	<img src="{{ URL::asset('assets/images/logo.png') }}" alt="logo" style="padding: 1%; width:auto;" />
</header>
@section('main')
<div class="elements">
	<section class="content">
		<div class="main">
      	<div class="content-body">
      		<article class="shadow login">
					<div class="row text">
						<h2>Login</h2>					
					</div>
					@if ($errors->any())
					<div class="row" id="notifications">					
						{{ implode('', $errors->all('<div data-alert="" class="alert-box error">:message<a href="#" class="close">'.HTML::image("assets/images/close-icon.png", "close").'</a></div>')) }}
					</div>
					@endif
					@if (Session::get('global'))
						<div class="row">
						<div data-alert="" class="alert-box error">{{ Session::get('global') }}<a href="#" class="close">{{ HTML::image("assets/images/close-icon.png", "close") }}</a></div>
						</div>
					@endif
					
					{{ Form::open(array('url' => 'login')) }}
					<div class="row">
						<div class="">
							<label>Email</label>
							{{ Form::text('email', Input::old('email'), array('placeholder' => 'Email')) }}
						</div>
					</div>
					<div class="row">
						<div class="">
							<label>Password</label>
							{{ Form::password('password', array('placeholder' => 'Password')) }}
						</div>
					</div>
					<div class="row">
						<div class="">
						{{ Form::submit('Login', array('class' => 'btn green')) }}
						</div>
					</div>
					{{ Form::close() }}
					<div class="row text">
							<p>
							<a href="{{ URL::route('forgot-password') }}">Forgot Password</a>
							| {{ link_to('register', "Sign Up"); }} 
							</p>
					</div>   		
      		</article>
      	</div>
		</div>
	</section>        
</div>
@stop		
