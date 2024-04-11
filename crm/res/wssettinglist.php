<?php  
error_reporting(E_ERROR | E_PARSE);

	include("../connect.php");
	
	//$par1=$_GET['p1'];
	//$par2=$_GET['p2'];
	
	
	
		
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('Y/m/d H:i:s');
	$mdate1= date('Y-m-d');
	
	$response = array();
	$posts = array();
	$eve1 =  "SELECT * FROM  res_settings_master";
	 $re1 = mysqli_query($conn,$eve1);
	
	$ufullname="";
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('Y-m-d');
	$mdate1= date('H:i:s');
	if(mysqli_num_rows($re1) > 0)
	{
			while($rt2 = mysqli_fetch_assoc($re1))
			{	
				$result="1";
				$semid=$rt2['semid'];
				$sappversion=$rt2['sappversion'];
				$sapplink=$rt2['sapplink'];
			
				
				
			
			$msg = "Success";
			$posts[] = array('p1'=> $result,'p2'=> $semid,'p3'=> $sappversion,'p4'=> $sapplink);
				
			}
		
				

	$response['posts'] = $posts;
		echo stripslashes(json_encode($posts));
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
