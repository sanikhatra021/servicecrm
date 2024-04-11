<?php  
error_reporting(E_ERROR | E_PARSE);
	include("../connect.php");
	$par1=$_GET['p1'];
	$par2=$_GET['p2'];
	$par3=$_GET['p3'];

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
	
		 $eve2 =  "SELECT * FROM  res_complainitem_detail where cmid='$par3'";
		 $re2 = mysqli_query($conn,$eve2);
		if(mysqli_num_rows($re2) > 0)
		{
			
		
			while($rt2 = mysqli_fetch_assoc($re2))
			{
				$result="1";
				
				$cmid=$rt2['cmid'];
				$pmid=$rt2['pmid'];
				$eve22 = "select * from res_product_master where pmid=$pmid";
				$re22 = mysqli_query($conn, $eve22);
				while($rt22 = mysqli_fetch_assoc($re22))
				{
					$pmname=$rt22['pmname'];
					
				} 
				$cmservicecharge = "0";
				$eve33 = "select * from res_complain_master where cmid=$par3";
				$re33 = mysqli_query($conn, $eve33);
				while($rt33 = mysqli_fetch_assoc($re33))
				{
					$cmservicecharge=$rt33['cmservicecharge'];
					
				} 
				$cidqty=$rt2['cidqty'];
				$cidrate=$rt2['cidrate'];
				
				
				$msg = "Success";
				$posts[] = array('p1'=> $result,'p2'=> $cmid,'p3'=> $pmid,'p4'=> $pmname,'p5'=> $cidqty,'p6'=> $cidrate,'p7'=> $cmservicecharge);
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
