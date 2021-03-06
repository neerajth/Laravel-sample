@extends('layouts.scaffold')

@section('main')

<h1>Create Resource</h1>

{{ Form::open(array('route' => 'resources.store')) }}
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