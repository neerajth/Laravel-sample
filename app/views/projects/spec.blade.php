<?php
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment;Filename=".$estimate[0]->file.".doc");
?>

<html>
	<head>
		<title>Specifications - <?php echo ucfirst($project->name) ?></title>
		<style>
		p{
			-webkit-margin-before: 0em;
			-webkit-margin-after: 0em;
			line-height: 20px;
			padding: 2px 0;
			width : 100%;
		}
		.full_width{
			width: 450px;
		}
		ul ul{padding: 10px 18px;}
		ul ul ul{padding: 5px 18px;}
		ul li{text-align:left; padding: 2px 0px;}
		</style>	
	</head>
	<body>	
		<div class="row">
			<!-- Start of Main Content -->
			<div class="small-12 columns">
				<?php 
				$logo= Contractor::where('id',Auth::id())->get();
				$client= Client::where('id',$project->clientid)->get();
				$ext = pathinfo($logo[0]->logo, PATHINFO_EXTENSION);
				?>
				@if($logoval == 0)	
					@if($logo[0]->logo != "")
					<div style="margin: 0 auto;width: 320px; text-align: center;">
						<img src="{{ URL::asset('uploads/logo/'.Auth::id().'.'.$ext) }}" alt="{{ Contractor::where('id',Auth::id())->Pluck('businessname') }}"  height="80px"/>
					</div>	
					@else
					<?php /**
					<img src="{{ URL::asset('assets/images/logo.png') }}" alt=""/>
					**/ ?>
					@endif
					
					<div style="text-align:center; margin: 2px auto 0 auto;width: 320px; line-height:4px;color:#abaaaa;">
						<p>{{ $logo[0]->street1}}<br /> 
						{{ $logo[0]->city }} {{ State::where('id',$logo[0]->state)->Pluck('state_abb') }}<br />  
						{{ $logo[0]->zip }}<br /> {{ $logo[0]->phone }} ..office <br /> 
						{{ $logo[0]->fax }} ..fax<br />
						{{ $logo[0]->email }}</p>
					</div>
				@endif
			
				<span style="float: left;margin: 0 auto;width: 100%;">Date:{{ date('m/d/Y')}} </span>
				<div style="margin: 0 auto; line-height: 4px;padding-top: 20px;clear: both; width: 100%">
					<p>{{ ucwords($client[0]->firstname.' '.$client[0]->lastname)}}<br />
						{{ $client[0]->street1}} {{ $client[0]->city }} {{ State::where('id',$client[0]->statecity)->Pluck('state_abb') }}<br /> 
						(Cell){{ $client[0]->phone }}<br />
						{{ $client[0]->email }}</p>
				</div>
				<h4 style="text-decoration:underline; margin-bottom: 5px;">Specifications - {{{ ucfirst($project->name) }}}</h4>
				<div style="width: 100%" class="tabs-content vertical">
					<div class="content active" id="panel1a">
						 <?php 
							$specific = Sepchistories::where('projectid','=',$project->id)->where('contractorid', Auth::id())->where('estimateid', $estimate[0]->id)->groupBy('jobtypeid')->get(); 
						?>
						<ul style='list-style:none; padding: 0;'>
						@foreach ($specific as $data) 
							<?php 
							$jobtypedetails = Sepchistories::where('projectid','=',$project->id)->where('contractorid', Auth::id())->where('estimateid', $estimate[0]->id)->where('jobtypeid',$data->jobtypeid)->get();
							foreach($jobtypedetails as $status){
								if(!empty($status->description)){
									$jtstatus = "havedesc";
									break;
								}else{
									$jtstatus = "nodesc";
								}
							}
							?>
							@if($jtstatus == "havedesc")
							<li style="font-size: 16px;font-weight: bold;text-decoration: underline;">{{ ucwords($data->jobtype_title) }}</li>
							<?php $tc_data = Sepchistories::where('projectid','=',$project->id)->where('contractorid', Auth::id())->where('estimateid', $estimate[0]->id)->where('jobtypeid',$data->jobtypeid)->groupby('taskcategoryid')->get(); $counter=1; ?>
								<ul style='list-style:none;'>
								@foreach ($tc_data as $tc_data1)
									<?php 
									$tastdetails = Sepchistories::where('projectid','=',$project->id)->where('contractorid', Auth::id())->where('estimateid', $estimate[0]->id)->where('jobtypeid',$tc_data1->jobtypeid)->where('taskcategoryid',$tc_data1->taskcategoryid)->orderBy('ordering', 'asc')->get(); 
									foreach($tastdetails as $status){
										if(!empty($status->description)){
											$tcstatus = "havedesc";
											break;
										}else{
											$tcstatus = "nodesc";
										}
									}
									?>
									@if($tcstatus == "havedesc")
									<li style="font-size: 14px; font-weight:bold;" >{{ ucwords($tc_data1->taskcategory_title) }}</li>
										<ul style='list-style:decimal;'>
										@foreach ($tastdetails as $task)
											@if(!empty($task->description))
												<li style="font-size: 14px; font-weight:normal;"><span style="font-weight:bold;">{{ucfirst($task->task_title)}} : </span><span>{{ ucfirst($task->description) }}</span></li>
												<!--<span style="white-space: pre-wrap;">-->										
											@endif	
										@endforeach	
										</ul>
									@endif	
								@endforeach	
								</ul>
							@endif	
						@endforeach
						</ul>
						<table class="full_width">	
							<tbody>
								<tr >
									<td style="width:60%;font-weight: bold;">Total Contract Cost</td>
									<td style="font-weight: bold;">{{ str_replace('$-','-$','$'.number_format($estimate[0]->total, 2)) }}</td>
								</tr>
							</tbody>
						</table>
						<div style='height:10px'></div>
						<table class="full_width">	
							<tbody>
								<tr>
									<td style="width:60%;text-decoration:underline; font-weight: bold;">Draw Schedule</td>		
								</tr>
								<?php
								$drawSchedule = DB::select("select draw_label, draw_value FROM draw_schedule where projectid = ".$estimate[0]->projectid." and estimateid = ".$estimate[0]->id." order by id asc");
												
								foreach($drawSchedule as $draw){
								?>
									<tr >
										<td style="width:60%;fullname">{{ $draw->draw_label }}</td>
										<td style="fullname">{{ str_replace('$-','-$','$'.number_format($draw->draw_value, 2)) }}</td>
									</tr>
								<?php
								}
								?>						
							</tbody>	
						</table>
					 </div>
					 <div style="height:10px;"></div>
				</div>
			</div><!-- End of Main Content -->		
		</div>
	</body>
</html>	
