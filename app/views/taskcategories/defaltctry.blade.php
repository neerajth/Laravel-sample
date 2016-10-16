@extends('layouts.user')

@section('main')
<div class="row" id="breadcrumb_row">
		<div class="small-12 columns">
			<ul id="page_breadcrumbs" class="breadcrumbs">
				<li><a href="{{ URL::to('dashboard')}}">Home</a></li>
				<li><a href="{{ URL::to('taskcategories')}}">View Task Categories</a></li>
				<li class="unavailable">Edit Pre-Construction Tasks</li>
			</ul>
		</div>
	</div>
	<div class="row">
		<div class="small-12 columns">
			<h1>Edit {{ ucfirst(Taskcategory::where('id','=',$id)->Pluck('name')); }}  Tasks</h1>
		</div>
	</div>
	<section class="row">
	{{ Form::model($id, array('method' => 'PATCH', 'route' => array('jobtypes.update', $id))) }}
	
		<div class="small-8 columns">
		<input type="hidden" value="default" name="action">
			<table width="100%" id="task_category_tasks">
				<thead>
					<tr>
						<th>Task Name</th>
						<th>Task Unit</th>
						<th>Cost Per Unit</th>
						<th>Action</th>
					</tr>
				</thead>
				
				<tbody>
					@foreach ($defaltcategory as $defaltcategies)
					<tr>
						<td>{{ Task::where('id','=',$defaltcategies->taskid)->Pluck('taskname'); }}  <input type="hidden" value="{{ $defaltcategies->taskid }}" name="jobtypeid[]"></td>
						<td>{{ Unit::where('id','=',Task::where('id','=',$defaltcategies->taskid)->Pluck('task_unit'))->Pluck('name'); }}</td>
						<td>${{ Task::where('id','=',$defaltcategies->taskid)->Pluck('cost_per_unit'); }} <input type="hidden" value="{{ $defaltcategies->taskcategoryid }}" name="categoriesid"></td>
						<td><a href="{{ URL::to('tasks/'.$defaltcategies->taskid.'edit') }}">Edit</a> | <a onclick="$(this).parents('tr').remove();" href="#">Delete</a></td>
					</tr>
					@endforeach	
					
				</tbody>
			</table>
			
		</div>
		<div class="small-4 columns">
			<div class="panel">
				<p>Adding custom task categories allows you to organize groups of tasks that will be needed for particular jobs.</p>
				{{ Form::submit('Update Task Category', array('class' => 'button expand')) }}
				<!--a class="button expand" href="/projects/view-task-categories.html?success_message=Task category updated successfully!">Update Task Category</a-->
			</div>
		</div>
	{{ Form::close() }}
	</section>
	<div class="row">
		<div class="small-8 columns">
			<div class="panel">
				
				<h4>Select a task to add to the task category: </h4>
				
				<div class="row">
					<div class="small-12 columns">
						<select id="task_to_add"> 
							@foreach ($tasks as $taskcategory)
								<option data-task-unit="{{ Unit::where('id','=',$taskcategory->task_unit)->Pluck('name'); }}" data-cost-per-unit="{{ $taskcategory->cost_per_unit; }}" data-task-id="{{ $taskcategory->id }}" data-task-categoriesid="{{ $id }}" >{{{ $taskcategory->taskname }}}</option>
							@endforeach	
						</select>
					</div>
				</div>
				<div class="row">
					<div class="small-12 columns">
						<a href="#" class="button small" id="add_task_to_task_category">Add Task</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop	