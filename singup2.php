<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);  
session_start(); 
	include("connect.php");
	if(!isset($_SESSION['businessid']))
	{
		header('Location: index.php');
	}
	$cmobile=$_POST['cmobile'];
	$_SESSION['cmobile'] = $cmobile;
	
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('y-m-d H:i:s');
	$mdate1= date('Y-m-d');
	$samid=$_SESSION['businessid'];
	
	$eve="select * from res_user_master where utype='customer' and umobile='$cmobile' and samid='$samid'";
												$re = mysqli_query($conn, $eve) or die("failed");
												if(mysqli_num_rows($re)> 0)
												{
													$_SESSION['cmobile']=$cmobile;
	  
	                                              header("Location: verifypassword.php");
												}
											else{
	/* $mobileotp = rand(1000, 9999); */
	$mobileotp = '12345';
	$_SESSION['mobileotp']=$mobileotp;
	 $eve2 = "select * from res_mobileacc_master";
				$re2 = mysqli_query($conn, $eve2);


				while($rt2 = mysqli_fetch_assoc($re2))
				{
					$muser=$rt2['muser'];
					$mpassword=$rt2['mpassword'];
					$msenderid=$rt2['msenderid'];
					$mchannel=$rt2['mchannel'];
					$mroute=$rt2['mroute'];
					$mdcs=$rt2['mdcs'];
					$mflashsms=$rt2['mflashsms'];
				}

					$message = "Dear User,Your OTP for login is $mobileotp. Please do not share this OTP. ";
					$smsurl="http://sms.thebulksms.in/api/mt/SendSMS?APIKey=Dc7oghFm10uk2468pLPTJQ&senderid=STBSMS&channel=Trans&DCS=0&flashsms=0&number=$cmobile&text=".urlencode($message)."&route=06&peid=1701158079650742945";
					//echo $smsurl=urlencode($smsurl);

					
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL,$smsurl);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
					
					//$content = curl_exec($ch);
					
					
					if(strlen($cmobile)>9)
					{
						
					   $content = curl_exec($ch);
					  
					   $_SESSION['sfotpmsg'] = "OTP Sent Via SMS";
					}
					else
					{
						
						$msg="failed";
					}
					
					curl_close($ch);

				
	 
				
				
	   
		$_SESSION['cmobile']=$cmobile;
	  
	  header("Location: verify.php");
											}
	
?>