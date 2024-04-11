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
	
	$smname=$_POST['smname'];
	$smpriorityno=$_POST['smpriorityno'];
			
	$eve1 = "INSERT INTO res_status_master (smname,smpriorityno) VALUES('$smname','$smpriorityno')";	
	if ($conn->query($eve1) === TRUE)
	{
		$last_id = $conn->insert_id;
		$_SESSION['msg'] = "Record has been added successfully";
	}
	else
	{
		$_SESSION['msg1'] = "Error";
	}
	
	header('Location: status.php');
?>