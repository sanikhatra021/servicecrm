<?php
session_start(); 

	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
		return;
	}
	
	include("connect.php");

	$p1=$_POST['password1'];
	$p2=$_POST['password2'];

	$p3=$_SESSION['umid'];
	$p4=$_SESSION['umobile'];
	
	
	$eve_select="select * from res_user_master where umobile='$p4' and upassword='$p1'";
	$re_select = mysqli_query($conn, $eve_select);
	if(mysqli_num_rows($re_select) > 0)
	{
		 $eve = "update res_user_master set upassword='$p2' where umobile='$p4' and umid='$p3' and upassword='$p1'";
		$re = mysqli_query($conn,$eve);
		
		$_SESSION['msg'] = "Password Updated";
	header('Location: changepassword.php');
	}
	else
	{
		$_SESSION['msg1'] = "Current Password Not Match";
	header('Location: changepassword.php');
	}
?>