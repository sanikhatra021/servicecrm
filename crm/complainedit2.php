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
	$mdate2= date('Y-m-d');
	
	

	$cmid=$_POST['cmid'];
	
	$cmtype=$_POST['cmtype'];
	//$ctmname=$_POST['ctmname'];
	$customerid=$_POST['customerid'];
	
	
	
	$customersite=$_POST['customersite'];
	$customermobile=$_POST['customermobile'];
	$uemail=$_POST['uemail'];
	
	$customeraddress=$_POST['customeraddress'];
	$ucity=$_POST['ucity'];
	
	// needed fields for editing starts
		$pmid=$_POST['pmid'];
		$cmpproductdetail=$_POST['sproductdetail'];
		$cmdetail=$_POST['cmdetail'];
		$servicemid=$_POST['servicecontractid'];
		
		
		
	// needed fields for editing ends
	
	
	
	
	
	
	
	$cmdate=implode('-', array_reverse(explode('-',$_POST['cmdate'])));
	$cstatus=$_POST['cstatus'];
	$problemname=$_POST['problemname'];
	
	//for service change				
	$ptmrate=0;
	$everate1= "SELECT ptmrate FROM res_problemtype_master where ptmname='$problemname'";
	$rerate1 = mysqli_query($conn, $everate1);
	while($rtmaxq1 = mysqli_fetch_assoc($rerate1))
	{
		$ptmrate=$rtmaxq1['ptmrate'];
	}
	
	$tt2="";
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
		  $tt2 = ",cmphoto='$cmphoto1'";
		}
		else 
		{
			$_SESSION['msg1'] = "Only Upload Image";
			header("Location: user.php");
			return;
		}
	}	
	
	 $eve = "update res_complain_master set pmid='$pmid',customerid='$customerid',cmdetail='$cmdetail',cmdate='$cmdate',cstatus='$cstatus',cmproblemtype='$problemname',cmpproductdetail='$cmpproductdetail',servicemid='$servicemid',cmservicecharge='$ptmrate',cmtype='$cmtype' $tt2 where cmid=$cmid and samid=$samid";
	if ($conn->query($eve) === TRUE)
	{
			
		$_SESSION['msg'] = "Record has been updated successfully";	
	}
	else
	{
		$_SESSION['msg1'] = "Error";
	}
	header('Location: complain.php');
?>