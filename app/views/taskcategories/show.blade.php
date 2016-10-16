@extends('layouts.scaffold')

@section('main')

<h1>Show Taskcategory</h1>

<p>{{ link_to_route('taskcategories.index', 'Return to all taskcategories') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Taskcategoryid</th>
				<th>Taskparentcategoryid</th>
				<th>Name</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $taskcategory->taskcategoryid }}}</td>
					<td>{{{ $taskcategory->taskparentcategoryid }}}</td>
					<td>{{{ $taskcategory->name }}}</td>
                    <td>{{ link_to_route('taskcategories.edit', 'Edit', array($taskcategory->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('taskcategories.destroy', $taskcategory->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
