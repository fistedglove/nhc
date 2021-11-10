<?php $title = "Login"; 
include_once('templates/_header.php');
if($session->isLoggedIn()) 
    redirect('index.php');
?>

<?php
 if($session->getMessage())
{echo flash_message($session->getMessage());
}elseif($session->getWarning())
{echo flash_warning($session->getWarning());} 
?>

<section id="loginForm">
<p>Authorised User Login</p>
<form action="form/loginreg.php" method="post">
<fieldset>
<p><label>Username</label><input type="text" name="login[username]" autofocus="autofocus" required="required" value="" placeholder="username" /></p>
<p><label>Password</label><input type="password" name="login[password]" required="required" value="" placeholder="password" /></p>
<p><input class="submit" type="submit" name="submit" value="Submit" /></p>
</fieldset>
</form>
</section>

<?php include_once('templates/_footer.php');?>
