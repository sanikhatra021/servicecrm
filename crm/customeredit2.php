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
	$mdate= date('d-m-Y');
	
	
							
	$umid=$_POST['umid'];
	$uname=$_POST['uname'];
	$umobile=$_POST['umobile'];
	$upassword="";
	
	$emailid=$_POST['emailid'];
	$uaddress=trim($_POST['uaddress']);
	$ucity=trim($_POST['ucity']);
	$upriority=trim($_POST['upriority']);
	$udefaultserviceengineer=$_POST['udefaultserviceengineer'];
	$usite=$_POST['usite'];
	$uprojectmanagername=$_POST['uprojectmanagername'];
	$uprojectmanagermobile=$_POST['uprojectmanagermobile'];
	$uprojectinchargename="";
	$uprojectinchargemobile="";

							
	
	
		
	  $eve = "update res_user_master set uname='$uname',umobile='$umobile',upassword='$upassword',emailid='$emailid',uaddress='$uaddress',ucity='$ucity',upriority='$upriority',udefaultserviceengineer='$udefaultserviceengineer',uprojectmanagername='$uprojectmanagername', uprojectmanagermobile='$uprojectmanagermobile',uprojectinchargename='$uprojectinchargename',uprojectinchargemobile='$uprojectinchargemobile',usite='$usite' where umid=$umid and samid=$samid";
	
	
	if ($conn->query($eve) === TRUE)
	{
			
		$_SESSION['msg'] = "Record has been updated successfully";	
	}
	else
	{
		$_SESSION['msg1'] = "Error";
	}
	header('Location: customer.php');
?>