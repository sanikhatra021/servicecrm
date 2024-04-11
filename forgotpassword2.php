<?php  
session_start(); 
	include("connect.php");


	
	
	$cmobile=$_POST['cmobile'];
	$_SESSION['cmobile'] = $cmobile;
	
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('y-m-d H:i:s');
	$mdate1= date('Y-m-d');
	
	
	
	$mobileotp = rand(10000, 99999);
	
	$eve = "select * from res_user_master where umobile='$cmobile' or emailid='$cmobile'";
	$re = mysqli_query($conn, $eve);
	if(mysqli_num_rows($re) ==1 )
	{
	   
	    while($rt = mysqli_fetch_assoc($re))
		{
				$result="1";
				$uname=$rt['uname'];
				$emailid=$rt['emailid'];
				$umobile=$rt['umobile'];
				
				$evenewpass = "update res_user_master set uforgototp=$mobileotp,uforgototpverify=0 where (umobile='$par1' or emailid='$par1')";
				$renewpass = mysqli_query($conn, $evenewpass);
				
			    //Email send 
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
				require_once('./class.phpmailer.php');
				
				$message="Dear $uname <br><br>Your Mobile Number (Username) is: $umobile<br>Your OTP  is: $mobileotp <br><br>Regards,<br>Team Sminder";


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
				$mail->AddAddress("$emailid");
				//$mail->addCC();
				$mail->IsHTML(true);
				$mail->Subject    = "Sminder Password Recovery";
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
					//header("location:contact-us.php");
				}

				

		}
		$_SESSION['sfotpmsg'] = "OTP Sent Via SMS & Email";
		$_SESSION['cmobile']=$cmobile;
		header("Location: otpverify.php");	
	   }
	   else
	   {
			$_SESSION['sfotpmsg1'] = "Mobile Number Not Found";
			header("Location: forgotpassword.php");
	   }
	
?>