@extends('layouts.signup')
@section('main')
<div class="create-client">
	<section class="content">
		<div class="main">
			<div class="content-body">
				<article class="shadow account">
					<div class="row text">
						<h2>Sign Up</h2>					
					</div>
					@if ($errors->any())
					<div class="row" id="notifications">					
						{{ implode('', $errors->all('<div data-alert="" class="alert-box error">:message<a href="#" class="close">'.HTML::image("assets/images/close-icon.png", "close").'</a></div>')) }}
					</div>
					@endif
					{{ Form::open(array('route' => 'contractors.store','files' => true)) }}
						<div class="row">
							<div class="left">
								<label>First Name *</label>
									{{ Form::text('firstname') }}
							</div>
							<div class="right">
								<label>Last Name *</label>
									{{ Form::text('lastname') }}
							</div>
						</div>
						<div class="row">
							<div class="left">
								<label>Email Address *</label>
									{{ Form::text('email') }}
							</div>
							<div class="right">
								<label>Phone</label>
								{{ Form::text('phone') }}
							</div>
							
						</div>
						<div class="row">
						<div class="left">
								<label>Company Name *</label>
									{{ Form::text('businessname') }}
							</div>
							<div class="right">
								<label>Company Logo</label>
								{{ Form::file('file') }}
							</div>
						</div>
						<div class="row">
							<div class="left">
								<label>Password *</label>
								{{ Form::password('password') }}
							</div>
							<div class="right">
								<label>Confirm Password *</label>
								{{ Form::password('password_confirmation') }}
							</div>
						</div>
						<div class="row">
							<div class="left">
								<label>Address 1 *</label>
									{{ Form::text('street1') }}
							</div>
							<div class="right">
								<label>Address 2</label>
									{{ Form::text('street2') }}
							</div>
						</div>
						<div class="row">
							<div class="left">
								<label>City *</label>
								{{ Form::text('city') }}
							</div>
							<div class="right">
								<label>State *</label>
								{{ Form::select('state', $state , Input::old('task_unit'), array('id'=>'state')) }}	
							</div>
								
						</div>
						<div class="row">
							<div class="left">
									<label>Zip *</label>
									{{ Form::text('zip') }}
								</div>
							<div class="right">
								<label>Fax</label>
								{{ Form::text('fax') }}
							</div>
						</div>
						
						<div class="row text">
							<input id="agreement" type="checkbox" />
							<p>By checking this box you agree to our <a target="_blank" href="{{{ URL::to('/agreement') }}}">terms of agreement</a>.</p>	
						</div>
						<div class="row">
							{{ Form::submit('Sign Up', array('class' => 'btn green right','onclick'=>'if( $("#agreement").is(":checked") ) { return true; } else { alert("Please read and agree to our terms of agreement."); return false; }')) }}
						</div>
					{{ Form::close() }}
				</article>			
			</div>
		</div>	
	</section>
</div>
<style>
.row #uniform-agreement.checker{width:auto;}
</style>
@stop


