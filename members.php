<?php	
// members.php
// This file handles the total list of all user accounts, and offers tools
// for the user to update their relationships.
include_once 'header.php';

if(!$loggedin) die();

echo "<div class='main'>";

// if you're viewing a specific user's page, this will be set and will run
if(isset($_GET['view'])){
	$view = sanitizeString($_GET['view']);

	if($view == $user){
		$name = "Your";
	}
	else{
		$name = "$view's";
	}

	echo "<h3>$name Profile</h3>";
	showProfile($view);
	echo "<a class='button' href='messages.php?view=$view'>" .
		"View $name messages</a><br /><br />";
	die("</div></body></html>");

}
// when you click to add a friend
if(isset($_GET['add'])){
	$add = sanitizeString($_GET['add']);

	$result = queryMysql("SELECT * FROM friends WHERE user='$user' AND friend=$add'");
	if($result){
		$numRows = mysqli_num_rows($result);
	}
	else{
		$numRows = FALSE;
	}

	if($numRows < 1){
		queryMysql("INSERT INTO friends(user,friend) VALUES('$user', '$add')");
	}
}
elseif(isset($_GET['remove'])){	//when you click to remove a friend
	$remove = sanitizeString($_GET['remove']);
	queryMysql("DELETE FROM friends WHERE user='$user' AND friend='$remove'");
}


// display the list of other members
$result = queryMysql("SELECT user FROM members ORDER BY user");
$num = mysqli_num_rows($result);

echo "<h3>Other Members</h3><ul>";

for($j = 0; $j < $num; ++$j){
	$row = mysqli_fetch_row($result);
	if($row[0] == $user) continue;

	echo "<li><a href='members.php?view=$row[0]'>$row[0]</a>";
	$follow = "follow";

	$t1 = mysqli_num_rows(queryMysql("SELECT * FROM friends WHERE user='$user' AND friend='$row[0]'"));
	$t2 = mysqli_num_rows(queryMysql("SELECT * FROM friends WHERE user='$row[0]' AND friend='$user'"));

	if(($t1 + $t2) > 1) echo " &harr; is a mutual friend";
	elseif($t1) echo " &larr; you are following";
	elseif($t2){
		echo " &rarr; is following you";
		$follow = "follow";
       	}

	if(!$t1) echo " <a href='members.php?add=" . $row[0] . "'>$follow</a>";
	else echo " <a href='members.php?remove=" . $row[0] . "'>drop</a>";
}

?>
<br /></div></body></html>
