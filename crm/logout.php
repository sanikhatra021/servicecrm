<?php
	session_start();
	include("connect.php");


				date_default_timezone_set("Asia/Kolkata");
				$mdate= date('Y-m-d H:i:s');

				$par1 = $_SESSION['umobile'];
				$ipaddress = "";

				



	unset($_SESSION['consultant']);

	session_destroy();
	header('Location: index.php');

?>
