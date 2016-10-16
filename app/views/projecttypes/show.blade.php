@extends('layouts.scaffold')

@section('main')

<h1>Show Projecttype</h1>

<p>{{ link_to_route('projecttypes.index', 'Return to all projecttypes') }}</p>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Name</th>
				<th>Contractorid</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>{{{ $projecttype->name }}}</td>
					<td>{{{ $projecttype->contractorid }}}</td>
                    <td>{{ link_to_route('projecttypes.edit', 'Edit', array($projecttype->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('projecttypes.destroy', $projecttype->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
		</tr>
	</tbody>
</table>

@stop
