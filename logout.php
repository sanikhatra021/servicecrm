<?php
session_start();
	$url=$_SESSION['weburl'];
	
	unset($_SESSION['sminderweb']);

	session_destroy();
	header("Location: $url");
?>