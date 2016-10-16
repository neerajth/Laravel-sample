@extends('layouts.signup')
@section('main')
<div class="elements">
	<section class="content">
		<div class="main">
      	<div class="content-body">
      		<article class="shadow login">
					<div class="row text">
						<h2>Forgot Password</h2>					
					</div>
					@if ($errors->any())
					<div class="row" id="notifications">					
						{{ implode('', $errors->all('<div data-alert="" class="alert-box error">:message<a href="#" class="close">'.HTML::image("assets/images/close-icon.png", "close").'</a></div>')) }}
					</div>
					@endif
					@if (Session::get('global'))
						<div class="row">
						<div data-alert="" class="alert-box success">{{ Session::get('global') }}<a href="#" class="close">{{ HTML::image("assets/images/close-icon.png", "close") }}</a></div>
						</div>
					@endif
					<form action="{{ URL::route('forgot-password-post') }}" method="post">
					<div class="row">
						<div class="">
							<label>Email</label>							
							{{ Form::text('email', Input::old('email'), array('placeholder' => 'Email')) }}
						</div>
					</div>
					<div class="row">
						<div class="">
						{{ Form::submit('Recover', array('class' => 'btn green')) }}
						{{ Form::token() }}
						</div>
					</div>
					</form> 		
      		</article>
      	</div>
		</div>
	</section>        
</div>
@stop		
