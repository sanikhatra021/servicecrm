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
	$servicengarry = array();
	$othrservicengarry = array();
	$itemlist = array();
	
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
		
			   $eve2 =  "SELECT * FROM  res_complain_master where samid=$samid and cmid = $par3";
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
				$cmnowithprefix=$rt2['cmnowithprefix'];
				$cmdetail=$rt2['cmdetail'];
				$cmactive=$rt2['cmactive'];
				$cmpproductdetail=$rt2['cmpproductdetail'];

				/* $cdstatus=$rt2['cdstatus']; */
				$cdservicecharge=0;
				
				if($rt2['cmservicecharge'] != null)
					$cdservicecharge=$rt2['cmservicecharge'];
				$cmdate=implode('-', array_reverse(explode('-', $rt2['cmdate'])));
				$assigndate=implode('-', array_reverse(explode('-', $rt2['assigndate'])));
				
				$cmphoto=$main1."/businesspanel/images/".$rt2['cmphoto'];
				$cmphoto=str_replace('http:','https:',$cmphoto);
				$cstatus= $rt2['cstatus'];
				$ctmid=$rt2['ctmid'];
				$cmtype=$rt2['cmtype'];
				$cmproblemtype=$rt2['cmproblemtype'];
				
				
			
				 $eve1134 = "select cdid,cdstatus from res_complain_detail where cmid=$cmid and serviceengineerid=$serviceengineerid and cactive=1";
				$re1134 = mysqli_query($conn, $eve1134);
				$cdid="";
				$cdstatus="";
				$cactive=0;
				if(mysqli_num_rows($re1134) > 0)
				{
					$cactive=1;
					while($rt1134 = mysqli_fetch_assoc($re1134))
					{
						$cdid=$rt1134['cdid'];
						$cdstatus=$rt1134['cdstatus'];
					}
				}
				
				/* 
				  $eve113 = "select cdid,cdstatus from res_complain_detail where cmid=$cmid and serviceengineerid = ''";
				$re113 = mysqli_query($conn, $eve113);
				$cdid="";
				$cdstatus="";
				while($rt112 = mysqli_fetch_assoc($re113))
				{
					$cdid=$rt112['cdid'];
					$cdstatus=$rt112['cdstatus'];
				}  
				
				 $eve12 = "select * from res_complaintype_master where ctmid=$ctmid";
				 
				$re12 = mysqli_query($conn, $eve12);
				if(mysqli_num_rows($re12) > 0)
				{
					while($rt12 = mysqli_fetch_assoc($re12))
					{
								$ctmname=$rt12['ctmname'];
					}
				} */
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
					$usite=$rt112['usite'];
					$managername=$rt112['uprojectmanagername'];
					$managermobile=$rt112['uprojectmanagermobile'];
					$inchargename=$rt112['uprojectinchargename'];
					$inchargemobile=$rt112['uprojectinchargemobile'];
				}
				$eve1121 = "select serviceengid from res_complainallocation_detail where cmid=$par3 GROUP BY serviceengid";
				$re1121 = mysqli_query($conn, $eve1121);
				while($rt1121 = mysqli_fetch_assoc($re1121))
				{
					$serviceengid=$rt1121['serviceengid'];
					$eve1122 = "select uname from res_user_master where umid=$serviceengid";
					$re1122 = mysqli_query($conn, $eve1122);
					while($rt1122 = mysqli_fetch_assoc($re1122))
					{
						$sename=$rt1122['uname'];
					}
					
					$servicengarry[] = array('serviceengid'=> $serviceengid,'p2'=> $sename);
				}
				
				$eve1123 = "select umid,uname from res_user_master where utype = 'serviceengineer' and samid=$samid and umid not in (select serviceengid from res_complainallocation_detail where cmid=$par3)";
				$re1123 = mysqli_query($conn, $eve1123);
				while($rt1123 = mysqli_fetch_assoc($re1123))
				{
					$othrserviceengid=$rt1123['umid'];
					$othrserviceengname=$rt1123['uname'];
					
					$othrservicengarry[] = array('serviceengid'=> $othrserviceengid,'p2'=> $othrserviceengname);
				}
				$eve24 =  "SELECT * FROM  res_complainitem_detail where cmid='$par3'";
				$re24 = mysqli_query($conn,$eve24);
				if(mysqli_num_rows($re24) > 0)
				{
					
				
					while($rt24 = mysqli_fetch_assoc($re24))
					{
						$result="1";
						
						$cmid=$rt24['cmid'];
						$cidqty=$rt24['cidqty'];
						$cidrate=$rt24['cidrate'];
						$pmid=$rt24['pmid'];
						$eve22 = "select * from res_product_master where pmid=$pmid";
						$re22 = mysqli_query($conn, $eve22);
						while($rt22 = mysqli_fetch_assoc($re22))
						{
							$pmname=$rt22['pmname'];
							
						} 
						/* $cmservicecharge = "0";
						$eve33 = "select * from res_complain_master where cmid=$par3";
						$re33 = mysqli_query($conn, $eve33);
						while($rt33 = mysqli_fetch_assoc($re33))
						{
							$cmservicecharge=$rt33['cmservicecharge'];
							
						}  */
						$itemlist[] = array('p1'=> $result,'p2'=> $cmid,'p3'=> $pmid,'p4'=> $pmname,'p5'=> $cidqty,'p6'=> $cidrate);
					}
				}
				
				$amcvalue = '0';
				$custsdate = '';
				$custedate = '';
				$amcserial = '';
				//$eve23 =  "SELECT * FROM  res_amc_master where amcid = $amcid and samid = '$samid'";		
				$eve23 =  "SELECT * FROM  res_amc_master where samid = '$samid'";		
				 $re23 = mysqli_query($conn,$eve23);
				if(mysqli_num_rows($re23) > 0)
				{
					$amcvalue = '1';
					
					while($rt23 = mysqli_fetch_assoc($re23))
					{
						$result="1";
						$amcserial=$rt23['amcserial'];
						$custsdate=implode('-', array_reverse(explode('-', $rt23['custsdate'])));
						$custedate=implode('-', array_reverse(explode('-', $rt23['custedate'])));
						
					}
				}else
				{
					$eve24 =  "SELECT * FROM  res_amc_master where pmid = $pmid  and samid = '$samid'";		
						 $re24 = mysqli_query($conn,$eve24);
						if(mysqli_num_rows($re24) > 0)
						{
							$amcvalue = '1';
							
							while($rt24 = mysqli_fetch_assoc($re24))
							{
								
								$amcserial=$rt24['amcserial'];
								$custsdate=implode('-', array_reverse(explode('-', $rt24['custsdate'])));
								$custedate=implode('-', array_reverse(explode('-', $rt24['custedate'])));
								
							}
						}
					
				}
				
			}
				$msg = "Success";
				$posts[] = array('p1'=> $result,'p2'=> $cmdetail,'p3'=> $cmdate,'p4'=> $cmphoto,'p5'=> $cstatus,'p6'=> $cmtype,'p7'=> $pmname,'p8'=> $uname,'p9'=> $uaddress,'p10'=> $umid,'p11'=> $pmid,'p12'=> $ctmid,'p13'=> $cmid,'p14'=> $cdid,'p15'=> $serviceengineerid,'p16'=> $cmdate,'p17'=> $cdstatus,'amcvalue'=> $amcvalue,'amcserial'=> $amcserial,'custsdate'=> $custsdate,'custedate'=> $custedate,'umobile'=> $umobile,'cdservicecharge'=> $cdservicecharge,'p18'=> $cmnowithprefix,'p19'=>$cmproblemtype,'p20'=>$cmtype,'p21'=>$usite,'p22'=>$managername,'p23'=>$managermobile,'p24'=>$inchargename,'p25'=>$inchargemobile,'p26'=>$cmactive,'p27'=>$cactive, 'p28'=> $servicengarry, 'p29'=> $othrservicengarry, 'p30'=> $itemlist, 'p31'=> $cmpproductdetail);
			
		
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
