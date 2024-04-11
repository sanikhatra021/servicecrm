<?php  
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("../connect.php");
	
	$par1=$_GET['p1'];
	$par2=$_GET['p2'];
	$par3=$_GET['p3'];
	
	
	$response = array();
	$posts = array();
	
	$eve1 =  "SELECT * FROM  res_user_master where  utype in ('serviceengineer','customer') and umobile='$par1' and upassword='$par2'";
	 $re1 = mysqli_query($conn,$eve1);
	
	$myObj2 = new stdClass();
	$ufullname="";
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('Y-m-d');
	$mdate1= date('H:i:s');
	if(mysqli_num_rows($re1) > 0)
	{
			while($rt2 = mysqli_fetch_assoc($re1))
			{	
		
				$umid=$rt2['umid'];
				$row_array['umid']=$rt2['umid'];
				$row_array['uname']=$rt2['uname'];
				$row_array['utype']=$rt2['utype'];
				$row_array['emailid']=$rt2['emailid'];
				$row_array['uaddress']=$rt2['uaddress'];
				$row_array['ucity']=$rt2['ucity'];
				$row_array['uloc1']=$rt2['uloc1'];
				$row_array['uloc2']=$rt2['uloc2'];
				
			
				$msg = "Success";
			
				
			}
			array_push($posts,$row_array);
			
			
			 $eve12 =  "update res_user_master set fcmtoken='$par3'  where umid=$umid";
			 $re12 = mysqli_query($conn,$eve12);
		
				$myObj2->status = "1";
				$myObj2->message = $msg;
				$myObj2->data=$posts;

				echo stripslashes(json_encode( array( $myObj2)));
	}
	
   else
   {
		$result="0";
		$msg = "Failed";	
		$myObj2->status = $result;
		$myObj2->message = $msg;
	
	echo stripslashes(json_encode( array( $myObj2)));
   }
	mysqli_close($conn);
?>
