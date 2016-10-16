@extends('layouts.adminlayout')
@section('main')
<div class="dashboard">
<section class="content">
	<div class="main">
		<div class="content-top">
			<div class="title-page left">
				<h2>Dashboard - admin</h2>
				<div class="breadcrumb">
					<a href="{{{ URL::to('/admin') }}}" class="home"><img src="{{ URL::asset('assets/images/home-icon.png') }}" alt=""/></a>
					<span>Dashboard</span>
				</div>
			</div><!--title-page-->             
		</div><!--top-content-->
	</div><!--main-->
</section><!--content-->
</div>
@stop
