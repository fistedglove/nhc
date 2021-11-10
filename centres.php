<?php 
	include_once('config.php'); 
	global $session;
	global $database;
	if($session->userPosition()!= 'nm' || !$session->isLoggedIn()){
	$session->setWarning("You are not permittted to view that page!"); 
	redirect('index.php');
	}

	$centres =  $database->find_all('centre');

	$title = "Centres";
?>

<?php include_once ('templates/_nmheader.php');?>
<?php include_once ('templates/_nmsidenav.php');?>

<?php
 if($session->getMessage())
{echo flash_message($session->getMessage());
}elseif($session->getWarning())
{echo flash_warning($session->getWarning());} 
?>

<section id="bookingTable<?php echo $session->userPosition();?>">
<table class="staffTbl">
<caption>Centres Details</caption>
<thead>
<tr>
<th>Centre Name</th>
<th>Address</th>
<th>Post Code</th>
<th>Telphone</th>
</tr>
</thead>
<tbody>
<?php foreach($centres as $centre):?>
<tr>
<td><a href="centrereport.php?id=<?php echo $centre->id?>#monMem" title="Click to View Report"><?php echo ucwords($centre->name)?></a></td>
<td><?php echo $centre->address;?></td>
<td><?php echo $centre->postcode;?></td>
<td><?php echo $centre->telephoneno?></td>
</tr>
<?php endforeach;?>
</tbody>
</table>
</section>

<?php include_once ('templates/_nmfooter.php');?>