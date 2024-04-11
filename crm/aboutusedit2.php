<?php
 session_start();

	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
		return;
	}
	

	date_default_timezone_set("Asia/Kolkata");
	$mdate1= date('Y-m-d H:i:s');
	$mdate= date('d-m-Y');

	include("connect.php");

	date_default_timezone_set("Asia/Kolkata");
	$mdate1= date('Y-m-d H:i:s');
	

	$aumid=$_POST['aumid'];
	$aumcontent=$_POST['aumcontent'];
	

	$eve = "update res_aboutus_master set aumcontent='$aumcontent' where aumid=$aumid";
	if ($conn->query($eve) === TRUE)
	{
		$_SESSION['msg'] = "Record saved successfully";
	}
	else
	{
		$_SESSION['msg1'] = "Error";
	}
	header("Location: myprofile.php");

?>