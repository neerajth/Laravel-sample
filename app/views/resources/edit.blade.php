@extends('layouts.scaffold')

@section('main')

<h1>Edit Resource</h1>
{{ Form::model($resource, array('method' => 'PATCH', 'route' => array('resources.update', $resource->id))) }}
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
			{{ link_to_route('resources.show', 'Cancel', $resource->id, array('class' => 'btn')) }}
		</li>
	</ul>
{{ Form::close() }}

@if ($errors->any())
	<ul>
		{{ implode('', $errors->all('<li class="error">:message</li>')) }}
	</ul>
@endif

@stop