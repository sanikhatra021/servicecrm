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

	
	
	$ptmname=trim($_POST['ptmname']);
	$ptmrate=trim($_POST['ptmrate']);

	if($ptmname=="")
	{
		$_SESSION['msg1'] = "Please Input Call Category Name";
		header('Location: problemtype.php');
		return;
	}
		
	/* $ptmimage1="";
	if(empty($_FILES['ptmimage']['name']) == false  )
	{
		$simplephoto11=$_FILES['ptmimage']['name'];
		$ext = pathinfo($simplephoto11, PATHINFO_EXTENSION);
		$fileexplode1 = explode(".",$simplephoto11);
		$fileend1 = end($fileexplode1);

		$ptmimage1= date("YmdHis").rand(100,999).".".$fileend1;
		$path = "images";
		if($ext=='png' || $ext=='jpg' || $ext=='jpeg' || $ext=='gif' || $ext=='PNG' || $ext=='JPG' || $ext=='JPEG' || $ext=='GIF')
		{
		  move_uploaded_file( $_FILES['ptmimage']['tmp_name'], $path ."/". $ptmimage1);
		  $flag=1;
		}
		else 
		{
		  $_SESSION['msg1'] = "Only Upload Image";
		  header('Location: problemtype.php');
		  return;
		  $flag=0;
		}
	} */

	
		$eve = "select ptmname from res_problemtype_master where samid=$samid and ptmname='$ptmname'";
		$re = mysqli_query($conn, $eve);
		if(mysqli_num_rows($re) > 0)
		{
			$_SESSION['msg1'] = "Call Category Name already used.";
			header('Location: problemtype.php');
		}
		else
		{	
			
			$eve1 = "INSERT INTO res_problemtype_master (samid,ptmname,ptmrate) VALUES('$samid','$ptmname','$ptmrate')";	
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
		
	if($_POST['from']=='problem')
	{
		header('Location: complainadd.php');
	}
	else{
	header('Location: problemtype.php');
	}
	
?>