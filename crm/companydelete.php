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
	

	
	$cpmid=(int)mysqli_real_escape_string($conn,$_GET['id']);
	
	$query="delete from res_company_master where cpmid=$cpmid";
	$result= mysqli_query($conn, $query) or die("Error");
		
	$_SESSION['msg'] = "Record deleted successfully";
	header('Location: company.php');
	
?>