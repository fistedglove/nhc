<?php

/**
*This set of PHP code fetches the Monthly Fee for a selected Activity from the Database.
*
*/


include_once("../config.php");

global $database;

if(isset($_POST['activityid'])){

$result = $database->find_by_column('activity', 'id', array('id'=>$_POST['activityid']));

if($result)
{
echo "{$result[0]->monthlyfee}";//Return the Monthly fee
}
else
{
echo '0';//Return 0
}

}
?>