<?php
// index.php
// This file checks if there is an active session and then if there is no
// session, it acts as the landing page for the user.

include_once 'header.php';

echo "<br /><span class='main'>Welcome to Robin's Nest,";

if($loggedin) echo " $user, you are logged in.";
	else echo ' please sign up and/or log in to join in.';

?>

</span><br /></body></html>
