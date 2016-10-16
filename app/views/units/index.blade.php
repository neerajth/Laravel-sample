@extends('layouts.user')

@section('main')
 
<div class="viewproject">
	<section class="content">
			<div class="main">
				<div class="content-top">
					<div class="title-page left">
						<h2>View Units</h2>
						<div class="breadcrumb">
							<a href="{{{ URL::to('/admin') }}}" class="home"><img src="{{ URL::asset('assets/images/home-icon.png') }}" alt=""/></a>
							<a href="{{{ URL::to('/admin') }}}">Home</a>
							
							<span>></span>
							<span>View Units</span>
						</div>
					</div><!--title-page-->
				</div><!--top-content-->	
				<div class="content-body">
					<article class="shadow right">
					<div class="row text">
					<p>Add custom units that fit your project's needs. Custom units allow you to correct quantities for the materials you'll need.</p>
					<a class="btn orange right" href="{{{ URL::to('/units/create') }}}">Create Unit</a>
					</div>
					@if (count($units))
					<ul class="title-list">
                        <li>
                            <span class="title">Unit</span>
                            <span class="title">Abbreviation</span>
                        </li>
                   </ul>
                   <ul class="body-list">
                   		@foreach ($units as $jobtype)
                        <li>
                            <span class="title">{{{ $jobtype->name }}}</span>
                            <span class="name">{{{ $jobtype->abbreviation }}}</span>
                            <span class="link">{{ link_to_route('units.edit', ' Edit', array($jobtype->id), array('style'=>'text-decoration: underline;')) }}
                            </span>
                            <span class="link">
							{{ Form::open(array('method' => 'DELETE','id'=>'delete','onsubmit'=>'return confirmDelete()', 'route' => array('units.destroy', $jobtype->id))) }}
								{{ Form::submit('Delete', array('class'=>'deleting', 'style'=>'text-decoration: underline;')) }}
								{{ Form::close() }}
							</span>
                           
                        </li>
                        @endforeach
                    </ul>
					{{ $units->links() }}
                    @else
						<div class="row">
							<div class="success">There are no Units</div><!--success-->
						</div><!--row-->
					@endif    
					</article>
				</div>		
			</div>
	</section>
</div>

@stop
