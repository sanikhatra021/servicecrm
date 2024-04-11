<?php
	session_start();

	include("connect.php");
	
	date_default_timezone_set("Asia/Kolkata");
	$mdate1= date('Y-m-d H:i:s');
	$mdate2= date('d-m-Y');

	$pumdid=(int)mysqli_real_escape_string($conn,$_GET['id']);
	$cmid=(int)mysqli_real_escape_string($conn,$_GET['id']);
	
	$query="delete from res_prodmaintainance_detail where pumdid=$pumdid";
	$result= mysqli_query($conn, $query) or die("Error");
		
	$_SESSION['msg'] = "Record deleted successfully";
	header('Location: complaindetail.php?id='.$_SESSION['cmid']);
?>