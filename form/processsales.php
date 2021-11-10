<?php

	/**
     *This PHP Script Processes Item Sales Requests.
     */
	
	include_once('../config.php');
	global $database;
	global $session;

	if(isset($_POST['sales'])){
	$array = $_POST['sales'];
	unset($array['price']);
	
    $array['date'] = strftime("%Y-%m-%d", time());
    
    $array['staffid'] = $session->userId();
 		
	if($database->insert("sale", $array)){

	$session->setMessage("Item sales Recorded Successfully!");
	
	redirect('../recordsales.php');
	
	}
	
	} 
?>