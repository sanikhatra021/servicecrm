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
	
		 $eve2 =  "SELECT * FROM  res_product_master where samid=$samid and ptype='Item'";
		 $re2 = mysqli_query($conn,$eve2);
		if(mysqli_num_rows($re2) > 0)
		{
			
		
			while($rt2 = mysqli_fetch_assoc($re2))
			{
				$result="1";
				
				$pmid=$rt2['pmid'];
				$pmname=$rt2['pmname'];
				$prate=$rt2['prate'];
				
				
				$msg = "Success";
				$posts[] = array('p1'=> $result,'p2'=> $pmid,'p3'=> $pmname,'p4'=> $prate);
			}
			$response['posts'] = $posts;
		echo stripslashes(json_encode($posts));
		}
	}
   else
   {
		$result="0";
		$msg = "No data found";
		$response['posts'] = $posts;
		echo stripslashes(json_encode($posts));
   }
	mysqli_close($conn);
?>
