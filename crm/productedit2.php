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
	
	

	$pmid=$_POST['pmid'];
	$pmname=trim($_POST['pmname']);
	$pmdesc=trim($_POST['pmdesc']);
	$pmremark=trim($_POST['pmremark']);
	$prate=trim($_POST['prate']);
	
	$tt2="";
	if(empty($_FILES['pimage']['name']) == false  )
	{
		$simplephoto11=$_FILES['pimage']['name'];
		$ext = pathinfo($simplephoto11, PATHINFO_EXTENSION);
		$fileexplode1 = explode(".",$simplephoto11);
		$fileend1 = end($fileexplode1);

		$pimage1= date("YmdHis").rand(100,999).".".$fileend1;
		$path = "../images";
		if($ext=='png' || $ext=='jpg' || $ext=='jpeg' || $ext=='gif' || $ext=='PNG' || $ext=='JPG' || $ext=='JPEG' || $ext=='GIF')
		{
		  move_uploaded_file( $_FILES['pimage']['tmp_name'], $path ."/". $pimage1);
		  $tt2 = ",pimage='$pimage1'";
		}
		else 
		{
			$_SESSION['msg1'] = "Only Upload Image";
			header("Location: product.php");
			return;
		}
	}
	  $eve = "update res_product_master set pmname='$pmname',pmdesc='$pmdesc',pmremark='$pmremark',prate='$prate',ptype='Product' $tt2 where pmid=$pmid and samid=$samid";
	if ($conn->query($eve) === TRUE)
	{
			
		$_SESSION['msg'] = "Record has been updated successfully";	
	}
	else
	{
		$_SESSION['msg1'] = "Error";
	}
	header('Location: product.php');
?>