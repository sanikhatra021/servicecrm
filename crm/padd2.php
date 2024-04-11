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
	
	$cmid=$_POST['cmid'];
	$pmid=$_POST['pmid'];
	$cidqty=$_POST['cidqty'];
	$cidrate=$_POST['cidrate'];
	
			
	 $eve1 = "INSERT INTO res_complainitem_detail (cmid,pmid,cidqty,cidrate) VALUES('$cmid','$pmid','$cidqty','$cidrate')";	
	if ($conn->query($eve1) === TRUE)
	{
		$last_id = $conn->insert_id;
		$_SESSION['msg'] = "Record has been added successfully";
	}
	else
	{
		$_SESSION['msg1'] = "Error";
	}
	
header('Location: complaindetail.php?id='.$_SESSION['cmid']);
?>