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
	
	
							
							$bmid=$_POST['bmid'];
							$bannerimgsortorder=$_POST['bannerimgsortorder'];
							$bmname=$_POST['bmname'];
						
							//$smcharge=$_POST['smcharge'];
							//$smdetail=$_POST['smdetail'];
							//$scmdesc=$_POST['scmdesc'];
							//$umemail=$_POST['umemail'];
							//$umaddress=$_POST['umaddress'];
							//$umpassword=$_POST['umpassword'];
							//$umstatus=$_POST['umstatus'];
							
	$tt2="";
	if(empty($_FILES['bannerimg']['name']) == false  )
	{
		$simplephoto11=$_FILES['bannerimg']['name'];
		$ext = pathinfo($simplephoto11, PATHINFO_EXTENSION);
		$fileexplode1 = explode(".",$simplephoto11);
		$fileend1 = end($fileexplode1);

		$bannerimg1= date("YmdHis").rand(100,999).".".$fileend1;
		$path = "images";
		if($ext=='png' || $ext=='jpg' || $ext=='jpeg' || $ext=='gif' || $ext=='PNG' || $ext=='JPG' || $ext=='JPEG' || $ext=='GIF')
		{
		  move_uploaded_file( $_FILES['bannerimg']['tmp_name'], $path ."/". $bannerimg1);
		  $tt2 = ",bannerimg='$bannerimg1'";
		}
		else 
		{
			$_SESSION['msg1'] = "Only Upload Image";
			header("Location: banner.php");
			return;
		}
	}	
	
		
  $eve = "update res_banner_master set bannerimgsortorder='$bannerimgsortorder',bmname='$bmname' $tt2 where bmid=$bmid and samid=$samid";
	
	
	if ($conn->query($eve) === TRUE)
	{
			
		$_SESSION['msg'] = "Record has been updated successfully";	
	}
	else
	{
		$_SESSION['msg1'] = "Error";
	}
	header('Location: banner.php');
?>