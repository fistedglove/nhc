<?php 
	include_once ('config.php');
	global $database;
	global $session;
	
	if($session->userPosition()!= 'nm' || !$session->isLoggedIn()){
	$session->setWarning("You are not permittted to view that page!"); 
	redirect('index.php');
	}
	$title = "New Staff";
?>

<?php include_once ('templates/_nmheader.php');?>
<?php include_once ('templates/_nmsidenav.php');?>

<section id="forms">
<p class="formHeading">Staff Details</p>
<form action="form/loginreg.php" onSubmit="return validatePass()" method="post"> 
<fieldset>
<p><label>Title</label>
<select name="staff[title]" id = "title">
<option value="">Title</option>
<option value="mr">Mr</option>
<option value="mrs">Mrs</option>
<option value="miss">Miss</option>
</select>
</p>
<p><label>First Name</label><input type="text" name="staff[firstname]" value=""  required="required" /></p>
<p><label>Last Name</label><input type="text" name="staff[lastname]" value="" required="required" /></p>
<p><label>Date Of Birth</label><input type="text" name="staff[dob]" id="date" value="" /></p>
<p><label>Gender</label><input class="radio" type="radio" name="staff[gender]" value="male" checked="checked" />Male<input class="radio" type="radio" name="staff[gender]" value="female"/> Female</p>
<p>
<label>Marital Status</label>
<select name="staff[maritalstatus]">
<option value="">Marital Status</option>
<option value="single">Single</option>
<option value="married">Married</option>
<option value="divorced">Divorced</option>
<option value="separated">Separated</option>
</select>
</p>
<p><label>Username</label><input type="text" name="staff[username]" id="username" value="" required="required" /><span id="result"></span></p>
<p><label>Password</label><input type="password" name="staff[password]" id="pass" value="" required /></p>
<p><label>Confirm Password</label><input type="password" name="staff[confirmpassword]" id="conpass" value="" required /></p>
<p><label>Position</label>
<select name="staff[position]">
<option value="">Position</option>
<option value="sales">Sales</option>
<option value="nm">National Manager</option>
</select>
</p>
<p><label>Email</label><input type="email" name="staff[email]" value="" required="required" /></p>
<p><label>Address Line 1</label><input type="text" name="staff[address]" value="" required="required" /></p>
<p><label>Address Line 2</label><input type="text" name="staff[addressline]" value="" /></p>
<p><label>Post Code</label><input type="text" name="staff[postcode]" value="" required="required" /></p>
<p><label>Mobile No.</label><input type="text" name="staff[mobileno]" value="" required="required" /></p>


<p><input class="submit" type="submit" name="submit" value="Submit" /></p>
</fieldset>
</form>
</section>

<?php include_once ('templates/_nmfooter.php');?>
