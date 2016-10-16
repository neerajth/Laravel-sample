@extends('layouts.user')

@section('main')

	<div class="viewproject">
	<section class="content">
			<div class="main">
				<div class="content-top">
					<div class="title-page left">
						<h2>Create Unit</h2>
						<div class="breadcrumb">
							<a href="{{{ URL::to('/admin') }}}" class="home"><img src="{{ URL::asset('assets/images/home-icon.png') }}" alt=""/></a>
							<a href="{{{ URL::to('/admin') }}}">Dashboard</a>
							<span>></span>
							<a href="{{{ URL::to('/units') }}}">View Unit</a>
							<span>></span>
							<span>Create Unit</span>
						</div>
					</div><!--title-page-->
				</div><!--top-content-->	
				<div class="content-body">
					<article class="shadow right">
						<div class="row text">
							<p>Add custom units that fit your project's needs. Custom units allow you to correct quantities for the materials you'll need..</p>
						</div>
						@if ($errors->any())
						<div class="row">
							{{ implode('', $errors->all('<div data-alert="" class="alert-box error">:message<a href="#" class="close">'.HTML::image("assets/images/close-icon.png", "close").'</a></div>')) }}
						</div>
						@endif
						{{ Form::open(array('route' => 'units.store')) }}
						{{ Form::hidden('contractorid',Auth::id()) }}
							@if(isset($_REQUEST['taskid']))
							{{ Form::hidden('taskid',$_REQUEST['taskid']) }}
							@endif
						<div class="row">
							<label>Unit Name </label>
							{{ Form::text('name') }}
						</div>
						<div class="row">
							<label>Unit Abbreviation </label>
							{{ Form::text('abbreviation') }}
						</div>
						<div class="row">
							
							<a href="{{{ URL::to('/units') }}}" class="btn red right">Cancel</a>
							{{ Form::submit('Create Unit', array('class' => 'btn green right')) }}
						</div>
						
						{{ Form::close() }}	
					</article>
				</div>		
			</div>
	</section>
</div>

@stop


