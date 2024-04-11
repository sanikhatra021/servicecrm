<?php  
error_reporting(E_ERROR | E_PARSE);

	include("../connect.php");
	
	$par1=$_GET['p1'];
	$par2=$_GET['p2'];
	$par3=$_GET['p3'];
	
	
		
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
		while($rt1 = mysqli_fetch_assoc($re1))
		{
			$samid=$rt1['samid'];
			$umid=$rt1['umid'];
			
		}
		
	
		 $eve2 =  "Select * from res_ufeedback_master where samid=$samid and cmid in (select cmid from res_complain_detail where serviceengineerid=$umid)";
		 $re2 = mysqli_query($conn,$eve2);
		if(mysqli_num_rows($re2) > 0)
		{
			
			while($rt2 = mysqli_fetch_assoc($re2))
			{
				$result="1";
				
				$cmid=$rt2['cmid'];
				// $customerid=$rt1['customerid'];
				
				$eve11 = "select * from res_user_master where umid in(select customerid from res_complain_master where cmid=$cmid and samid=$samid)";
				$re11 = mysqli_query($conn, $eve11);
				$uname="";
				while($rt11 = mysqli_fetch_assoc($re11))
				{
					$uname=$rt11['uname'];
				} 
				$ufmid = $rt2['ufmid'];
				$ufmrating = $rt2['ufmrating'];
				$ufmreview = $rt2['ufmreview'];
				$ufmtechnical = $rt2['ufmtechnical'];
				$ufmdate=implode('-', array_reverse(explode('-', $rt2['ufmdate'])));
				
				
				$msg = "Success";
				$posts[] = array('p1'=> $result,'p2'=> $ufmid,'p3'=> $ufmrating,'p4'=> $ufmreview,'p5'=> $ufmdate,'p6'=> $cmid,'p7'=>$ufmtechnical,'p8'=>$uname);
			}
			$response['posts'] = $posts;
		echo stripslashes(json_encode($posts));
		}
		else{
			$result="0";
		
			$posts[] = array('p1'=> $result,'p2'=> "No Data Found");
	
			//$response['posts'] = $posts;
			echo stripslashes(json_encode($posts));
		}
	}
   else
   {
		$result="0";
		
		$posts[] = array('p1'=> $result,'p2'=> "No Data Found");
	
		//$response['posts'] = $posts;
		echo stripslashes(json_encode($posts));
   }
	mysqli_close($conn);
?>
