@extends('layouts.user')

@section('main')
 <div class="viewproject">
	<section class="content">
			<div class="main">
				<div class="content-top">
					<div class="title-page left">
						<h2>Edit Task Categories</h2>
						<div class="breadcrumb">
							<a href="{{{ URL::to('/dashboard') }}}" class="home"><img src="{{ URL::asset('assets/images/home-icon.png') }}" alt=""/></a>
							<a href="{{{ URL::to('/dashboard') }}}">Dashboard</a>
							<span>></span>
							<a href="{{{ URL::to('/taskcategories') }}}">View Task Categories</a>
							<span>></span>
							<span>Edit Task Category</span>
						</div>
					</div><!--title-page-->
				</div><!--top-content-->	
				<div class="content-body">
					<article class="shadow account right">
						<div class="row text">
							<p>Add custom units that fit your project's needs. Custom units allow you to correct quantities for the materials you'll need.</p>
						</div>
						@if ($errors->any())
						<div class="row">
							{{ implode('', $errors->all('<div data-alert="" class="alert-box error">:message<a href="#" class="close">'.HTML::image("assets/images/close-icon.png", "close").'</a></div>')) }}
						</div>
						@endif
						{{ Form::model($taskcategory, array('method' => 'PATCH', 'route' => array('taskcategories.update', $taskcategory->id))) }}
						<div class="row">
							<label>Task Category Name </label>
							{{ Form::text('name') }}
						</div>
						<div class="row">
							<label>Select Tasks </label>
							<select name="task[]" size="4" style="height:100px;" multiple="multiple" id="example-getting-started" >
								<?php
								foreach($jobtype as $key =>  $company_id){
									$arrselects = array();
									 foreach($selectid as $key => $selectids){
									//
									 $arrselects[] = $selectids->taskid;
									 } 
									//  print_r($arrselects); die;
								 ?>
							  <option value="<?php echo $company_id->id; ?>" <?php if(in_array($company_id->id,$arrselects)){ echo "selected=selected"; } ?> ><?php echo $company_id->taskname; ?></option>
							<?php } ?>
							</select>
						</div>
						<div class="row">
							{{ Form::submit('Update Task Category', array('class' => 'btn green right')) }}
						</div>
						
						{{ Form::close() }}	
					</article>
				</div>		
			</div>
	</section>
</div>
@stop
