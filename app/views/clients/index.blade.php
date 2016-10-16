@extends('layouts.user')
@section('main')

<div class="viewproject">
	<section class="content">
			<div class="main">
				<div class="content-top">
					<div class="title-page left">
						<h2>Clients</h2>
						<div class="breadcrumb">
							<a href="{{{ URL::to('/dashboard') }}}" class="home"><img src="{{ URL::asset('assets/images/home-icon.png') }}" alt=""/></a>
							<a href="{{{ URL::to('/dashboard') }}}">Dashboard</a>
							<span>></span>
                     <span>Clients</span>
						</div>
					</div><!--title-page-->
					<div class="search-block right shadow">
						{{ Form::open(array('method' => 'get','route' => 'clients.index')) }}
							{{ Form::text('search','',array('placeholder'=>'Search Clients','class'=>'search')) }}
							{{ Form::submit('') }}	
						{{-- Form::close() --}}  
					</div><!--search-block-->
				</div><!--top-content-->	
				<div class="content-body">
					<article class="shadow right">
						@if (count($clients))
						<ul class="title-list">
                        <li>
                            <span class="title">Name</span>
                            <span class="name">Email</span>
                            <span class="date">Phone</span>
                        </li>
					   </ul>
					   <ul class="body-list">
							@foreach ($clients as $client)
							<?php $secondname= !empty($client->second_firstname) || !empty($client->second_lastname)? ', ('.ucwords($client->second_firstname.' '.$client->second_lastname).')' : "" ;?>
							<li>
								 <span class="title">{{{ucwords( $client->lastname." ".$client->firstname.$secondname)}}}</span>
								<span class="name"><a style="text-decoration: underline;" href="mailto:{{ $client->email }}" target="_top">{{{ $client->email }}}</a>
								</span>
								<span class="date">{{{ $client->phone }}}</span>
								<span class="link"><a style="text-decoration: underline;" href="{{{ URL::to('/clients/'.$client->id) }}}">View Profile</a></span>
								<span class="link"><a style="text-decoration: underline;" href="{{{ URL::to('projects/'.$client->id.'/clientprojects') }}}">View Project</a></span>
							</li>
							@endforeach
						</ul>
						<div class="row"><?php echo $clients->links(); ?></div>
						@else
								<div class="row">
                        	<div class="success">There are no clients</div><!--success-->
                    		</div><!--row-->
						  @endif    
					</article>
				</div>		
			</div>
	</section>
</div>
	
	@stop