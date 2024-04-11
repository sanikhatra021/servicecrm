<?php
session_start();

	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
		return;
	}


	include("connect.php");

	$cmid=$_GET['id'];

	$eve = "select * from res_complain_master where cmid=$cmid";
	$re = mysqli_query($conn, $eve);
	while($rt = mysqli_fetch_assoc($re))
	{
		$cstatus=$rt['cstatus'];
	
		if($cstatus=='Pending')
		{
			$eve1 = "update res_complain_master set cstatus='In Process' where cmid=$cmid";
			$re1 = mysqli_query($conn, $eve1);
		}
		if($cstatus=='In Process')
		{
			$eve1 = "update res_complain_master set cstatus='Completed' where cmid=$cmid";
			$re1 = mysqli_query($conn,$eve1);
		}
		if($cstatus=='Completed')
		{
			$eve1 = "update res_complain_master set cstatus='Cancel' where cmid=$cmid";
			$re1 = mysqli_query($conn,$eve1);
		}
		if($cstatus=='Cancel')
		{
			$eve1 = "update res_complain_master set cstatus='Pending' where cmid=$cmid";
			$re1 = mysqli_query($conn,$eve1);
		}
	}

	$_SESSION['msg'] = "Status Changed";
	header('Location: complain.php');
?>
