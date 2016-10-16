@extends('layouts.adminlayout')

@section('main')

	<div class="viewproject">
	<section class="content">
			<div class="main">
				<div class="content-top">
					<div class="title-page left">
						<h2>Edit Project Type</h2>
						<div class="breadcrumb">
							<a href="{{{ URL::to('/admin') }}}" class="home"><img src="{{ URL::asset('assets/images/home-icon.png') }}" alt=""/></a>
							<a href="{{{ URL::to('/admin') }}}">Dashboard</a>
							<span>></span>
							<a href="{{{ URL::to('/projecttypes') }}}">View Project Type</a>
							<span>></span>
							<span>Edit Project Type</span>
						</div>
					</div><!--title-page-->
				</div><!--top-content-->	
				<div class="content-body">
					<article class="shadow right">
						<div class="row text">
							<p></p>
						</div>
						@if ($errors->any())
						<div class="row">
							{{ implode('', $errors->all('<div data-alert="" class="alert-box error">:message<a href="#" class="close">'.HTML::image("assets/images/close-icon.png", "close").'</a></div>')) }}
						</div>
						@endif
						{{ Form::model($projecttype, array('method' => 'PATCH', 'route' => array('projecttypes.update', $projecttype->id))) }}
						<div class="row">
							<label>Project Type Name </label>
							{{ Form::text('name') }}
						</div>
						
						<div class="row">
							<!--a href="{{{ URL::to('/units') }}}" class="btn red right">Cancel</a-->
							{{ Form::submit('Update Project Type', array('class' => 'btn green right')) }}
						</div>
						
						{{ Form::close() }}	
					</article>
				</div>		
			</div>
	</section>
</div>

@stop


