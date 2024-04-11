<?php
include './superpanel/phpqrcode/qrlib.php';
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
	$mdate= date('Y-m-d');
	
	
	
	$uname=$_POST['uname'];
	$umobile=$_POST['umobile'];
	$upassword=rand(10000,99999);
	//$utype=$_POST['utype'];
	$emailid=$_POST['emailid'];
	$uaddress=trim($_POST['uaddress']);
	$ucity=trim($_POST['ucity']);
	$upriority=$_POST['upriority'];
	$usite=$_POST['usite'];
	$uprojectmanagername=$_POST['uprojectmanagername'];
	$uprojectmanagermobile=$_POST['uprojectmanagermobile'];
	$uprojectinchargename="";
	$uprojectinchargemobile="";
	$udefaultserviceengineer=$_POST['udefaultserviceengineer'];
	
	
	/* if($_SESSION['currentid']==1)
	{
		$utype="customer";
	}
	else if($_SESSION['currentid']==2)
	{
		$utype="serviceengineer";
	} */
	
	
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
	
   		
		 $eve1 = "INSERT INTO res_user_master (samid,uname,umobile,upassword,utype,emailid,uaddress,ucity,upriority,udefaultserviceengineer,usite,uprojectmanagername,uprojectmanagermobile,uprojectinchargename,uprojectinchargemobile) VALUES('$samid','$uname','$umobile','$upassword','customer','$emailid','$uaddress','$ucity','$upriority','$udefaultserviceengineer','$usite','$uprojectmanagername','$uprojectmanagermobile','$uprojectinchargename','$uprojectinchargemobile')";
		
		
		if ($conn->query($eve1) === TRUE)
		{
			$last_id = $conn->insert_id;
			
			$saurl1=$main."mywebpage.php?id=".$last_id;
			if($last_id!=0)
			{
				$path = '../images/';
				/* $file1 = uniqid().".png"; */
				
				$no= date('YmdHis').rand(1111,9999);
				$file1 = $no.".png";
				$file = $path.$file1;
				
				// $ecc stores error correction capability('L')
				$ecc = 'L';
				$pixel_Size = 10;
				$frame_Size = 10;
				  
				// Generates QR Code and Stores it in directory given
				//QRcode::png($saurl1, $file, $ecc, $pixel_Size, $frame_size);
				$uqrimg=$file1;
				
				 $eve = "update res_user_master set uqrimg='$uqrimg' where umid=$last_id and samid=$samid and utype='customer'";
				 $re = mysqli_query($conn, $eve); 
			}
	
			$_SESSION['msg'] = "Record has been added successfully";
		}
		else
		{
			$_SESSION['msg1'] = "Error";
		}
		
	if($_POST['from']=='complain')
	{
		header('Location: complainadd.php');
	}
	else
	{
		header("Location: customer.php");
	}
	
?>