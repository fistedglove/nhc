<?php  
	include_once('config.php'); 
	global $session;if(!$session->isLoggedIn()) 
	redirect('login.php');
	$title = "Home Page";
?>

<?php if($session->userPosition() == 'sales'): ?>
<?php include_once ('templates/_salesheader.php');?>
<?php elseif($session->userPosition() == 'nm'):?>
<?php include_once ('templates/_nmheader.php');?>
<?php include_once ('templates/_nmsidenav.php');?>
<?php endif;?>


<section id="mainContent">
<?php if($session->getMessage())
{echo flash_message($session->getMessage());
}elseif($session->getWarning())
{echo flash_warning($session->getWarning());} ?>

</section>

<?php if($session->userPosition() == 'sales'): ?>
<?php include_once ('templates/_salesfooter.php');?>
<?php elseif($session->userPosition() == 'nm'):?>
<?php include_once ('templates/_nmfooter.php');?>
<?php endif;?>
