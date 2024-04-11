<?php  
session_start(); 
	include("connectp.php");
	include("connect.php");
	
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('y-m-d H:i:s');
	$mdate1= date('Y-m-d');
	
	$par1 = $_SESSION['cmobile'];

	
	$uforgototp = $_POST['uforgototp'];
	
	$eve = "select * from res_user_master where uforgototp=$uforgototp and (umobile='$par1' or emailid='$par1')";
	$re = mysqli_query($conn, $eve);
	
	  if(mysqli_num_rows($re) > 0)
	  {
			while($rt = mysqli_fetch_assoc($re))
			{
				$evenewpass = "update res_user_master set uforgototpverify='1' where uforgototp=$uforgototp and (umobile='$par1' or emailid='$par1')";
				$renewpass = mysqli_query($conn, $evenewpass);
			}
			$result="1";
			$_SESSION['ssetnewmsg']= "OTP verification successfull";
			header("Location: setnewpassword.php");
		}
	   else
	   {
			$result="0";
			$_SESSION['sfotpmsg1']= "Invalid OTP";
			header("Location: otpverify.php");
	   }

?>