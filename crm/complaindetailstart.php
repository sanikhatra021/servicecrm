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
	
	$samid=$_SESSION['samid'];
	$umid=$_SESSION['umid'];
	$cmid=$_POST['cmid'];
	$customerid=$_POST['customerid'];
	$cmserviceengineerid=$_POST['cmserviceengineerid'];
	$cdstatus=$_POST['cdstatus'];
	$startdate=date("Y-m-d", strtotime($_POST['startdate']));
	$starttime=date("H:i:s", strtotime($_POST['starttime']));
	
	 $eve1 = "INSERT INTO res_complain_detail (cmid,samid,custid,serviceengineerid,cdstatus,cdaddedon,assigndate,cactive,cdstarttime) VALUES('$cmid','$samid','$customerid','$cmserviceengineerid','$cdstatus','$mdate1','$mdate2',1,'$startdate $starttime')";	
	if ($conn->query($eve1) === TRUE)
	{
		$last_id = $conn->insert_id;
		
		$eve2 = "update res_complain_master set cstatus='$cdstatus',cmstatusudate='$mdate2',cmupdatedon='$mdate1',cmupdatedby='$umid' where cmid='$cmid'";
		if ($conn->query($eve2) === TRUE) 
		{
		} 
			
		$_SESSION['msg'] = "Record has been added successfully";
	}
	else
	{
		$_SESSION['msg1'] = "Error";
	}
	
header('Location: complaindetail.php?id='.$_SESSION['cmid']);
?>