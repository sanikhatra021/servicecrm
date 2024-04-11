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
	

	
	$servicemid=(int)mysqli_real_escape_string($conn,$_GET['id']);
	
	$query="delete from res_service_master where servicemid=$servicemid";
	$result= mysqli_query($conn, $query) or die("Error");
		
		$query1="delete from res_complain_master where servicemid=$servicemid";
	$result1= mysqli_query($conn, $query1) or die("Error");
		
	$_SESSION['msg'] = "Record deleted successfully";
	header("Location: service.php");
	
?>