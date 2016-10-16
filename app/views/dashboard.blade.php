@extends('layouts.user')
@section('main')
<div class="dashboard">
<section class="content">
	<div class="main">
		<div class="content-top">
			<div class="title-page left">
				<h2>Dashboard</h2>
				<div class="breadcrumb">
					<a href="{{{ URL::to('/dashboard') }}}" class="home"><img src="{{ URL::asset('assets/images/home-icon.png') }}" alt=""/></a>
						<span>Dashboard</span>
				</div>
			</div>
			<div class="search-block right shadow">
				<form method="get">
					<input type="text" class="search" name="search" placeholder="Search projects">
					<input type="submit" value="" placeholder="Search projects">
				</form>
 			</div><!--search-block-->
		</div><!--top-content-->
		<div class="content-body">
			<aside class="left">
				<div class="shadow">
					<a href="{{{ URL::to('/clients') }}}">{{ Client::where('contractorid','=',Auth::id())->count(); }}<span>clients</span></a> 
				</div>
				<div class="shadow">
					<a href="{{{ URL::to('/projects') }}}">{{ Project::where('contractorid','=',Auth::id())->count(); }}<span>projects</span></a> 
				</div>
				<div class="shadow">
					<!--<span id="tages">{{ Estimate::where('contractorid','=',Auth::id())->count(); }}<span>estimates</span></span>-->
					<a href="{{{ URL::to('/estimates') }}}">{{ Estimate::where('contractorid','=',Auth::id())->count(); }}<span>estimates</span></a> 
				</div>
				<div class="shadow" >
					<!--<span id="tages">{{ Invoice::where('contractorid','=',Auth::id())->count(); }}<span>invoices</span></span>-->
					<a href="{{{ URL::to('/invoices') }}}">{{ Invoice::where('contractorid','=',Auth::id())->count(); }}<span>invoices</span></a>
				</div>
			</aside>
			<?php 
			$id=auth::id();
			if(isset($_REQUEST['search'])){
				$con = $_REQUEST['search'];
			}else{
				$con = "";
			} 
			$results =  Project::where('contractorid','=',$id)->where('name','like','%'.$con.'%')->orderBy('id','desc')->paginate(10);
			?>
		
			<article class="shadow right">
				<p class="title">Recent Projects</p>
				<?php if(count($results)>0){ ?>
				<ul class="title-list">
					<li>
						<span class="title">Project Title</span>
						<span class="title">Job Type</span>
						<span class="date">Estimate Date</span>
					</li>
				</ul>
				<ul class="body-list">
				<?php 
					foreach($results as $result){
					$jobtypes= Contractjobtypetaskcategoriesactual::where('contractorid',Auth::id())->where('projectid',$result->id)->groupby('jobtypeid')->get();
				?>
					<li>
						<span class="title"><a href="{{ URL::to('projects/'.$result->id) }}">{{ ucwords($result->name) }}</a></span>
						<span class="title">
							<?php $inc=0;  ?>
							@foreach($jobtypes as $jobtype)
								@if($inc>0)
									{{', '.ucwords(Jobtype::where('id',$jobtype->jobtypeid)->Pluck('name'))}}
								@else
									{{ucwords(Jobtype::where('id',$jobtype->jobtypeid)->Pluck('name'))}}
								@endif
								<?php $inc++ ?>
							@endforeach
							
						</span>
						<span class="date">{{ date("d M Y", strtotime($result->created_at)) }}</span>
						<span class="link"><a href="{{ URL::to('projects/'.$result->id) }}">View Project</a></span>
					</li>
				<?php  } ?>
				
				</ul>
				<div class="row"><?php echo $results->links(); ?></div>
				<?php
				}else{
				?>
					<div class="row">
						<div class="success">There are no projects</div><!--success-->
					</div>
				<?php
				}
				?>
			</article>
		</div>
	</div><!--main-->
</section><!--content-->
</div>
<style>			
.dashboard aside > div #tages {
	color: #0082c3;
	display: table-cell;
	font-family: "proxima_novabold";
	font-size: 72px;
	height: 160px;
	line-height: 1;
	text-align: center;
	text-decoration: none;
	vertical-align: middle;
	width: 100%;
}
.dashboard aside > div #tages span {
	color: #c0c0c0;
	display: block;
	font-size: 24px;
	text-transform: uppercase;
}
.content {
	margin-top: 40px;
	padding-bottom: 0px;
}
</style>			

@stop
