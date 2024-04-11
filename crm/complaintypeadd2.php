<?php
session_start(); 

	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
		return;
	}
	$samid=$_SESSION['samid'];

	include("connect.php");
	
	date_default_timezone_set("Asia/Kolkata");
	$mdate1= date('Y-m-d H:i:s');
	$mdate2= date('d-m-Y');
	
	
	$_SESSION['_token']=bin2hex(openssl_random_pseudo_bytes(16));

	
	
	$ctmname=trim($_POST['ctmname']);

		
	 $eve = "select ctmname from res_complaintype_master where samid=$samid and ctmname='$ctmname'";
		$re = mysqli_query($conn, $eve);
		if(mysqli_num_rows($re) > 0)
		{
			$_SESSION['msg1'] = "Complain Type Name already used.";
			header('Location: complaintype.php');
		}
		else
		{	
			if($ctmname!='')
			{
			 $eve1 = "INSERT INTO res_complaintype_master (samid,ctmname) VALUES('$samid','$ctmname')";	
			if ($conn->query($eve1) === TRUE)
			{
				$last_id = $conn->insert_id;
				$_SESSION['msg'] = "Record has been added successfully";
			}
			else
			{
				$_SESSION['msg1'] = "Error";
			}
			}
			else
			{
				$_SESSION['msg1'] = "Please Input Complain Type Name";
			}
		}
		
		
		if($_POST['from']=='com')
	{
		header('Location: complainadd.php');
	}
	else{
	header('Location: complaintype.php');
	}

	
	
?>