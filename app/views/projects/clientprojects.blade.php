@extends('layouts.user')

@section('main')

<div class="viewproject">
	<section class="content">
			<div class="main">
				<div class="content-top">
					<div class="title-page left">
						<h2>Projects</h2>
						<div class="breadcrumb">
							<a href="{{{ URL::to('/dashboard') }}}" class="home"><img src="{{ URL::asset('assets/images/home-icon.png') }}" alt=""/></a>
							<a href="{{{ URL::to('/dashboard') }}}">Dashboard</a>
							<span>></span>
                     <span>Projects</span>
						</div>
					</div><!--title-page-->
				</div><!--top-content-->	
				<div class="content-body">
					<article class="shadow right">
						@if (count($projects))
						<ul class="title-list">
                        <li>
                            <span class="title">Project Title</span>
                            <span class="name">Name</span>
                            <span class="date">Estimate Date</span>
                        </li>
						</ul>
                   <ul class="body-list">
                   		@foreach ($projects as $project)
						<?php 
						
						?>
                        <li>
						    <span class="title"><a href="{{{ URL::to('projects/'.$project->id) }}}">{{{ $project->name }}}</a></span>
                            <span class="name">{{ Client::where('id', $project->clientid)->pluck('firstname').' '.Client::where('id', $project->clientid)->pluck('lastname');  }}</span>
                            <span class="date">{{ date("d-M-Y", strtotime($project->created_at)) }}</span>
                           
                            <span class="link"><a style="text-decoration: underline;" href="{{{ URL::to('projects/'.$project->id) }}}">View Project</a></span>
                        </li>
                        @endforeach
                    </ul>
					{{ $projects->links() }}
                    @else
								<div class="row">
                        	<div class="success">There are no projects</div><!--success-->
                    		</div><!--row-->
						  @endif    
					</article>
				</div>		
			</div>
	</section>
</div>
@stop
