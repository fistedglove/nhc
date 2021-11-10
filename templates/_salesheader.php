<?php include_once ('config.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title><?php echo $title;?></title>
<link rel="stylesheet" href="stylesheet/main.css" type="text/css" />
<link href="stylesheet/jsDatePick_ltr.min.css"  rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="script/jsDatePick.min.1.3.js"></script>
<script type="text/javascript" src="script/displayreg.js"></script>
<script type="text/javascript" src="script/jquery.js"></script>
<script type="text/javascript">
<!--
//This Scipt is meant to get the monthly fee for a selected Activity type from the Database Activity table

$(document).ready(function()//Call Jquery Ready function when DOM is ready
{
$("#activityid").change(function() ////Call function when an option is selected in the select field.
{ 

var activityid = $("#activityid option:selected").val();//Get the option value of the Activity Select field

if(activityid)//If the user selected an option in the Select field
{

//Make the Ajax Request
$.ajax({  
    type: "POST",  
    url: "form/ajaxbooking.php",  //the validation file name
    data: "activityid="+ activityid,  //Request data
    success: function(response){  
    
    $("#monthlyfee").val(response);// Set the monthly Fee input field value to the value return from Ajax
     
   } 
   
  }); 

}

return false;
});

});

//-->
</script>

</head>

<body>
<div id="wrapper">
<header id="mainHeading">
<hgroup>
<h1><a href="index.php">National Health Club HQ</a></h1>
<h2>Your Fitness is Our Concern</h2>
</hgroup>
    <nav id="topNav">
        <ul>
        <li><a href="members.php">Members</a></li>
        <li><a href="booking.php">Bookings</a></li>
        <li><a href="addmember.php">New Member</a></li>
        <li><a href="recordbooking.php">New Booking</a></li>
        <li><a href="activities.php">Activities</a></li>
        <li><a href="recordsales.php" class="last">Cafe</a></li>
        <?php if($session->isLoggedIn()):
      	echo '<li><a href=logout.php onClick ="return confirm(\'Do you want to log out?\')";>Log Out</a></li>';
		?> 
       <?php  else: 
       echo "<li><a href=login.php>Log In</a></li>";
	   ?>
       <?php endif; ?>
        </ul>
    </nav>
</header>