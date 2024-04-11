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
	
	$saemailid=$_POST['saemailid'];
	$saaddress=$_POST['saaddress'];
	$sawhatsappno=$_POST['sawhatsappno'];
	$sawebsitedetail=$_POST['sawebsitedetail'];
	$sacompanyname=$_POST['sacompanyname'];
	
	  $eve = "update res_superadmin_master set saemailid='$saemailid',saaddress='$saaddress',sawhatsappno='$sawhatsappno',sawebsitedetail='$sawebsitedetail',sacompanyname='$sacompanyname' where samid=$samid";
	if ($conn->query($eve) === TRUE)
	{
			
		$_SESSION['msg'] = "Record has been updated successfully";	
	}
	else
	{
		$_SESSION['msg1'] = "Error";
	}
	header('Location: companyedit.php');
?>