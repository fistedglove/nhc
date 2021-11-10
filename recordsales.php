<?php 
	include_once('config.php'); 
	global $session;if(!$session->isLoggedIn()) 
	redirect('login.php');
	$title = "New Item Sale";
?>
<?php if($session->userPosition() == 'sales'): ?>
<?php include_once ('templates/_salesheader.php');?>
<?php elseif($session->userPosition() == 'nm'):?>
<?php include_once ('templates/_nmheader.php');?>
<?php include_once ('templates/_nmsidenav.php');?>
<?php endif;?>
<?php echo flash_message($session->getMessage()) ?>

<section id="forms">
<p>Record Item Sales</p>
<form action="form/processsales.php" method="post">
<fieldset>
<p><label>Item Name</label><input type="text" name="sales[itemname]" value="" autofocus="autofocus" required="required" /></p>
<p><label>Price(GBP)</label><input type="text" name="sales[price]" id="price" value="" required="required" /></p>
<p><label>Quantity</label><input type="text" name="sales[quantity]" id="quantity" onBlur="setAmount();" value="" required="required" /></p>
<p><label>Amount(GBP)</label><input type="text" name="sales[amount]" id="amount" onFocus="blur()" value="" required="required" /></p>
<p><input class="submit" type="submit" name="submit" value="Submit" /></p>
</fieldset>
</form>
</section>
<?php if($session->userPosition() == 'sales'): ?>
<?php include_once ('templates/_salesfooter.php');?>
<?php elseif($session->userPosition() == 'nm'):?>
<?php include_once ('templates/_nmfooter.php');?>
<?php endif;?>
