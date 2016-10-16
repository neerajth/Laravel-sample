@extends('layouts.user')

@section('main')
<div class="viewproject">
	<section class="content">
			<div class="main">
				<div class="content-top">
					<div class="title-page left">
						<h2>Estimates</h2>
						<div class="breadcrumb">
							<a href="{{{ URL::to('/dashboard') }}}" class="home"><img src="{{ URL::asset('assets/images/home-icon.png') }}" alt=""/></a>
							<a href="{{{ URL::to('/dashboard') }}}">Dashboard</a>
							<span>></span>
                     <span>Estimates</span>
						</div>
					</div><!--title-page-->
				</div><!--top-content-->	
				<div class="content-body">
					<article class="shadow right">
						@if (count($estimates))
						<ul class="title-list">
                        <li>
                            <span style="width:18%" class="name">Estimate Title</span>
							<span style="width:18%" class="name">Project Name</span>
                            <span style="width:10%" class="date">Date Created</span>
							<span style="width:8%" class="date">Proposal No.</span>
							<span style="width:8%" class="date">Total</span>
                        </li>
                   </ul>
                   <ul class="body-list">
                   		@foreach ($estimates as $estimate)
                        <li>
                        	<span style="width:18%" class="name">{{ $estimate->title }}</span>
							<span style="width:18%" class="name">{{ Project::where('id',$estimate->projectid)->Pluck('name');}}</span>
							<span style="width:10%" class="date">{{ date("M d, Y", strtotime($estimate->created_at)) }}</span>
							<span style="width:8%" class="date">{{ $estimate->proposal }}</span>
                            <span style="width:8%" class="date" style="border-right:none;">{{ str_replace('$-','-$','$'.number_format($estimate->total, 2)) }}</span>
							
							<span style="width:auto" class="link">
								<select name="pdf_option_{{ $estimate->id }}" id="pdf_option_{{ $estimate->id }}" >
									<option value='0'>Download with Logo</option>
									<option value='1'>Download without Logo</option>
								</select>
								<a onclick='downloadEstimate( {{ $estimate->id }} )' style="text-decoration:underline">Download</a> | 
							
								<a href="{{ URL::to('projects/'.$estimate->id.'/showsepc?id='.$estimate->projectid.'&urls=estimates') }}" style="text-decoration:underline">View Estimate</a> | 
							
								{{ Form::open(array('method' => 'DELETE','onsubmit'=>'return confirmDelete()','id'=>'delete', 'style'=>'display: inline-block; width: 45px; float: none;', 'route' => array('estimates.destroy', $estimate->id))) }}
									{{ Form::hidden('projects',$estimate->projectid) }}
									{{ Form::hidden('urls','estimates') }} 
									{{ Form::submit('Delete', array('class'=>'deleting')) }}
								{{ Form::close() }}
							</span>
							
                        </li>
                        @endforeach
                    </ul>
					{{ $estimates->links() }}
                    @else
								<div class="row">
                        	<div class="success">There are no Estimates</div><!--success-->
                    		</div><!--row-->
						  @endif    
					</article>
				</div>		
			</div>
	</section>
</div>
<script>
function downloadEstimate(id){

	var op = document.getElementById('pdf_option_'+id).value;
	window.location="<?php echo  URL::to('estimates') ?>/"+id+"/download?logo="+op;
}
</script>
@stop