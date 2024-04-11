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
	
	
	$samid=$_SESSION['samid'];
	$ptmid=$_POST['ptmid'];
	$ptmname=trim($_POST['ptmname']);
	$ptmrate=trim($_POST['ptmrate']);

	if($ptmname=="")
	{
		$_SESSION['msg1'] = "Please Input Call Category Name";
		header('Location: problemtype.php');
		return;
	}
	
	/* $tt2="";
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
		  $tt2 = ",ptmimage='$ptmimage1'";
		}
		else 
		{
			$_SESSION['msg1'] = "Only Upload Image";
			header("Location: problemtype.php");
			return;
		}
	}	 */
	
	$eve = "update res_problemtype_master set ptmname='$ptmname',ptmrate='$ptmrate'  where ptmid=$ptmid and samid=$samid";
	if ($conn->query($eve) === TRUE)
	{
			
		$_SESSION['msg'] = "Record has been updated successfully";	
	}
	else
	{
		$_SESSION['msg1'] = "Error";
	}
	header('Location: problemtype.php');
?>