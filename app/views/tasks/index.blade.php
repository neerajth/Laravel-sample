@extends('layouts.user')

@section('main')
<div class="viewproject">
	<section class="content">
			<div class="main">
				<div class="content-top">
					<div class="title-page left">
						<h2>View Tasks</h2>
						<div class="breadcrumb">
							<a href="{{{ URL::to('/dashboard') }}}" class="home"><img src="{{ URL::asset('assets/images/home-icon.png') }}" alt=""/></a>
							<a href="{{{ URL::to('/dashboard') }}}">Dashboard</a>
							<span>></span>
							<span>View Tasks</span>
						</div>
					</div><!--title-page-->
					<div class="search-block right shadow">
						{{ Form::open(array('method' => 'get','route' => 'tasks.index')) }}
							{{ Form::text('search','',array('placeholder'=>'Search tasks','class'=>'search')) }}
							{{ Form::submit('') }}	
						{{ Form::close() }}  
					</div>
				</div><!--top-content-->	
				<div class="content-body">
					<article class="shadow account right">
					<div class="row text">
					<p>Custom tasks specify tasks that will be required for the project and that you'll be billing the client for.</p>
					<a class="btn orange right" href="{{{ URL::to('/tasks/create') }}}">Create Task</a>
					</div>
					@if (count($tasks))
					<ul class="title-list">
                        <li>
                            <span class="title">Task Name</span>
                            <span class="name">Task Unit</span>
							<span class="date">Cost Per Unit</span>
                        </li>
                   </ul>
                   <ul class="body-list">
                   		@foreach ($tasks as $task)
                        <li>
                            <span class="title">{{{ $task->taskname }}}</span>
                            <span class="name">{{	Unit::where( 'id', '=',$task->task_unit)->Pluck('name'); }}</span>
							<span class="date">${{{ sprintf ("%.2f", $task->cost_per_unit) }}}</span>
                            <span class="link">
								{{ link_to_route('tasks.edit', 'Edit', array($task->id), array('style'=>'text-decoration: underline;')) }}
							</span>
							<span class="link">
								{{ Form::open(array('method' => 'DELETE','id'=>'delete','onsubmit'=>'return confirmDelete()','route' => array('tasks.destroy', $task->id))) }}
									{{ Form::submit('Delete', array('class'=>'deleting', 'style'=>'text-decoration: underline;', 'onclick'=>'deleteItem()')) }}
								{{ Form::close() }}
								<!--<a style="text-decoration: underline;" href="">View Project</a>-->
							</span>
                        </li>
                        @endforeach
                    </ul>
					{{ $tasks->links() }}
                    @else
						<div class="row">
							<div class="success">There are no tasks</div><!--success-->
						</div><!--row-->
					@endif    
					</article>
				</div>		
			</div>
	</section>
</div>
@stop
