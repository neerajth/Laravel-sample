@extends('layouts.user')

@section('main')

<div class="create-client">
	<section class="content">
        <div class="main">
            <div class="content-top">
                <div class="title-page left">
                    <h2>Change Password</h2>
                    <div class="breadcrumb">
                        <a href="{{{ URL::to('/dashboard') }}}" class="home"><img src="{{ URL::asset('assets/images/home-icon.png') }}" alt=""/></a>
                        <a href="{{{ URL::to('/dashboard') }}}">Dashboard</a>
                        <span>></span>
                        <a href="{{{ URL::to('/contractors') }}}/{{{ $contractor[0]->id }}}">{{{ $contractor[0]->firstname." ".$contractor[0]->lastname }}}</a>
                        <span>></span>
                        <span>Change Password</span>
                    </div>
                </div><!--title-page-->
            </div><!--top-content-->
            
            <div class="content-body">
                
                <article class="shadow account">
                	  @if ($errors->any())
							<div class="row">
								
								{{ implode('', $errors->all('<div data-alert="" class="alert-box error">:message<a href="#" class="close">'.HTML::image("assets/images/close-icon.png", "close").'</a></div>')) }}
							</div>
						  @endif
						  @if (Session::get('global'))
								<div class="row">
									<div data-alert="" class="alert-box error">{{ Session::get('global') }}<a href="#" class="close">{{ HTML::image("assets/images/close-icon.png", "close") }}</a></div>
								</div>
						  @endif
						  
                    {{ Form::open(array('route' => 'contractors.storepassword','files' => true)) }}
                        <div class="row">
                                <label>Old Password *</label>
                                {{ Form::password('old_password') }}
                        </div><!--row-->
                        
                        <div class="row">
                                <label>New Password *</label>
                                {{ Form::password('new_password') }}
                        </div><!--row-->
                        <div class="row">
						        <label>Confirm New Password *</label>
                                {{ Form::password('confirm_password') }}
                        </div><!--row-->
						<div class="row">
							<a href="{{{URL::to('/contractors/'.$contractor[0]->id)}}}" class="btn red right">Cancel</a>
						{{ Form::submit('Update', array('class' => 'btn orange right')) }}
						</div><!--row-->
                    {{ Form::close() }}
                    
                </article>
            </div>
        </div><!--main-->
    </section><!--content-->
</div>
@stop
