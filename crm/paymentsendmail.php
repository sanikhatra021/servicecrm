<?php
session_start(); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
	}
	$cmid=$_SESSION['cmid'];
	$umid=$_SESSION['umid'];
	include("connect.php");
	$conn->query("set names utf8");

	$mdate= date('d-m-Y');
	$mdate11= date('Y-m-d');


				$cidid=(int)mysqli_real_escape_string($conn,$_GET['id']);
				//user detail
			  	$eve2 = "select * from res_user_master where umid=(select customerid from res_complain_master where cmid=$cidid)";
				$re2 = mysqli_query($conn, $eve2);
				while($rt2 = mysqli_fetch_assoc($re2))
				{
			
					$umid=$rt2['umid'];
					$uname=$rt2['uname'];
					$umobile=$rt2['umobile'];
					$emailid=$rt2['emailid']; 
				}
				
		
				//payment detail
				$eve2="SELECT * FROM res_complainitem_detail where cidid=$cidid";		
				$re2 = mysqli_query($conn, $eve2);
				if(mysqli_num_rows($re2) > 0)
				{
					 while($rt2 = mysqli_fetch_assoc($re2))
					 {	
						$imid=$rt2['imid'];
						$pmid=$rt2['pmid'];
						$eve2111="SELECT * FROM res_product_master where pmid=$pmid";		
						$re2111 = mysqli_query($conn, $eve2111);
						 while($rt2111 = mysqli_fetch_assoc($re2111))
						 {
							$pmname=$rt2111['pmname'];
						 }
						 
						 $cidqty=$rt2['cidqty'];
						 $cidrate=$rt2['cidrate'];
						
					 }
				}
				
				
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

			ob_start();
			require_once('class.phpmailer.php');
			
			$message="Dear $uname<br><br>Your Payment Receipt is Here<br><br>Regards,<br>Team LinkArise Service";


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
			if($emailid!="")
			{
				$mail->AddAddress("$emailid");
			}
				/* $attachmentUrl = "http://localhost/sminder/businesspanel/download/".$cidid.".pdf";  */
				
				$attachmentUrl = "http://sminder.in/businesspanel/download/".$cidid.".pdf";
					
				$qno="Payment Receipt ".$cidid;
				$tempFile = tempnam(sys_get_temp_dir(), 'attachment.pdf');  
				file_put_contents($tempFile, $attachmentUrl);
				//$mail->AddAttachment($tempFile);
				$mail->addStringAttachment(file_get_contents($attachmentUrl), "$qno.pdf");
					
					
			//$mail->addCC();
			$mail->IsHTML(true);
			$mail->Subject    = "LinkArise Sevice Email";
			$mail->AltBody    = ".";
			$mail->Body    = $message;


			if(!$mail->Send())
			{
				$err=$mail->ErrorInfo;
				$_SESSION['msg1'] = "Error";
				//echo $err;
				//return;
			}
			else	
			{
				//echo 'send';
				$_SESSION['msg'] = "Mail Send successfully";
			}
			
	header("Location: paymentreceiptdetail.php?id=$cmid");
?>
