<?php  
	include("../connect.php");
	
	$par1=$_GET['p1'];//mobile
	$par2=$_GET['p2'];//password
	$par3=$_GET['p3'];//complain id


	$response = array();
	$posts = array();
	
	$ufullname="";
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('Y/m/d H:i:s');
				
	$eve1 =  "SELECT * FROM  res_user_master where umobile='$par1' and upassword='$par2'";
	$re1 = mysqli_query($conn,$eve1);
	if(mysqli_num_rows($re1) > 0)
	{
		while($rt1 = mysqli_fetch_assoc($re1))
		{
			$samid=$rt1['samid'];
		}
		
		$eve2 = "select semailsubject,semailmsg from res_generalsettings_master where samid=$samid";
		$re2 = mysqli_query($conn, $eve2);
		while($rt2 = mysqli_fetch_assoc($re2))
		{
			$semailsubject=$rt2['semailsubject'];
			$semailmsg=$rt2['semailmsg'];
		}
		
		$eve3 = "select emailid from res_user_master where umid in(select customerid from res_complain_master where cmid=$par3)";
		$re3 = mysqli_query($conn, $eve3);
		$emailid="";
		while($rt3 = mysqli_fetch_assoc($re3))
		{
			$emailid=$rt3['emailid'];
		}
		
		$hostName = $_SERVER['HTTP_HOST']; 
		
		$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'https://';
		
		$main1=$protocol.$hostName;
		
		
		/* $url="http://localhost/sminder/businesspanel/generatepdf/invoicepdf.php?cmid=".$par3."&p1=app";		 */				
		 $url=$main1."/businesspanel/generatepdf/invoicepdf.php?cmid=".$par3."";
		//echo $url;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
		
		$content = curl_exec($ch);
		curl_close($ch);
	
		$par4=$main1."/businesspanel/download/".$par3.".pdf";
		//$par4=str_replace('http:','https:',$par4);
		
		
		/* $par4="http://localhost/sminder/businesspanel/download/".$par3.".pdf"; */
		
		$result=1;
		$msg = "Success";
		$posts[] = array('p1'=> $result,'p2'=> $msg,'p3'=> $par4,'p4'=> $emailid,'p5'=> $semailsubject,'p6'=> $semailmsg);
		
		$response['posts'] = $posts;
		echo stripslashes(json_encode($posts));
	
	}
   else
   {
		$result="0";
		
		$posts[] = array('p1'=> $result,'p2'=> "Invalid Mobile Or Password");
	
		echo stripslashes(json_encode($posts));
   }
	mysqli_close($conn);
?>
