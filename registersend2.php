<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');  

	
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('y-m-d H:i:s');
	$mdate1= date('Y-m-d');
	
	
	
	$cmobile="9846788598";
	
	$mobileotp = rand(10000, 99999);

	
					
				

					$message = "Your OTP is $mobileotp.  With Regards Easy Khoj Nepal";
					
					
					  $args = http_build_query(array(
            'auth_token'=> 'd315207e2c1f9487f1c9697a55dacd6117fe3eecaa0ab71e2c1bd04def01ed82',
            'to'    => $cmobile,
            'text'  => $message));
					$url = "https://sms.aakashsms.com/sms/v3/send/";

					# Make the call using API.
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_POST, 1); ///
					curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
					// Response
					$response = curl_exec($ch);
					echo $response;
					curl_close($ch); 
				

				

				
			
	
?>