<?php  
error_reporting(E_ERROR | E_PARSE);
	include("../connect.php");
	$par1=$_GET['p1'];
	$par2=$_GET['p2'];
	$par3=$_GET['p3'];

	$hostName = $_SERVER['HTTP_HOST']; 
		
	$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
	
	$main1=$protocol.$hostName;
	
	$response = array();
	$posts = array();
	
	$ufullname="";
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('Y/m/d H:i:s');
	$tt = "";			
	if($par3 == "1")
	{
		$tt = " and cstatus NOT IN ('Scheduled','Completed') ";
	}
	else
	{
		$tt = " and cstatus = 'Completed' ";
	}
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
		  $eve2 =  "SELECT * FROM  res_complain_master where customerid=$serviceengineerid $tt and samid=$samid";
		 $re2 = mysqli_query($conn,$eve2);
		}
		else
		{
			  $eve2 =  "SELECT * FROM res_complain_master WHERE samid = $samid $tt AND cmid IN (SELECT cmid FROM res_complainallocation_detail WHERE serviceengid = $serviceengineerid)  order by cmid IN (SELECT cmid FROM res_complain_detail where cactive=1) desc";
			  $re2 = mysqli_query($conn,$eve2);
		}
		
		if(mysqli_num_rows($re2) > 0)
		{
			
		$serviceengineerid =0;
			while($rt2 = mysqli_fetch_assoc($re2))
			{
				$result="1";
				$serviceengineerid = $rt2['cmserviceengineerid'];
				/* $cdid=$rt2['cdid']; */
				$cmid=$rt2['cmid'];
				$cmno=$rt2['cmno'];
				//$cmactive=$rt2['cmactive'];
				$cmnowithprefix=$rt2['cmnowithprefix'];
				$cmdetail=$rt2['cmdetail'];
				$cmproblemtype=$rt2['cmproblemtype'];
				$cmtype=$rt2['cmtype'];
				$cdstatus=$rt2['cdstatus'];
				$cmdate=implode('-', array_reverse(explode('-', $rt2['cmdate'])));
				$cmupdatedon=date('d-m-Y',strtotime($rt2['cmupdatedon']));
				$assigndate=implode('-', array_reverse(explode('-', $rt2['assigndate'])));
				
				$cmphoto=$main1."/businesspanel/images/".$rt2['cmphoto'];
				$cmphoto=str_replace('http:','https:',$cmphoto);
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
					$umobile=$rt112['umobile'];
				}
				
				 $eve13 =  "SELECT cdid,cdstatus,cactive FROM  res_complain_detail where cmid=$cmid";
				 $re13 = mysqli_query($conn,$eve13);
				 $cdid="";
				 $cdstatus="";
				 $cactive="";
				 if(mysqli_num_rows($re2) > 0)
					{
				 while($rt13 = mysqli_fetch_assoc($re13))
				 {
					 $cdid=$rt13['cdid'];
					 $cdstatus=$rt13['cdstatus'];
					 $cactive=$rt13['cactive'];
				 }
				}
				
				if($cactive==1){
					$cactive1="Active Call";
				}
				else{
					$cactive1="InActive Call";
				}
				$msg = "Success";
				if($uname!= null)
				{
					$posts[] = array('p1'=> $result,'p2'=> $cmdetail,'p3'=> $cmdate,'p4'=> $cmphoto,'p5'=> $cstatus,'p6'=> $ctmname,'p7'=> $pmname,'p8'=> $uname,'p9'=> $uaddress,'p10'=> $umid,'p11'=> $pmid,'p12'=> $ctmid,'p13'=> $cmid,'p14'=> $cdid,'p15'=> $serviceengineerid,'p16'=> $cmupdatedon,'p17'=> $cdstatus,'p18'=> $cmnowithprefix,'p19'=>$umobile,'p20'=>$cmproblemtype,'p21'=>$cmtype,'p22'=>$cactive1);
				}
				
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
