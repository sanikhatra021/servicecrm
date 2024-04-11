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
	
	
	$cmid=$_POST['cmid'];
	$pumdid=$_POST['pumdid'];
	$pumdetail=$_POST['pumdetail'];
	$smid=$_POST['smid'];
	$pumddcollectate=implode('-', array_reverse(explode('-',$_POST['pumddcollectate'])));
	$pumdgivendate=implode('-', array_reverse(explode('-',$_POST['pumdgivendate'])));
	$pumdexpreturndate=implode('-', array_reverse(explode('-',$_POST['pumdexpreturndate'])));
	$pumdactualdate=implode('-', array_reverse(explode('-',$_POST['pumdactualdate'])));
	$pumdcustdate=implode('-', array_reverse(explode('-',$_POST['pumdcustdate'])));
	$pumdcollectby=$_POST['pumdcollectby'];
	$pumdgivento=$_POST['pumdgivento'];
	$pumdconatctper=$_POST['pumdconatctper'];
	$pumdconatctno=$_POST['pumdconatctno'];
	$pumdexpamt=$_POST['pumdexpamt'];
	

		
	
	 $eve1 = "INSERT INTO res_prodmaintainance_detail (cmid,pumdetail,smid,pumddcollectate,pumdcollectby,pumdgivento,pumdconatctper,pumdconatctno,pumdgivendate,pumdexpamt,pumdexpreturndate,pumdactualdate,pumdcustdate) VALUES('$cmid','$pumdetail','$smid','$pumddcollectate','$pumdcollectby','$pumdgivento','$pumdconatctper','$pumdconatctno','$pumdgivendate','$pumdexpamt','$pumdexpreturndate','$pumdactualdate','$pumdcustdate')";	
			if ($conn->query($eve1) === TRUE)
			{
				$last_id = $conn->insert_id;
				$_SESSION['msg'] = "Record has been added successfully";
			}
			else
			{
				$_SESSION['msg1'] = "Error";
			}
			
	
	header("Location: complaindetail.php?id=$cmid");
?>