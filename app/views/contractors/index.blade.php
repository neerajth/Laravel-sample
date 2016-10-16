@extends('layouts.adminlayout')

@section('main')
<div class="viewproject">
	<section class="content">
			<div class="main">
				<div class="content-top">
					<div class="title-page left">
						<h2>Contractors</h2>
						<div class="breadcrumb">
							<a href="{{{ URL::to('/admin') }}}" class="home"><img src="{{ URL::asset('assets/images/home-icon.png') }}" alt=""/></a>
							<a href="{{{ URL::to('/admin') }}}">Dashboard</a>
							<span>></span>
							<span>Contractors</span>
						</div>
					</div><!--title-page-->
				</div><!--top-content-->	
				<div class="content-body">
					<article class="shadow right">
						@if (count($contractors))
						<ul class="title-list">
                        <li>
                            <span class="title">Name</span>
                            <span class="name">Email</span>
                            <span class="date">Phone</span>
                        </li>
                   </ul>
                   <ul class="body-list">
                   		@foreach ($contractors as $contractor)
                        <li>
                        	 <span class="title">{{{ $contractor->firstname." ".$contractor->lastname }}}</span>
                            <span class="name">{{{ $contractor->email }}}</span>
                            <span class="date">{{{ $contractor->phone }}}</span>
                            <span class="link"><a style="text-decoration: underline;" href="{{{ URL::to('/contractors/'.$contractor->id) }}}">View Profile</a></span>
                        </li>
                        @endforeach
                    </ul>
                    @else
								<div class="row">
                        	<div class="success">There are no Contractors</div><!--success-->
                    		</div><!--row-->
						  @endif    
					</article>
				</div>		
			</div>
	</section>
</div>
@stop
