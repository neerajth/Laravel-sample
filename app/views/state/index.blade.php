@extends('layouts.scaffold')

@section('main')

<h1>All Units</h1>

<p>{{ link_to_route('units.create', 'Add new unit') }}</p>

@if ($units->count())
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th>Unitid</th>
				<th>Name</th>
				<th>Abbreviation</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($units as $unit)
				<tr>
					<td>{{{ $unit->unitid }}}</td>
					<td>{{{ $unit->name }}}</td>
					<td>{{{ $unit->abbreviation }}}</td>
                    <td>{{ link_to_route('units.edit', 'Edit', array($unit->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('units.destroy', $unit->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no units
@endif

@stop
