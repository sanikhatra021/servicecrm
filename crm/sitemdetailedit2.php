<?php
session_start(); 

	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
		return;
	}

	include("connect.php");
	$cmid=(int)mysqli_real_escape_string($conn,$_GET['id']);

	date_default_timezone_set("Asia/Kolkata");
	$mdate1= date('Y-m-d H:i:s');
	$mdate2= date('d-m-Y');
	
	$cidid=$_POST['sidid'];
	$cmid=$_POST['cmid'];
	$pmid=$_POST['pmid'];
	
	$cidqty=$_POST['cidqty'];
	$cidrate=$_POST['cidrate'];
	
	
	 $eve = "update res_serviceitem_detail set pmid='$pmid',sidqty='$cidqty',sidrate='$cidrate' where  sitemdid=$cidid";
	if ($conn->query($eve) === TRUE)
	{
			
		$_SESSION['msg'] = "Record has been updated successfully";	
	}
	else
	{
		$_SESSION['msg1'] = "Error";
	}
	header('Location: servicedetail.php?id='.$_SESSION['servicemid']);
?>