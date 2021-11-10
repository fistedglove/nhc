<?php

	/**
	* This PHP script processes Staff login, New Membership Account, Membership Account Update, and Staff Account Creation
	*
	*/
	include_once('../config.php');
	global $database;
	global $session;

	//New Membership Account Creation

	if(isset($_POST['member'])){
	$array = $_POST['member'];
	
	$array['address'] .=  " ".$array['addressline'];
	
	$array['dob'] = mysql_date($array['dob']);
	
	$newArray = array();
	
	foreach($array as $key => $value){
	if($key == 'addressline')
	continue;	
	$newArray[$key] = trim($value);	
	}
    
	$newArray['staffid'] = $session->userId();
    $newArray['signupdate'] = strftime("%Y-%m-%d", time());
    
 		
	$id = $database->insert("member", $newArray);

	$session->setMessage("Client Membership Account Created Successfully!");
	
	redirect('../index.php');
	
	} 

    //Staff Account Creation
	
    if(isset($_POST['staff'])){
	$array = $_POST['staff'];
	
	$array['address'] .=  " ".$array['addressline'];
	
	$array['dob'] = mysql_date($array['dob']);
	
	$newArray = array();
	foreach($array as $key => $value){
	if($key == 'confirmpassword' || $key == 'addressline')
	continue;	
	$newArray[$key] = trim($value);	
	}	
	
	$newArray['password'] = sha1($newArray['password']);
			
	$id = $database->insert("staff", $newArray);
	
	$session->setMessage("Staff Account Created Successfully!");
    redirect('../staff.php');
	
	}

	//Staff Login
	
	if(isset($_POST['login'])){
	
	$array = $_POST['login'];
	
	$username = trim($array['username']);
	
	$password = sha1($array['password']);
	
	$query = "SELECT id, position FROM staff WHERE username =:username AND password =:password";
	
	$result = $database->find_by_query($query, array(':username' =>$username, ':password'=>$password));
	if($result){
		
		$session->logIn($result[0]);
		$session->setMessage("Login Successful! You are Welcome $username");
		redirect("../index.php");
		}else{
        $session->setWarning("Username/Password Incorrect. Check Caps lock and Try Again!");
		redirect("../login.php");
		}	
		
	}

	//Membership Account Update
	
	if(isset($_POST['memberupdate'])){
	$array = $_POST['memberupdate'];
	
	$array['address'] .=  " ".$array['addressline'];
	
	$array['dob'] = mysql_date($array['dob']);
	
	$newArray = array();
	foreach($array as $key => $value){
	if($key == 'addressline')
	continue;	
	$newArray[$key] = trim($value);	
	}
    
	$id = $database->update("member", $newArray, "id = {$newArray['id']}");

	$session->setMessage("Member Details Updated Successfully!");
	redirect("../members.php");

	} 


?>



