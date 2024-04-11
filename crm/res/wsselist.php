<?php  
error_reporting(E_ERROR | E_PARSE);

	include("../connect.php");
	
	$par1=$_GET['p1'];
	$par2=$_GET['p2'];
	//$par3=$_GET['p3'];
	
	
		
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('Y/m/d H:i:s');
	$mdate1= date('Y-m-d');
	
	$response = array();
	$posts = array();
	$result ="0";
	$msg = "";
	$eve1 =  "SELECT * FROM  res_user_master where  umobile='$par1' and upassword='$par2'";
	$re1 = mysqli_query($conn,$eve1);
															
	if(mysqli_num_rows($re1) > 0)
	{
		//$cdid=$rt_category['cdid'];
		//$cmid=$rt_category['cmid'];
	
		 $eve2 =  "Select * from res_complain_detail";
		 $re2 = mysqli_query($conn,$eve2);
		if(mysqli_num_rows($re2) > 0)
		{
			
			while($rt1 = mysqli_fetch_assoc($re2))
			{
				$result="1";
				
				$serviceengineerid = $rt1['serviceengineerid'];
				$cdid = $rt1['cdid'];
				$cmid = $rt1['cmid'];
				$assigndate=implode('-', array_reverse(explode('-', $rt1['assigndate'])));
				$cdstatus = $rt1['cdstatus'];
				
				
				$msg = "Success";
				$posts[] = array('p1'=> $result,'p2'=> $cmid,'p3'=> $assigndate,'p4'=> $cdstatus,'p5'=> $cdid,'p6'=> $serviceengineerid);
			}
			$response['posts'] = $posts;
		echo stripslashes(json_encode($posts));
		}
	}
   else
   {
		$result="0";
		
		$posts[] = array('p1'=> $result,'p2'=> "No Data Found");
	
		//$response['posts'] = $posts;
		echo stripslashes(json_encode( array( $myObj2)));
   }
	mysqli_close($conn);
?>
