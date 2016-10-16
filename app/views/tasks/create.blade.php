@extends('layouts.user')

@section('main')
<div class="viewproject">
	<section class="content">
			<div class="main">
				<div class="content-top">
					<div class="title-page left">
						<h2>Create Task</h2>
						<div class="breadcrumb">
							<a href="{{{ URL::to('/dashboard') }}}" class="home"><img src="{{ URL::asset('assets/images/home-icon.png') }}" alt=""/></a>
							<a href="{{{ URL::to('/dashboard') }}}">Dashboard</a>
							<span>></span>
							<a href="{{{ URL::to('/tasks') }}}">View Tasks</a>
							<span>></span>
							<span>Create Task</span>
						</div>
					</div><!--title-page-->
				</div><!--top-content-->	
				<div class="content-body">
					<article class="shadow account right">
						<div class="row text">
							<p>Add custom units that fit your project's needs. Custom units allow you to correct quantities for the materials you'll need.</p>
						</div>
						@if ($errors->any())
						<div class="row">
							{{ implode('', $errors->all('<div data-alert="" class="alert-box error">:message<a href="#" class="close">'.HTML::image("assets/images/close-icon.png", "close").'</a></div>')) }}
						</div>
						@endif
						{{ Form::open(array('route' => 'tasks.store')) }}
						{{ Form::hidden('contractorid',$id) }}
						{{ Form::hidden('taskcategoryid','21') }}	
						<div class="row">
							<div class="left">
								<label>Task Name </label>
								{{ Form::text('taskname') }}
							</div>
							<div class="right">
								<div class="left">
									 <label>Task Unit </label>
									 {{ Form::select('task_unit', $unit , Input::old('task_unit')) }}
								</div>
								<div class="right">
									<label>Cost Per Unit </label>
									{{ Form::text('cost_per_unit') }}
								</div>
							</div>
						</div>	
						<div class="row">	
							<div class="left">
								<label>Description </label>
								{{ Form::textarea('description') }}
							</div>
						</div>
						<div class="row">
							<a href="{{{ URL::to('/jobtypes') }}}" class="btn red right">Cancel</a>
							{{ Form::submit('Create Task', array('class' => 'btn green right')) }}
						</div>
						
						{{ Form::close() }}	
					</article>
				</div>		
			</div>
	</section>
</div>
@stop


