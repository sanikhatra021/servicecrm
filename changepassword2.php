<?php
session_start(); 

	if(!isset($_SESSION['sminderweb']))
	{
		header('Location: index.php');
		return;
	}
	
	include("connect.php");
	
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('Y-m-d H:i:s');
	$mdate1= date('d-m-Y');
	
	
	$p1=$_POST['password1'];
	$p2=$_POST['password2'];

	$p3 = $_SESSION['customerid'];
	$par1=$_SESSION['cmobile'];
	
	$eve_select="select * from res_user_master where umobile='$par1' and upassword='$p1'";
	$re_select = mysqli_query($conn, $eve_select);
	if(mysqli_num_rows($re_select) > 0)
	{
		$eve = "update res_user_master set upassword='$p2' where umobile='$par1' and umid=$p3 and upassword='$p1'";
		$re = mysqli_query($conn, $eve);
		
		$_SESSION['scpmsg'] = "Password Updated";
		header('Location: myaccount.php');
	}
	else
	{
		$_SESSION['scpmsg1'] = "Current Password Not Match";
		header('Location: myaccount.php');
	}
?>