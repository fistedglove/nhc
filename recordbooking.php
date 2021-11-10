<?php 
	include_once('config.php'); 
	global $session;
	if(!$session->isLoggedIn()) 
	redirect('login.php');
	
	$members = $database->find_all('member');
	
	$activities = $database->find_all('activity');
	
	$title = "New Activity Booking";

?>
<?php if($session->userPosition() == 'sales'): ?>
<?php include_once ('templates/_salesheader.php');?>
<?php elseif($session->userPosition() == 'nm'):?>
<?php include_once ('templates/_nmheader.php');?>
<?php include_once ('templates/_nmsidenav.php');?>
<?php endif;?>

<section id="bookingForm">
<p>Record Booking Details</p>
<form action="form/processbooking.php" method="post">
<fieldset>
<input type="hidden" name="id" value=""/>
<input type="hidden" name="bookingdate" value=""/>
<input type="hidden" name="staffid" value=""/>
<p>
<label>Member Name</label>
<select name="booking[memberid]">
<option value="">Full Name</option>
<?php foreach($members as $member):?>
<option value="<?php echo $member->id;?>"><?php echo $member->firstname.' '.$member->lastname;?></option>
<?php endforeach;?>
</select>
</p>
<p>
<label>Activity</label>
<select name="activityid" id="activityid">
<option value="">Activity</option>
<?php foreach($activities as $activity):?>
<option value="<?php echo $activity->id;?>"><?php echo $activity->name;?></option>
<?php endforeach;?>
</select>
</p>
<p><label>Monthly Fee(GBP)</label><input type="text" id="monthlyfee" name="booking[monthlyfee]" value="" required="required" /></p>
<p><label>Start Date</label><input type="text" name="booking[startdate]" id="date" value="" required="required" /></p>
<p><label>Duration (Months)</label><input type="text" name="booking[monthduration]" id="duration" onblur="setFee()" value="" required="required" /></p>
<p><label>Total Fee(GBP)</label><input type="text" name="booking[totalfee]" onFocus="blur()" id="totalfee" value="" required="required" /></p>
<p><input class="submit" type="submit" name="submit" value="Submit" /></p>
</fieldset>
</form>
</section>
<?php if($session->userPosition() == 'sales'): ?>
<?php include_once ('templates/_salesfooter.php');?>
<?php elseif($session->userPosition() == 'nm'):?>
<?php include_once ('templates/_nmfooter.php');?>
<?php endif;?>
