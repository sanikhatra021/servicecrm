<?php
include 'phpqrcode/qrlib.php'; 
session_start(); 

	if(!isset($_SESSION['lacomplainsuperadmin']))
	{
		header('Location: index.php');
		return;
	}
	
	
	
	include("connect.php");

	$samid=$_POST['samid'];
	$safullname=$_POST['safullname'];
	$samobile=$_POST['samobile'];

	$saemailid=$_POST['saemailid'];
	$saaddress=trim($_POST['saaddress']);
	$sacity="";
	$sauloc1="";
	$sauloc2="";
	$saplanexpdate=date("Y-m-d",strtotime($_POST['saplanexpdate']));
	/* $planstatus=$_POST['pstatus']; */
	$sacurrentplanstatus=$_POST['sacurrentplanstatus'];
	$estatus=$_POST['estatus'];
	$wstatus=$_POST['wstatus'];
	$satotusers=$_POST['satotusers'];
	$saurl=trim($_POST['saurl']);
	$saprefix=trim($_POST['saprefix']);
	
	
include("mylibrary.php");

$attach14="";
	if(empty($_FILES['cmpadminlogo']['name']) == false  )
	{
		$image1=checkvalidstring($_FILES['cmpadminlogo']['name']);
		$ext = pathinfo($image1, PATHINFO_EXTENSION);
		$cmpadminlogo = date("YmdHis").rand(1000,9999).'.'.$ext;
		$path = "../images";
		if($ext=='png' || $ext=='jpg' || $ext=='jpeg')
		 {
		move_uploaded_file( $_FILES['cmpadminlogo']['tmp_name'], $path ."/". $cmpadminlogo );

		$attach14 = ", cmpadminlogo='$cmpadminlogo'";
		}
	}
	
	
	// output: /myproject/index.php
	$currentPath = $_SERVER['PHP_SELF']; 
	
	// output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index ) 
	$pathInfo = pathinfo($currentPath); 
	
	// output: localhost
	$hostName = $_SERVER['HTTP_HOST']; 
	
	// output: http://
	$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
	/* $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))==''; */
	
	// return: http://localhost/myproject/
	$main=$protocol.$hostName."/";
	//return;
	$saurl1=$main.$saurl;
	if($saurl!='')
	{
		$path = '../../images/';
		/* $file1 = uniqid().".png"; */
		$file1 = $saurl.".png";
		$file = $path.$file1;
		
		// $ecc stores error correction capability('L')
		$ecc = 'L';
		$pixel_Size = 10;
		$frame_Size = 10;
		  
		// Generates QR Code and Stores it in directory given
		QRcode::png($saurl1, $file, $ecc, $pixel_Size, $frame_Size);
		$saqrimg=$file1;
	}
	else
	{
		$saqrimg='';
	}
	
	$eve = "update res_superadmin_master set safullname='$safullname',samobile='$samobile',saemailid='$saemailid',saaddress='$saaddress',sacity='$sacity',sauloc1='$sauloc1',sauloc2='$sauloc2',saplanexpdate='$saplanexpdate',sacurrentplanstatus='$sacurrentplanstatus',saurl='$saurl',saqrimg='$saqrimg',satotusers='$satotusers',saprefix='$saprefix' ,sendwhatsapp='$wstatus',sendemail='$estatus' $attach14 where samid=$samid";	
	
	if ($conn->query($eve) === TRUE)
	{
			
		$_SESSION['msg'] = "Record has been updated successfully";
		
		header('Location: superadmin.php');
			
	}
?>