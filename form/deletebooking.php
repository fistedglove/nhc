<?php
include_once("../config.php");

	/**
	* This PHP script basically processes a delete request from the Staff.
	* It also apply the rule that a booking can only be deleted by the creator.
	*
	*/
	
	global $session;
	global $database;
	if(!$session->isLoggedIn()) 
	redirect('login.php');
	
	if($_GET['id']){
    
   $id = $_GET['id'];
   $staffid = $session->userId();
   
   $query = "DELETE FROM booking WHERE staffid =$staffid AND id=$id"; 
   
   if($database->execute_query($query)){
    $session->setMessage("Booking Deleted Successfully!");
    redirect("../booking");
   }else{
    $session->setWarning("You are not permitted to delete this record!");
    redirect("../booking.php");
    
   }
   
   $session->setMessage("Booking Records Deleted Successfully!");
   redirect("../booking.php");
   }

?>