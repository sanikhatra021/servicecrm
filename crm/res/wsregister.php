<?php  
//error_reporting(E_ERROR | E_PARSE);
	include("../connect.php");
	
	$par1=$_GET['p1'];	//name
	$par2=$_GET['p2'];	//mobile
	$par3=$_GET['p3'];	//password
	$par4=$_GET['p4'];	//emailid
	$par5=$_GET['p5'];	//uaddress
	$par6=$_GET['p6'];	//samid
	$par7=$_GET['p7'];	//samid
	
	
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('Y/m/d H:i:s');
	$mdate1= date('Y/m/d');
	
	$response = array();
	$posts = array();
	$result ="0";
	$msg = "";
	$eve22 = "select umid from res_user_master where  umobile='$par2'";
	$re22 = mysqli_query($conn, $eve22); 
	if(mysqli_num_rows($re22) > 0)
	{
			$result="0";
			$msg = "Registration Failed";	
			$myObj2->status = $result;
			$myObj2->message = $msg;
			echo stripslashes(json_encode(array($myObj2)));
	}
	else
	{		
	
		 $eve = "insert  into res_user_master (uname,umobile,upassword,emailid,uaddress,utype,samid,fcmtoken) values('$par1','$par2','$par3','$par4','$par5','customer','$par6','$par7')";
		if ($conn->query($eve) === TRUE) 
		{
			$msg = "Registration Successful";
			$myObj2->status = "1";
			$myObj2->message = $msg;
			echo stripslashes(json_encode(array($myObj2)));	
		}		
		else
		{
			
			$result="0";
			$msg = "Registration Failed";	
			$myObj2->status = $result;
			$myObj2->message = $msg;
			echo stripslashes(json_encode(array($myObj2)));
		
		}
	}
		mysqli_close($conn);
	
	
?>