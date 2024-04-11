<?php
session_start();

	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
		return;
	}


	include("connect.php");

	$servicemid=$_GET['id'];

	$eve = "select * from res_service_master where servicemid=$servicemid";
	$re = mysqli_query($conn, $eve);
	while($rt = mysqli_fetch_assoc($re))
	{
		$servicestatus=$rt['servicestatus'];

		if($servicestatus=='Active')
		{
			$eve1 = "update res_service_master set servicestatus='Inactive' where servicemid=$servicemid";
			$re1 = mysqli_query($conn, $eve1);
		}
		if($servicestatus=='Inactive')
		{
			$eve1 = "update res_service_master set servicestatus='Active' where servicemid=$servicemid";
			$re1 = mysqli_query($conn, $eve1);
		}
	}

	$_SESSION['msg'] = "Status Changed";
	header('Location: service.php');
?>
