<?php
session_start(); 
	include("connect.php");		
	 $servicemid=$_SESSION['servicemid'];
	date_default_timezone_set("Asia/Kolkata");
	$mdate1= date('d-m-Y');
	$mdate= date('d-m-y H:i:s');
								
	$cmid=$_POST['cmid'];	
	$cmdate=date("y-m-d",strtotime($_POST['edate']));
			
    $eve1 = "update res_complain_master set cmdate='$cmdate' where cmid='$cmid'";		
	if ($conn->query($eve1) === TRUE)
	{
		$_SESSION['msg'] = "Record has been Update successfully";
	}
	else
	{
		$_SESSION['msg1'] = "Error";
	}
	header("Location: servicedetail.php?id=$servicemid");
	
	
?>