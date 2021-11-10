<?php 
	include_once('config.php'); 
	global $session;
	global $database;
	if($session->userPosition()!= 'nm' || !$session->isLoggedIn()){
	$session->setWarning("You are not permittted to view this page!"); 
	redirect('index.php');
	}

	$centres = $database->find_all('centre');
	
	$reports = array();
	
	if(!empty($_POST)){
			
	!empty($_POST['month']) ? $month = trim($_POST['month']): $month = "";	
	!empty($_POST['week']) ? $week = intval(trim($_POST['week'])): $week = "";	
	
		if($month != "" && $week!=""){
			
		foreach($centres as $centre)
		$reports[] = getReport($centre->wsdladdress, $month, $week);
		$reports[] = getLocalReport($month, $week);
		
		}elseif($month != ""){
		foreach($centres as $centre)
		$reports[] = getReport($centre->wsdladdress, $month, strftime("%U", time()));
		$reports[] = getLocalReport($month, strftime("%U", time()));
			
		}elseif($week!=""){
		foreach($centres as $centre)
		$reports[] = getReport($centre->wsdladdress, strftime("%B", time()), $week);
		$reports[] = getLocalReport(strftime("%B", time()), $week);				
		}else{
			
		$month = "";
		$week = "";
		foreach($centres as $centre)
		$reports[] = getReport($centre->wsdladdress, strftime("%B", time()), strftime("%U", time()));	
		$reports[] = getLocalReport(strftime("%B", time()), strftime("%U", time()));
		
		}
		
	}else{	
	
	$month = "";
	$week = "";

	foreach($centres as $centre)
	$reports[] = getReport($centre->wsdladdress, strftime("%B", time()), strftime("%U", time()));	
	$reports[] = getLocalReport(strftime("%B", time()), strftime("%U", time()));
	}
	
	$sumMonBooking['fee'] = 0;
	$sumMonBooking['booking'] = 0;
	$sumWeekBooking['fee'] = 0;
	$sumWeekBooking['booking'] = 0;
	$sumWeekMembership['membership'] = 0;
	$sumMonMembership['membership'] = 0;
	$sumMonSales['amount'] = 0;
	$sumWeekSales['amount'] = 0;
	
	$monBooking;	
	$weekBooking;
	$monMembership;
	$weekMembership;
	$monSale;
	$weekSale;

	foreach($reports as $centreReport){
		
	$monBooking = $centreReport[0];	
	$weekBooking = $centreReport[1];
	$monMembership = $centreReport[2];
	$weekMembership = $centreReport[3];	
	$monSale = $centreReport[4];
	$weekSale = $centreReport[5];
	
	foreach($monBooking as $value){
	$sumMonBooking['fee'] += $value['fee'];
	$sumMonBooking['booking'] += $value['booking'];
	}			
	
	foreach($weekBooking as $value){
	$sumWeekBooking['fee'] += $value['fee'];
	$sumWeekBooking['booking'] += $value['booking'];
	}
	
	foreach($monMembership as $value){
	$sumMonMembership['membership'] += $value['membership'];	
	}
	
	foreach($weekMembership as $value){
	$sumWeekMembership['membership'] += $value['membership'];
		
	}
	
	foreach($monSale as $value){
	$sumMonSales['amount'] += $value['amount'];	
	}
	
	foreach($weekSale as $value){
	$sumWeekSales['amount'] += $value['amount'];
	}
  }

$title = "National Reports";
	
?>
<?php include_once ('templates/_nmheader.php');?>
<?php include_once ('templates/_nmsidenav.php');?>


<section id="mainContent">
<h2 class="report">National Reports</h2>
<div class="reportFilter">
<form action="nationalreport.php#monMem" method="post">
<fieldset>
<p>
<label>Month</label>&nbsp;&nbsp;<input type="text" name="month" id="month" value =""  placeholder="Enter The Month Name"/>&nbsp;&nbsp;&nbsp;&nbsp;
<label>Week</label>&nbsp;&nbsp;<input type="text" name="week" id="week" value =""  placeholder="Enter The Week No."/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" value="Search" />
</p>
</fieldset>
</form>
</div>

<div id="reportTabs">
<ul>
<li id="monMem"><a href="#monMem">M/Members</a>
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
<tr>
<td><?php if($month != "") echo $month; else echo strftime("%B", time()); ?></td>
<td><?php echo $sumMonMembership['membership']?></td>
</tr>
</tbody>
</table>
</div>
</li>
<li id="weekMem"><a href="#weekMem">W/Members</a>
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
<tr>
<td><?php if($week != "") echo $week; else echo strftime("%U", time()); ?></td>
<td><?php echo $sumWeekMembership['membership']?></td>
</tr>
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
</tr>
</thead>
<tbody>
<tr>
<td><?php if($month != "") echo $month; else echo strftime("%B", time()); ?></td>
<td><?php echo $sumMonBooking['booking']?></td>
<td><?php echo $sumMonBooking['fee']?></td>
</tr>
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
</tr>
</thead>
<tbody>
<tr>
<td><?php if($week != "") echo $week; else echo strftime("%U", time()); ?></td>
<td><?php echo $sumWeekBooking['booking']?></td>
<td><?php echo $sumWeekBooking['fee']?></td>
</tr>
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
</tr>
</thead>
<tbody>
<tr>
<td><?php if($month != "") echo $month; else echo strftime("%B", time()); ?></td>
<td><?php echo $sumMonSales['amount']?></td>
</tr>
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
</tr>
</thead>
<tbody>
<tr>
<td><?php if($week != "") echo $week; else echo strftime("%U", time()); ?></td>
<td><?php echo $sumWeekSales['amount']?></td>
</tr>
</tbody>
</table>
</div>
</li>
</ul>
</div>
</section>

<?php if($session->userPosition() == 'sales'): ?>
<?php include_once ('templates/_salesfooter.php');?>
<?php elseif($session->userPosition() == 'nm'):?>
<?php include_once ('templates/_nmfooter.php');?>
<?php endif;?>
