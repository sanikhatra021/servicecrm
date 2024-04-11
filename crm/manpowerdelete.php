<?php
session_start();

	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
		return;
	}
$samid=$_SESSION['samid'];
	include("connect.php");
	include("connectp.php");
	
	$invoicemid=(int)mysqli_real_escape_string($conn,$_GET['id']);
	$imid=(int)mysqli_real_escape_string($conn,$_GET['imid']);
	
	
		$sql = "DELETE FROM res_manpowerexpense_detail WHERE manpowerdid=? and samid=$samid";
		$stmt= $db7->prepare($sql);
		if($stmt->execute([$invoicemid]))
		{
			$_SESSION['msg'] = "Record deleted successfully";
		} 
		else
		{
			$_SESSION['msg1'] = "Error";
		}
	
	

	header("Location: workorderdetail.php?id=$imid");
?>