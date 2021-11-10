<?php
	include_once("config.php");
	global $session;
	if(!$session->isLoggedIn()) 
	redirect('login.php');

	$session->logOut();
	$session->setMessage("Logout Successful!");
	redirect("login.php")

?>