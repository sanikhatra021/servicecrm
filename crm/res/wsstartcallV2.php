<?php  
error_reporting(E_ERROR | E_PARSE);
	include("../connect.php");
	$par1=$_GET['p1'];
	$par2=$_GET['p2'];
	$par3=$_GET['p3'];
	$par4=$_GET['p4'];
	$par5=$_GET['p5'];
	$par6=$_GET['p6'];

	$hostName = $_SERVER['HTTP_HOST']; 
		
	$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
	
	$main1=$protocol.$hostName;
	
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
			$serviceengineerid=$rt1['umid'];
			$utype=$rt1['utype'];
			
		}
		
			 //$eve2 =  "SELECT * FROM  res_complain_master where samid=$samid and cmid in(select cmid from res_complainallocation_detail where serviceengid=$serviceengineerid)";
			$eve2 =  "SELECT * FROM  res_complain_master where samid=$samid and cmid ='$par3'";
			  $re2 = mysqli_query($conn,$eve2);
		if(mysqli_num_rows($re2) > 0)
		{
			
		//$serviceengineerid =0;
			while($rt2 = mysqli_fetch_assoc($re2))
			{
				$result="1";
				//$serviceengineerid = $rt2['cmserviceengineerid'];
				/* $cdid=$rt2['cdid']; */
				$cmid=$rt2['cmid'];
				$cmno=$rt2['cmno'];
				$customerid=$rt2['customerid'];
				$cmdate=$rt2['cmdate'];
		
				$cstatus= $rt2['cstatus'];
				
				$ctmname='';
				
			
				$last_id = "0";
				
				 $eve113 = "INSERT INTO res_complain_detail (cmid,custid,samid, serviceengineerid,cdstatus,cdaddedon,cactive,cdstarttime,assigndate,cdstartlatitude,cdstartlongitude,cdstartaddress)
				 VALUES ($par3, '$customerid', '$samid', '$serviceengineerid', '$cstatus', '$mdate', 1, '$mdate','$cmdate','$par4','$par5','$par6')";
				if ($conn->query($eve113) === TRUE) 
				{
					$last_id = $conn->insert_id;
				}
				
				$eve12 = "UPDATE res_complain_master SET cmactive = '1' WHERE cmid = $par3"; 
				$re12 = mysqli_query($conn, $eve12);
			
				$msg = "Success";
				$posts[] = array('p1'=> $result,'p2'=> "Call started",'p3'=> $last_id);
			}
				
			
		
			$response['posts'] = $posts;
			echo stripslashes(json_encode($posts));
		}
		else
		{
			$result="0";
		
		$posts[] = array('p1'=> $result,'p2'=> "No Data Found");
	
		//$response['posts'] = $posts;
		echo stripslashes(json_encode( array( $posts)));
		}
	}
   else
   {
		$result="0";
		
		$posts[] = array('p1'=> $result,'p2'=> "No Data Found");
	
		//$response['posts'] = $posts;
		echo stripslashes(json_encode( array( $posts)));
   }
	mysqli_close($conn);
?>
