<?php
	session_start();

	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
		return;
	}

	include("connect.php");
	include("connectp.php");
	
	$iadid=(int)mysqli_real_escape_string($conn,$_GET['id']);
	$cmid=(int)mysqli_real_escape_string($conn,$_GET['cmid']);
		
	$sql = "DELETE FROM res_complainallocation_detail WHERE callocationmid=?";
	$stmt= $db7->prepare($sql);
	if($stmt->execute([$iadid]))
	{
		$_SESSION['msg'] = "Record deleted successfully";
	} 
	else
	{
		$_SESSION['msg1'] = "Error";
	}
	
	header("Location: complaindetail.php?id=$cmid");
?>