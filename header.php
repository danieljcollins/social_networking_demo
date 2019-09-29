<?php	
// header.php
/* @desc This file displays the header HTML elements based on whether the
 * user is signed in or not. For example, if the user is not logged in, a
 * sign-up and log-in HTML elements are available. If they are logged in, those
 * are not displayed and other options are available for the logged in user
 * to use.
 */

session_start();
echo "<DOCTYPE html>\n<html><head>";
include 'functions.php';

$userstr = ' (Guest)';

if(isset($_SESSION['user'])){
	$user = $_SESSION['user'];
	$loggedin = TRUE;
	$userstr = " ($user)";
}
else $loggedin = FALSE;

echo "<title>$appname$userstr</title><link rel='stylesheet'" . 
	"href='styles.css' type='text/css' />" .
	"</head><body><div class='appname'>$appname$userstr</div>";

if($loggedin){
	echo "<br ><ul class='menu'>" .
		"<li><a href='members.php?view=$user'>Home</a></li>" .
		"<li><a href='members.php'>Members</a></li>" .
		"<li><a href='friends.php'>Friends</a></li>" . 
		"<li><a href='messages.php'>Messages</a></li>" . 
		"<li><a href='profile.php'>Edit Profile</a></li>" . 
		"<li><a href='logout.php'>Log out</a></li></ul><br />";
}
else{
	echo("<br /><ul class='menu'>" .
		"<li><a href='index.php'>Home</a></li>" .
		"<li><a href='signup.php'>Sign up</a></li>" .
		"<li><a href='login.php'>Log in</a></li></ul><br />" .
		"<span class='info'>&#8658; You must be logged in to " . 
		"view this page.</span><br /><br />");
}

?>
