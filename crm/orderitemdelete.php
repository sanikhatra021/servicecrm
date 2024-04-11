<?php
session_start();

	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
		return;
	}

	include("connect.php");
	
	date_default_timezone_set("Asia/Kolkata");
	$mdate1= date('Y-m-d H:i:s');
	$mdate2= date('d-m-Y');
	

		$imid=(int)mysqli_real_escape_string($conn,$_GET['imid']);
	$orderdid=(int)mysqli_real_escape_string($conn,$_GET['id']);
	
	 $eve15="SELECT * FROM res_workorder_detail WHERE workorderdid=$orderdid and dispatchqty!=0";
	
	$re15 = mysqli_query($conn, $eve15);
	if(mysqli_num_rows($re15) > 0)
	{
			$_SESSION['msg1'] = "Order Already Dispatched So Record Can't be Deleted";
	}
	else
	{	
	$query="delete from res_workorder_detail where workorderdid=$orderdid";
	$result= mysqli_query($conn, $query) or die("Error");
	if($result === TRUE)
	{

	 $_SESSION['msg'] = "Record deleted successfully";
	}else{
		$_SESSION['msg'] = "Error";
	}
	}	
	
	header("Location: workorderdetail.php?id=$imid");
	
?>