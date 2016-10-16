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
						<h3>Project Information</h3>
					</div><!--row-->
					<div class="row text">
						<p>Adding a project name helps you identify between different projects with the same client. You can add project notes to help further identify what is to be/has been accomplished on each project.</p>
					</div><!--row-->
                	{{ Form::open(array('route' => 'projects.store')) }}
					
						<div class="row">
							<label>Project Name </label>
							{{ Form::text('name','',array('required')) }}
						</div>
						<div class="row">
							<label>Select Job Type </label>
							{{ Form::select('jobtypeid[]', $projectslist  , array('S', 'M'), array('id'=>'example-getting-started','multiple'=>'multiple', 'style'=>'height:100px' )) }}
						</div>
						<div class="row">
							<label>Project Notes </label>
							{{ Form::textarea('description') }}
						</div>
                        <div class="row">
							{{ Form::submit('Add Project', array('class' => 'btn green right')) }}
                        </div><!--row-->
                    {{ Form::close() }}
                </article>
			</div>
        </div><!--main-->
		<style>
		.account .row > div { width: 100%;}
		</style>
    </section><!--content-->
</div>
@stop


