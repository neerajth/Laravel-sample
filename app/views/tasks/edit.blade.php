@extends('layouts.user')

@section('main')
<div class="viewproject">
	<section class="content">
			<div class="main">
				<div class="content-top">
					<div class="title-page left">
						<h2>Edit Task</h2>
						<div class="breadcrumb">
							<a href="{{{ URL::to('/dashboard') }}}" class="home"><img src="{{ URL::asset('assets/images/home-icon.png') }}" alt=""/></a>
							<a href="{{{ URL::to('/dashboard') }}}">Dashboard</a>
							<span>></span>
							<a href="{{{ URL::to('/tasks') }}}">View Tasks</a>
							<span>></span>
							<span>Edit Task</span>
						</div>
					</div><!--title-page-->
				</div><!--top-content-->	
				<div class="content-body">
					<article class="shadow account right">
						<div class="row text">
							<p>Add custom units that fit your project's needs. Custom units allow you to correct quantities for the materials you'll need.</p>
						</div>
						<div class="row">
							<a href="{{{ URL::to('/units/create?taskid='.$task->id) }}}" class="btn orange right">Create Unit</a>
						</div>
						@if ($errors->any())
						<div class="row">
							{{ implode('', $errors->all('<div data-alert="" class="alert-box error">:message<a href="#" class="close">'.HTML::image("assets/images/close-icon.png", "close").'</a></div>')) }}
						</div>
						@endif
						 @if (Session::get('success_message'))
								<div class="row">
									<div data-alert="" class="alert-box success">{{ Session::get('success_message') }}<a href="#" class="close">{{ HTML::image("assets/images/close-icon.png", "close") }}</a></div>
								</div>
						  @endif
						{{ Form::model($task, array('method' => 'PATCH', 'route' => array('tasks.update', $task->id))) }}
						{{ Form::hidden('contractorid',$id) }}
						{{ Form::hidden('taskcategoryid',$task->taskcategoryid) }}	
						<div class="row">
							<div class="left">
								<label>Task Name </label>
								{{ Form::text('taskname') }}
							</div>
							<div class="right">
								<div class="left">
									 <label>Task Unit </label>
									 {{ Form::select('task_unit', $unit , ($task->task_unit)) }}
								</div>
								<div class="right">
									<label>Cost Per Unit  </label>
									{{ Form::text('cost_per_unit',sprintf ("%.2f", $task->cost_per_unit)) }}
								</div>
							</div>
						</div>	
						<div class="row">	
							<div class="left">
								<label>Description </label>
								<!--{{ Form::textarea('description') }}-->
								<textarea rows="10" cols="50" name='description'>{{ str_replace('<br />', PHP_EOL, $task->description) }}</textarea>
							</div>
						</div>
						<div class="row">
							<a href="{{{ URL::to('/jobtypes') }}}" class="btn red right">Cancel</a>
							{{ Form::submit('Update Task', array('class' => 'btn green right')) }}
						</div>
						
						{{ Form::close() }}	
					</article>
				</div>		
			</div>
	</section>
</div>
@stop
