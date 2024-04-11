<?php  
error_reporting(E_ERROR | E_PARSE);

	include("../connect.php");
	
	$par1=$_GET['p1'];
	$par2=$_GET['p2'];
	$par3=$_GET['p3'];
	$par4=$_GET['p4'];
	$par5=$_GET['p5'];
	$par6=$_GET['p6'];
	$par7=$_GET['p7'];
	$par8=$_GET['p8'];
	
		
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
		while($rt2 = mysqli_fetch_assoc($re1))
		{
				
				$samid=$rt2['samid'];
				
			
		}	
	
		 $eve2 =  "Select * from res_user_master where utype='customer' and samid=$samid";
		 $re2 = mysqli_query($conn,$eve2);
		if(mysqli_num_rows($re2) > 0)
		{
			
			while($rt1 = mysqli_fetch_assoc($re2))
			{
				$result="1";
				
				$umid = $rt1['umid'];
				$uname = $rt1['uname'];
				$umobile = $rt1['umobile'];
				$utype = $rt1['utype'];
				$emailid = $rt1['emailid'];
				$uaddress = $rt1['uaddress'];
				$ucity = $rt1['ucity'];
				
				$msg = "Success";
				$posts[] = array('p1'=> $result,'p2'=> $umid,'p3'=> $uname,'p4'=> $umobile,'p5'=> $utype,'p6'=> $emailid,'p7'=> $uaddress,'p8'=> $ucity);
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
		echo stripslashes(json_encode( array( $posts)));
   }
	mysqli_close($conn);
?>
