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

	
	
	$ctmname=trim($_POST['stypename']);

		
	 $eve = "select stypename from res_servicetype_master where samid=$samid and stypename='$ctmname'";
		$re = mysqli_query($conn, $eve);
		if(mysqli_num_rows($re) > 0)
		{
			$_SESSION['msg1'] = "Service Type Name already used.";
			header('Location: servicetype.php');
		}
		else
		{	
			if($ctmname!='')
			{
			 $eve1 = "INSERT INTO res_servicetype_master (samid,stypename) VALUES('$samid','$ctmname')";	
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
				$_SESSION['msg1'] = "Please Input Service Type Name";
			}
		}
		
		
		if($_POST['from']=='com')
	{
		header('Location: serviceadd.php');
	}
	else{
	header('Location: servicetype.php');
	}

	
	
?>