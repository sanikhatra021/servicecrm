<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include("connect.php");

if(isset($_POST['submit']))
{
				$name1=$_POST['name1'];
				$mobile1=$_POST['mobile1'];
				$email1=$_POST['email1'];
				$message1=$_POST['message1'];
				
				$eve2 = "select * from res_emailacc_master LIMIT 0,1";
				$re2 = mysqli_query($conn, $eve2);
				
				if(mysqli_num_rows($re2) > 0)
				{
					while($rt2 = mysqli_fetch_assoc($re2))
					{
						$providername=$rt2['providername'];
						$email=$rt2['email'];
						$epassword=$rt2['epassword'];
						$esmtp=$rt2['esmtp'];
						$eport=$rt2['eport'];
						$essltls=$rt2['essltls'];
						
					}
				}

				$message="Contact Detail of  Name : $name1<br>Mobile No : $mobile1<br> Email : $email1<br>Message : $message1";

				$uu = "$email";
				$pp = "$epassword";

				ob_start();
				require_once('class.phpmailer.php');




				$mail = new PHPMailer();
				$mail->IsSMTP();
				$mail->CharSet="UTF-8";
				$mail->SMTPSecure = "$essltls";
				$mail->Host = "$esmtp";
				$mail->Port = "$eport";
				$mail->Username = $uu;
				$mail->Password = $pp;
				$mail->SMTPAuth = true;

				$mail->From = $uu;
				$mail->FromName = 'Sminder';
				 /* $mail->AddAddress('at.zeelsheth@gmail.com'); */
				$mail->AddAddress('contact@arthtechnology.com'); 
				//$mail->addCC();
				$mail->IsHTML(true);
				$mail->Subject    = "Contact From Website";
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
					header("location:contact.php");
				}
			}
		
?>
