@extends('layouts.adminlayout')

@section('main')
 
<div class="viewproject">
	<section class="content">
			<div class="main">
				<div class="content-top">
					<div class="title-page left">
						<h2>View Project Types</h2>
						<div class="breadcrumb">
							<a href="{{{ URL::to('/admin') }}}" class="home"><img src="{{ URL::asset('assets/images/home-icon.png') }}" alt=""/></a>
							<a href="{{{ URL::to('/admin') }}}">Home</a>
							
							<span>></span>
							<span>View Project Types</span>
						</div>
					</div><!--title-page-->
				</div><!--top-content-->	
				<div class="content-body">
					<article class="shadow right">
					<div class="row text">
					<p></p>
					<a class="btn orange right" href="{{{ URL::to('/projecttypes/create') }}}">Create Project Types</a>
					</div>
					@if (count($projecttypes))
					<ul class="title-list">
                        <li>
                            <span class="title">Project Type</span>
                        </li>
                   </ul>
                   <ul class="body-list">
                   		@foreach ($projecttypes as $projecttype)
                        <li>
                            <span class="title">{{{ $projecttype->name }}}</span>
                             <span class="link">{{ link_to_route('projecttypes.edit', ' Edit', array($projecttype->id), array('style'=>'text-decoration: underline;')) }}
                            </span>
                            <span class="link">
							{{ Form::open(array('method' => 'DELETE','id'=>'delete','onsubmit'=>'return confirmDelete()', 'route' => array('projecttypes.destroy', $projecttype->id))) }}
								{{ Form::submit('Delete', array('class'=>'deleting', 'style'=>'text-decoration: underline;')) }}
								{{ Form::close() }}
							</span>
                           
                        </li>
                        @endforeach
                    </ul>
                    @else
						<div class="row">
							<div class="success">There are no Project Types</div><!--success-->
						</div><!--row-->
					@endif    
					</article>
				</div>		
			</div>
	</section>
</div>

@stop
