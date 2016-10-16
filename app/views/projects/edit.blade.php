@extends('layouts.user')
@section('main')
<div class="viewproject">
	<section class="content">
		<div class="main">
			<div class="content-top">
				<div class="title-page left">
					<h2>{{{ ucfirst($project->name) }}} Project&#44; {{ ucfirst(Client::where('id', $project->clientid)->pluck('firstname'));  }}</h2>
					<div class="breadcrumb">
						<a href="{{{ URL::to('/dashboard') }}}" class="home"><img src="{{ URL::asset('assets/images/home-icon.png') }}" alt=""/></a>
						<a href="{{{ URL::to('/dashboard') }}}">Dashboard</a><span>></span>
						<a href="{{{ URL::to('projects') }}}">Projects</a><span>></span>
						<a href="{{{ URL::to('projects') }}}/{{{ $project->id }}}">{{{ $project->name }}}</a><span>></span>
						<span>Edit</span>
					</div>
				</div><!--title-page-->
			</div>
			<div class="content-body">
				<article class="shadow account">
					@if ($errors->any())
					<div class="row" id="notifications">					
						{{ implode('', $errors->all('<div data-alert="" class="alert-box error">:message<a href="#" class="close">'.HTML::image("assets/images/close-icon.png", "close").'</a></div>'))  }}
					</div>
					@endif
					{{ Form::model($project, array('method' => 'PATCH', 'route' => array('projects.update', $project->id))) }}
						<div class="row">
							<div class="left">
								<label>Project Name </label>{{ Form::text('name') }}
							</div>
							<div class="large-12 columns">
								<label>Client Name </label>{{ Form::select('clientid', $listclient ,$project->clientid ) }}
							</div>
						</div>
						<div class="row">
							<label>Project Notes </label>{{ Form::textarea('description') }}
						</div>
						<ul class="title-list">
							<li>
								<span class="title">Job Type Name</span>
								<span style="border-right:none;" class="name">Tasks Categories</span>
							</li>
						</ul>
						<ul class="body-list" id="project_job_types">
							@foreach ($actualpro as $defaltcategory)
							<li>
								<span class="title">
									{{ Jobtype::where('id','=',$defaltcategory->jobtypeid)->Pluck('name'); }}
								</span>
								<span class="name" style="border-right:none;">
									{{ Contractjobtypetaskcategoriesactual::where('contractorid','=',Auth::id())->where('projectid','=',$defaltcategory->projectid)->where('jobtypeid','=',$defaltcategory->jobtypeid)->count(); }}
								</span>
							</li>	
							@endforeach	
						</ul>
						<div class="row text" style="margin-top:20px;"><p>Add the types of jobs that will be required for this project.</p></div>
						<div class="row">
							<div class="left">
								<select name="jobtypeid[]" size="4" style="height:100px; width:100%" multiple="multiple" id="example-getting-started" >
									<?php
									foreach($listjobtypes as $key =>  $company_id){
											
										$arrselects =array();
										 foreach($actualpro as $key => $selectids){
										//
										 $arrselects[] = $selectids->jobtypeid;
										 } 
										//  print_r($arrselects); die;
									 ?>
										<option value="<?php echo $company_id->id; ?>" <?php if(in_array($company_id->id,$arrselects)){ echo "selected=selected"; } ?> ><?php echo $company_id->name; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="right">
								
							</div>
						</div>
						<div class="row"></div>
						<div class="row">
							{{ Form::submit('Update Project', array('class' => 'btn green right')) }}
							{{ link_to_route('projects.show', 'Cancel', $project->id, array('class' => 'btn red right')) }}
						</div>
					{{ Form::close() }}	
				</article>
			</div>
		</div>
	</section>	
</div>
<style>
div.btn-group{
width:100%;
}
</style>
@stop
