<?php 
	include_once('config.php'); 
	global $session;if(!$session->isLoggedIn()) 
	redirect('login.php');
	$title = "New Activity";

?>
<?php if($session->userPosition() == 'sales'): ?>
<?php include_once ('templates/_salesheader.php');?>
<?php elseif($session->userPosition() == 'nm'):?>
<?php include_once ('templates/_nmheader.php');?>
<?php include_once ('templates/_nmsidenav.php');?>
<?php endif;?>
<?php echo flash_message($session->getMessage()) ?>

<section id="forms">
<p>Edit Activity</p>
<form action="form/processactivity.php" method="post">
<fieldset>
<p><label>Activity</label><input type="text" name="activity[name]" value="" autofocus="autofocus" required="required" /></p>
<p><label>Monthly Fee(GBP)</label><input type="text" name="activity[monthlyfee]" value="" required="required" /></p>
<p><input class="submit" type="submit" name="submit" value="Submit" /></p>
</fieldset>
</form>
</section>
<?php if($session->userPosition() == 'sales'): ?>
<?php include_once ('templates/_salesfooter.php');?>
<?php elseif($session->userPosition() == 'nm'):?>
<?php include_once ('templates/_nmfooter.php');?>
<?php endif;?>
