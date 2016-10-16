@extends('layouts.user')

@section('main')
<div class="viewproject">
	<section class="content">
			<div class="main">
				<div class="content-top">
					<div class="title-page left">
						<h2>Create Task Categories</h2>
						<div class="breadcrumb">
							<a href="{{{ URL::to('/dashboard') }}}" class="home"><img src="{{ URL::asset('assets/images/home-icon.png') }}" alt=""/></a>
							<a href="{{{ URL::to('/dashboard') }}}">Dashboard</a>
							<span>></span>
							<a href="{{{ URL::to('/taskcategories') }}}">View Task Categories</a>
							<span>></span>
							<span>Create Task Category</span>
						</div>
					</div><!--title-page-->
				</div><!--top-content-->	
				<div class="content-body">
					<article class="shadow account right">
						<div class="row text">
							<p>Adding custom task categories allows you to organize groups of tasks that will be needed for particular jobs.</p>
						</div>
						@if ($errors->any())
						<div class="row">
							{{ implode('', $errors->all('<div data-alert="" class="alert-box error">:message<a href="#" class="close">'.HTML::image("assets/images/close-icon.png", "close").'</a></div>')) }}
						</div>
						@endif
						{{ Form::open(array('route' => 'taskcategories.store')) }}
						<div class="row">
							<label>Task Category Name </label>
							{{ Form::text('name') }}
						</div>
						<div class="row">
							<label>Select Task </label>
							{{ Form::select('task[]',$jobtype , array('S', 'M'),array('id'=>'example-getting-started','multiple'=>'multiple', 'style'=>'height:100px' )) }}
						</div>
						<div class="row">
							<a href="{{{ URL::to('/taskcategories') }}}" class="btn red right">Cancel</a>
							{{ Form::submit('Create Task', array('class' => 'btn green right')) }}
						</div>
						
						{{ Form::close() }}	
					</article>
				</div>		
			</div>
	</section>
</div>
@stop


