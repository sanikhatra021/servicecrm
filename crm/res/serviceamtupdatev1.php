<?php

 // mobile photo
 include("../connect.php");
 
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('Y/m/d H:i:s');
	$mdate1= date('Y-m-d');
	
	
	$par1 = $_GET['p1'];	//ummobile
	$par2 = $_GET['p2'];	//umpassword
	$par3 = $_GET['p3'];	//complain ID
	$par4 = $_GET['p4'];	//service amount
	$par5 = $_GET['p5'];	//final pay amount
	
	
	 $eve_category3 = "SELECT * FROM  res_user_master where  umobile='$par1' and upassword='$par2'";
	$re_category3 = mysqli_query($conn, $eve_category3);
	$umid=0;
	if(mysqli_num_rows($re_category3) > 0)
    {
		while($rt_category3 = mysqli_fetch_assoc($re_category3))
		{
			$samid = $rt_category3['samid'];
			$umid = $rt_category3['umid'];
		 
		  $eve1 = "update res_complain_master set cmstatusudate='$mdate1',cmupdatedon='$mdate',cmupdatedby='$umid',cmservicecharge='$par4',cmpayamount='$par5' where cmid='$par3'";
		  
			if ($conn->query($eve1) === TRUE) 
			{
				$result="1";

				$posts[] = array('p1'=> $result,'p2'=> "Successful");

				$response['posts'] = $posts;					
			}
			else
			{
				$result="0";
				
				$posts[] = array('p1'=> $result,'p2'=> "Failed");

				$response['posts'] = $posts;	
		   }
		}
	}
	else
	{
		$result="0";
		
		$posts[] = array('p1'=> $result,'p2'=> "Failed");

		$response['posts'] = $posts;	
   }		
	  echo stripslashes(json_encode($posts));
 
 
 ?>