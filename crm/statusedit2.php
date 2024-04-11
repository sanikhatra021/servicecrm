<?php
session_start(); 

	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
		return;
	}
	
	include("connect.php");
	
	date_default_timezone_set("Asia/Kolkata");
	$mdate1= date('Y-m-d H:i:s');
	$mdate2= date('d-m-Y');
	
	

	$smid=$_POST['smid'];
	$smname=$_POST['smname'];
	$smpriorityno=$_POST['smpriorityno'];
	
	 $eve = "update res_status_master set smname='$smname',smpriorityno='$smpriorityno' where smid=$smid";
	if ($conn->query($eve) === TRUE)
	{
			
		$_SESSION['msg'] = "Record has been updated successfully";	
	}
	else
	{
		$_SESSION['msg1'] = "Error";
	}
	header('Location: status.php');
?>