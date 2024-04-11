<?php  
	include("../connect.php");

	//mobile
	$par1=$_GET['p1'];
	$par2=$_GET['p2'];
	
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('Y/m/d H:i:s');
	$mdate1= date('Y-m-d');
	if (getenv('HTTP_CLIENT_IP'))
		$ipaddress = getenv('HTTP_CLIENT_IP');
	else if(getenv('HTTP_X_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	else if(getenv('HTTP_X_FORWARDED'))
		$ipaddress = getenv('HTTP_X_FORWARDED');
	else if(getenv('HTTP_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_FORWARDED_FOR');
	else if(getenv('HTTP_FORWARDED'))
		$ipaddress = getenv('HTTP_FORWARDED');
	else if(getenv('REMOTE_ADDR'))
		$ipaddress = getenv('REMOTE_ADDR');
	else
		$ipaddress = 'UNKNOWN';
	
	$userserver=$_SERVER['HTTP_USER_AGENT'];
		
	/* $eve_log = "insert into res_customer_log (clid,clmobile,cllastupdatedtime,clpagename,cltaskname,clipaddress,cluseragentdetail,clslog) values(NULL,'$par1','$mdate','User Register otp resend Android App','User Register','$ipaddress','$userserver',0)";
	$re_log = mysqli_query($conn, $eve_log); */

	$response = array();
	$posts = array();
	$result="0";
	
	$query_mobile = "select * from res_user_master where umobile='$par1' and upassword='$par2'";
	$result_mobile = mysqli_query($conn, $query_mobile);
	if(mysqli_num_rows($result_mobile) > 0)
	{
		while($rt1 = mysqli_fetch_assoc($result_mobile))
		{
			$samid=$rt1['samid'];
			$umid=$rt1['umid'];
			
		}
	    $query_mobile1 = "select * from  res_problemtype_master where samid='$samid'";
		$result_mobile1 = mysqli_query($conn, $query_mobile1);
		if(mysqli_num_rows($result_mobile1) > 0)
		{
		 while($rt_mobile1 = mysqli_fetch_assoc($result_mobile1))
		 {
			$ptmid=$rt_mobile1['ptmid'];	
			$ptmname=$rt_mobile1['ptmname'];	
			
			$result="1";
			$posts[] = array('p1'=> $result,'p2'=> 'successful','p3'=> $ptmid,'p4'=>$ptmname);			
		 }
		}
		else
		{
		   $posts[] = array('p1'=> 0,'p2'=> "No Data");
		}
				   
			 
		   
   }
   else
   {
	   $posts[] = array('p1'=> $result,'p2'=> "Unsuccessfull");
   }

	$response['posts'] = $posts;
	echo stripslashes(json_encode($posts));


	mysqli_close($conn);
	
?>