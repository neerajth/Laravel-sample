@extends('layouts.user')
@section('main')
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script type="text/javascript" src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
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
		var url ="{{ URL::to('updatespecification') }}";
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
			var url ="{{ URL::to('updatespecification') }}";
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
				//$('.listajax'+data.result1).html( data.result2.html );
			}
		});
	}	
	});
});

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
		//console.log( draw ); alert(draw['key']); return false; alert('hello');
		/**
		var dp = document.getElementById('down_payment').value;
		var cf = document.getElementById('completion_foundation').value;
		var dc = document.getElementById('delivery_cabinets').value;
		var fp = document.getElementById('final_payment').value;
		**/
		//var legend=document.getElementById('legend').value;
		 e.preventDefault();
		//var url="{{{ URL::to('projects') }}}/{{{ $project->id }}}/spec?status=pdf&proposal="+proposal+"&tolal="+tolal+"&multi="+multi+"&dp="+dp+"&cf="+cf+"&dc="+dc+"&fp="+fp+"&status=pdf";
		
		//var url="{{{ URL::to('projects') }}}/{{{ $project->id }}}/spec?status=pdf&proposal="+proposal+"&tolal="+tolal+"&multi="+multi+"&draw_key="+draw['key']+"&draw_value="+draw['value']+"&status=pdf";
		
		var url="{{{ URL::to('projects') }}}/{{{ $project->id }}}/spec?status=pdf&proposal="+proposal+"&tolal="+tolal+"&multi="+multi+"&draw="+json+"&status=pdf";
		//window.location.href  = url;
		window.open(url,'_self');
	});
});

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
		var url ="{{{ URL::to('description') }}}";
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

function myFunction() {
	var name = (document.getElementById("description").value).replace(/(\r\n)+|(\n|\r)+/g, "<br />");
	var id = document.getElementById("sepname").value;
	
	//preg_replace("/(\r\n)+|(\n|\r)+/", "<br />", name); 
	var dataString = 'name='+ name + '&id=' + id ;
	var url ="{{{ URL::to('description') }}}";
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


function selectAlltask(){
	var status = $('input[name="taskselect-all"]').is(':checked');
	if(status){
		$('.taskName .checker span').attr('class', 'checked');
		select_all('sdel_task_ck', 1);
	}else{
		$('.taskName .checker span').attr('class', '');
		select_all('sdel_task_ck', 0);
	}
}

function select_all(name, value) {
	var selection=$("input.sdel_task_ckC");
	for (i = 0; i < selection.length; i++) {
		// regex here to check name attribute
		var regex = new RegExp(name, "i");
		if (regex.test(selection[i].getAttribute('name'))) {
			if (value == '1') {
				selection[i].checked = true;
			} else {
				selection[i].checked = false;
			}
		}
	}
}

function tasksDelete(p_id){
	var selection=$("input.sdel_task_ckC:checked");
	//alert(selection.serialize());
	if(selection.length==0){
		alert('select at least one item');
		return false;
	}else if(confirm('are you sure')){
		var url="{{{ URL::to('projects') }}}/{{{ $project->id }}}/deletesepc?pid="+p_id+"&"+selection.serialize();
		window.location.href  = url;
	}else{
		return false;
	}
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
<style>@media print {body * {visibility: hidden;}  #specifictab, #specifictab * {visibility: visible;}  #specifictab { width: 1300px; margin: 0; float: none; position: absolute; left: 0; top: 0;} .content-body {position: static;} .printNone, .printNone_child .checker, .printNone_child input, .printNone_child a{display:none!important;} }</style>
<?php
// Function for encryption
function encrypt($data) {
	return base64_encode(base64_encode(base64_encode(strrev($data))));
}
?>
<div class="viewproject">
	<section class="content">
		<div class="main">
			<div class="content-top">
				<div class="title-page left">
					<h2>{{{ ucfirst($project->name) }}} Project&#44; {{ ucfirst(Client::where('id', $project->clientid)->pluck('firstname').' '.Client::where('id', $project->clientid)->pluck('lastname'));  }}</h2>
					<div class="breadcrumb">
						<a href="{{{ URL::to('/dashboard') }}}" class="home"><img src="{{ URL::asset('assets/images/home-icon.png') }}" alt=""/></a>
						<a href="{{{ URL::to('/dashboard') }}}">Dashboard</a><span>></span>
						<a href="{{{ URL::to('projects') }}}">Projects</a><span>></span>
						<span>{{{ ucwords($project->name) }}}</span>
					</div>
				</div>	
			</div>
			<div class="content-body">
				<article class="shadow">
					<div class=""><a class="btn orange right" href="{{{ URL::to('projects/'.$project->id).'/edit' }}}">Edit Project</a></div>
					<div class="row text">
						<h3>{{ Projecttype::where('id',$project->projecttype)->Pluck('name') }} </h3>
						<h3>Project Description: </h3>
						<p style="padding:2px 5px;">{{{ ucfirst($project->description) }}}</p>
					</div>
					<div class="row">
						<ul class="title-list">
							<li>
								<span style="width:50%;" class="">Job Type Name</span>
								<span style="width:50%;" class="">Tasks Categories</span>
							  </li>
						</ul>			
						<ul class="body-list">
							@foreach ($tasks as $task)
							<li>
								<span style="width:50%;height: auto;" class="">{{ ucwords(Jobtype::where('id', $task->jobtypeid)->pluck('name'));  }}</span>
								<span style="width:50%;height: auto;" class="">{{	Contractjobtypetaskcategoriesactual::where( 'projectid', '=', $task->projectid )->where( 'jobtypeid', '=', $task->jobtypeid )->where( 'contractorid', '=', Auth::id())->count(); }}</span>
							</li>
							@endforeach	
						</ul>	
					</div>
					<div class="project_view_left">
						<div class="row">
							<div class="project_nav">
							<span id="project_nav_menu" class="">
								<em></em>
								<em></em>
								<em></em>
							</span>
							</div>
							<ul id="smallscreen" class="smallscreen tabs button-group even-5" data-tab>
							<li id="smallscreen_li" ><a href="#specifications" class="tab-title button btn light-blue">Specifications</a></li>
								<li><a id="smallscreen_li" href="#estimates" class="tab-title button btn light-blue">Estimates</a></li>
								<li><a id="smallscreen_li" href="#invoices" class="tab-title button btn light-blue">Invoices</a></li>
								<li><a id="smallscreen_li" href="#resources" class="tab-title button btn light-blue">Resources</a></li>
								<li><a id="smallscreen_li" href="#notes" class="tab-title button btn light-blue">Notes</a></li>
							</ul>
							<ul class="bigscreen tabs button-group even-5" data-tab>
								<li><a href="#specifications" class="tab-title button btn light-blue">Specifications</a></li>
								<li><a href="#estimates" class="tab-title button btn light-blue">Estimates</a></li>
								<li><a href="#invoices" class="tab-title button btn light-blue">Invoices</a></li>
								<li><a href="#resources" class="tab-title button btn light-blue">Resources</a></li>
								<li><a href="#notes" class="tab-title button btn light-blue">Notes</a></li>
							</ul>
						</div>
					</div>
					<div class="project_view_right">
						<div class="tabs-content account">
							<div class="content <?php if(((isset($_REQUEST['active'])) && ($_REQUEST['active'] == 5)) || !isset($_REQUEST['active'])){ echo "active";}else{ echo "";}?>" id="specifications">
								<div class="search-block right shadow">
									{{ Form::model($project, array('method' => 'get', 'route' => array('projects.show', $project->id))) }}
										{{ Form::text('search','',array('placeholder'=>'Search Tasks','class'=>'search')) }}
										{{ Form::submit('') }}	
									{{ Form::close() }}  
								</div><!--search-block-->
								<div class="text"><h3>Specifications</h3></div>
								<!--#include virtual="panels/specifications.html"-->
								
								<div class="specificationTab" id="specifictab" style="margin-top:20px;">
									<div class="row" style="max-width: 100%;margin-top:20px;">
										<div class="right" style="width: 300px;">
											<div class="" style="border:2px solid; width:100%; min-height: 100px; text-align: center; ">
												<?php $Clientinfo =Client::where('id', $project->clientid)->get(); ?>
												<span id="cnamecs" style="padding: 2px;">{{ $project->name; }}</span>
												<span id="street1cs" style="margin-bottom: 5px;">{{{ $Clientinfo[0]->firstname.' '.$Clientinfo[0]->lastname  }}}</span>
												<span id="street1cs" style="">{{{ $Clientinfo[0]->street1.' '.$Clientinfo[0]->street2.' '.$Clientinfo[0]->city.', '.State::where('id',$Clientinfo[0]->statecity)->Pluck('state_abb') }}}</span>
												<span id="street1cs" style="">{{{ '(Cell)'.$Clientinfo[0]->phone }}}</span>
											</div>
											 <div class="" style="margin-top: 5px;">
												<label style="float: left; width: 150px;">Proposal No:</label>
												<input style="width: 150px;" type="text" id="proposal" name="margin">
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
											<ul class="printNone" style="width: 100%; display: inline-block; margin-bottom:2px; margin-left:12px;">
												<li><span class="taskName"><input type="checkbox" name="taskselect-all" id="taskselect-all" onclick='selectAlltask()' />&nbsp;&nbsp;&nbsp; Check All <a style='margin-left:25px' onclick="return tasksDelete( {{ $project->id }} )" >Delete Tasks</a><span>
												</li>
											</ul>
											<ul class="body-list ">
												<li class="listajax" style="background: none repeat scroll 0 0 rgba(236, 236, 228, 1);font-weight:bold;color: #000;">
												<span class="taskName">Task Name </span>
												<span class="">Unit</span>
												<span class="click">Qty.</span>
												<span class="">Cost/Unit</span>
												<span class="task_order">Order <a href="{{{URL::current()}}}?active=5&s=ordering&o={{{ $order }}}" ><img src="{{{ $sortimg }}}" alt="" width="10"/></a></span>
												<span class="">Estimate</span>
												<span class="">Actual</span>
												<span class="">Over/Under</span>
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
													<span class=""></span>
													<span class=""></span>
												</li>
												<?php 
												$taskname=isset($_REQUEST['search']) && !empty($_REQUEST['search'])? $_REQUEST['search']: "" ;
												$data = Specification::where('projectid','=',$id)->where('contractorid', Auth::id())->where('jobtypeid',$specifications->jobtypeid)->where('task_title','LIKE','%'.$taskname.'%')->groupby('taskcategoryid')->get(); 
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
													<span class=""></span>
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
												$datatask = Specification::where('projectid','=',$id)->where('contractorid', Auth::id())->where('jobtypeid',$datatask->jobtypeid)->where('taskcategoryid',$datatask->taskcategoryid)->where('task_title','LIKE','%'.$taskname.'%')->orderBy($sorting, $orderby)->get();  
												?>
												@foreach($datatask as $specifications)
												<?php $costpunit= Task::where('id', $specifications->taskid)->Pluck('cost_per_unit'); ?>
												<li class="listajax{{ $specifications->id}}" style="color:#5d5d5d;">
													<span class="taskName printNone_child">
														<input type='checkbox' style="" name='sdel_task_ck[]' id='sdel_task_ck_{{ $specifications->id}}' class='sdel_task_ckC' value='{{ $specifications->id}}' >
														<p>Task : </p> &nbsp;&nbsp;&nbsp; {{ ucwords(Task::where('id', $specifications->taskid)->Pluck('taskname')); }}<br />
														<a style="float:right;margin-top:-15px; z-index: 5; position: relative;" href="#login-box" id="pop-desc" class="{{$specifications->id}}"><img src="{{ URL::asset('assets/images/description.png') }}" alt="" width="16" title="Add description"/></a>
														<!--
														<a style="float:right;margin-top:-15px; z-index: 5; position: relative;" onclick="return confirmDelete()"  href="{{{ URL::to('projects/'.$specifications->id.'/deletesepc?pid='.$specifications->projectid) }}}" id="pop-desc"><img src="{{ URL::asset('assets/images/delete.png') }}" alt="" title="Delete Task"/></a>
														-->
														<input type="hidden" id="task{{$specifications->id}}" value="{{ ucwords(Task::where('id', $specifications->taskid)->Pluck('taskname')); }}">
														<input type="hidden" id="description{{$specifications->id}}" value="{{ ucwords(Specification::where('id', $specifications->id)->Pluck('description')); }}">
													</span>
													<span class="">
														<p>Unit : </p>{{ ucwords(Unit::where('id', Task::where('id', $specifications->taskid)->Pluck('task_unit'))->Pluck('name')); }}
													</span>
													<span class="" id="editing">
														<div class="grid_content editable" id="grid_contentid">
															<p>Qty. : </p>
															<input type="text" id="qty{{ $specifications->id}}" class="gridder_input" name="<?php echo encrypt("qty|".$specifications->id."|".$specifications->cost_per_unit); ?>" value="<?php echo $specifications->qty; ?>" />
														</div>
													</span>
													<span class="" id="qty{{ $specifications->id}}">
														<div class="grid_content editable">
															<p>Cost/Unit : </p>
															<input type="text" id="costunit{{ $specifications->id}}"  class="gridder_input" name="<?php echo encrypt("cost_per_unit|".$specifications->id); ?>" value="<?php echo $specifications->cost_per_unit; ?>" />
														</div>
													</span>
													<span class="task_order" id="ordering">
														<div class="grid_content editable">
															<p>Order : </p>
															<input type="text" id="ordering" class="gridder_input" name="<?php echo encrypt("ordering|".$specifications->id); ?>" value="<?php echo $specifications->ordering; ?>" />
														</div>
													</span>
													<span class="" id="estimate{{ $specifications->id}}">
														<p>Estimate : </p>{{ str_replace('$-','-$','$'.number_format($specifications->estimate, 2)) }}
													</span>
													<span class="" id="qty{{ $specifications->id}}">
														<div class="grid_content editable">
															<p>Actual : </p>
															<input type="text" id="actual{{ $specifications->id}}" class="gridder_input" name="<?php echo encrypt("actual|".$specifications->id); ?>" value="<?php echo $specifications->actual; ?>" />
														</div>
													</span>
													<span class="" id="overunder{{ $specifications->id}}" style="color:#29BD9B;">
														<p>Over/Under : </p>{{ str_replace('$-','-$','$'.number_format($specifications->over_under, 2)) }}
													</span>
													<span class="" id="subtotal{{ $specifications->id}}">
														<p>Subtotal : </p>{{ str_replace('$-','-$','$'.number_format($specifications->subtotal, 2)) }}
													</span>
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
														<span class=""></span>
														<span id="totaloftc{{$specifications->taskcategoryid}}" class="" style="background: none repeat scroll 0 0 rgba(236, 236, 228, 1);font-weight:bold;color: #000;">
														<?php $tcSubTotal = Specification::where('projectid','=',$id)->where('contractorid', Auth::id())->where('jobtypeid','=',$specifications->jobtypeid)->where('taskcategoryid','=',$specifications->taskcategoryid)->sum('subtotal'); ?>
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
													<span class=""></span>
													<span id="totalofjobtype{{$specifications->jobtypeid}}" class="" style="background: none repeat scroll 0 0 rgba(236, 236, 228, 1);font-weight:bold;color: #000;">
														<?php $jobtypeSubTotal = Specification::where('projectid','=',$id)->where('contractorid', Auth::id())->where('jobtypeid',$specifications->jobtypeid)->sum('subtotal'); ?>
														{{ str_replace('$-','-$','$'.number_format($jobtypeSubTotal, 2)) }}
													</span>
												</li>
												@endforeach	
											</ul>
										</div>
										<?php $tolal=Specification::where('contractorid','=',Auth::id())->where('projectid','=',$project->id)->sum('subtotal'); ?>
										<div class="as_gridder" id="as_gridder">
											<ul class="boby-list managingCost" style='display: inline-block; width: 100%; margin: 20px 0 0 10px;'>
												<li>
													<span style="clear:both;font-weight: bold;">Total Construction Cost </span>
													<span class="fieldvalue" style="" id="constructioncost">{{ str_replace('$-','-$','$'.number_format($tolal, 2)) }}</span><input type="hidden" id="countsub" value="{{ $tolal }}" name="countsub"/>
												</li>
												<li style='margin-top:5px' >
													<span style="clear:both;">Overhead/margin multiplier </span>
													<span class="fieldvalue"><input type="text" id="multiplier" name="margin"></span>
												</li>
												<li style='margin-top:5px' >
													<span style="clear:both;font-weight: bold;">Total Contract Price </span>
													<span class="fieldvalue" style="background: #fafafa; padding: 4px 2px; border-radius: 5px; height: 25px; width: auto;" id="totalcost"></span>
												</li>
											</ul>
											<ul id="draw_schedule" class="boby-list managingCost" style='display: inline-block; width: 100%; margin: 15px 0 0 10px;'>
												<li>
													<span style="clear:both;font-weight: bold; text-decoration: underline;">Draw Schedule : </span><input class="add_field_button btn green printNone" style="width: auto; padding: 5px; min-width: initial; height: auto;" type="button" value="Add Field" />
													<input type="hidden" name="draw" id="draw" />
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="row" style="max-width:100%;">
									<a class="btn green right" id="something" href="">Save/Generate Estimate</a>
									<a class="btn green right" target="_blank" onclick="window.print()" >Print</a> 
								</div>
							</div>
							
							<div id="login-box" class="login-popup" style="margin-left: -15%; margin-top: -20%;">
								<a href="#" class="close" onclick="javascript:$('#description').val('');"><img src="{{ URL::asset('assets/images/pop_close.png') }}" class="btn_close" title="Close Window" alt="Close" /></a>
								{{-- Form::open(array('route' => 'projects.store','class'=>'dis')) --}}
								<!---form class="dis" accept-charset="UTF-8" action="" method="POST"--->
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
								<!--/form-->	
								 {{-- Form::close() --}}	
							</div> 
							
							<div class="content <?php if((isset($_REQUEST['active'])) && ($_REQUEST['active'] == 1)){ echo "active";}else{ echo "";}?>" id="estimates">
								<div class="row text"><h3>Estimates</h3></div>
								<table id='table_estimate'>
									<thead>
										<tr>
										<td style="display:none"></td>
										<td>Name</td>
										<td>Date</td>	
										<td>Total</td>
										<td>Proposal</td>
										<td></td>
										</tr>
									</thead>
									<tbody>
										@foreach ($estimates as $estimate)
											<tr>
											<td style="display:none">{{ $estimate->id }}</td>
											<td><span class="dtmob">Name :</span><span>{{ ucwords($estimate->title) }}</span></td>
											<td><span class="dtmob">Date :</span><span>{{ date("M d, Y", strtotime($estimate->created_at)) }}</span></td>	
											<td><span class="dtmob">Total :</span><span>{{ str_replace('$-','-$','$'.number_format($estimate->total, 2)) }}</span></td>
											<td><span class="dtmob">Proposal :</span><span>{{ $estimate->proposal }}</span></td>
											<td><span class="dtmob">Action :</span><span>
												<select name="pdf_option_{{ $estimate->id }}" id="pdf_option_{{ $estimate->id }}" >
													<option value='0'>Download with Logo</option>
													<option value='1'>Download without Logo</option>
												</select>
												<a onclick='downloadEstimate( {{ $estimate->id }} )'>Download</a> | 
												<a href="{{ URL::to('projects/'.$estimate->id.'/showsepc?id='.$project->id) }}">View Estimate</a> | 
												{{ Form::open(array('method' => 'DELETE', 'id'=>'','onsubmit'=>'return confirmDelete()', 'route' => array('estimates.destroy', $estimate->id))) }}
													 {{ Form::hidden('projects',$project->id) }}
														{{ Form::submit('Delete', array('class' => '')) }}
												{{ Form::close() }}
												</span>
											</td>
											</tr>
										@endforeach	
									</tbody>
								</table>
							</div>
							
							<div class="content <?php if((isset($_REQUEST['active'])) && ($_REQUEST['active'] == 2)){ echo "active";}else{ echo "";}?>" id="invoices">
								<div class="row text"><h3>Invoices</h3></div>
								{{ Form::open(array('route' => 'invoices.store', 'files' => true)) }}
									{{ Form::hidden('projectid',$project->id) }}
									{{ Form::hidden('contractorid',Auth::id()) }}
									<div class="row"><label>Invoice Name </label>{{ Form::text('title','',array('required'=>'required')) }}</div>
									<div class="row"><label>Total </label>{{ Form::text('total','',array('required'=>'required')) }}</div>
									<div class="row">{{ Form::file('file') }}</div>
									<div class="row">{{ Form::submit('Upload', array('class' => 'btn green right')) }}</div>
								{{ Form::close() }}	
								<table id='table_invoices'>
									<thead>
										<tr>
										<td style="display:none"></td>
										<td>Name</td>
										<td>Date</td>	
										<td>Total</td>
										<td></td>
										</tr>
									</thead>
									<tbody>
										@foreach ($invoices as $invoice)
											<tr>
											<td style="display:none"><?php echo $invoice->id; ?></td>
											<td><span class="dtmob">Name :</span><span>{{ ucwords($invoice->title) }}</span></td>
											<td><span class="dtmob">Date :</span><span>{{ date("M d, Y", strtotime($invoice->created_at)) }}</span></td>	
											<td><span class="dtmob">Total :</span><span>{{ str_replace('$-','-$','$'.number_format($invoice->total, 2)) }}</span></td>
											<td><span class="dtmob">Action :</span><span>
												@if($invoice->file!="")<a href="{{ URL::to('invoices/'.$invoice->id.'/download') }}">Download</a> | @endif 
												<a href="#">Email</a> | 
												{{ Form::open(array('method' => 'DELETE','id'=>'', 'onsubmit'=>'return confirmDelete()', 'route' => array('invoices.destroy', $invoice->id))) }}
													{{ Form::hidden('projects',$project->id) }}
													{{ Form::submit('Delete', array('class' => '')) }}
												{{ Form::close() }}
												</span>
											</td>
											</tr>
										@endforeach	
									</tbody>
								</table>
							</div>
							
							<div class="content <?php if((isset($_REQUEST['active'])) && ($_REQUEST['active'] == 3)){ echo "active";}else{ echo "";}?>" id="resources">
								<div class="row text"><h3>Resources</h3></div>
								{{ Form::open(array('route' => 'resources.store', 'files' => true)) }}
									{{ Form::hidden('projectid',$project->id) }}
									{{ Form::hidden('contractorid',Auth::id()) }}
									<div class="row"><label>Resource Name </label>{{ Form::text('title','',array('required'=>'required')) }}</div>
									<div class="row">{{ Form::file('file','',array('required'=>'required')) }}</div>
									<div class="row">{{ Form::submit('Upload', array('class' => 'btn green right')) }}</div>
								{{ Form::close() }}
								<table id='table_resources'>
									<thead>
										<tr>
										<td style="display:none"></td>
										<td>Name</td>
										<td>Date</td>	
										<td></td>
										</tr>
									</thead>
									<tbody>
										@foreach ($resources as $resource)
											<tr>
											<td style="display:none"><?php echo $resource->id; ?></td>
											<td><span class="dtmob">Name :</span><span>{{ucwords($resource->title) }}</span></td>
											<td><span class="dtmob">Date :</span><span>{{ date("M d, Y", strtotime($resource->created_at)) }}</span></td>	
											<td><span class="dtmob">Action :</span><span>
												@if($resource->file!="")<a href="{{ URL::to('resources/'.$resource->id.'/download') }}">Download</a>@endif |
												{{ Form::open(array('method' => 'DELETE','id'=>'','onsubmit'=>'return confirmDelete()', 'route' => array('resources.destroy', $resource->id))) }}
												{{ Form::hidden('projects',$project->id) }}
												{{ Form::submit('Delete', array('class' => '')) }}
											{{ Form::close() }}
												</span>
											</td>
											</tr>
										@endforeach	
									</tbody>
								</table>
							</div>
							
							<div class="content <?php if((isset($_REQUEST['active'])) && ($_REQUEST['active'] == 4)){ echo "active";}else{ echo "";}?>" id="notes">
								<div class="row text"><h3>Notes</h3></div>
								<?php 
								if(isset($_REQUEST['action'])){
									$notes=Note::where('id', $_REQUEST['note'])->get();
								}
								if(isset($_REQUEST['action']) && $_REQUEST['action']=="edit"){
									$title=$notes[0]->title;
									$reminderdate=$notes[0]->reminderdate;
									$name=$notes[0]->note;
								 ?>
								{{ Form::model($_REQUEST['note'], array('method' => 'PATCH', 'route' => array('notes.update', $_REQUEST['note']))) }}
								 <?php
								 }else{
									$title="";
									$reminderdate="";
									$name="";
								 ?>
								{{ Form::open(array('route' => 'notes.store')) }}
								<?php }?>
									<input type="hidden" name="projectid" value="{{ $project->id }}">
									<input type="hidden" name="contractorid" value="{{ Auth::id() }}">
									<div class="row">
										<div class="left">
											<?php if(isset($_REQUEST['action']) && $_REQUEST['action']=="view"){ ?>
												<label>Title: </label>
												<p>{{ $notes[0]->title }}</p>
											<?php }else{ ?>
												<label>Title: </label>
												{{ Form::text('title',$title,array('required'=>'required')) }}
											<?php } ?>
										</div>
										<div class="right">
											<?php if(isset($_REQUEST['action']) && $_REQUEST['action']=="view"){ ?>
												<label>Set a Reminder: </label>
												<p>{{ date("d M,Y", strtotime($notes[0]->reminderdate))  }}</p>
											<?php }else{ ?>
												<label>Set a Reminder: </label>
												{{ Form::text('reminderdate',$reminderdate ,array('class'=>'dp','required'=>'required')) }}
											<?php } ?>
										</div>
									</div>
									<div class="row">
										<?php if(isset($_REQUEST['action']) && $_REQUEST['action']=="view"){ ?>
											<label>Note: </label> 
											<p>{{ $notes[0]->note }}</p>
											<?php }else{ ?>
											<label>Note: </label>
											{{ Form::textarea('note',$name,array('required'=>'required')) }}
										<?php } ?>
									</div>
									<div class="row">
										<?php if(isset($_REQUEST['action']) && $_REQUEST['action']=="edit"){ ?>
											{{ Form::submit('Edit Note', array('class' => 'btn green right')) }}
										<?php }elseif(isset($_REQUEST['action']) && $_REQUEST['action']=="view"){?>
										<?php }else{?>
											{{ Form::submit('Add Note', array('class' => 'btn green right')) }}
										<?php }?>
									</div>
								{{ Form::close() }}
								<?php if(isset($_REQUEST['action']) && ($_REQUEST['action']=="edit" || $_REQUEST['action']=="view")){ ?>
									<div class="row">
										<a href="{{ URL::to('projects/'.$project->id.'?active=4') }}" class="btn green right">New Note</a>
									</div>
								<?php } ?>
								<table id='table_notes'>
									<thead>
										<tr>
										<td style="display:none"></td>
										<td>Title</td>
										<td>Reminder Date</td>	
										<td></td>
										</tr>
									</thead>
									<tbody>
										@foreach ($noteslist as $note)
											<tr>
											<td style="display:none"><?php echo $note->id; ?></td>
											<td><span class="dtmob">Title :</span><span><?php echo ucwords($note->title); ?></span></td>
											<td><span class="dtmob">Reminder Date :</span><span>{{ date("d M,Y", strtotime($note->reminderdate))  }}</span></td>	
											<td><span class="dtmob">Action :</span><span>
												<a href="{{ URL::to('projects/'.$project->id.'?active=4&action=view&note='.$note->id) }}">View</a> |
												<a href="{{ URL::to('projects/'.$project->id.'?active=4&action=edit&note='.$note->id) }}">Edit</a> | 
												<a onclick="confirm('are you sure') ? window.location='{{ URL::to('notes/'.$note->id.'/destroy?projectid='.$project->id) }}' : false ">Delete</a>
												</span>
											</td>
											</tr>
										@endforeach	
									</tbody>
								</table>
							</div>
						</div>
					</div>
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

$("#project_nav_menu").on('click', function() {
	if(document.getElementById('smallscreen').style.display == 'none'){
			$("#smallscreen").show();
		}else{
			
				$("#smallscreen").hide();
			}
});

$("#smallscreen li").on('click', function() {
	$("#smallscreen").hide();
});

$(document).ready( function() {
   $('#table_estimate').dataTable( {
		"order": [0,'desc'],
		 "language": {
		   "lengthMenu": 'Display <select>'+
			 '<option value="10">10</option>'+
			 '<option value="20">20</option>'+
			 '<option value="30">30</option>'+
			 '<option value="40">40</option>'+
			 '<option value="50">50</option>'+
			 '<option value="-1">All</option>'+
			 '</select> records'
		 }
   } );
   
   $('#table_notes').dataTable( {
		"order": [0,'desc'],
		 "language": {
		   "lengthMenu": 'Display <select>'+
			 '<option value="10">10</option>'+
			 '<option value="20">20</option>'+
			 '<option value="30">30</option>'+
			 '<option value="40">40</option>'+
			 '<option value="50">50</option>'+
			 '<option value="-1">All</option>'+
			 '</select> records'
		 }
   } );
   
   $('#table_resources').dataTable( {
		"order": [0,'desc'],
		 "language": {
		   "lengthMenu": 'Display <select>'+
			 '<option value="10">10</option>'+
			 '<option value="20">20</option>'+
			 '<option value="30">30</option>'+
			 '<option value="40">40</option>'+
			 '<option value="50">50</option>'+
			 '<option value="-1">All</option>'+
			 '</select> records'
		 }

	} );
   
   	$('#table_invoices').dataTable( {
		"order": [0,'desc'],
		 "language": {
		   "lengthMenu": 'Display <select>'+
			 '<option value="10">10</option>'+
			 '<option value="20">20</option>'+
			 '<option value="30">30</option>'+
			 '<option value="40">40</option>'+
			 '<option value="50">50</option>'+
			 '<option value="-1">All</option>'+
			 '</select> records'
		 }

	} );
	
} );

</script>
<style>

@media screen and (max-width: 767px) {
	
 }

</style>
@stop
