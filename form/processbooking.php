<?php
	/**
     *This PHP Script Processes Booking Request and Update
     * 
     */
	
	include_once('../config.php');
	global $database;
	global $session;
	

	if(isset($_POST['booking'])){
	$array = $_POST['booking'];
    
    unset($array['monthlyfee']);
	
	$array['startdate'] = mysql_date($array['startdate']);

	$array['totalfee'] = ceil($array['totalfee']);
	
    $array['bookingdate'] = strftime("%Y-%m-%d", time());
    
    $array['staffid'] = $session->userId();
    
    $array['activityid'] = $_POST['activityid'];
 		
	$id = $database->insert("booking", $array);

	$session->setMessage("Booking Recorded Successfully!");
	
	redirect('../booking.php');
	
	} 
	
	if(isset($_POST['editbooking'])){
	$id = $_POST['editbooking']['id'];
    
    $startdate = mysql_date($_POST['editbooking']['startdate']);
    
    $duration = $_POST['editbooking']['monthduration'];
    $totalfee = $_POST['editbooking']['totalfee'];
 		
	$id = $database->update("booking", array('startdate'=>$startdate, 'monthduration'=>$duration, 'totalfee'=>$totalfee), "id =$id");

	$session->setMessage("Booking Updated Successfully!");
	
	redirect('../booking.php');
	
	} 
?>