<?php  
error_reporting(E_ERROR | E_PARSE);
	include("../connect.php");
	$par1=$_GET['p1'];
	$par2=$_GET['p2'];
	$par3=$_GET['p3'];
	$par4=$_GET['p4'];

	$hostName = $_SERVER['HTTP_HOST']; 
		
	$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
	
	$main1=$protocol.$hostName;
	
	$response = array();
	$posts = array();
	
	$ufullname="";
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('Y/m/d H:i:s');
	$mdate2= date('Y-m-d');
				
	 $eve1 =  "SELECT * FROM  res_user_master where  umobile='$par1' and upassword='$par2'";
	$re1 = mysqli_query($conn,$eve1);
															
	if(mysqli_num_rows($re1) > 0)
	{
		while($rt1 = mysqli_fetch_assoc($re1))
		{
			$samid=$rt1['samid'];
			$serviceengineerid=$rt1['umid'];
			$utype=$rt1['utype'];
			
		}
		$eve113 = "INSERT INTO res_complainallocation_detail (cmid,serviceengid,allocateddate, samid)
				 VALUES ($par3, '$par4', '$mdate2', '$samid')";
		if ($conn->query($eve113) === TRUE) 
		{
			$result="1";
		
				$posts[] = array('p1'=> $result,'p2'=> "success");
			
				//$response['posts'] = $posts;
				echo stripslashes(json_encode( ( $posts)));
		}
		else
		{
			$result="0";
		
		$posts[] = array('p1'=> $result,'p2'=> "No Data Found");
	
		//$response['posts'] = $posts;
		echo stripslashes(json_encode( ( $posts)));
		}
	}
   else
   {
		$result="0";
		
		$posts[] = array('p1'=> $result,'p2'=> "No Data Found");
	
		//$response['posts'] = $posts;
		echo stripslashes(json_encode( ( $posts)));
   }
	mysqli_close($conn);
?>
