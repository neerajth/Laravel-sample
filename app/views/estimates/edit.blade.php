@extends('layouts.scaffold')

@section('main')

<h1>Edit Estimate</h1>
{{ Form::model($estimate, array('method' => 'PATCH', 'route' => array('estimates.update', $estimate->id))) }}
	<ul>
        <li>
            {{ Form::label('title', 'Title:') }}
            {{ Form::text('title') }}
        </li>

        <li>
            {{ Form::label('file', 'File:') }}
            {{ Form::text('file') }}
        </li>

        <li>
            {{ Form::label('contractorid', 'Contractorid:') }}
            {{ Form::input('number', 'contractorid') }}
        </li>

        <li>
            {{ Form::label('projectid', 'Projectid:') }}
            {{ Form::input('number', 'projectid') }}
        </li>

		<li>
			{{ Form::submit('Update', array('class' => 'btn btn-info')) }}
			{{ link_to_route('estimates.show', 'Cancel', $estimate->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop
