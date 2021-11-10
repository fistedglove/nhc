<?php
	/**
	* This PHP script processes the deletion of membership account.
	*
	*/
	
	include_once("../config.php");

	global $session;
	global $database;
	if(!$session->isLoggedIn()) 
	redirect('login.php');
	
	if($_GET['id']){
		$id = trim($_GET['id']);
		
    
   $database->delete('member', "id =$id");
   
   $session->setMessage("Booking Records Deleted Successfully!");
   redirect("../members.php");
   }

?>