<?php
$db_connection = mysql_connect("localhost", "cs143","");
if(!$db_connection){
	die("Could not connect: " . mysql_error());
}
$db_selected = mysql_select_db("CS143", $db_connection);
if(!$db_selected){
	die('Can\'t use database: '.mysql_error());
}
?>