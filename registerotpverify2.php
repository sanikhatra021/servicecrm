<?php  
session_start(); 
	include("connectp.php");
	include("connect.php");
	
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('y-m-d H:i:s');
	$mdate1= date('Y-m-d');
	
	
	if(isset($_SESSION['cmobile']))
	{
		$par1 = $_SESSION['cmobile'];
	}
	else if(isset($_SESSION['cemail']))
	{
		$par1 = $_SESSION['cemail'];
	}
	
	$uregotp = $_POST['uregotp'];
	
	$eve = "select * from res_user_master where uregotp=$uregotp and (umobile='$par1' or emailid='$par1')";
	$re = mysqli_query($conn, $eve);
	
	  if(mysqli_num_rows($re) > 0)
	  {
			 while($rt = mysqli_fetch_assoc($re))
			 {
				$evenewpass = "update res_user_master set uregotpverify='1' where uregotp=$uregotp and (umobile='$par1' or emailid='$par1')";
				$renewpass = mysqli_query($conn, $evenewpass);
			}
			$result="1";
			$_SESSION['srotpmsg']= "Registration & OTP verification successfull";
			header("Location: login.php");
		}
	   else
	   {
			$result="0";
			$_SESSION['srotpmsg1']= "Invalid OTP";
			header("Location: registerotpverify.php");
	   }

?>