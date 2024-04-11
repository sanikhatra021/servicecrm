<?php
session_start(); 
	include("connect.php");		
	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
		return;
	}
	
	date_default_timezone_set("Asia/Kolkata");
	$mdate1= date('d-m-Y');
	$mdate= date('Y-m-d H:i:s');
	$mdate2= date('Y-m-d');
								
	$cmid=$_POST['cmid'];	
	$cmserviceengineerid=$_POST['umid'];	
	$cmupdatedby=$_SESSION['umid'];	
	$samid=$_SESSION['samid'];	
	
	/* $eve1 = "update res_complain_detail set serviceengineerid=$cmupdatedby where cmid=$cmid"; */
	
	$eve1 = "INSERT INTO res_complainallocation_detail (cmid,serviceengid,allocateddate,samid) VALUES($cmid,$cmserviceengineerid,'$mdate2',$samid)";
	if ($conn->query($eve1) === TRUE)
	{
		$_SESSION['msg'] = "Record has been Updated successfully";
	}
	else
	{
		$_SESSION['msg1'] = "Error";
	}
	
	header("Location: complaindetail.php?id=$cmid");
	
?>