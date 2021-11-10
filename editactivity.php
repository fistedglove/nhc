<?php 
	include_once('config.php'); 
	global $session;
	global $database;
	if(!$session->isLoggedIn()) 
	redirect('login.php');

	if(isset($_GET['id'])){
		
	$id = $_GET['id'];
	
	$activity = $database->find_by_column('activity', 'id', array(':id'=>$id));		
	}
$title = "Edit Activities";
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
<input type="hidden" name="editactivity[id]" value="<?php echo $id;?>" />
<p><label>Activity</label><input type="text" name="editactivity[name]" value="<?php echo $activity[0]->name?>" autofocus="autofocus" required="required" /></p>
<p><label>Monthly Fee(GBP)</label><input type="text" name="editactivity[monthlyfee]" value="<?php echo $activity[0]->monthlyfee?>" required="required" /></p>
<p><input class="submit" type="submit" name="submit" value="Update" /></p>
</fieldset>
</form>
</section>
<?php if($session->userPosition() == 'sales'): ?>
<?php include_once ('templates/_salesfooter.php');?>
<?php elseif($session->userPosition() == 'nm'):?>
<?php include_once ('templates/_nmfooter.php');?>
<?php endif;?>
