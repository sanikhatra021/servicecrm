<?php  
error_reporting(E_ERROR | E_PARSE);
	include("../connect.php");
	$par1=$_GET['p1'];
	$par2=$_GET['p2'];
	//$par3=$_GET['p3'];

	
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
		if($utype=='customer')
		{
		  $eve2 =  "SELECT * FROM  res_complain_master where cstatus != 'Scheduled' and customerid=$serviceengineerid and samid=$samid";
		 $re2 = mysqli_query($conn,$eve2);
		}
		else
		{
			  $eve2 =  "SELECT * FROM  res_complain_master where cstatus != 'Scheduled' and cmserviceengineerid=$serviceengineerid and samid=$samid";
			  $re2 = mysqli_query($conn,$eve2);
		}
		if(mysqli_num_rows($re2) > 0)
		{
			
		
			while($rt2 = mysqli_fetch_assoc($re2))
			{
				$result="1";
				
				$seid=$rt2['cmserviceengineerid'];
				$cmno=$rt2['cmno'];
				$cmnowithprefix=$rt2['cmnowithprefix'];
				$cmid=$rt2['cmid'];
				$cmdetail=$rt2['cmdetail'];
				$cmdate=implode('-', array_reverse(explode('-', $rt2['cmdate'])));
				
				$cmphoto=$main1."/businesspanel/images/".$rt2['cmphoto'];
				$cmphoto=str_replace('http:','https:',$cmphoto);
				$cstatus= $rt2['cstatus'];
				$ctmid=$rt2['ctmid'];
				$cmproblemtype=$rt2['cmproblemtype'];
				$cmtype=$rt2['cmtype'];
				$eve12 = "select * from res_complaintype_master where ctmid=$ctmid";
				$re12 = mysqli_query($conn, $eve12);
				while($rt12 = mysqli_fetch_assoc($re12))
				{
					$ctmname=$rt12['ctmname'];
				}
				$pmid=$rt2['pmid'];
				$eve11 = "select * from res_product_master where pmid=$pmid and samid=$samid";
				$re11 = mysqli_query($conn, $eve11);
				while($rt11 = mysqli_fetch_assoc($re11))
				{
					$pmname=$rt11['pmname'];
				}
				
				$customerid=$rt2['customerid'];
				$eve112 = "select * from res_user_master where utype='customer' and umid=$customerid and samid=$samid";
				$re112 = mysqli_query($conn, $eve112);
				while($rt112 = mysqli_fetch_assoc($re112))
				{
					$umid=$rt112['umid'];
					$uname=$rt112['uname'];
					$uaddress=$rt112['uaddress'];
				}
				
				
				
				$cmid=$rt2['cmid'];
				 $eve113 = "select cdid from res_complain_detail where cmid=$cmid";
				$re113 = mysqli_query($conn, $eve113);
				$cdid="";
				while($rt112 = mysqli_fetch_assoc($re113))
				{
					$cdid=$rt112['cdid'];
				}
				$eve113 = "select * from res_user_master where utype='serviceengineer' and umid=$seid and samid=$samid";
				$re113 = mysqli_query($conn, $eve113);
				$seruname="";
				while($rt113 = mysqli_fetch_assoc($re113))
				{
					$seruname=$rt113['uname'];
					
				}
				
				$msg = "Success";
				$posts[] = array('p1'=> $result,'p2'=> $cmdetail,'p3'=> $cmdate,'p4'=> $cmphoto,'p5'=> $cstatus,'p6'=> $ctmname,'p7'=> $pmname,'p8'=> $uname,'p9'=> $uaddress,'p10'=> $umid,'p11'=> $pmid,'p12'=> $ctmid,'p13'=> $cmid,'p14'=> $cdid,'seruname'=>$seruname,'p18'=>$cmnowithprefix,'p19'=>$cmproblemtype,'p20'=>$cmtype);
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
		
		$posts[] = array('p1'=> $result,'p2'=> "No Data Found");
	
		//$response['posts'] = $posts;
		echo stripslashes(json_encode($posts));
   }
	mysqli_close($conn);
?>
