<?php	// functions.php
include_once 'db_information.php';

/* @desc This file handles the database connection to a MySQL db; including
 * the queries that will be sent from other PHP scripts in this project. 
 * Query strings are sanitized before being sent to the DB and there's a 
 * small function which displays the user's profile here.
 */

$appname = "Robin's Nest";

$mysqli = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if(!$mysqli){
	echo "Error: Unable to connect to MySQL.";
}

function createTable($name, $query){
	queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
	echo "Table '$name' created or already exists.<br />";
}

function queryMysql($query){
	global $mysqli;
	$result = mysqli_query($mysqli, $query);	// or $die(mysqli_error());
	return $result;
}

function destroySession(){
	$_SESSION = array();

	if(session_id() != "" || isset($_COOKIE[session_name()]))
		setcookie(session_name(), '', time()-2592000, '/');

	session_destroy();
}

function sanitizeString($var){
	$var = strip_tags($var);
	$var = htmlentities($var);
	$var = stripslashes($var);

	global $mysqli;	
	$sanitizedString = mysqli_real_escape_string($mysqli, $var);
	return $sanitizedString;
}

function showProfile($user){
	if(file_exists("$user.jpg"))
		echo "<img src='$user.jpg' align='left' />";

	$result = queryMysql("SELECT * FROM profiles WHERE user='$user'");

	if(mysqli_num_rows($result)){
		$row = mysqli_fetch_row($result);
		echo stripslashes($row[1]) . "<br clear=left /><br />";
	}
}

?>
