<?php  
	include("../connect.php");
	
	function check_file_exists_here($url){
	   $result=get_headers($url);
	   return stripos($result[0],"200 OK")?true:false; //check if $result[0] has 200 OK
	}
		
	$par1=$_GET['p1'];//mobile
	$par2=$_GET['p2'];//password
	$par3=$_GET['p3'];//complain id
	$par4=$_GET['p4'];//customer emailid
	$par5=$_GET['p5'];//semailsubject
	$par6=$_GET['p6'];//semailmsg


	$response = array();
	$posts = array();
	$file=0;
	
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
		
		$hostName = $_SERVER['HTTP_HOST']; 
		
		$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
		
		$main1=$protocol.$hostName;
		
		
		
	
		$pdfurl=$main1."/businesspanel/download/".$par3.".pdf";
		$pdfurl=str_replace('http:','https:',$pdfurl);
		
		

		if(check_file_exists_here($main1."/businesspanel/download/".$par3.".pdf"))
		{
		   $file="1";
		}
		else
		{
		   $file="0";
		}

		/* $par4="http://localhost/sminder/businesspanel/download/".$par3.".pdf"; */
		
			$eve3 = "select * from res_emailacc_master LIMIT 0,1";
			$re3 = mysqli_query($conn, $eve3);
			
			if(mysqli_num_rows($re3) > 0)
			{
				while($rt3 = mysqli_fetch_assoc($re3))
				{
					$providername=$rt3['providername'];
					$email=$rt3['email'];
					$epassword=$rt3['epassword'];
					$esmtp=$rt3['esmtp'];
					$eport=$rt3['eport'];
					$essltls=$rt3['essltls'];
				}
			}
			
			$uu = "$email";
			$pp = "$epassword";
			
			if($file==1)
			{
				ob_start();
				require_once('../class.phpmailer.php');
				
				$message=$par6;


				$mail = new PHPMailer();
				$mail->IsSMTP();
				$mail->CharSet="UTF-8";
				$mail->SMTPSecure = "$essltls";
				$mail->Host = "$esmtp";
				$mail->Port = "$eport";
				$mail->Username = $uu;
				$mail->Password = $pp;
				$mail->SMTPAuth = true;
				$mail->SMTPDebug = 1;
				$mail->From = $uu;
				$mail->FromName = "$providername";
				if($par4!="")
				{
					$mail->AddAddress("$par4");
				}
					/* $attachmentUrl = "http://localhost/sminder/businesspanel/download/".$par3.".pdf";  */
				
				/* $attachmentUrl = "https://sminder.in/businesspanel/download/".$par3.".pdf"; */
				
				$attachmentUrl = $pdfurl;
					
				$qno="Payment Receipt ".$par3;
				$tempFile = tempnam(sys_get_temp_dir(), 'attachment.pdf');  
				file_put_contents($tempFile, $attachmentUrl);
				//$mail->AddAttachment($tempFile);
				$mail->addStringAttachment(file_get_contents($attachmentUrl), "$qno.pdf");
					
					
				//$mail->addCC();
				$mail->IsHTML(true);
				$mail->Subject    = $par5;
				$mail->AltBody    = ".";
				$mail->Body    = $message;


				if(!$mail->Send())
				{
					$err=$mail->ErrorInfo;
					//echo $err;
					//return;
				}
				else	
				{
					//echo 'send';
					
				}
			}
			
				$result=1;
				$msg = "Success";
				$posts[] = array('p1'=> $result,'p2'=> $msg);
				
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
