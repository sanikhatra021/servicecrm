<?php
session_start(); 
include("connect.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
	
	
	include("connect.php");
	include("./businesspanel/getcomplainno.php");
	date_default_timezone_set("Asia/Kolkata");
	$mdate1= date('Y-m-d H:i:s');
	$mdate= date('Y-m-d');
	
	
	$url=$_SESSION['weburl'];
	$samid=$_POST['samid'];
	$pmid=$_POST['pmid'];
	$ctmname=$_POST['ctmname'];
	$problemname=$_POST['problemname'];
	$cmdetail=$_POST['cmdetail'];
	$customerid=$_POST['customerid'];
	$_SESSION['umid']=$_SESSION['customerid'];
	$cmupdatedby=$customerid;
	$cmdate=$mdate;
	$cmupdatedon=$mdate;
	
	// for test //
	  $everate11= "SELECT udefaultserviceengineer FROM res_user_master where umid='$customerid'";
	$rerate11 = mysqli_query($conn, $everate11);
	while($rtmaxq11 = mysqli_fetch_assoc($rerate11))
	{
		$udefaultserviceengineer=$rtmaxq11['udefaultserviceengineer'];
	}
	if($udefaultserviceengineer==0)
	{
		$cmserviceengineerid=0;
		
	}
	else
	{
	    $cmserviceengineerid=$udefaultserviceengineer;
	}
			
	//for service change				
	$ptmrate=0;
	$evemaxq1= "SELECT ptmrate FROM res_problemtype_master where ptmname='$problemname'";
	$remaxq1 = mysqli_query($conn, $evemaxq1);
	while($rtmaxq1 = mysqli_fetch_assoc($remaxq1))
	{
		$ptmrate=$rtmaxq1['ptmrate'];
	}
	
	
	$cyear = getFinancialYear2($mdate);
		$evemaxq = "SELECT max(cmno) AS maxcmno FROM res_complain_master where cyear='$cyear' and  samid=$samid";
	$remaxq = mysqli_query($conn, $evemaxq);
	while($rtmaxq = mysqli_fetch_assoc($remaxq))
	{
		$cmno=$rtmaxq['maxcmno'];
	}
	$cmno1=$cmno+1;
	$cmnowithprefix=generatecomplainno();
	
	$cmphoto1="";
	 if(empty($_FILES['cmphoto']['name']) == false)
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
		 // header("Location: $url");
		 
		  $flag=0;
		}
	}

	        $eve1 = "INSERT INTO res_complain_master 
(cmno,samid,pmid,customerid,cmdetail,cmphoto,cmdate,cstatus,cmstatusudate,cmupdatedon,cmupdatedby,cmnowithprefix,cmaddedby,cmaddedon
,cmproblemtype,cmtype,cmmethod,cmadminstatus,cmservicecharge,cmserviceengineerid,servicetype,cyear) VALUES('$cmno1','$samid','$pmid','$customerid','$cmdetail','$cmphoto1','$cmdate
','Pending','$mdate','$mdate1','$cmupdatedby','$cmnowithprefix','$customerid','$mdate1','$problemname','$ctmname','Online','Open','$ptmrate','$cmserviceengineerid','Complain','$cyear')";	


		if ($conn->query($eve1) === TRUE)
		{
			
			$last_id = $conn->insert_id;
			$_SESSION['cmsg'] = "You Complain Has Been Add  successfully";
			//header('Location: myaccount.php');
		}
		else
		{
			
			$_SESSION['cmsg1'] = "Error";
		}
		
		header("Location:mywebpage.php?id=$customerid");
	

  
	
		
?>