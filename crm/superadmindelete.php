<?php
	session_start();

	if(!isset($_SESSION['lacomplainsuperadmin']))
	{
		header('Location: index.php');
		return;
	}

	include("connect.php");
	
	$samid=(int)mysqli_real_escape_string($conn,$_GET['id']);
	
	$query="delete from res_superadmin_master where samid=$samid";
	$result= mysqli_query($conn, $query);
	
	$query="delete from res_complain_master where samid=$samid";
	$result= mysqli_query($conn, $query);
	
	$query="delete from res_complain_detail where samid=$samid";
	$result= mysqli_query($conn, $query);
	
	$query="delete from res_service_master where samid=$samid";
	$result= mysqli_query($conn, $query);
	$query="delete from res_workorder_detail where workordermid in(select workordermid from res_workorder_master where samid=$samid)";
	$result= mysqli_query($conn, $query);
	$query="delete from res_workorder_master where samid=$samid";
	$result= mysqli_query($conn, $query);
	
	$query="delete from res_deliverydispatch_master where samid=$samid";
	$result= mysqli_query($conn, $query);
	$query="delete from res_deliverydispatch_detail where samid=$samid";
	$result= mysqli_query($conn, $query);
	
	$query1="delete from res_user_master where samid=$samid";
	$result1= mysqli_query($conn, $query1);
	
	$query2="delete from res_generalsettings_master where samid=$samid";
	$result2= mysqli_query($conn, $query2);
	
	$query3="delete from res_aboutus_master where samid=$samid";
	$result3= mysqli_query($conn, $query3);
	$query3="delete from res_product_master where samid=$samid";
	$result3= mysqli_query($conn, $query3);
	$query3="delete from res_user_master where samid=$samid";
	$result3= mysqli_query($conn, $query3);
	$query3="delete from res_generalsettings_master where samid=$samid";
	$result3= mysqli_query($conn, $query3);
	
	$_SESSION['msg'] = "Record deleted successfully";
	header('Location: superadmin.php');
	
?>