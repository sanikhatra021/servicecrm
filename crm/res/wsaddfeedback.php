<?php  
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	include("../connect.php");
	
	$par1=$_GET['p1'];	//mobile
	$par2=$_GET['p2'];	//pass
	$par3=$_GET['p3'];	//ufmrating
	$par4=$_GET['p4'];	//ufmreview
	$par5=$_GET['p5'];	//ufmtechnical
	$par6=$_GET['p6'];	//cmid
	
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('Y-m-d');
	$myObj2 = new stdClass();
	$response = array();
	$posts = array();
	$result ="0";
	$msg = "";
	
	$eve_category =  "SELECT * FROM  res_user_master where  umobile='$par1' and upassword='$par2'";
	$re_category = mysqli_query($conn,$eve_category);
	if(mysqli_num_rows($re_category) > 0)
    {
		while($rt_category = mysqli_fetch_assoc($re_category))
		{
			$samid=$rt_category['samid'];
			
		}	
			
		   	  $eve1 = "insert into res_ufeedback_master (ufmrating,ufmreview,ufmtechnical,ufmdate,cmid,samid) values('$par3','$par4','$par5','$mdate','$par6','$samid')";
			
			if ($conn->query($eve1) === TRUE) 
			{
				$msg = "Success";
				
				$myObj2->status = "1";
				$myObj2->message = $msg;
				echo stripslashes(json_encode(array($myObj2)));	
			}
			else
		   {
				
				$result="0";
				$msg = "Failure";	
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