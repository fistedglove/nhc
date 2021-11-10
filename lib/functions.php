<?php

	/**
	* This PHP Script contains the User Defined function(Rules) used in this project
	*/
	include_once("database.php");
	
	
	/**
	* getReport method Calls the Webservice Methods
	* @param string $wsdladdress a WSDL Adress for the remote Centre
	* @param string $month the particular month to fetch
	* @param string $week the particular week to fetch
	* @return Mixed
	*/

	function getReport($wsdlAddress, $month = '', $week =''){

    ini_set("soap.wsdl_cache_enabled", "0");

    try{
    $client = @new SoapClient("$wsdlAddress");

	$reports = array();
		
     $reports[0] = $client->monBooking($month);
	 $reports[1] = $client->weekBooking($week);
	 $reports[2] = $client->monMembership($month);
	 $reports[3] = $client->weekMembership($week);
	 $reports[4] = $client->monSales($month);
	 $reports[5] = $client->weekSales($week);

    return $reports;

    }catch(SoapFault $e){
		
      return $e->faultstring;
    }
   	
	}
	
	/**
	* getLocalReport method get the Local Report 
	* @param string $month the particular month to fetch
	* @param string $week the particular week to fetch
	* @return Mixed
	*/

	function getLocalReport($month = 'MONTH(NOW())', $week ='WEEK(NOW())'){
	global $database;
	
	$query = "SELECT MONTHNAME(bookingdate) as month, sum(totalfee) as fee, count(*) as booking
              FROM booking WHERE MONTHNAME(bookingdate)='$month'";
		
		$localReports[] = $database->execute_query($query, true);
		
	$query = "SELECT WEEK(bookingdate) as week, sum(totalfee) as fee, count(*) as booking
              FROM booking WHERE WEEK(bookingdate) =$week";
		
		$localReports[] = $database->execute_query($query, true);
		
	$query = "SELECT MONTHNAME(signupdate) as month, count(*) as membership
              FROM member WHERE MONTHNAME(signupdate)='$month'";
		
		$localReports[] = $database->execute_query($query, true);
		
	$query = "SELECT WEEK(signupdate) as week, count(*) as membership
              FROM member WHERE WEEK(signupdate) =$week";
		
		$localReports[] = $database->execute_query($query, true);
		
		
	$query = "SELECT sum(amount) as amount, MONTHNAME(date) as month 
          	  FROM sale WHERE MONTHNAME(date)='$month'";
		
		$localReports[] = $database->execute_query($query, true);
		
		$query = "SELECT sum(amount) as amount, WEEK(date) as week 
          FROM sale WHERE WEEK(date) =$week";
		
		$localReports[] = $database->execute_query($query, true);
				
		return $localReports;
		
		
	}
	
	/**
	* redirect method Redirects to a specified location
	* @param string $location Location to redirect to relatively
	*/

	 function redirect($location = NULL){
		if($location != NULL){
		header("Location:$location");
		exit();
		}
	}
	
	
	/**
	* mysql_date method Format Date and Time for Database insertion
	* @param string $date Date to Format
	* @param string $time Time to Format
	* @return string
	*/
	
	 function mysql_date($date = NULL, $time = ""){
		return strftime("%Y-%m-%d $time", strtotime($date));	
	}
	
	/**
	* date_display method Format Date and Time for Display
	* @param string $date Date to Format
	* @return string
	*/
	
	 function date_display($date = NULL){
		
		return strftime("%b %d, %Y", strtotime($date));
	}

	
	
	/**
	* flash_message method Display saved SESSION messages
	* @param string $msg Message to display
	* @return string
	*/
	
	function flash_message($msg){
		if($msg != ""){
		return "<div  class='flashMessage'><p>$msg</p></div>";
		}else{
		return "";
		}
	}
	
	/**
	* flash_warning method Display saved SESSION warning message
	* @param string $msg Warning Message to display
	* @return string
	*/
	function flash_warning($msg){
		if($msg != ""){
		return "<div  class='flashWarning'><p>$msg</p></div>";
		}else{
		return "";
		}
	}
?>