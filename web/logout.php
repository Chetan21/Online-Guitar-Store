<?php
	if(isset($_COOKIE['User_Name'])){
		$email = $_COOKIE['User_Name'];
		setcookie('User_Name', '', 0, '/amazon/web');
		header("Location: index.php");
		exit;
	}
?>