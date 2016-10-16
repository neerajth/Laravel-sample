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
					<div class="search-block right shadow">
						
						{{ Form::open(array('method' => 'get','route' => 'projects.index')) }}
							{{ Form::text('search','',array('placeholder'=>'Search Projects','class'=>'search')) }}
							{{ Form::submit('') }}	
						{{ Form::close() }}  
					</div><!--search-block-->
				</div><!--top-content-->	
				
				<div class="content-body">
					<article class="shadow right">
						@if (count($projects))
					<ul class="title-list">
                        <li>
						<?php 
						$page =isset($_REQUEST['page'])? $_REQUEST['page'] : "" ;
						$sort =isset($_REQUEST['sort'])? '&'.$_REQUEST['page'] : "id" ;
						$order = isset($_REQUEST['order'] )&& $_REQUEST['order'] =="asc"? 'desc' : "asc" ;
						//print_r(URL::to('projects?page='.$page.'&sort='.$sort.'&order='.$order));
						?>
						   <span class="name"><a href="{{ URL::to('projects?page='.$page.'&sort=clientid'.'&order='.$order) }}"> Name</a></span>
							<span class="title" ><a href="{{ URL::to('projects?page='.$page.'&sort=name'.'&order='.$order) }}">Project Title</a></span>
                           <span class="date">Estimate Date</span>
                            
                        </li>
                   </ul>
                   <ul class="body-list">
                   		@foreach ($projects as $project)
                        <li>
						<?php $client = Client::where('id', $project->clientid)->get();
							?>
                            <span class="name">{{ ucwords(Client::where('id', $project->clientid)->pluck('lastname').' '.Client::where('id', $project->clientid)->pluck('firstname'));  }}</span>
							<span class="title" ><a href="{{{ URL::to('projects/'.$project->id.'?active=5') }}}">{{{ $project->name }}}</a></span>
                            <span class="date">{{ date("d-M-Y", strtotime($project->created_at)) }}</span>
                          
                            <span class="link"><a style="text-decoration: underline;" href="{{{ URL::to('projects/'.$project->id.'?active=5') }}}">View Project</a></span>
							<!--span class="link"><a style="text-decoration: underline;" href="{{{-- URL::to('projects/'.$project->id).'/edit' --}}}">Edit Project</a></span-->
							<span class="link">
								{{ Form::open(array('method' => 'DELETE','id'=>'delete','onsubmit'=>'return confirmDelete()', 'route' => array('projects.destroy', $project->id))) }}
									{{ Form::submit('Delete', array('class'=>'deleting', 'style'=>'text-decoration: underline;', 'onclick'=>'')) }}
								{{ Form::close() }}
								<!--<a style="text-decoration: underline;" href="">View Project</a>-->
							</span>
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
