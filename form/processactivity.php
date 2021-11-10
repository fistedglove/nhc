<?php
	/**
	* This PHP Script Processes Club Activity Creation, Update and Deletion
	*
	*/

	include_once('../config.php');
	global $database;
	global $session;


	if(isset($_POST['activity'])){
    
		 if($database->insert('activity', $_POST['activity'])){
		   
		 $session->setMessage("Activity Created Successfully!");
		
		 redirect('../activities.php');
		 }
	 	
	}elseif(isset($_POST['editactivity'])){
	
	$id = $_POST['editactivity']['id'];
	$name = $_POST['editactivity']['name'];
    $monthlyfee = $_POST['editactivity']['monthlyfee'];
 		
	$database->update("activity", array('name'=>$name, 'monthlyfee'=>$monthlyfee), "id =$id");

	$session->setMessage("Activity Updated Successfully!");
	
	redirect('../activities.php');
	
	
	}else{
	
		if(isset($_GET['id'])){
			
		$id = $_GET['id'];
		
		if($database->delete('activity', "id=$id")){
		$session->setMessage("Activity Deleted Successfully!");
		
		redirect('../activities.php');
		}
	
	  }

	}


?>