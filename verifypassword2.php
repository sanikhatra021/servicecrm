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
	$samid=$_SESSION['businessid'];
	
      $password = $_POST['cpassword'];
	$cmobile=$_SESSION['cmobile'];
	$eve="select * from res_user_master where utype='customer' and umobile='$cmobile' and upassword='$password' and samid='$samid'";
	$re = mysqli_query($conn, $eve) or die("failed");
	$upassword="";
	if(mysqli_num_rows($re) > 0)
	{
		while($rt = mysqli_fetch_assoc($re))
		{
			$umid=$rt['umid'];
			
		}
			$_SESSION['sfotpmsg1']= " success";
			header("Location: info.php"); 
	}
	else
	{
		  
			$result="0";
			$_SESSION['sfotpmsg1']= "Invalid Password";
			header("Location: verifypassword.php"); 
	}
		
	
	
   

?>