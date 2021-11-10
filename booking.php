<?php 
	include_once ('config.php');
	global $database;
	global $session;

	$query = "SELECT booking.id as id, totalfee, member.firstname as cfn, member.lastname as cln, staff.firstname as sfn, staff.lastname as sln,
			 name, bookingdate, startdate, monthduration FROM member, staff, activity, booking WHERE booking.memberid = member.id AND 
			 booking.staffid = staff.id AND booking.activityid = activity.id";

	$bookings = $database->find_by_query($query);
	$perPage = 4;
	$currentPage = !empty($_GET['page']) ? $_GET['page'] : 1;
	$rowCount = count($bookings);
	$pagination = new Pagination($perPage, $currentPage, $rowCount);


	$query = "SELECT booking.id as id, totalfee, member.firstname as cfn, member.lastname as cln, staff.firstname as sfn, staff.lastname as sln,
			 name, bookingdate, startdate, monthduration FROM member, staff, activity, booking WHERE booking.memberid = member.id AND
			 booking.staffid=staff.id AND booking.activityid = activity.id ORDER BY bookingdate DESC LIMIT $perPage OFFSET ".$pagination->offSet();

	$bookings =  $database->find_by_query($query);
	
	$title = "Activities Bookings";
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
<table class="bookingTbl">
<caption>Activity Booking</caption>
<thead>
<tr>
<th>Member Name</th>
<th>Activity</th>
<th>Booking Date</th>
<th>Start Date</th>
<th>Duration</th>
<th>Fee</th>
<th> Staff Name</th>
<th>Task</th>
</tr>
</thead>
<tbody>
<?php foreach($bookings as $booking):?>
<tr>
<td><?php echo $booking->cfn.' '.$booking->cln?></td>
<td><?php echo $booking->name?></td>
<td><?php echo date_display($booking->bookingdate)?></td>
<td><?php echo date_display($booking->startdate)?></td>
<td><?php echo $booking->monthduration?></td>
<td><?php echo $booking->totalfee?></td>
<td><?php echo $booking->sfn.' '.$booking->sln?></td>
<td><a href="editbooking.php?id=<?php echo $booking->id;?>">Edit</a> | <a onclick="return confirm('Do You want to delete this booking entry?');" href="form/deletebooking.php?id=<?php echo $booking->id?>">Delete</a></td>
</tr>
<?php endforeach;?>
</tbody>
</table>
<div id="pagination">
<?php if($pagination->totalPages()>1){
	
	if($pagination->hasPrevious()){
		echo '<p><a href ="booking.php?page=1">&lt;first</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="booking.php?page='.
		$pagination->prevPage().'">&lt;&lt;previous</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';	
		}else{echo '<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';}
		
		if($pagination->hasNext()){
		echo '<a href ="booking.php?page='.$pagination->nextPage().'">next &gt;</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="booking.php?page='.
		$pagination->totalPages().'">last &gt;&gt;</a></p>';
		
		}else{ echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>';}
	}
?>
</div>
</section>

<?php if($session->userPosition() == 'sales'): ?>
<?php include_once ('templates/_salesfooter.php');?>
<?php elseif($session->userPosition() == 'nm'):?>
<?php include_once ('templates/_nmfooter.php');?>
<?php endif;?>
