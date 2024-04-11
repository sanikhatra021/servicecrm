<?php  
error_reporting(E_ERROR | E_PARSE);

	include("../connect.php");
	
	$par1=$_GET['p1'];//mobile
	$par2=$_GET['p2'];//pass
	$par3=$_GET['p3'];//emailid
	$par4=$_GET['p4'];//umid
	$par5=$_GET['p5'];//address
		
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('Y/m/d H:i:s');
	$mdate1= date('Y-m-d');
	
	$response = array();
	$posts = array();
	$myObj2 = new stdClass();
	$result ="0";
	$msg = "";
	 $eve_category =  "SELECT * FROM  res_user_master where  umobile='$par1' and upassword='$par2'";
	$re_category = mysqli_query($conn,$eve_category);
	
	if(mysqli_num_rows($re_category) > 0)
    {
		while($rt_category = mysqli_fetch_assoc($re_category))
		{
			$samid =$rt_category['samid'];
		}	
				$eve = "update res_user_master set emailid='$par3',uaddress='$par5' where umid=$par4 and samid=$samid";
			if ($conn->query($eve) === TRUE) 
			{
				$msg = "Profile Updated";
				$myObj2->status = "1";
				$myObj2->message = $msg;
				echo stripslashes(json_encode(array($myObj2)));	
			}
			else
		   {
				
				$result="0";
				$msg = "Profile Not Updated";	
				$myObj2->status = $result;
				$myObj2->message = $msg;
				echo stripslashes(json_encode(array($myObj2)));
			
		   }
		
	}
	else
    {
	   $result="0";
	   $msg = "Invalid mobile OR password";
	   
		$myObj2->status = $result;
		$myObj2->message = $msg;
		echo stripslashes(json_encode(array($myObj2)));	
    }
   
    $response['posts'] = $posts;
	mysqli_close($conn);
	
?>