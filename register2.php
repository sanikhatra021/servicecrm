<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');  
session_start(); 

	include("connect.php");
	
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('y-m-d H:i:s');
	$mdate1= date('Y-m-d');
	
	
	$samid=$_POST['samid'];
	$cname=$_POST['cname'];
	$cmobile=$_POST['cmobile'];
	$cpassword=$_POST['cpassword'];
	$cemail=$_POST['cemail'];
	$caddress=$_POST['caddress'];
	$ccity=$_POST['ccity'];
	$mobileotp = rand(10000, 99999);

		$eve2 = "select umobile,emailid from res_user_master where umobile='$cmobile'";
		$re2 = mysqli_query($conn, $eve2);
		if(mysqli_num_rows($re2) > 0)
		{
			$_SESSION['sregmsg1'] = "Mobile No used, Register with other mobile number.";
			header('Location: login.php#lg2');
		}
		else
		{			
    
			$eve1 = "INSERT INTO res_user_master (samid,uname,umobile,upassword,utype,emailid,uaddress,ucity,uregotp) VALUES('$samid','$cname','$cmobile','$cpassword','customer','$cemail','$caddress','$ccity',$mobileotp)";
			if ($conn->query($eve1) === TRUE)
			{
				$cmid = $conn->insert_id;
				
					
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
				require_once('class.phpmailer.php');
				
				$message="Dear $cname<br><br>Your Mobile Number (Username) is: $cmobile<br>Your OTP  is: $mobileotp <br><br>Regards,<br>Team LinkArise Service";


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
				if($cemail!='')
				{
				$mail->AddAddress("$cemail");
				}
				//$mail->addCC();
				$mail->IsHTML(true);
				$mail->Subject    = "LinkArise Customer Registration";
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

				$_SESSION['sregmsg'] = "OTP Send Via Email Or SMS.";
				
				$_SESSION['cmobile']=$cmobile;
				$_SESSION['cemail']=$cemail;
				header('Location: registerotpverify.php');
			}
			else
			{
				$_SESSION['sregmsg1'] = "Error";
				header('Location: register.php');
			}
		}
	
?>