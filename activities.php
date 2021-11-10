<?php 
	include_once ('config.php');
	global $database;
	global $session;
	
	$activities = $database->find_all('activity');
	$title = "Club Activities";
?>

<?php if($session->userPosition() == 'sales'): ?>
<?php include_once ('templates/_salesheader.php');?>
<?php elseif($session->userPosition() == 'nm'):?>
<?php include_once ('templates/_nmheader.php');?>
<?php include_once ('templates/_nmsidenav.php');?>
<?php endif;?>

<?php 
if($session->getMessage())
{echo flash_message($session->getMessage());
}elseif($session->getWarning())
{echo flash_warning($session->getWarning());} 
?>

<section id="bookingTable<?php echo $session->userPosition();?>">
<table class="activityTbl">
<caption>Activities</caption>
<thead>
<tr>
<th>Activity</th>
<th>Monthly Fee</th>
<th>Task</th>
</tr>
</thead>
<tbody>
<?php foreach($activities as $activity):?>
<tr>
<td><?php echo ucfirst($activity->name); ?></td>
<td><?php echo $activity->monthlyfee?></td>
<td><a href="editactivity.php?id=<?php echo $activity->id;?>">Edit</a> | <a onclick="return confirm('Do You want to delete this activity entry?');" href="form/processactivity.php?id=<?php echo $activity->id?>">Delete</a></td>
</tr>
<?php endforeach;?>
</tbody>
</table>
<p class="newActivity"><a href="newactivity.php">New Activity</a></p>
</section>

<?php if($session->userPosition() == 'sales'): ?>
<?php include_once ('templates/_salesfooter.php');?>
<?php elseif($session->userPosition() == 'nm'):?>
<?php include_once ('templates/_nmfooter.php');?>
<?php endif;?>
