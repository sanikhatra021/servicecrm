<?php  

error_reporting(E_ERROR | E_PARSE);
	include("../connect.php");
	include("../mylibrary.php");
	include("../getcomplainno.php");
	
	$par1=$_GET['p1'];	//mobile
	$par2=$_GET['p2'];	//university
	$par3=$_GET['p3'];	//iecourse
	$par4=$_GET['p4'];	//iepercentage
	$par5=$_GET['p5'];	//ctmid
	$par6=$_GET['p6'];	//status
	$par7=$_GET['p7'];	//detail
	
	if($par4=='')
	{
		$par4=0;
	}
	
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('Y-m-d');
	$mdate1= date('Y-m-d H:i:s');
	
	$response = array();
	$posts = array();
	$result ="0";
	$msg = "";
	
	$eve_category =  "SELECT * FROM  res_user_master where  umobile='$par1' and upassword='$par2'";
	$re_category = mysqli_query($conn,$eve_category);
	if(mysqli_num_rows($re_category) > 0)
    {
		while($rt_category = mysqli_fetch_assoc($re_category))
		{
				//$ctmid=$rt_category['ctmid'];
				//$pmid=$rt_category['pmid'];
				$umid=$rt_category['umid'];
				$samid=$rt_category['samid'];
				//$cmdate=implode('-', array_reverse(explode('-', $rt1['cmdate'])));
			
		}	
	
		
		$cyear = getFinancialYear2($mdate);
	$evemaxq = "SELECT max(cmno) AS maxcmno FROM res_complain_master where cyear='$cyear' and  samid=$samid";
	$remaxq = mysqli_query($conn, $evemaxq);
	while($rtmaxq = mysqli_fetch_assoc($remaxq))
	{
		$cmno=$rtmaxq['maxcmno'];
	}
	$cmno1=$cmno+1;
		//$saprefix=date("ymd");
		//$cmnowithprefix=$saprefix.$cmno1;
		$cmnowithprefix=generatecomplainno();
		
		   	  $eve1 = "insert into res_complain_master (cmno,ctmid,pmid,customerid,cmdate,cmdetail,cstatus,samid,cmserviceengineerid,cmupdatedon,cmupdatedby,cmaddedby,cmaddedon,cmnowithprefix,cyear) values($cmno1,'$par3','$par4','$par5','$par6','$par7','Pending','$samid','$umid','$mdate1','$umid','$umid','$mdate1','$cmnowithprefix','$cyear')";
			
			if ($conn->query($eve1) === TRUE) 
			{
				$last_id = $conn->insert_id;
				
				/* $eve123 = "insert into res_complain_detail (cmid,serviceengineerid) values('$last_id','$umid')";
				$re123 = mysqli_query($conn, $eve123); */
				
				$msg = "Success";
				$myObj2->status = "1";
				$myObj2->message = $msg;
				echo stripslashes(json_encode(array($myObj2)));	
			}
			else
		   {
				
				$result="0";
				$msg = "Failure";	
				$myObj2->status = $result;
				$myObj2->message = $msg;
				echo stripslashes(json_encode(array($myObj2)));
			
		   }
		
	}
	else
    {
	   $result="0";
	   $msg = "Invalid mobile OR password";
	   
		$myObj2->status = $result;
		$myObj2->message = $msg;
		echo stripslashes(json_encode(array($myObj2)));	
	
    }
   
    $response['posts'] = $posts;
	mysqli_close($conn);
	
	
?>