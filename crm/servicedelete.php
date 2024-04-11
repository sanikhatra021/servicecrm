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
	

	
	$cmid=(int)mysqli_real_escape_string($conn,$_GET['id']);
	$umid=(int)mysqli_real_escape_string($conn,$_GET['umid']);
	
	$query="delete from res_complain_master where cmid=$cmid";
	$result= mysqli_query($conn, $query) or die("Error");
		
	$_SESSION['msg'] = "Record deleted successfully";
		header('Location: userdetail.php?id='.$_SESSION['umid']);
	
?>