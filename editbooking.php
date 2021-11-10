<?php 

	include_once('config.php'); 
	global $session;
	global $database;
	if(!$session->isLoggedIn()) 
	redirect('login.php');

	if($_GET['id']){
    
    $id = $_GET['id'];
    $query = "SELECT booking.id as id, totalfee, monthlyfee, member.firstname as cfn, member.lastname as cln,  name, 
              startdate, monthduration FROM member, activity, booking WHERE booking.memberid = member.id AND 
              booking.activityid = activity.id AND booking.id =$id"; 
            
    $booking = $database->find_by_query($query);  
	}

	$title = "Edit Booking";
	
?>
	<?php if($session->userPosition() == 'sales'): ?>
	<?php include_once ('templates/_salesheader.php');?>
	<?php elseif($session->userPosition() == 'nm'):?>
	<?php include_once ('templates/_nmheader.php');?>
	<?php include_once ('templates/_nmsidenav.php');?>
	<?php endif;?>

<section id="bookingForm">
<p>Edit Booking Details</p>
<form action="form/processbooking.php" method="post">
<fieldset>
<input type="hidden" name="editbooking[id]" value="<?php echo $id;?>"/>
<p>
<label>Member Name</label><input type="text" onfocus="blur()" name="editbooking[membername]" value="<?php echo $booking[0]->cfn.' '.$booking[0]->cln;?>" />
</p>
<p>
<label>Activity</label><input type="text" onfocus="blur()" name="editbooking[activityname]" value="<?php echo $booking[0]->name;?>" />
</p>
<p><label>Start Date</label><input type="text" name="editbooking[startdate]" id="date" value="<?php echo date_display($booking[0]->startdate);?>" required="required" /></p>
<p><label>Monthly Fee</label><input type="text" name="editbooking[montlyfee]" id="monthlyfee" onfocus="blur()" value="<?php echo $booking[0]->monthlyfee;?>" required="required" /></p>
<p><label>Duration (Months)</label><input type="text" name="editbooking[monthduration]" id="duration" value="<?php echo $booking[0]->monthduration;?>" onblur="setFee()" required="required" /></p>
<p><label>Total Fee</label><input type="text" id="totalfee" name="editbooking[totalfee]" onfocus="blur()" value="<?php echo $booking[0]->totalfee;?>" required="required" /></p>
<p><input class="submit" type="submit" name="submit" value="Submit" /></p>
</fieldset>
</form>
</section>

<?php if($session->userPosition() == 'sales'): ?>
<?php include_once ('templates/_salesfooter.php');?>
<?php elseif($session->userPosition() == 'nm'):?>
<?php include_once ('templates/_nmfooter.php');?>
<?php endif;?>
