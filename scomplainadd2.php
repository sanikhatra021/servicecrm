<?php
session_start(); 

	include("connect.php");
	if(!isset($_SESSION['complainweb']))
	{
		header("Location: $_SERVER[HTTP_REFERER]");
		return;
	}
	date_default_timezone_set("Asia/Kolkata");
	$mdate1= date('Y-m-d H:i:s');
	$mdate2= date('Y-m-d');
	$mdate= date('Y-m-d');
	
	$samid=$_POST['samid'];
	$pmid=$_POST['pmid'];
	$ctmid=$_POST['ctmid'];
	$customerid=$_POST['customerid'];
	$cmdetail=$_POST['cmdetail'];
	$cmupdatedby=0;
	$cmdate=$mdate;
	$cmupdatedon=$mdate;
	
	
	
	$cmphoto1="";
	 if(empty($_FILES['cmphoto']['name']) == false  )
	{
		$simplephoto11=$_FILES['cmphoto']['name'];
		$ext = pathinfo($simplephoto11, PATHINFO_EXTENSION);
		$fileexplode1 = explode(".",$simplephoto11);
		$fileend1 = end($fileexplode1);

		$cmphoto1= date("YmdHis").rand(100,999).".".$fileend1;
		$path = "./businesspanel/images";
		if($ext=='png' || $ext=='jpg' || $ext=='jpeg' || $ext=='gif' || $ext=='PNG' || $ext=='JPG' || $ext=='JPEG' || $ext=='GIF')
		{
		  move_uploaded_file( $_FILES['cmphoto']['tmp_name'], $path ."/". $cmphoto1);
		  $flag=1;
		}
		else 
		{
		  $_SESSION['cmsg1'] = "Only Upload Image";
		  header("Location: mywebpage.php?id=$customerid");
		  return;
		  $flag=0;
		}
	}

		
	
	 $eve1 = "INSERT INTO res_complain_master (samid,ctmid,pmid,customerid,cmdetail,cmphoto,cmdate,cstatus,cmstatusudate,cmupdatedon,cmupdatedby) VALUES('$samid','$ctmid','$pmid','$customerid','$cmdetail','$cmphoto1','$cmdate','Pending','$mdate2','$mdate1','$cmupdatedby')";	
		if ($conn->query($eve1) === TRUE)
		{
			$last_id = $conn->insert_id;
			
			if($cmupdatedby!="0")
			{
				$eve2 = "INSERT INTO res_complain_detail (serviceengineerid,cmid,cdaddedon,cdupdatedon) VALUES($cmupdatedby,$last_id,'$mdate','$mdate')";
				if ($conn->query($eve2) === TRUE)
				{
				}
				
			}
			$_SESSION['cmsg'] = "Record has been added successfully";
		}
		else
		{
			$_SESSION['cmsg1'] = "Error";
		}
	
header("Location: mywebpage.php?id=$customerid");
?>