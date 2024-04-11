<?php
session_start(); 

	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
		return;
	}
	$samid=$_SESSION['samid'];

	include("connect.php");
	
	date_default_timezone_set("Asia/Kolkata");
	$mdate1= date('Y-m-d H:i:s');
	$mdate2= date('d-m-Y');
	
	

	 $samid=$_POST['samid'];
	 $customerid=$_POST['customerid'];
	 $uname=$_POST['cname'];
	 $ccity=$_POST['ccity'];
	 $cemail=$_POST['cemail'];
	 $caddress=$_POST['caddress'];
	
	   $eve = "update res_user_master set uname='$uname',ucity='$ccity',emailid='$cemail',uaddress='$caddress' where umid=$customerid and samid=$samid";
	if ($conn->query($eve) === TRUE)
	{
			
		$_SESSION['msg'] = "Record has been updated successfully";	
	}
	else
	{
		$_SESSION['msg1'] = "Error";
	}
	header('Location: myprofile.php');
?>