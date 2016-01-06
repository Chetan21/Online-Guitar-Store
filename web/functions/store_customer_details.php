<?php
include 'database_connector.php';
include 'amazon\web\register.php';
function store_customer_info(){
	//database_connect();
	$link = mysql_connect('127.0.0.1:3306', 'root', 'root');
	mysql_select_db('guitar_store_schema');
	$sql = 'INSERT INTO customer_details '.
       '(first_name, last_name, email_id, phone_number)'.
       'VALUES ( $first_name, $last_name, $email, $phone )';
	$retval = mysql_query( $sql, $link );
	if(! $retval )
	{	
	die('Could not enter data: ' . mysql_error());
	}
	
	
			   
}
?>