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
	
	
	//$admdate=implode('-', array_reverse(explode('-', $_SESSION['date1'])));
    $cmid=$_POST['cmid'];
	$scharge=$_POST['scharge'];
	

  $eve = "update res_complain_master set cmservicecharge='$scharge' where cmid=$cmid";
	 if ($conn->query($eve) === TRUE)
	{
			
		$_SESSION['msg'] = "Record has been updated successfully";	
	}
	else
	{
		$_SESSION['msg1'] = "Error";
	}
	header('Location: complaindetail.php?id='.$_SESSION['cmid']);  
?>