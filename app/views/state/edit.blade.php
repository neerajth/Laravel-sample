@extends('layouts.scaffold')

@section('main')

<h1>Edit Unit</h1>
{{ Form::model($unit, array('method' => 'PATCH', 'route' => array('units.update', $unit->id))) }}
	<ul>
        <li>
            {{ Form::label('unitid', 'Unitid:') }}
            {{ Form::input('number', 'unitid') }}
        </li>

        <li>
            {{ Form::label('name', 'Name:') }}
            {{ Form::text('name') }}
        </li>

        <li>
            {{ Form::label('abbreviation', 'Abbreviation:') }}
            {{ Form::text('abbreviation') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('units.show', 'Cancel', $unit->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
