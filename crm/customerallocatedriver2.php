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
	$cstatus = $_SESSION['cstatus'];							
	$cmupdatedby=$_SESSION['umid'];	
	$samid=$_SESSION['samid'];	
	$cmid=$_POST['cmid'];	
	$cmserviceengineerid=$_POST['umid'];		
			
	 /* $eve1 = "INSERT INTO res_complain_detail (serviceengineerid,cmid,cdaddedon,cdupdatedon) VALUES($serviceengineerid,$cmid,'$mdate','$mdate')"; */
	
	 $eve1 = "insert into res_complainallocation_detail (cmid,serviceengid,allocateddate,samid) values ($cmid,$cmserviceengineerid,'$mdate2',$samid)";
	if ($conn->query($eve1) === TRUE)
	{
		$_SESSION['msg'] = "Record has been added successfully";
	}
	else
	{
		$_SESSION['msg1'] = "Error";
	}
	if($_POST['from']=='uac')
	{
		header('Location: unallocatedcomplain.php');
	}else if($_POST['from']=='cmp')
	{
		header('Location: complain.php?cstatus='.$cstatus);
	}
	else if($_POST['from']=='sc')
	{
		header('Location: servicelist.php?cstatus='.$cstatus);
	}else if($_POST['from']=='cmpc')
	{
		header('Location: completedcomplain.php?cstatus='.$cstatus);
	}else if($_POST['from']=='scs')
	{
		header('Location: completedservicelist.php?cstatus='.$cstatus);
	}
	
	else{
	header('Location: dashboard.php');
	}
	
?>