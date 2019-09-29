<?php	// checkuser.php
include_once 'functions.php';

/* @desc this function simply sends the user-inputted user name string to
 * the DB to check if the user name is already in use; and then responds if
 * the user name is available or not.
 */

if(isset($_POST['user'])){
	$user = sanitizeString($_POST['user']);


	if(mysqli_num_rows(queryMysql("SELECT * FROM members WHERE user='$user'"))){
		echo "<span class='taken'>&nbsp;&#x2718; " .
			"Sorry, this username is taken</span";
	}
	else{
		echo "<span class='available'>&nbsp;&#x2714; " .
			"This username is available</span>";
	}
?>
	

