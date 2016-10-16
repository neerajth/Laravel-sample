@extends('layouts.scaffold')

@section('main')

<h1>Create Unit</h1>

{{ Form::open(array('route' => 'units.store')) }}
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
			{{ Form::submit('Submit', array('class' => 'btn btn-info')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop


