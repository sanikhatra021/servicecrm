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
	$mdate= date('d-m-Y');
     
	
		$cmphoto1="";
	 if(empty($_FILES['cmphoto']['name']) == false  )
	{
		$simplephoto11=$_FILES['cmphoto']['name'];
		$ext = pathinfo($simplephoto11, PATHINFO_EXTENSION);
		$fileexplode1 = explode(".",$simplephoto11);
		$fileend1 = end($fileexplode1);

		$cmphoto1= date("YmdHis").rand(100,999).".".$fileend1;
		$path = "images";
		if($ext=='png' || $ext=='jpg' || $ext=='jpeg' || $ext=='gif' || $ext=='PNG' || $ext=='JPG' || $ext=='JPEG' || $ext=='GIF')
		{
		  move_uploaded_file( $_FILES['cmphoto']['tmp_name'], $path ."/". $cmphoto1);
		  $flag=1;
		}
		else 
		{
		  $_SESSION['msg1'] = "Only Upload Image";
		 // header('Location: complain.php');
		  return;
		  $flag=0;
		}
	}					
	
	
    $eve = "update res_superadmin_master set salogo='$cmphoto1' where samid=$samid";
	
	
	if ($conn->query($eve) === TRUE)
	{
		
		$_SESSION['msg'] = "Record has been updated successfully";	
	}
	else
	{
		
		$_SESSION['msg1'] = "Error";
	}
	header('Location: myprofile.php');
?>