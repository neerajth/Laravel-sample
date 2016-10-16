@extends('layouts.scaffold')

@section('main')

<h1>Show Task</h1>

<p>{{ link_to_route('tasks.index', 'Return to all tasks') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Taskid</th>
				<th>Taskcategoryid</th>
				<th>Contractorid</th>
				<th>Taskname</th>
				<th>Task_unit</th>
				<th>Cost_per_unit</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $task->taskid }}}</td>
					<td>{{{ $task->taskcategoryid }}}</td>
					<td>{{{ $task->contractorid }}}</td>
					<td>{{{ $task->taskname }}}</td>
					<td>{{{ $task->task_unit }}}</td>
					<td>{{{ $task->cost_per_unit }}}</td>
                    <td>{{ link_to_route('tasks.edit', 'Edit', array($task->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('tasks.destroy', $task->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
