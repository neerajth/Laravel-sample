@extends('layouts.scaffold')

@section('main')

<h1>Show Estimate</h1>

<p>{{ link_to_route('estimates.index', 'Return to all estimates') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Title</th>
				<th>File</th>
				<th>Contractorid</th>
				<th>Projectid</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $estimate->title }}}</td>
					<td>{{{ $estimate->file }}}</td>
					<td>{{{ $estimate->contractorid }}}</td>
					<td>{{{ $estimate->projectid }}}</td>
                    <td>{{ link_to_route('estimates.edit', 'Edit', array($estimate->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('estimates.destroy', $estimate->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop