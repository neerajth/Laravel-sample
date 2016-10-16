@extends('layouts.user')

@section('main')

<div class="create-client">
	<?php $result = DB::select('select * from states'); ?>
	<section class="content">
        <div class="main">
            <div class="content-top">
                <div class="title-page left">
                    <h2>Edit Profile</h2>
                    <div class="breadcrumb">
                        <a href="{{{ URL::to('/dashboard') }}}" class="home"><img src="{{ URL::asset('assets/images/home-icon.png') }}" alt=""/></a>
                        <a href="{{{ URL::to('/dashboard') }}}">Dashboard</a>
                        <span>></span>
                        <a href="{{{ URL::to('/contractors') }}}/{{{ $contractor->id }}}">{{{ $contractor->firstname." ".$contractor->lastname }}}</a>
                        <span>></span>
                        <span>Edit Profile</span>
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
						  @if (Session::get('success'))
								<div class="row">
									<div data-alert="" class="alert-box error">{{ Session::get('success') }}<a href="#" class="close">{{ HTML::image("assets/images/close-icon.png", "close") }}</a></div>
								</div>
						  @endif
						  
                    {{ Form::model($contractor, array('method' => 'PATCH', 'route' => array('contractors.update', $contractor->id),'files' => true)) }}
                        <div class="row">
                            <div class="left">
                                <label>First Name *</label>
                                {{ Form::text('firstname') }}
                            </div>
                            <div class="right">
                                <label>Last Name *</label>
                                {{ Form::text('lastname') }}
                            </div>
                        </div><!--row-->
                        
                        <div class="row">
                            <div class="left">
                                <label>Email Address *</label>
                                {{ Form::text('email') }}
                            </div>
							<div class="right">
                                <label>Phone Number</label>
								{{ Form::text('phone') }}
							</div>
                           
                        </div><!--row-->
                        <div class="row">
							 <div class="left">
                                <label>Company Name *</label>
                                {{ Form::text('businessname') }}
                            </div>
							<div class="right">
								{{ Form::hidden('logoold',$contractor->logo) }}
                                <label>Company Logo</label>
								{{ Form::file('logo') }}
							</div>
                        </div><!--row-->
                        <div class="row">
                            <div class="left">
                                <label>Address 1 *</label>
                                {{ Form::text('street1') }}
                            </div>
                            <div class="right">
                                <label>Address 2</label>
                                {{ Form::text('street2') }}
                            </div>
                        </div><!--row-->
                        
                        <div class="row">
                            <div class="left">
                                <label>City *</label>
                                {{ Form::text('city') }}
                            </div>
                            <div class="right">
								<label>State *</label>
								{{ Form::select('state', $state ,$contractor->state ) }}
							</div>
                        </div><!--row-->
						<div class="row">
							<div class="left">
									<label>Zip Code *</label>
									{{ Form::text('zip') }}
								</div>	
                            <div class="right">
                                <label>Fax</label>
                                {{ Form::text('fax') }}
                            </div>
						</div><!--row-->
						
                        <div class="row">
							<a href="{{{URL::to('/contractors/'.$contractor->id)}}}" class="btn red right">Cancel</a>
                           {{ Form::submit('Update', array('class' => 'btn orange right')) }}
                        </div><!--row-->
                    {{ Form::close() }}
                    
                </article>
            </div>
        </div><!--main-->
    </section><!--content-->
</div>
@stop
