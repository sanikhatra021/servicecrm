<?php  
error_reporting(E_ERROR | E_PARSE);
	include("../connect.php");
	$par1=$_GET['p1'];
	$par2=$_GET['p2'];
	//$par3=$_GET['p3'];

	$response = array();
	$posts = array();
	
	$ufullname="";
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('Y/m/d H:i:s');
				
	$eve1 =  "SELECT * FROM  res_user_master where  umobile='$par1' and upassword='$par2'";
	$re1 = mysqli_query($conn,$eve1);
															
	if(mysqli_num_rows($re1) > 0)
	{
		while($rt1 = mysqli_fetch_assoc($re1))
		{
			$samid=$rt1['samid'];
			
		}
	
		 $eve2 =  "SELECT * FROM  res_superadmin_master where samid=$samid";
		 $re2 = mysqli_query($conn,$eve2);
		if(mysqli_num_rows($re2) > 0)
		{
			
		
			while($rt2 = mysqli_fetch_assoc($re2))
			{
				$result="1";
				
				 $samid = $rt2['samid'];
				$safullname = $rt2['safullname'];
				$samobile=$rt2['samobile'];
				$saemailid=$rt2['saemailid'];
				$saaddress=$rt2['saaddress'];
				
				
				$msg = "Success";
				$posts[] = array('p1'=> $result,'p2'=> $samid,'p3'=> $safullname,'p4'=> $samobile,'p5'=> $saemailid,'p6'=> $saaddress);
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
