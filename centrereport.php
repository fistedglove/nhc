<?php 
	include_once('config.php'); 
	global $session;
	global $database;
	
	if($session->userPosition()!= 'nm' || !$session->isLoggedIn()){
	$session->setWarning("You are not permittted to view that page!"); 
	redirect('index.php');
	}

	if($_GET['id']){
	
 	$id = $_GET['id'];	
	
	$centre = $database->find_by_column('centre','id', array(':id'=>$id));
	}
	
	$reports = getReport($centre[0]->wsdladdress);
	
	$report0 = $reports[0];
	$report1 = $reports[1];
	$report2 = $reports[2];
	$report3 = $reports[3];	
	$report4 = $reports[4];
	$report5 = $reports[5];	

	$title = "Centres Reports";
?>
<?php include_once ('templates/_nmheader.php');?>
<?php include_once ('templates/_nmsidenav.php');?>

<section id="mainContent">
<h2 class="report"><?php echo ucwords($centre[0]->name)?> Summary Reports</h2>
<div id="reportTabs">
<ul>
<li id="monMem"><a href="#monMem">M/Booking</a>
<div>
<table class="bookingReport">
<caption>Monthly Membership Report</caption>
<thead>
<tr>
<th>Month</th>
<th>Membership</th>
</tr>
</thead>
<tbody>
<?php foreach($report2 as $member):?>
<tr>
<td><?php echo $member['month']?></td>
<td><?php echo $member['membership']?></td>
</tr>
<?php endforeach?>
</tbody>
</table>
</div>
</li>
<li id="weekMem"><a href="#weekMem">W/Member</a>
<div>
<table class="bookingReport">
<caption>Weekly Membership Report</caption>
<thead>
<tr>
<th>Week</th>
<th>Membership</th>
</tr>
</thead>
<tbody>
<?php foreach($report3 as $member):?>
<tr>
<td><?php echo $member['week']?></td>
<td><?php echo $member['membership']?></td>
</tr>
<?php endforeach?>
</tbody>
</table>

</div>
</li>

<li id="monthly"><a href="#monthly">M/Booking</a>
<div>
<table class="bookingReport">
<caption>Monthly Bookings Report</caption>
<thead>
<tr>
<th>Month</th>
<th>Bookings</th>
<th>Total Fee</th>
<th>Avg Fee</th>
</tr>
</thead>
<tbody>
<?php foreach($report0 as $booking):?>
<tr>
<td><?php echo $booking['month']?></td>
<td><?php echo $booking['booking']?></td>
<td><?php echo $booking['fee']?></td>
<td><?php echo round($booking['avg'], 2)?></td>
</tr>
<?php endforeach?>
</tbody>
</table>
</div>
</li>
<li id="weekly"><a href="#weekly">W/Booking</a>
<div>
<table class="bookingReport">
<caption>Weekly Bookings Report</caption>
<thead>
<tr>
<th>Week</th>
<th>Bookings</th>
<th>Total Fee</th>
<th>Avg Fee</th>

</tr>
</thead>
<tbody>
<?php foreach($report1 as $booking):?>
<tr>
<td><?php echo $booking['week']?></td>
<td><?php echo $booking['booking']?></td>
<td><?php echo $booking['fee']?></td>
<td><?php echo round($booking['avg'], 2)?></td>
</tr>
<?php endforeach?>
</tbody>
</table>

</div>
</li>

<li id="monSales"><a href="#monSales">M/Sales</a>
<div>
<table class="bookingReport">
<caption>Monthly Item Sales Report</caption>
<thead>
<tr>
<th>Week</th>
<th>Total Amount</th>
<th>Avg Amount</th>
</tr>
</thead>
<tbody>
<?php foreach($report4 as $sale):?>
<tr>
<td><?php echo $sale['month']?></td>
<td><?php echo $sale['amount']?></td>
<td><?php echo round($sale['avg'], 2)?></td>
</tr>
<?php endforeach?>
</tbody>
</table>
</div>
</li>

<li id="weekSales"><a href="#weekSales">W/Sales</a>
<div>
<table class="bookingReport">
<caption>Weekly Item Sales Report</caption>
<thead>
<tr>
<th>Week</th>
<th>Total Amount</th>
<th>Avg Amount</th>
</tr>
</thead>
<tbody>
<?php foreach($report5 as $sale):?>
<tr>
<td><?php echo $sale['week']?></td>
<td><?php echo $sale['amount']?></td>
<td><?php echo round($sale['avg'], 2)?></td>
</tr>
<?php endforeach?>
</tbody>
</table>
</div>
</li>
</ul>
</div>
</section>

<?php include_once ('templates/_nmfooter.php');?>

