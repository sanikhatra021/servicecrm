<?php
session_start(); 

	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
		return;
	}
	//$samid=$_SESSION['samid'];

	include("connect.php");
	
	date_default_timezone_set("Asia/Kolkata");
	$mdate1= date('Y-m-d H:i:s');
	$mdate2= date('d-m-Y');
	
	

	$semid=$_POST['semid'];
	$sappversion=$_POST['sappversion'];
	$sapplink=$_POST['sapplink'];
	
	
	  $eve = "update res_settings_master set sappversion='$sappversion',sapplink='$sapplink'  where semid=$semid";
	if ($conn->query($eve) === TRUE)
	{
			
		$_SESSION['msg'] = "Record has been updated successfully";	
	}
	else
	{
		$_SESSION['msg1'] = "Error";
	}
	header('Location: settingedit.php?id=1');
?>