<?php
session_start(); 

	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
		return;
	}

	include("connect.php");
	$cmid=(int)mysqli_real_escape_string($conn,$_GET['id']);

	date_default_timezone_set("Asia/Kolkata");
	$mdate1= date('Y-m-d H:i:s');
	$mdate2= date('d-m-Y');
	
	$pumdid=$_POST['pumdid'];
	$pumdetail=$_POST['pumdetail'];
	$smid=$_POST['smid'];
	$pumddcollectate=implode('-', array_reverse(explode('-',$_POST['pumddcollectate'])));
	$pumdcollectby=$_POST['pumdcollectby'];
	$pumdgivento=$_POST['pumdgivento'];
	$pumdconatctno=$_POST['pumdconatctno'];
	$pumdconatctper=$_POST['pumdconatctper'];
	$pumdgivendate=implode('-', array_reverse(explode('-',$_POST['pumdgivendate'])));
	$pumdexpamt=$_POST['pumdexpamt'];
	$pumdexpreturndate=implode('-', array_reverse(explode('-',$_POST['pumdexpreturndate'])));
	$pumdactualdate=implode('-', array_reverse(explode('-',$_POST['pumdactualdate'])));
	$pumdcustdate=implode('-', array_reverse(explode('-',$_POST['pumdcustdate'])));
	
	 $eve = "update res_prodmaintainance_detail set pumdetail='$pumdetail',smid='$smid',pumddcollectate='$pumddcollectate',pumdcollectby='$pumdcollectby',pumdgivento='$pumdgivento',pumdconatctper='$pumdconatctper',pumdconatctno='$pumdconatctno',pumdgivendate='$pumdgivendate',pumdexpamt='$pumdexpamt',pumdexpreturndate='$pumdexpreturndate' ,pumdactualdate='$pumdactualdate' ,pumdcustdate='$pumdcustdate' where  pumdid=$pumdid";
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