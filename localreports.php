<?php 
		include_once('config.php'); 
		global $session;
		global $database;
		if($session->userPosition()!= 'nm' || !$session->isLoggedIn()){
		$session->setWarning("You are not permittted to view that page!"); 
		redirect('index.php');
		}

		$query = "SELECT MONTHNAME(bookingdate) as month, sum(totalfee) as fee, avg(totalfee) as avg, count(activity.name) as category, 
				  activity.name FROM booking, activity 
				  WHERE booking.activityid = activity.id GROUP BY MONTH(bookingdate), activityid";
		
		$monReports = $database->find_by_query($query);

		$query = "SELECT WEEK(bookingdate) as week, sum(totalfee) as fee, avg(totalfee) as avg, count(activity.name) as category, 
				  activity.name FROM booking, activity 
				  WHERE booking.activityid = activity.id GROUP BY WEEK(bookingdate), activityid";

		$weekReports = $database->find_by_query($query);

		$query = "SELECT MONTHNAME(signupdate) as month, count(*) as membership
                  FROM member GROUP BY MONTH(signupdate)";
		
		$monMemberships = $database->find_by_query($query);
		
		$query = "SELECT WEEK(signupdate) as week, count(*) as membership
                  FROM member GROUP BY WEEK(signupdate)";
		
		$weekMemberships = $database->find_by_query($query);
		
		
		$query = "SELECT sum(amount) as amount, avg(amount) as avg, MONTHNAME(date) as month 
				  FROM `sale` GROUP BY MONTH(date)";
		
		$monSales = $database->find_by_query($query);
		
		$query = "SELECT sum(amount) as amount, avg(amount) as avg, WEEK(date) as week 
				  FROM `sale` GROUP BY WEEK(date)";
		
		$weekSales = $database->find_by_query($query);
		
		$title = "Local Reports";
?>

<?php include_once ('templates/_nmheader.php');?>
<?php include_once ('templates/_nmsidenav.php');?>


<section id="mainContent">
<h2 class="report">Local Reports</h2>
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
<?php foreach($monMemberships as $monMembership):?>
<tr>
<td><?php echo $monMembership->month?></td>
<td><?php echo $monMembership->membership?></td>
</tr>
<?php endforeach?>
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
<?php foreach($weekMemberships as $weekMembership):?>
<tr>
<td><?php echo $weekMembership->week?></td>
<td><?php echo $weekMembership->membership?></td>
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
<th>Activity</th>
<th>Bookings</th>
<th>Total Fee</th>
<th>Avg Fee</th>
</tr>
</thead>
<tbody>
<?php foreach($monReports as $report):?>
<tr>
<td><?php echo $report->month?></td>
<td><?php echo $report->name?></td>
<td><?php echo $report->category?></td>
<td><?php echo $report->fee?></td>
<td><?php echo round($report->avg, 2)?></td>
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
<th>Activity</th>
<th>Bookings</th>
<th>Total Fee</th>
<th>Avg Fee</th>
</tr>
</thead>
<tbody>
<?php foreach($weekReports as $report):?>
<tr>
<td><?php echo $report->week?></td>
<td><?php echo $report->name?></td>
<td><?php echo $report->category?></td>
<td><?php echo $report->fee?></td>
<td><?php echo round($report->avg, 2)?></td>
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
<th>Month</th>
<th>Total Amount</th>
<th>Average Amount</th>
</tr>
</thead>
<tbody>
<?php foreach($monSales as $sale):?>
<tr>
<td><?php echo $sale->month?></td>
<td><?php echo $sale->amount?></td>
<td><?php echo round($sale->avg, 2)?></td>
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
<th>Average Amount</th>
</tr>
</thead>
<tbody>
<?php foreach($weekSales as $sale):?>
<tr>
<td><?php echo $sale->week?></td>
<td><?php echo $sale->amount?></td>
<td><?php echo round($sale->avg, 2)?></td>
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

