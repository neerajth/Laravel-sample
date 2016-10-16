@extends('layouts.user')

@section('main')
<div class="create-client">
	<section class="content">
        <div class="main">
            <div class="content-top">
                <div class="title-page left">
                    <h2>Create Project</h2>
                    <div class="breadcrumb">
                        <a href="{{{ URL::to('/dashboard') }}}" class="home"><img src="{{ URL::asset('assets/images/home-icon.png') }}" alt=""/></a>
                        <a href="{{{ URL::to('/dashboard') }}}">Dashboard</a>
                        <span>></span>
                        <a href="{{{ URL::to('projects') }}}">Projects</a>
                        <span>></span>
                        <span>Create Project</span>
                    </div>
                </div><!--title-page-->
            </div><!--top-content-->
            <div class="content-body">
				<article class="shadow account">
					<div class="row text">
						<h3>Select a Client</h3>
					</div><!--row-->
					<div class="row text">
						<p>Adding custom task categories allows you to organize groups of tasks that will be needed for particular jobs.</p>
						<a class="btn orange right" href="{{ URL::to('clients/create?act=project') }}">Add Client</a>
						<a href="{{ URL::to('projects') }}" class="btn red right">Cancel</a>
					</div><!--row-->
					@if ($errors->any())
					<div class="row" id="notifications">					
						{{ implode('', $errors->all('<div data-alert="" class="alert-box error">:message<a href="#" class="close">'.HTML::image("assets/images/close-icon.png", "close").'</a></div>')) }}
					</div>
					@endif
                	{{ Form::open(array('route' => 'projects.projectinfo')) }}
				
                        <div class="row">
                            <label>Select Client </label>
							<select name="clientname">
									<option value="">Select Client</option>
								@foreach ($listclient as $project) 
								<?php $secondname= !empty($project->second_firstname) || !empty($project->second_lastname)? ', '.$project->second_firstname.' '.$project->second_lastname : "" ;?>
									<option value="{{ $project->id }}">{{ ucwords($project->firstname.' '.$project->lastname.$secondname) }} </option>
								@endforeach	
		                	</select>
                        </div><!--row-->
                        <div class="row">
							{{ Form::submit('Project Information', array('class' => 'btn green right')) }}
                        </div><!--row-->
                    {{ Form::close() }}
                </article>
            </div>
        </div><!--main-->
    </section><!--content-->
</div>
@stop


