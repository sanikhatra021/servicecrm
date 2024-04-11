<?php
 session_start();

	date_default_timezone_set("Asia/Kolkata");
	$mdate1= date('Y-m-d H:i:s');
	
	include("connect.php");
	
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('y-m-d H:i:s');
	$mdate1= date('Y-m-d');
	
	
	$par1=$_SESSION['cmobile'];
	$par2=md5($_POST['cpassword']);

	$mobileotp = rand(100000, 999999);

	$eve = "select umid from res_user_master where uforgototpverify=1 and (umobile='$cmobile' or emailid='$cmobile')";
	$re = mysqli_query($conn, $eve);
	if(mysqli_num_rows($re) >0)
	{
		while($rt = mysqli_fetch_assoc($re))
		{
			$result="1";

			$evenewpass = "update res_user_master set upassword='$par2' where (umobile='$cmobile' or emailid='$cmobile')";
			$renewpass = mysqli_query($conn, $evenewpass);
		}
	  $_SESSION['sloginmsg']="Password successfully updated";

	}
  else{
    $result="0";
		$_SESSION['sloginmsg1'] ="Error";
  }
  header("Location: login.php");
?>
