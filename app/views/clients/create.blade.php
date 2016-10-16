@extends('layouts.user')
@section('main')
<div class="create-client">
	<?php $result = DB::select('select * from states'); ?>
	<section class="content">
        <div class="main">
            <div class="content-top">
                <div class="title-page left">
                    <h2>Create Client</h2>
                    <div class="breadcrumb">
                        <a href="{{{ URL::to('/dashboard') }}}" class="home"><img src="{{ URL::asset('assets/images/home-icon.png') }}" alt=""/></a>
                        <a href="{{{ URL::to('/dashboard') }}}">Dashboard</a>
                        <span>></span>
                        <a href="{{{ URL::to('/clients') }}}">Clients</a>
                        <span>></span>
                        <span>Create Client</span>
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
                    {{ Form::open(array('route' => 'clients.store')) }}
								{{ Form::hidden('contractorid',$id) }}
								@if(isset($_REQUEST['act']))	
								<input type="hidden" name="project" value="<?php echo $_REQUEST['act']; ?>">
								@endif
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
                                <label>First Name (Second) </label>
                                {{ Form::text('second_firstname') }}
                            </div>
                            <div class="right">
                                <label>Last Name (Second) </label>
                                {{ Form::text('second_lastname') }}
                            </div>
							
                        </div><!--row-->
                        <div class="row">
                            <div class="left">
                                <label>Phone Number *</label>
                                {{ Form::text('phone') }}
                            </div>
                            <div class="right">
                                <label>Email Address </label>
                                {{ Form::text('email') }}
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
                                <div class="left">
                                    <label>State *</label>
                                    {{ Form::select('statecity', $state , Input::old('task_unit'), array('id'=>'state')) }}
                                    <!--
                                    <select name="state" id="state">
                                        <option>In</option>
                                        <option>In2</option>
                                        <option>In2</option>
                                    </select>
                                    -->
                                </div>
                                <div class="right">
                                    <label>Zip Code</label>
                                    {{ Form::text('zip') }}
                                </div>
                            </div>
                        </div><!--row-->
                        <div class="row">
                            <label>Notes</label>
                            {{ Form::textarea('client_note') }}
                        </div><!--row-->
                        
                        <div class="row">
							<p>
							</p>
                        </div><!--row-->
                        <div class="row">
								{{ Form::submit('Create Client', array('class' => 'btn green right')) }}
						</div>
                    {{ Form::close() }}
                    
                </article>
            </div>
        </div><!--main-->
    </section><!--content-->
</div>
@stop


