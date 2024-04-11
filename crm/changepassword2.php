<?php
session_start(); 

	if(!isset($_SESSION['lacomplainsuperadmin']))
	{
		header('Location: index.php');
		return;
	}
	
	include("connect.php");

	$p1=$_POST['password1'];
	$p2=$_POST['password2'];

	$p3=$_SESSION['samid'];
	$p4=$_SESSION['samobile'];
	
	
	$eve_select="select * from res_superadmin_master where samobile='$p4' and sapassword='$p1'";
	$re_select = mysqli_query($conn, $eve_select);
	if(mysqli_num_rows($re_select) > 0)
	{
		 $eve = "update res_superadmin_master set sapassword='$p2' where samobile='$p4' and samid='$p3' and sapassword='$p1'";
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