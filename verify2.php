<?php  
session_start(); 
	include("connectp.php");
	include("connect.php");
	$url=$_SESSION['weburl'];
	if(!isset($_SESSION['businessid']))
	{
		header('Location: index.php');
	}
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('y-m-d H:i:s');
	$mdate1= date('Y-m-d');
	
	
      $uforgototp = $_POST['uforgototp'];
	$cmobile=$_SESSION['cmobile'];
	  $mobileotp=$_SESSION['mobileotp'];
	
	if($uforgototp==$mobileotp)
	{
		
		
		$_SESSION['sfotpmsg1']= "Verification success";
			header("Location: info.php"); 
		
	}
	else
	{
		  
			$result="0";
			$_SESSION['sfotpmsg1']= "Invalid OTP";
			header("Location: verify.php"); 
	}
		
	
	
   

?>