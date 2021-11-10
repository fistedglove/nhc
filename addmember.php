<?php 
	include_once ('config.php');
	global $database;
	global $session;
	$title = "Register Member";
?>

<?php if($session->userPosition() == 'sales'): ?>
<?php include_once ('templates/_salesheader.php');?>
<?php elseif($session->userPosition() == 'nm'):?>
<?php include_once ('templates/_nmheader.php');?>
<?php include_once ('templates/_nmsidenav.php');?>
<?php endif;?>

<section id="forms">
<p class="formHeading">Member Details</p>
<form action="form/loginreg.php" onSubmit="return validatePass()" method="post"> 
<fieldset>
<p><label>Title</label>
<select name="member[title]" id = "title" autofocus = "autofocus">
<option value="">Title</option>
<option value="mr">Mr</option>
<option value="mrs">Mrs</option>
<option value="miss">Miss</option>
</select>
</p>
<p><label>First Name</label><input type="text" name="member[firstname]" value=""  required="required" /></p>
<p><label>Last Name</label><input type="text" name="member[lastname]" value="" required="required" /></p>
<p><label>Date Of Birth</label><input type="text" name="member[dob]" id="date" value="" /></p>
<p><label>Gender</label><input class="radio" type="radio" name="member[gender]" value="male"/>Male
<input class="radio" type="radio" name="member[gender]" value="female"/> Female</p>
<p>
<label>Marital Status</label>
<select name="member[maritalstatus]">
<option value="">Marital Status</option>
<option value="single">Single</option>
<option value="married">Married</option>
<option value="divorced">Divorced</option>
<option value="separated">Separated</option>
</select>
</p>
<p><label>Email</label><input type="email" name="member[email]" value="" required="required" /></p>
<p><label>Address Line 1</label><input type="text" name="member[address]" value="" required="required" /></p>
<p><label>Address Line 2</label><input type="text" name="member[addressline]" value="" /></p>
<p><label>Post Code</label><input type="text" name="member[postcode]" value="" required="required" /></p>
<p><label>Mobile No.</label><input type="text" name="member[mobileno]" value="" required="required" /></p>
<p><input class="submit" type="submit" name="submit" value="Submit" /></p>
</fieldset>
</form>
</section>

<?php if($session->userPosition() == 'sales'): ?>
<?php include_once ('templates/_salesfooter.php');?>
<?php elseif($session->userPosition() == 'nm'):?>
<?php include_once ('templates/_nmfooter.php');?>
<?php endif;?>
