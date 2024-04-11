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
	
	

		$bannerimgsortorder=$_POST['bannerimgsortorder'];
		$bmname=$_POST['bmname'];
		
		
		
	$bannerimg1="";
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
		  $flag=1;
		}
		else 
		{
		  $_SESSION['msg1'] = "Only Upload Image";
		  header('Location: banner.php');
		  return;
		  $flag=0;
		}
	}
	
   /*  $eve22 = "select bannerimg from res_banner_master where bannerimgsortorder='$bannerimgsortorder'";
	$re22 = mysqli_query($conn, $eve22); 
	if(mysqli_num_rows($re22) > 0)
	{
		$_SESSION['msg1'] = "This type of Category Already Added..";
		header('Location: banner.php');
	}
	else
	{	 */	
	
		 $eve1 = "INSERT INTO res_banner_master (samid,bannerimg,bannerimgsortorder,bmname) VALUES('$samid','$bannerimg1','$bannerimgsortorder','$bmname')";
		
		
		if ($conn->query($eve1) === TRUE)
		{
			$last_id = $conn->insert_id;
			$_SESSION['msg'] = "Record has been added successfully";
		}
		else
		{
			$_SESSION['msg1'] = "Error";
		}
	//}
		
	
header('Location: banner.php');
?>