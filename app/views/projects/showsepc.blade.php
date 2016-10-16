@extends('layouts.user')
@section('main')
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script type="text/javascript" src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<div class="viewproject">

<script type="text/javascript">
$(function(){
	
	// Show the text box on click
	$('body').delegate('.editable', 'click', function(){
		var ThisElement = $(this);
		//ThisElement.find('gridder_input').hide();
		ThisElement.find('.gridder_input').show().focus();
	});
	
	// Pass and save the textbox values on blur function
	$('body').delegate('.gridder_input', 'blur', function(){
	
		var ThisElement = $(this);
		var UrlToPass = 'action=update&value='+ThisElement.val()+'&crypto='+ThisElement.prop('name');
		if(ThisElement.hasClass('datepicker')) {
			return false;
		}
		var url ="{{ URL::to('updatespecarchive') }}";
	//	var url ="";
		
		$.ajax({
			url : url,
			type : 'GET',
			data : UrlToPass,
			dataType: 'json',
			success: function(data) {
					$("#estimate"+data.result1).text(data.estimate);
					$("#overunder"+data.result1).text(data.over_under);
					$("#subtotal"+data.result1).text(data.subtotal);
					$("#constructioncost").text(data.total);
					$("#totalofjobtype"+data.jobid).text(data.totalofjobtype);
					$("#totaloftc"+data.tcid).text(data.totaloftc);
					$("#countsub").val(data.total_val);
					
			}
		});
	});
	$('body').delegate('.gridder_input', 'keypress', function(e){
			var next_idx = $('input[type=text]').index(this) + 1;
 
			//get number of text input element in a html document
			var tot_idx = $('body').find('input[type=text]').length;
 
		if(e.keyCode == '13') {
				if(tot_idx == next_idx)
				//go to the first text element if focused in the last text input element
				$('input[type=text]:eq(0)').focus();
				else
				//go to the next text input element
				$('input[type=text]:eq(' + next_idx + ')').focus();
				
			
			//$(this).next(":input").focus();
			var ThisElement = $(this);
			var UrlToPass = 'action=update&value='+ThisElement.val()+'&crypto='+ThisElement.prop('name');
			if(ThisElement.hasClass('datepicker')) {
				return false;
			}
			var url ="{{ URL::to('updatespecarchive') }}";
			$.ajax({
			url : url,
			type : 'GET',
			data : UrlToPass,
			dataType: 'json',
			success: function(data) {
					$("#estimate"+data.result1).text(data.estimate);
					$("#overunder"+data.result1).text(data.over_under);
					$("#subtotal"+data.result1).text(data.subtotal);
					$("#constructioncost").text(data.total);
					$("#totaloftc"+data.tcid).text(data.totaloftc);
					$("#totalofjobtype"+data.jobid).text(data.totalofjobtype);
					$("#countsub").val(data.total_val);
				//$('.listajax'+data.result1).html( data.result2.html );
				
			}
			
		});
	}	
	});

	
});

</script>
<script type="text/javascript">
Number.prototype.format = function(n, x) {
    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
};

$(function () {
        $('#multiplier').keypress(function (event) {
            if (event.keyCode  == 13 || event.keyCode  == 9) {
			var multi=document.getElementById('multiplier').value;
			var tolal=document.getElementById('countsub').value;
			var div = Math.floor(tolal/multi);
			$("#multiplier").val(multi);
			$("#totalcost").text(('$'+div.format(2)).replace('$-', '-$'));
            }
        });

		$('body').delegate('#multiplier', 'blur', function(){
			var multi=document.getElementById('multiplier').value;
			var tolal=document.getElementById('countsub').value;
			var div = Math.floor(tolal/multi);
			$("#multiplier").val(multi);
			$("#totalcost").text(('$'+div.format(2)).replace('$-', '-$'));
		
		});
    });
</script>	
<script type="text/javascript">
$(function() {
   $('#something').click( function(e) { 
		var multi=document.getElementById('multiplier').value;
		var tolal=$('#totalcost').text();
		var proposal=document.getElementById('proposal').value;
		var key_elem = document.getElementsByClassName("draw_key");
		var value_elem = document.getElementsByClassName("draw_value");
		var draw = [];
		var key_names = [];
		var value_names = [];
		for (var i = 0; i < key_elem.length; ++i) {
			if (typeof key_elem[i].value !== "undefined") {
				key_names.push(key_elem[i].value);
			}
		}
		
		for (var i = 0; i < value_elem.length; ++i) {
			if (typeof value_elem[i].value !== "undefined") {
				value_names.push(value_elem[i].value);
			}
		}
		draw= [key_names, value_names];
		
		var json = JSON.stringify(draw);
		/**
		var dp = document.getElementById('down_payment').value;
		var cf = document.getElementById('completion_foundation').value;
		var dc = document.getElementById('delivery_cabinets').value;
		var fp = document.getElementById('final_payment').value;
		**/
		 e.preventDefault();
		//var url="{{ URL::to('projects') }}/{{ $id }}/projecthistory?&tolal="+tolal+"&multi="+multi+"&proposal="+proposal+"&dp="+dp+"&cf="+cf+"&dc="+dc+"&fp="+fp+"&urls=<?php echo $urls ?>";
		
		var url="{{ URL::to('projects') }}/{{ $id }}/projecthistory?&tolal="+tolal+"&multi="+multi+"&proposal="+proposal+"&draw="+json+"&urls=<?php echo $urls ?>";
		window.location.href  = url;
  
   });
});
</script>
<script type="text/javascript">
$(document).ready(function() {
	$('a#pop-desc').click(function() {
		// Getting the variable's value from a link 
		var loginBox = $(this).attr('href');

		//Fade in the Popup and add close button
		$(loginBox).fadeIn(300);
		
		//Set the center alignment padding + border
		var popMargTop = ($(loginBox).height() + 24) / 2; 
		var popMargLeft = ($(loginBox).width() + 24) / 2; 
		
		$(loginBox).css({ 
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});
		// Add the mask to body
		$('body').append('<div id="mask"></div>');
		$('#mask').fadeIn(300);
		$("#sepname").val($(this).attr('class'));
	
		var dataString = 'from=loaddesc&id=' + $(this).attr('class') ;
		var url ="{{{ URL::to('historydescription') }}}";
		//var url ="";
		$.ajax({
			type: "GET",
			url: url,
			data: dataString,
			//cache: false,
			dataType: 'json',
			success: function(data) {
				$("#description").val( data.descriptiontext );
			}  
			});
		$("#tasksname").text(document.getElementById('task'+$(this).attr('class')).value);
		return false;
	});
	
	// When clicking on the button close or the mask layer the popup closed
	$('a.close, #mask').on('click', function() { 
	  $('#mask , .login-popup').fadeOut(300 , function() {
		$('#mask').remove();  
	}); 
	return false;
	});
});

</script> 

  <script type="text/javascript">
  function myFunction() {
  
	var name = (document.getElementById("description").value).replace(/(\r\n)+|(\n|\r)+/g, "<br />");
	var id = document.getElementById("sepname").value;
	var dataString = 'name='+ name + '&id=' + id ;
	var url ="{{{ URL::to('historydescription') }}}";
	//var url ="";
//	alert(url);
	$.ajax({
		type: "GET",
		url: url,
		data: dataString,
		//cache: false,
		dataType: 'json',
		success: function(data) {
			
			 $('#mask , .login-popup').fadeOut(300 , function() {
			$('#mask').remove();  
			});
			alert("Added successfully."); 
			$("#description").val('');
		}  
		});
		
}
$(document).ready(function() {
	var max_fields      = 10; //maximum input boxes allowed
	var wrapper         = $("#draw_schedule"); //Fields wrapper
	var add_button      = $(".add_field_button"); //Add button ID
   
	var x = 1; //initlal text box count
	$(add_button).click(function(e){ //on add input button click
		e.preventDefault();
		if(x < max_fields){ //max input box allowed
			x++; //text box increment
			$(wrapper).append('<li style="margin-top:5px" ><span><input type="text" id="draw_key[]" name="draw_key[]" class="draw_key" placeholder="Draw schedule label" /></span><span class="fieldvalue"><input type="text" id="draw_value[]" name="draw_value[]"  class="draw_value" placeholder="value" /></span><a href="#" class="remove_field printNone" style="margin-left:5px">Remove</a></li>'); //add input box
		}
	});
   
	$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('li').remove(); x--;
	})
});
</script>
<style>
@media print {
	body * {visibility: hidden;}  
	#specifictab, #specifictab * {visibility: visible;}  
	#specifictab { width: 1300px; margin: 0; float: none; position: absolute; left: 0; top: 0;} 
	.content-body {position: static;} 
	.printNone, .printNone_child .checker, .printNone_child input, .printNone_child a{display:none!important;} 
}
</style>
<?php
// Function for encryption
function encrypt($data) {
	return base64_encode(base64_encode(base64_encode(strrev($data))));
}
?>
 	<section class="content">
		<div class="main">
			<div class="content-top">
				<div class="title-page left">
					<h2>{{{ ucfirst($project->name) }}} Project&#44; {{ ucfirst(Client::where('id', $project->clientid)->pluck('firstname').' '.Client::where('id', $project->clientid)->pluck('lastname'));  }}</h2>
					<div class="breadcrumb">
						<a href="{{{ URL::to('/dashboard') }}}" class="home"><img src="{{ URL::asset('assets/images/home-icon.png') }}" alt=""/></a>
						<a href="{{{ URL::to('/dashboard') }}}">Dashboard</a>
						<span>></span>
                  <a href="{{{ URL::to('projects') }}}">Projects</a>
                  <span>></span>
                  <span>{{{ ucwords($project->name) }}}</span>
					</div>
				</div><!--title-page-->
				
				
			</div>
			<div class="content-body">
				<article class="shadow">
				
					
					<div class="row text">
					<h3>{{ Projecttype::where('id',$project->projecttype)->Pluck('name') }} </h3>
					<h3>Project Description: </h3><p style="padding:2px 5px;">{{{ ucfirst($project->description) }}}</p></div>
					
					
					
					<div class="project_view_right">
						<div class="tabs-content account">
						
							<div class="content <?php if(((isset($_REQUEST['active'])) && ($_REQUEST['active'] == 5)) || !isset($_REQUEST['active'])){ echo "active";}else{ echo "";}?>" id="specifications">
								<div class="search-block right shadow">
								{{ Form::model($project, array('method' => 'get')) }}
									{{ Form::text('search','',array('placeholder'=>'Search Tasks','class'=>'search')) }}
									{{ Form::submit('') }}	
								{{ Form::close() }}  
								</div><!--search-block-->	
								<div class="text"><h3>Specifications, {{{ $estimates[0]->title}}}, {{{ date("M-d-Y", strtotime($estimates[0]->created_at))}}}</h3></div>
								
								<!--#include virtual="panels/specifications.html"-->
						
								<div class="specificationTab" id="specifictab" style="margin-top:20px;">
									<div class="row" style="max-width: 100%;margin-top:20px;">
										<div class="right" style="width: 300px;">
												<div class="" style="border:2px solid; width:100%; min-height: 100px; text-align: center; ">
													<span id="cnamecs" style="padding: 2px;">{{ ucfirst(Client::where('id', $project->clientid)->pluck('firstname').' '.Client::where('id', $project->clientid)->pluck('lastname'));  }}</span>
													<span id="street1cs" style="margin: 10px;">{{ Client::where('id', $project->clientid)->pluck('street1') }}</span>
													<span id="street1cs" style="">{{Client::where('id', $project->clientid)->pluck('street2') }}</span>
													<span id="street1cs" style="margin-bottom: 5px;">{{ $project->name; }}</span>
												</div>
												 <div class="" style="margin-top: 5px;">
													<label style="float: left; width: 150px;">Proposal No:</label>
													<input style="width: 150px;" type="text" value="{{{ $estimates[0]->proposal}}}" id="proposal" name="margin">
												 </div>
										</div>
									</div><!--row-->
									<div class="as_grid_container">
										<div class="as_gridder" id="as_gridder">
											<?php
												if(isset($_REQUEST['o']) && $_REQUEST['o'] == "desc"){
												$sortimg= URL::asset('assets/images/arrow_down.gif');
												$order = "asc";
												}else{
												$sortimg= URL::asset('assets/images/arrow_up.gif');
												$order = "desc";
												}
											?>
											<ul class="body-list ">
												<li class="listajax" style="background: none repeat scroll 0 0 rgba(236, 236, 228, 1);font-weight:bold;color: #000;">
												<span class="taskName">Task Name</span>
												<span class="">Unit</span>
												<span class="click">Qty.</span>
												<span class="">Cost/Unit</span>
												<span class="task_order">order <a href="{{{URL::current()}}}?active=5&s=ordering&o={{{ $order }}}" ><img src="{{{ $sortimg }}}" alt="" width="16"/></a></span>
												<span class="">Estimate</span>
												<span class="">Actual</span>
												<span class="costunit">Over/Under</span>
												<span class="">Subtotal</span>
												</li>	
											
												
												@foreach($specification as $specifications)
												<li class="listajax">
													<span class="taskName" style="background:#81BEF7;color: #000;font-weight: bold;text-decoration: underline;">{{ ucwords(Jobtype::where('id', $specifications->jobtypeid)->Pluck('name')); }}</span>
													<span class=""></span>
													<span class="click"></span>
													<span class=""></span>
													<span class="task_order"></span>
													<span class=""></span>
													<span class=""></span>
													<span class="costunit"></span>
													<span class=""></span>
												</li>
												<?php 
												$taskname=isset($_REQUEST['search']) && !empty($_REQUEST['search'])? $_REQUEST['search']: "" ;
												$data = Sepchistories::where('contractorid', Auth::id())->where('estimateid',$id)->where('jobtypeid', $specifications->jobtypeid)->where('task_title','LIKE','%'.$taskname.'%')->groupby('taskcategoryid')->get();
												?>
													@foreach($data as $datatask)
													<li class="listajax">
														<span class="taskName" style="color:#5d5d5d;font-weight:bold;">{{ ucwords(Taskcategory::where('id', $datatask->taskcategoryid)->Pluck('name')); }} </span>
														<span class=""></span>
														<span class="click"></span>
														<span class=""></span>
														<span class="task_order"></span>
														<span class=""></span>
														<span class=""></span>
														<span class="costunit"></span>
														<span class=""></span>
													</li>
													<?php
													if(isset($_REQUEST['o']) && $_REQUEST['o']!="" && isset($_REQUEST['s']) && $_REQUEST['s']!=""){
														$orderby = $_REQUEST['o'];
														$sorting= $_REQUEST['s'];
														}else{
														$orderby = 'asc';
														$sorting= 'ordering';
													}
													$taskname=isset($_REQUEST['search']) && !empty($_REQUEST['search'])? $_REQUEST['search']: "" ;
													$datatasks = Sepchistories::where('contractorid', Auth::id())->where('estimateid',$id)->where('jobtypeid',$datatask->jobtypeid)->where('taskcategoryid',$datatask->taskcategoryid)->where('task_title', 'LIKE', '%'.$taskname.'%')->orderBy($sorting, $orderby)->get();
													?>
												
													@foreach($datatasks as $specifications)
													<?php $costpunit= Task::where('id', $specifications->taskid)->Pluck('cost_per_unit'); ?>
														<li class="listajax{{ $specifications->id}}" style="color:#5d5d5d;">
															<span class="taskName printNone_child"><p>Task : </p> &nbsp;&nbsp;&nbsp; {{ ucwords(Task::where('id', $specifications->taskid)->Pluck('taskname')); }}<br /><a style="float:right;margin-top:-15px; z-index: 5; position: relative;" href="#login-box" id="pop-desc" class="{{$specifications->id}}"><img src="{{ URL::asset('assets/images/description.png') }}" alt="" width="16" title="Add description"/></a>
															
															<!--a style="float:right;margin-top:-15px; z-index: 5; position: relative;" onclick="return confirmDelete()"  href="{{{ URL::to('projects/'.$specifications->id.'/deletesepc?pid='.$specifications->projectid) }}}" id="pop-desc"><img src="{{ URL::asset('assets/images/delete.png') }}" alt="" title="Delete Task"/></a-->
															<input type="hidden" id="task{{$specifications->id}}" value="{{ ucwords(Task::where('id', $specifications->taskid)->Pluck('taskname')); }}">
															<input type="hidden" id="description{{$specifications->id}}" value="{{ ucwords(Sepchistories::where('id', $specifications->id)->Pluck('description')); }}">
															
															</span>
															
															<span class=""><p>Unit : </p>{{ ucwords(Unit::where('id', Task::where('id', $specifications->taskid)->Pluck('task_unit'))->Pluck('name')); }}</span>
															<span class="" id="editing">
																<div class="grid_content editable" id="grid_contentid"><p>Qty. : </p>
																	<!--span><?//php echo $specifications->qty; ?></span-->
																		<input type="text" id="qty{{ $specifications->id}}" class="gridder_input" name="<?php echo encrypt("qty|".$specifications->id."|".$specifications->cost_per_unit); ?>" value="<?php echo $specifications->qty; ?>" />
																</div>
															</span>
															<span class="" id="editing">
																<div class="grid_content editable" id="grid_contentid"><p>Cost/Unit : </p>
																	<!--span><?//php echo $specifications->qty; ?></span-->
																		<input type="text" id="qty{{ $specifications->id}}" class="gridder_input" name="<?php echo encrypt("cost_per_unit|".$specifications->id."|".$specifications->cost_per_unit); ?>" value="<?php echo $specifications->cost_per_unit; ?>" />
																</div>
															</span>
															<span class="task_order" id="ordering">
																<div class="grid_content editable"><p>Ordering : </p>
																		<input type="text" id="ordering" class="gridder_input" name="<?php echo encrypt("ordering|".$specifications->id); ?>" value="<?php echo $specifications->ordering; ?>" />
																</div>
															</span>
															<span class="" id="estimate{{ $specifications->id}}"><p>Estimate : </p>
															{{ str_replace('$-','-$','$'.number_format($specifications->estimate, 2)) }}</span>
															<span class="" id="qty{{ $specifications->id}}">
																<div class="grid_content editable"><p>Actual : </p>
																	<!--span >$<?//php echo $specifications->actual; ?></span-->
																		<input type="text" id="actual{{ $specifications->id}}" class="gridder_input" name="<?php echo encrypt("actual|".$specifications->id); ?>" value="<?php echo $specifications->actual; ?>" />
																</div>
															</span>
															<span class="costunit" id="overunder{{ $specifications->id}}" style="color:#29BD9B;"><p>Over/Under : </p>
															{{ str_replace('$-','-$','$'.number_format($specifications->over_under, 2)) }}</span>
															<span class="" id="subtotal{{ $specifications->id}}"><p>Subtotal : </p>
															{{ str_replace('$-','-$','$'.number_format($specifications->subtotal, 2)) }}</span>
														</li>
													@endforeach	
														<li class="listajax">
															<span class="taskName">Task category Total</span>
															<span class=""></span>
															<span class="click"></span>
															<span class=""></span>
															<span class="task_order"></span>
															<span class=""></span>
															<span class=""></span>
															<span class="costunit"></span>
															<span id="totaloftc{{$specifications->taskcategoryid}}" class="" style="background: none repeat scroll 0 0 rgba(236, 236, 228, 1);font-weight:bold;color: #000;">
															<?php $tcSubTotal = Sepchistories::where('contractorid','=',Auth::id())->where('jobtypeid','=',$specifications->jobtypeid)->where('taskcategoryid','=',$specifications->taskcategoryid)->where('estimateid','=',$id)->sum('subtotal'); ?>
															{{ str_replace('$-','-$','$'.number_format($tcSubTotal, 2)) }}
															</span>
														</li>		
												@endforeach	
													<li class="listajax">
														<span class="taskName">Job type Total</span>
														<span class=""></span>
														<span class="click"></span>
														<span class=""></span>
														<span class="task_order"></span>
														<span class=""></span>
														<span class=""></span>
														<span class="costunit"></span>
														<span id="totalofjobtype{{$specifications->jobtypeid}}" class="" style="background: none repeat scroll 0 0 rgba(236, 236, 228, 1);font-weight:bold;color: #000;">
														<?php $jobtypeSubTotal = Sepchistories::where('contractorid','=',Auth::id())->where('jobtypeid','=',$specifications->jobtypeid)->where('estimateid','=',$id)->sum('subtotal'); ?>
														{{ str_replace('$-','-$','$'.number_format($jobtypeSubTotal, 2)) }}
														</span>
													</li>
											
												@endforeach	
											</ul>
										</div>
										<?php $tolal=Sepchistories::where('contractorid','=',Auth::id())->where('projectid','=',$project->id)->where('estimateid','=',$id)->sum('subtotal'); ?>
										<div class="as_gridder" id="as_gridder">	
											<ul class="boby-list managingCost" style='display: inline-block; width: 100%; margin: 20px 0 0 10px;'>
												<li>
													<span style="clear:both;font-weight: bold;">Total Construction Cost </span>
													<span class="fieldvalue" style="" id="constructioncost">{{ str_replace('$-','-$','$'.number_format($tolal, 2)) }}</span><input type="hidden" id="countsub" value="{{ $tolal }}" name="countsub"/>
												</li>
												<li style='margin-top:5px' >
													<span style="clear:both;">Overhead/margin multiplier </span>
													<span class="fieldvalue"><input type="text" id="multiplier" value="{{{ $estimates[0]->percentage}}}" name="margin"></span>
												</li>
												<li style='margin-top:5px' >
													<span style="clear:both;font-weight: bold;">Total Contract Price </span>
													<span class="fieldvalue" style="background: #fafafa; padding: 4px 2px; border-radius: 5px; height: 25px; width: auto;" id="totalcost">${{{ $estimates[0]->total}}}</span>
												</li>
											</ul>
											<ul id="draw_schedule" class="boby-list managingCost" style='display: inline-block; width: 100%; margin: 15px 0 0 10px;'>
												<li>
													<span style="clear:both;font-weight: bold; text-decoration: underline;">Draw Schedule : </span><input class="add_field_button btn green printNone" style="width: auto; padding: 5px; min-width: initial; height: auto;" type="button" value="Add Field" />
													<input type="hidden" name="draw" id="draw" />
												</li>
												<?php
												$drawSchedule = DB::select("select draw_label, draw_value FROM draw_schedule where projectid = ".$estimates[0]->projectid." and estimateid = ".$estimates[0]->id." order by id asc");
												
												foreach($drawSchedule as $draw){
													echo '<li style="margin-top:5px" ><span><input type="text" id="draw_key[]" name="draw_key[]" value="'.$draw->draw_label.'" class="draw_key" placeholder="Draw schedule label" /></span><span class="fieldvalue"><input type="text" id="draw_value[]" name="draw_value[]" value="'.$draw->draw_value.'" class="draw_value" placeholder="value" /></span><a href="#" class="remove_field printNone" style="margin-left:5px">Remove</a></li>';
												}
												?>
											</ul>
										</div>
									</div>
								</div>
								<div class="row" style="max-width:100%;">
									<a class="btn green right" id="something" href="">Update Estimate</a><a class="btn green right" target="_blank" onclick="window.print()" >Print</a> 
								</div>
							</div>
							<?php 
						//	Specification::where('id','=',)->get();	
							?>
							
						  <div id="login-box" class="login-popup" style="margin-left: -15%; margin-top: -20%;">
							<a href="#" class="close" onclick="javascript:$('#description').val('');">
							<img src="{{ URL::asset('assets/images/pop_close.png') }}" class="btn_close" title="Close Window" alt="Close" />
							</a>
							 		<input type="hidden"  name="_token">
									<fieldset class="textbox">
									 <label class="username">
									<span>Title:</span>&nbsp;&nbsp;&nbsp;<span id="tasksname"></span> 
									</label> 
									<label class="description">
									<span>Description</span>
									{{ Form::hidden('id','',array('id'=>'sepname')) }}
									{{ Form::textarea('description','',array('id'=>'description', 'value'=>'', 'style'=>'font-weight: normal; font-family: inherit; font-size: 1rem;')) }}
									</label>
									{{ Form::submit('Add Description', array('class' => 'btn green right','onclick'=>'myFunction()')) }}
									</fieldset>
							 
							</div> 
							
							
						</div>
					</div>
				</article>
			</div>							
		</div>
	</section>
</div>
@stop
