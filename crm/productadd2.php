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
	$pmname=trim($_POST['pmname']);
	$pmdesc=trim($_POST['pmdesc']);
	$pmremark=trim($_POST['pmremark']);
	$prate=trim($_POST['prate']);

	$pimage1="";
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
		  $flag=1;
		}
		else 
		{
		  $_SESSION['msg1'] = "Only Upload Image";
		  header('Location: product.php');
		  return;
		  $flag=0;
		}
	}	
	 
		$eve = "select pmname from res_product_master where samid=$samid and pmname='$pmname'";
		$re = mysqli_query($conn, $eve);
		if(mysqli_num_rows($re) > 0)
		{
			$_SESSION['msg1'] = "Product Name already used.";
			header('Location: product.php');
		}
		else
		{	
			if($pmname!='')
			{
			 $eve1 = "INSERT INTO res_product_master (samid,pmname,pmdesc,pmremark,ptype,prate,pimage) VALUES('$samid','$pmname','$pmdesc','$pmremark','Product','$prate','$pimage1')";	
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
			else
			{
				$_SESSION['msg1'] = "Please Input Product Name";
			}
		}
	if($_POST['from']=='pro')
	{
		header('Location: complainadd.php');
	}
	else{
	header('Location: product.php');
	}
	
?>