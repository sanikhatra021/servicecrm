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
			$serviceengineerid=$rt1['umid'];
			$utype=$rt1['utype'];
			$utype=$rt1['utype'];
		}
		if($utype=='customer')
		{
		  $eve2 =  "SELECT * FROM  res_complain_master where customerid=$serviceengineerid and samid=$samid";
		 $re2 = mysqli_query($conn,$eve2);
		}
		else
		{
			  $eve2 =  "SELECT * FROM  res_complain_master,res_complain_detail where res_complain_master.cmid=res_complain_detail.cmid and res_complain_detail.serviceengineerid=$serviceengineerid and res_complain_master.samid=$samid";
			  $re2 = mysqli_query($conn,$eve2);
		}
		
		if(mysqli_num_rows($re2) > 0)
		{
			
		$serviceengineerid =0;
			while($rt2 = mysqli_fetch_assoc($re2))
			{
				$result="1";
				$serviceengineerid = $rt2['serviceengineerid'];
				$cdid=$rt2['cdid'];
				$cmid=$rt2['cmid'];
				$cmdetail=$rt2['cmdetail'];
				$cdstatus=$rt2['cdstatus'];
				$cmdate=implode('-', array_reverse(explode('-', $rt2['cmdate'])));
				$assigndate=implode('-', array_reverse(explode('-', $rt2['assigndate'])));
				
				$cmphoto="https://linkarise.com/lacomplain/images/".$rt2['cmphoto'];
				$cstatus= $rt2['cstatus'];
				$ctmid=$rt2['ctmid'];
				$eve12 = "select * from res_complaintype_master where ctmid=$ctmid";
				$re12 = mysqli_query($conn, $eve12);
				while($rt12 = mysqli_fetch_assoc($re12))
				{
					$ctmname=$rt12['ctmname'];
				}
				$pmid=$rt2['pmid'];
				$eve11 = "select * from res_product_master where pmid=$pmid";
				$re11 = mysqli_query($conn, $eve11);
				while($rt11 = mysqli_fetch_assoc($re11))
				{
					$pmname=$rt11['pmname'];
				}
				
				$customerid=$rt2['customerid'];
				$eve112 = "select * from res_user_master where utype='customer' and umid=$customerid";
				$re112 = mysqli_query($conn, $eve112);
				while($rt112 = mysqli_fetch_assoc($re112))
				{
					$umid=$rt112['umid'];
					$uname=$rt112['uname'];
					$uaddress=$rt112['uaddress'];
				}
				
				
				$msg = "Success";
				$posts[] = array('p1'=> $result,'p2'=> $cmdetail,'p3'=> $cmdate,'p4'=> $cmphoto,'p5'=> $cstatus,'p6'=> $ctmname,'p7'=> $pmname,'p8'=> $uname,'p9'=> $uaddress,'p10'=> $umid,'p11'=> $pmid,'p12'=> $ctmid,'p13'=> $cmid,'p14'=> $cdid,'p15'=> $serviceengineerid,'p16'=> $cmdate,'p17'=> $cdstatus);
			}
		
			$response['posts'] = $posts;
			echo stripslashes(json_encode($posts));
		}
		else
		{
			$result="0";
		
		$posts[] = array('p1'=> $result,'p2'=> "No Data Found");
	
		//$response['posts'] = $posts;
		echo stripslashes(json_encode($posts));
		}
	}
   else
   {
		$result="0";
		
		$posts[] = array('p1'=> $result,'p2'=> "Invalid Username or Password");
	
		//$response['posts'] = $posts;
		/* echo stripslashes(json_encode( array( $posts))); */
		echo stripslashes(json_encode($posts));
   }
	mysqli_close($conn);
?>
