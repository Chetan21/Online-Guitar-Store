<?php 
if(isset($_POST['email']) && !isset($_COOKIE['User_Name'])) {
	$email = urldecode($_POST['email']);
	header("Set-Cookie: User_Name={$email}; EXPIRES={time()+86400}; Path:'/'");
	header("Location: shop.php");
	exit;
}
 ?>