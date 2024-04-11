<?php
	//include("../connect.php");
	$s7891 = "localhost";
	$u7891 = "root";
	$p7891 = '';
	$d7891 = "linkaitb_servicecrm";


	$db7 = new PDO("mysql:host=$s7891;dbname=$d7891", $u7891, $p7891);
	/*$conn = new mysqli($servername, $username, $password,$db);

	if ($conn->connect_error)
	{
		die("Connection failed: " . $conn->connect_error);
	}

	*/
?>
