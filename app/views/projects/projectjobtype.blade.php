@extends('layouts.user')

@section('main')

<?php
/* 		echo Session::get('description')."<br>";
		echo Session::get('name')."<br>";
		echo Session::get('clientid'); */
		//print_r($listjobtypes);
?>
<div class="create-client viewproject">
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
						<h3><?php echo ucfirst(Session::get('name')); ?> Job Types</h3>
					</div><!--row-->
					@if(count($listjobtypes)!=0)
					<div class="row">
						<label>Add the types of jobs that will be required for this project.</label>
						<select id="job_types_for_project" name="jobtypes">
							@foreach ($listjobtypes as $jobtype)
		                		<option data-task-categories="{{Contractjobtypetaskcategoriesdefault::where('jobtypeid', '=', $jobtype->id)->where('contractorid', '=',Auth::id())->count();}}" data-task-categoriesid="{{Contractjobtypetaskcategoriesdefault::where('jobtypeid', '=', $jobtype->id)->pluck('taskcategoryid');}}" data-tasks="0"  data-task-id="{{ $jobtype->id }}">{{ ucfirst($jobtype->name) }}</option>
		                		
		                	@endforeach	
		                </select>
						
					</div><!--row-->
					<div class="row">
						<a class="btn orange right" target="_blank" href="{{{ URL::to('jobtypes/create')}}}">Create Job Type</a>
						<a class="btn green right" id="add_job_type_to_project">Add Job Type</a>
					</div>
					@endif
					{{ Form::open(array('route' => 'projects.store')) }}
						<ul class="title-list">
							<li>
								<span class="title">Job Type Name</span>
								<span class="name">Tasks Categories</span>
							</li>
					   </ul>
						<ul class="body-list" id="project_job_types">
						</ul>
						<div class="row">
						</div>
						<div class="row">
							{{ Form::submit('Build Project', array('class' => 'btn green right')) }}
						</div>
					{{ Form::close() }}
					
                </article>
			</div>
        </div><!--main-->
    </section><!--content-->
</div>

@stop


