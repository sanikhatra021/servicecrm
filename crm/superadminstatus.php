<?php
session_start();

	if(!isset($_SESSION['latcloginsesion']))
	{
		header('Location: index.php');
		return;
	}
	
	include("connect.php");
	
	
	$mumid=$_GET['id'];
	$eve = "select * from res_mainuser_master where mumid=$mumid";
	$re = mysqli_query($conn, $eve);
	while($rt = mysqli_fetch_assoc($re))
	{
		$user_status=$rt['user_status'];

		if($user_status=='Active')
		{
			$eve1 = "update res_mainuser_master set user_status='Blocked' where mumid=$mumid";
			$re1 = mysqli_query($conn, $eve1);
		}
		else
		{
			$eve1 = "update res_mainuser_master set user_status='Active' where mumid=$mumid";
			$re1 = mysqli_query($conn, $eve1);
		}
	}

	$_SESSION['msg'] = "Product Status Changed";
	header('Location: teamleader.php');
?>