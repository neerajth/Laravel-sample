<?php
	$remdate = date("Y-m-d");
	$result;
	$data;
	$con = mysqli_connect('localhost','snwebbuh_snuser','snweb123db','snwebbuh_toby_ezestimates');
	$query = "SELECT notes.id as noteID, projects.id as proID, notes.title as notesTitle, notes.reminderdate as remindeDate, notes.note as notesDesc, projects.name as proName, projects.description as proDesc, contractors.firstname as firstnName, contractors.lastname as lastName, contractors.businessname as Company, contractors.email as email FROM notes left join contractors on notes.contractorid = contractors.id left join projects on notes.projectid = projects.id where notes.reminderdate = '".$remdate."'";
	
	if($result = mysqli_query($con,$query)){
		while ($data = mysqli_fetch_array($result)) {
			if($data['email'] != ''){
				$message ="";
				$to = $data['email'];
				//$to = "neerajth@gmail.com";
				$subject = "Remember Alert";
				$message .= "Dear ".$data['firstnName']." ".$data['lastName'].", \n\n";
				$message .= "You have a reminder alert '".$data['notesTitle']."' on ".date('jS M Y',strtotime($data['remindeDate']))." related to ".$data['proName']." Project. \n";
				$message .="Follow this link to view the details : http://www.snwebtechnologies.com/ez_estimates/public/projects/".$data['proID']."?active=4&action=view&note=".$data['noteID'];
				//$message .= "Notes title : ".$details->notesTitle."\n";
				//$message .= "Description : ".$details->notesDesc;
				$from = "info@snwebtechnologies.com";
				$headers = "From:".$from;
				if(mail($to,$subject,$message,$headers)){
					
				}else{
					
				}
			}
		}
		mysqli_free_result($result);
	}
	mysqli_close($con);
?>