<?php
function database_connect(){
	$link = mysql_connect('127.0.0.1:3306', 'root', 'root');
	if (!$link) {
	die('Could not connect: ' . mysql_error());
	}
	//echo 'Connected successfully';
	//mysql_close($link);
}
?>