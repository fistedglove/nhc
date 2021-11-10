<?php  
	include_once('config.php'); 
	if(!$session->isLoggedIn()) 
	redirect('login.php');
	global $database;
	global $session;
	
   if(isset($_POST['membersearch'])){
    
   $member = $database->find_by_column('member', 'lastname', array(':lastname'=>trim($_POST['membersearch']))); 
  
	   if(count($member)<1){
		$session->setMessage('Search did not return any result');
		redirect('index.php');
		
	   }elseif(count($member)>1){
		
		$perPage = 1;
		$currentPage = !empty($_GET['page']) ? $_GET['page'] : 1;
		$rowCount = count($members);
		$pagination = new Pagination($perPage, $currentPage, $rowCount);
		
		$query = "SELECT * FROM member WHERE lastname = '{$_POST['membersearch']}' LIMIT $perPage OFFSET ". $pagination->offSet();
		$member =  $database->find_by_query($query);
    
	   }else{
	  
		$perPage = 1;
		$currentPage = !empty($_GET['page']) ? $_GET['page'] : 1;
		$rowCount = count($member);
		$pagination = new Pagination($perPage, $currentPage, $rowCount);
		
		$query = "SELECT * FROM member WHERE lastname = '{$_POST['membersearch']}' LIMIT $perPage OFFSET ". $pagination->offSet();
		$member =  $database->find_by_query($query);
		
		}
 
	}else{

		$members = $database->find_all('member');
		$perPage = 1;
		$currentPage = !empty($_GET['page']) ? $_GET['page'] : 1;
		$rowCount = count($members);
		$pagination = new Pagination($perPage, $currentPage, $rowCount);

		$query = "SELECT * FROM member LIMIT $perPage OFFSET ". $pagination->offSet();
		$member =  $database->find_by_query($query);

	}

	$title = "Club Members";
?>

<?php if($session->userPosition() == 'sales'): ?>
<?php include_once ('templates/_salesheader.php');?>
<?php elseif($session->userPosition() == 'nm'):?>
<?php include_once ('templates/_nmheader.php');?>
<?php include_once ('templates/_nmsidenav.php');?>
<?php endif;?>
<?php echo flash_message($session->getMessage()) ?>

<div id="searchbox">
<form action="members.php" method="post"><p>Search Members</p><input type="text" required placeholder="Last Name" name="membersearch" value="" />
<input type="submit" id="button" value="" /></form>
</div>

<section id="forms">
<p class="formHeading">Club Members</p>

<?php if($member):?>
<form action="form/loginreg.php" method="post">
<fieldset>
<input type="hidden" name="memberupdate[id]" value="<?php echo $member[0]->id;?>" />
<p><label>Title</label>
<select name="memberupdate[title]" id = "title" >
<option value="<?php echo $member[0]->title;?>"><?php echo $member[0]->title;?></option>
<option value="mr">Mr</option>
<option value="mrs">Mrs</option>
<option value="miss">Miss</option>
</select>
</p>
<p><label>First Name</label><input type="text" name="memberupdate[firstname]" value="<?php echo $member[0]->firstname;?>"  /></p>
<p><label>Last Name</label><input type="text" name="memberupdate[lastname]" value="<?php echo $member[0]->lastname;?>"  /></p>
<p><label>Date Of Birth</label><input type="text" name="memberupdate[dob]" id="date" value="<?php echo date_display($member[0]->dob);?>"  /></p>
<p><label>Gender</label>
<select name="memberupdate[gender]">
<option value="<?php echo $member[0]->gender;?>"><?php echo $member[0]->gender;?></option>
<option value="male">Male</option>
<option value="female">Female</option>
</select>
</p>
<p><label>Marital Status</label><input type="text" name="memberupdate[maritalstatus]" value="<?php echo $member[0]->maritalstatus;?>" /></p>
<p><label>Email</label><input type="email" name="memberupdate[email]" value="<?php echo $member[0]->email;?>"  /></p>
<p><label>Address Line 1</label><input type="text" name="memberupdate[address]" value="<?php echo $member[0]->address;?>" /></p>
<p><label>Address Line 2</label><input type="text" name="memberupdate[addressline]" value=""  /></p>
<p><label>Post Code</label><input type="text" name="memberupdate[postcode]" value="<?php echo $member[0]->postcode;?>" /></p>
<p><label>Mobile No.</label><input type="text" name="memberupdate[mobileno]" value="<?php echo $member[0]->mobileno;?>" /></p>
<p><input type="submit" name="submit" value="Save" class="submit"/>&nbsp;<a href="form/deletemember.php?id=<?php echo $member[0]->id ?>" onclick="return confirm('Do you want to delete this member?')">Delete</a></p>
</fieldset>
</form>
<div id="pagination">

<?php if($pagination->totalPages()>1){
	
	if($pagination->hasPrevious()){
		echo '<p><a href ="members.php?page=1">&lt;first</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="members.php?page='.$pagination->prevPage().'">&lt;&lt; 		previous</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';	
		}else{echo '<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';}
		
		if($pagination->hasNext()){
		echo '<a href ="members.php?page='.$pagination->nextPage().'">next &gt;</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="members.php?page='.
		$pagination->totalPages().'">last &gt;&gt;</a></p>';
		
		}else{ echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>';}	
	 }
?>
</div>
<?php endif;?>
</section>

<?php if($session->userPosition() == 'sales'): ?>
<?php include_once ('templates/_salesfooter.php');?>
<?php elseif($session->userPosition() == 'nm'):?>
<?php include_once ('templates/_nmfooter.php');?>
<?php endif;?>