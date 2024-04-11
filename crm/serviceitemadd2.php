<?php
if(!isset($_SESSION)) { 
  session_start(); 
} 

	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
		return;
	}
	
	include("connect.php");
	
	date_default_timezone_set("Asia/Kolkata");
	$mdate1= date('Y-m-d H:i:s');
	$mdate2= date('Y-m-d');
	
	$cmid=$_POST['servicemid'];
	$pmid=$_POST['pmid'];
	$cidqty=$_POST['cidqty'];
	$cidrate=$_POST['cidrate'];
	$serviceengid=$_POST['serviceengineerid'];
	$itemdate=date("Y-m-d", strtotime($_POST['itemdate'])); 
	
			
	 $eve1 = "INSERT INTO res_serviceitem_detail (servicemid,pmid,sidqty,sidrate,sitemdate,serviceengid) VALUES('$cmid','$pmid','$cidqty','$cidrate','$itemdate','$serviceengid')";	
	if ($conn->query($eve1) === TRUE)
	{
		$last_id = $conn->insert_id;
		$_SESSION['msg'] = "Record has been added successfully";
	}
	else
	{
		$_SESSION['msg1'] = "Error";
	}
	
header('Location: servicedetail.php?id='.$_SESSION['servicemid']);
?>