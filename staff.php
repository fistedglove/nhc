<?php 
	include_once ('config.php');
	global $database;
	global $session;
	if($session->userPosition()!= 'nm' || !$session->isLoggedIn()){
	$session->setWarning("You are not permittted to view that page!"); 
	redirect('index.php');
	}
	
	$query = "SELECT title, firstname, lastname, count(staffid) as bookings, sum(totalfee) as fee FROM `staff` left join booking
	 		  on staff.id =booking.staffid GROUP BY staff.id";
	
	$bookings =  $database->execute_query($query, true);
	
	$query = "SELECT staff.title, staff.firstname, staff.lastname, count(staffid) as member FROM `staff` left join member
	 		  on staff.id =member.staffid GROUP BY staff.id";
	
	$members =  $database->execute_query($query, true);
	
	$query = "SELECT title, firstname, lastname, sum(amount) as amount FROM `staff` left join sale on staff.id = sale.staffid GROUP BY staff.id";
	$sales = $database->execute_query($query, true);

	$newArray = array();
	foreach($bookings as $booking){
		
	  foreach($members as $member){	
	   
		foreach($sales as $sale){		
		if($booking['lastname'] == $sale['lastname'] && $booking['firstname'] == $sale['firstname']&& $booking['firstname'] == $member['firstname']
		&& $booking['lastname'] == $member['lastname'])
		$newArray[] = array_merge($booking, $member,$sale);
		}
	  }	
	}
	
	$title = "Staff Sales Statistics";
?>

<?php include_once ('templates/_nmheader.php');?>
<?php include_once ('templates/_nmsidenav.php');?>

<?php if($session->getMessage())
{echo flash_message($session->getMessage());
}elseif($session->getWarning())
{echo flash_warning($session->getWarning());} ?>

<section id="bookingTable<?php echo $session->userPosition();?>">
<table class="staffTbl">
<caption>Staff Statistics</caption>
<thead>
<tr>
<th>First Name </th>
<th>Last Name</th>
<th>Memberships</th>
<th>Bookings</th>
<th>Bookings Total Fee</th>
<th>Item Sales Total Amount</th>
</tr>
</thead>
<tbody>
<?php foreach($newArray as $staff):?>
<tr>
<td><?php echo $staff['firstname'];?></td>
<td><?php echo $staff['lastname'];?></td>
<td><?php echo $staff['member'];?></td>
<td><?php echo $staff['bookings'];?></td>
<td><?php isset($staff['fee'])? print $staff['fee']: print 0;?></td>
<td><?php isset($staff['amount'])?print $staff['amount']: print 0;?></td></tr>
<?php endforeach;?>
</tbody>
</table>
<p class="addStaff"><a href="addstaff.php">Add Staff</a></p>
</section>

<?php include_once ('templates/_nmfooter.php');?>

