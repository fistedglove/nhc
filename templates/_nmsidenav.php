<section id="sideNavNM">
    <nav>
        <ul>
        <li><a href="members.php">Members</a></li>
        <li><a href="staff.php">Staff</a></li>
        <li><a href="booking.php">Bookings</a></li>
        <li><a href="addmember.php">New Member</a></li>
        <li><a href="recordbooking.php">New Booking</a></li>
        <li><a href="activities.php">Activities</a></li>
        <li><a href="recordsales.php">Cafe</a></li>
        <li><a href="localreports.php#monMem">Local Reports</a></li>
        <li><a href="centres.php">Centres</a></li>
        <li><a href="nationalreport.php#monMem">National Reports</a></li>
        <?php if($session->isLoggedIn()):
      	echo '<li><a href="logout.php" onClick ="return confirm(\'Do you want to log out?\');">Log Out</a></li>';
		?> 
        <?php  else: 
        echo '<li><a href="login.php">Log In</a></li>';
	    ?>
        <?php endif; ?>
        </ul>
    </nav>
</section>