@extends('layouts.user')

@section('main')

<div class="create-client">
	<section class="content">
        <div class="main">
            <div class="content-top">
                <div class="title-page left">
                    <h2>Billing Information</h2>
                    <div class="breadcrumb">
                        <a href="{{{ URL::to('/dashboard') }}}" class="home"><img src="{{ URL::asset('assets/images/home-icon.png') }}" alt=""/></a>
                        <a href="{{{ URL::to('/dashboard') }}}">Dashboard</a>
                        <span>></span>
                        <a href="{{{ URL::to('/contractors') }}}/{{{ $contractor[0]->id }}}">{{{ $contractor[0]->firstname." ".$contractor[0]->lastname }}}</a>
                        <span>></span>
                        <span>Billing Information</span>
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
						  
                    {{ Form::open(array('route' => 'contractors.storebillingifo','files' => true)) }}
                        <div class="row">
                                <label>Card Holder Name *</label>
                                {{ Form::text('cardholdername',$contractor[0]->cardholdername) }}
                        </div><!--row-->
                        
                        <div class="row">
                                <label>Card Number *</label>
                                {{ Form::text('cardno',$contractor[0]->cardno) }}
                        </div><!--row-->
						<div class="row">
						 <label>Expiry Date *</label>
							<div class="left">
								<?php $months=array("January","February","March","April","May","June","July","August","September","October","November","December");
								//print_r($month);
								?>
								<select name="expmonth">
								<option value="">Select Month</option>
								<?php foreach($months as $month){ ?>
								<option value="{{ $month }}" <?php if($month == $contractor[0]->expmonth){ echo 'selected="selected"';}?> >{{ $month }}</option>
								<?php } ?>
								</select>
							</div>
							<div class="right">
								<select name="expyear">
								<option value="">Select Year</option>
								<?php for($year=date('Y');$year<=date('Y')+50;$year++){ ?>
								<option value="{{$year}}" <?php if($year == $contractor[0]->expyear){ echo 'selected="selected"';}?>>{{$year}}</option>
								<?php } ?>
								</select>
							</div>
						</div>
                        <div class="row">
							<a href="{{{URL::to('dashboard')}}}" class="btn red right">Cancel</a>
						{{ Form::submit('Update', array('class' => 'btn orange right')) }}
						</div><!--row-->
                    {{ Form::close() }}
                    
                </article>
            </div>
        </div><!--main-->
    </section><!--content-->
</div>
@stop
