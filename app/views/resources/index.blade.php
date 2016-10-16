@extends('layouts.scaffold')

@section('main')

<h1>All Resources</h1>

<p>{{ link_to_route('resources.create', 'Add new resource') }}</p>

@if ($resources->count())
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
			@foreach ($resources as $resource)
				<tr>
					<td>{{{ $resource->title }}}</td>
					<td>{{{ $resource->file }}}</td>
					<td>{{{ $resource->contractorid }}}</td>
					<td>{{{ $resource->projectid }}}</td>
                    <td>{{ link_to_route('resources.edit', 'Edit', array($resource->id), array('class' => 'btn btn-info')) }}</td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('resources.destroy', $resource->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	There are no resources
@endif

@stop