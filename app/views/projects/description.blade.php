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
                        <span>Add Description</span>
                    </div>
                </div><!--title-page-->
            </div><!--top-content-->
            <div class="content-body">
				<article class="shadow account">
					<div class="row text">
						<h3>Add Description</h3>
					</div><!--row-->
					<div class="row text">
						<p>Adding custom task categories allows you to organize groups of tasks that will be needed for particular jobs.</p>
						
					</div><!--row-->
					@if ($errors->any())
					<div class="row" id="notifications">					
						{{ implode('', $errors->all('<div data-alert="" class="alert-box error">:message<a href="#" class="close">'.HTML::image("assets/images/close-icon.png", "close").'</a></div>')) }}
					</div>
					@endif
                	{{ Form::open(array('route' => 'projects.updatedescription')) }}
						
						{{ Form::hidden('sepid',$id) }}	
                        <div class="row">
                            <label>Description </label>
							{{ Form::textarea('description') }}
                        </div><!--row-->
                        <div class="row">
							{{ Form::submit('Add Description', array('class' => 'btn green right')) }}
                        </div><!--row-->
                    {{ Form::close() }}
                </article>
            </div>
        </div><!--main-->
    </section><!--content-->
</div>
@stop


