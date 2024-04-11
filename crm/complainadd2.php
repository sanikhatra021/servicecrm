<?php
session_start(); 

	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
		return;
	}
	$samid=$_SESSION['samid'];
	$umid=$_SESSION['umid'];
	include("connect.php");
	include("mylibrary.php");
	include("getcomplainno.php");
	
	date_default_timezone_set("Asia/Kolkata");
	//$mdate1= date('Y-m-d h:i:sa');
	$mdate2= date('Y-m-d');
	$mdate= date('Y-m-d');
	$mdate1= date('Y-m-d H:i:sa');
	
	$cmtype=$_POST['cmtype'];
	$pmid=$_POST['pmid'];
	//$ctmname=$_POST['ctmname'];
	$customerid=$_POST['customerid'];
	$problemname=$_POST['problemname'];
	$cmdetail=$_POST['cmdetail'];
	
	$cmserviceengineerid=$_POST['serviceengineerid'];
	$cmdate=implode('-', array_reverse(explode('-',$_POST['cmdate'])));
	//$cmupdatedon=implode('-', array_reverse(explode('-',$_POST['cmupdatedon'])));
	
	$customername=$_POST['customername'];
	$customersite=$_POST['customersite'];
	$customermobile=$_POST['customermobile'];
	$uemail=$_POST['uemail'];
	
	$customeraddress=$_POST['customeraddress'];
	$ucity=$_POST['ucity'];
	$managername=$_POST['managername'];
	$managermobile=$_POST['managermobile'];
	$inchargename=$_POST['inchargename'];
	$inchargemobile=$_POST['inchargemobile'];
	$servicemid=$_POST['servicecontractid'];
	$cmservicecharge=$_POST['servicecharge'];
	$cmpproductdetail=$_POST['sproductdetail'];
	 $udefaultserviceengineer=0;
	
	if($customerid=="New Customer")
	{
		$eve1 = "INSERT INTO res_user_master (samid,uname,umobile,utype,emailid,uaddress,ucity,upriority,udefaultserviceengineer,usite,uprojectmanagername,uprojectmanagermobile,uprojectinchargename,uprojectinchargemobile) VALUES('$samid','$customername','$customermobile','customer','$uemail','$customeraddress','$ucity','Low','$cmserviceengineerid','$customersite','$managername','$managermobile','$inchargename','$inchargemobile')";
		if ($conn->query($eve1) === TRUE)
		{
			$customerid = $conn->insert_id;
		}
	}
	
	if($cmserviceengineerid== 0){
		$status = 'Unallocated';
	}else{
		$status = 'Pending';
	}
	
	$ptmrate=0;
	
	$cmphoto1="";
	 if(empty($_FILES['cmphoto']['name']) == false  )
	{
		$simplephoto11=$_FILES['cmphoto']['name'];
		$ext = pathinfo($simplephoto11, PATHINFO_EXTENSION);
		$fileexplode1 = explode(".",$simplephoto11);
		$fileend1 = end($fileexplode1);

		$cmphoto1= date("YmdHis").rand(100,999).".".$fileend1;
		$path = "images";
		if($ext=='png' || $ext=='jpg' || $ext=='jpeg' || $ext=='gif' || $ext=='PNG' || $ext=='JPG' || $ext=='JPEG' || $ext=='GIF')
		{
		  move_uploaded_file( $_FILES['cmphoto']['tmp_name'], $path ."/". $cmphoto1);
		  $flag=1;
		}
		else 
		{
		  $_SESSION['msg1'] = "Only Upload Image";
		 // header('Location: complain.php');
		  return;
		  $flag=0;
		}
	}
	$cyear = getFinancialYear2($mdate);
		$evemaxq = "SELECT max(cmno) AS maxcmno FROM res_complain_master where cyear='$cyear' and  samid=$samid";
	$remaxq = mysqli_query($conn, $evemaxq);
	while($rtmaxq = mysqli_fetch_assoc($remaxq))
	{
		$cmno=$rtmaxq['maxcmno'];
	}
	$cmno1=$cmno+1;
	$cmnowithprefix=generatecomplainno();
	
	  $eve1 = "INSERT INTO res_complain_master (cmno,samid,pmid,customerid,cmdetail,cmphoto,cmdate,cstatus,cmstatusudate,cmupdatedon,cmupdatedby,cmnowithprefix,cmaddedby,cmaddedon,cmproblemtype,cmtype,cmmethod,cmadminstatus,cmservicecharge,servicetype,cmnetamount,cyear,servicemid,cmpproductdetail) VALUES($cmno1,'$samid','$pmid','$customerid','$cmdetail','$cmphoto1','$cmdate','Pending','$mdate2','$mdate1','$umid','$cmnowithprefix','$umid','$mdate1','$problemname','$cmtype','Offline','Open','$cmservicecharge','Complain','$cmservicecharge','$cyear','$servicemid','$cmpproductdetail')";	
	if ($conn->query($eve1) === TRUE)
	{
		$last_id = $conn->insert_id;
		
					if($cmserviceengineerid!= 0){
					 $eve3 = "INSERT INTO res_complainallocation_detail (cmid,serviceengid,allocateddate,samid) VALUES($last_id,$cmserviceengineerid,'$mdate',$samid)";
					if ($conn->query($eve3) === TRUE)
					{
						
						$title = "New Complain has been assigned to You.";
						$message = "New Complain has been assigned to You.";
						$imgurl = "";
						   $eve_category37 = "SELECT uname,fcmtoken FROM  res_user_master where umid = '$cmserviceengineerid'";
						 
						 $re_category37 = mysqli_query($conn, $eve_category37);
					
						if(mysqli_num_rows($re_category37) > 0)
						{
							while($rt_category37 = mysqli_fetch_assoc($re_category37))
							{
								$token=$rt_category37['fcmtoken'];
								$uname=$rt_category37['uname'];
								$pushStatus = push_notification_android($token,$title,$message,$imgurl);
								//echo "<br> uname :: ".$uname." ||| token :: ".$token." <br> Results :: ".$pushStatus;
							}
						}
			//sent notification to service engineer
			
				
					}
					}
		
		
				
		$_SESSION['msg'] = "Record has been added successfully";
		$uname = "";
        $utype = "";
		$uemail = "";
        $umobile = "";
	 $eveag = "select * from res_user_master where umid=$customerid";

    $reag = mysqli_query($conn, $eveag);

    if (mysqli_num_rows($reag) > 0) {

        while ($rtag = mysqli_fetch_assoc($reag)) {

            $uname = $rtag['uname'];
            $utype = $rtag['utype'];
            $uemail = $rtag['emailid'];
            $umobile = $rtag['umobile'];

        }

    }
	//.......    1.---- Process to send email whatsapp for complain add to Customer is starts here//

	$sendwhatsapp = $_SESSION['sendwhatsapp'];
	$sendemail = $_SESSION['sendemail'];
         
	$flagsendemailtoengineer2=0;	
	$flagsendwhatsapptoengineer2=0;		
					
	if($sendemail==1)
	{
		$etemailsubject='';
		$emessage='';
		$etstatus='';

					
		$eve331 = "select * from res_emailtemplate_master where etsubject='Complain add' and (etstatus='Active') and samid='$samid'";
		$re331 = mysqli_query($conn, $eve331);
		
		if (mysqli_num_rows($re331) > 0) 
		{

			while ($rt331 = mysqli_fetch_assoc($re331))
			{

				$etemailsubject = $rt331['etemailsubject'];
				$emessage = $rt331['emessage'];
				$etstatus = $rt331['etstatus'];
				
				$flagsendemailtoengineer2=1;	
			}

		}
	}
	if($sendwhatsapp==1)
		{
			
			$wastatus='';
			$wamessage2='';
			  $eve112 = "select * from res_watemplate_master where wasubject='Complain add' and (wastatus='Active') and samid='$samid'";
			 $re112 = mysqli_query($conn,$eve112);
			 if (mysqli_num_rows($re112) > 0) 
			{

				while ($rt112 = mysqli_fetch_assoc($re112))
				{
					$wastatus = $rt112['wastatus'];
					$wamessage2 = strip_tags($rt112['wamessage']);

				$flagsendwhatsapptoengineer2=1;
				}

			}
			
			
		}


					
					
	$etemailsubject2='';
	$emessage='';
	$etstatus='';

					
	$eve33 = "select * from res_emailtemplate_master where etsubject='Complain add' and (etstatus='Active') and samid='$samid'";

    $re33 = mysqli_query($conn, $eve33);



    if (mysqli_num_rows($re33) > 0) {

        while ($rt33 = mysqli_fetch_assoc($re33)) {

            $etemailsubject2 = $rt33['etemailsubject'];
            $emessage2 = $rt33['emessage'];
            $etstatus = $rt33['etstatus'];
            

        }

    }
	$url1 = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$url = substr($url1, 0, strrpos( $url1, '/'));
	$url = substr($url, 0, strrpos( $url, '/'));
	 $crmurl = $url."/student/";
	
		if($flagsendemailtoengineer2==1)
		{
				 $eve3 = "select * from res_emailacc_master where samid=$samid";

				$re3 = mysqli_query($conn, $eve3);



				if (mysqli_num_rows($re3) > 0) {

					while ($rt3 = mysqli_fetch_assoc($re3)) {

						$providername = $rt3['providername'];

						$email = $rt3['email'];

						$epassword = $rt3['epassword'];

						$esmtp = $rt3['esmtp'];

						$eport = $rt3['eport'];

						$essltls = $rt3['essltls'];

					}

				}



	   

				$uu = "$email";

				$pp = "$epassword";



				ob_start();

				require_once('class.phpmailer.php');



	   
		
		

			$eve2 = "select safullname from res_superadmin_master where samid=$samid";
				$re2 = mysqli_query($conn,$eve2);
				  if (mysqli_num_rows($re2) > 0) {

					while ($rt2 = mysqli_fetch_assoc($re2)) {

					   
						$safullname = $rt2['safullname'];
					 
					}

				}


	   

				$etemailsubject2 = str_replace("#problemname", "$problemname", $etemailsubject2);
			 
				
				
				
				
				$emessage2 = str_replace("#customername", "$uname", $emessage2);
				$emessage2 = str_replace("#companyname", "$safullname", $emessage2);
				$emessage2 = str_replace("#ticketnumber", "$cmnowithprefix", $emessage2);
		
		
	 
				$emessage2 = str_replace("#crmurl", "$crmurl", $emessage2); 

			 
				$mail = new PHPMailer();

				$mail->IsSMTP();

				$mail->CharSet = "UTF-8";

				$mail->SMTPSecure = "$essltls";

				$mail->Host = "$esmtp";

				$mail->Port = "$eport";

				$mail->Username = $uu;

				$mail->Password = $pp;

				$mail->SMTPAuth = true;

				$mail->SMTPDebug = 1;

				$mail->From = $uu;

				$mail->FromName = "$providername";

				if ($uemail == '') {

					$uemail = 'noreply@linkarise.in';

				}

				if ($uemail != '' ) {

					$mail->AddAddress("$uemail");



				}



				$mail->IsHTML(true);

				$mail->Subject = "$etemailsubject2";

				$mail->AltBody = ".";

				$mail->Body = $emessage2;



				if (!$mail->Send()) {

					$err = $mail->ErrorInfo;

					echo $err;

					//return;

				} else {

					//header("location:contact-us.php");

				}
		
		}	
	
		if($flagsendwhatsapptoengineer2==1)
		{
		
			
		$wamessage2 = str_replace("#customername", "$uname", $wamessage2);
		$wamessage2 = str_replace("#companyname", "$safullname", $wamessage2);
		$wamessage2 = str_replace("#ticketnumber", "$cmnowithprefix", $wamessage2);
		
		$wamessage2 = str_replace("#crmurl", "$crmurl", $wamessage2); 
		 $wamessage2 = urlencode($wamessage2);
		 $wamessage2= preg_replace("/[\n\r]/", '<br />', $wamessage2);
	
				$_SESSION['msg'] = "Record saved successfully";
				
				$eve11 = "select smslink from res_superadmin_master where samid=$samid";
		$re11 = mysqli_query($conn,$eve11);
		  if (mysqli_num_rows($re11) > 0) {

			while ($rt11 = mysqli_fetch_assoc($re11)) {

			   
				$cmpwhatsapplink = $rt11['smslink'];

			}

		}
				$umobile="91".$umobile;
				
				$cmpwhatsapplink = str_replace("#umobile", "$umobile", $cmpwhatsapplink);
				$cmpwhatsapplink = str_replace("#wamessage", "$wamessage2", $cmpwhatsapplink);
				
				 $smsurl="$cmpwhatsapplink";
				
				// $smsurl="https://skrumessage.com/api/send?number=91$umobile&type=text&message=$wamessage2&instance_id=64DD9BD31CE9E&access_token=64dd9b4da664a";
				//$smsurl="https://skrumessage.com/api/send.php?number=91$cmobile&type=text&message=$idetails&instance_id=63CFC7E87816D&access_token=a4d3bdd4e537e329484fc357cf0767be";
				$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL,$smsurl);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
					if(strlen($umobile)>9 )
					{
						$content = curl_exec($ch);
						$msg="sent";
						$_SESSION['msg2'] =$content;
						
					}
		}
		
		
		
	$flagsendemailtoengineer=0;	
	$flagsendwhatsapptoengineer=0;	
	if($cmserviceengineerid!="0")
	{
		
		if($sendemail==1)
		{
			$etemailsubject='';
	$emessage='';
	$etstatus='';
			 $eve33 = "select * from res_emailtemplate_master where etsubject='Engineer Add' and (etstatus='Active') and samid=$samid";
			 $re33 = mysqli_query($conn, $eve33);
			if (mysqli_num_rows($re33) > 0) 
			{
				while ($rt33 = mysqli_fetch_assoc($re33)) {

				$etemailsubject = $rt33['etemailsubject'];
				$emessage = $rt33['emessage'];
				$etstatus = $rt33['etstatus'];
				
				$flagsendemailtoengineer=1;	
				}

			}
			
		}
		if($sendwhatsapp==1)
		{
			
			$wastatus='';
			$wamessage='';
			  $eve110 = "select * from res_watemplate_master where wasubject='Engineer Add' and (wastatus='Active') and samid=$samid";
			 $re110 = mysqli_query($conn,$eve110);
			  if (mysqli_num_rows($re110) > 0) 
			{

				while ($rt110 = mysqli_fetch_assoc($re110))
				{
					$wastatus = $rt110['wastatus'];
					$wamessage = strip_tags($rt110['wamessage']);

				$flagsendwhatsapptoengineer=1;
				}

			}
			
		}
	}
		

		
	
		
			
						
	$eve31 = "select * from res_user_master where umid='$cmserviceengineerid'";

    $re31 = mysqli_query($conn, $eve31);



    if (mysqli_num_rows($re31) > 0) {

        while ($rt31 = mysqli_fetch_assoc($re31)) {

            
            

					$enggname=$rt31['uname'];
					$enggemail=$rt31['emailid'];
					$enggmobile=$rt31['umobile'];
		}
	}				
	
	$url1 = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$url = substr($url1, 0, strrpos( $url1, '/'));
	$url = substr($url, 0, strrpos( $url, '/'));
	 $crmurl = $url."/student/";
	
	
	
	
	
	if($flagsendemailtoengineer==1)
	{
		
	
		if($etstatus == 'Active')
		{		
			 $eve3 = "select * from res_emailacc_master where samid=$samid";

			$re3 = mysqli_query($conn, $eve3);



			if (mysqli_num_rows($re3) > 0) {

				while ($rt3 = mysqli_fetch_assoc($re3)) {

					$providername = $rt3['providername'];

					$email = $rt3['email'];

					$epassword = $rt3['epassword'];

					$esmtp = $rt3['esmtp'];

					$eport = $rt3['eport'];

					$essltls = $rt3['essltls'];

				}

			}

			$uu = "$email";
			$pp = "$epassword";
			ob_start();

			require_once('class.phpmailer.php');

			$emessage = str_replace("#serviceengineer", "$enggname", $emessage);
			$emessage = str_replace("#customername", "$uname", $emessage);
			$emessage = str_replace("#companyname", "$safullname", $emessage);
			$emessage = str_replace("#ticketnumber", "$cmnowithprefix", $emessage);
			
		  
			 $emessage = str_replace("#crmurl", "$crmurl", $emessage); 

		 
			$mail = new PHPMailer();

			$mail->IsSMTP();

			$mail->CharSet = "UTF-8";

			$mail->SMTPSecure = "$essltls";

			$mail->Host = "$esmtp";

			$mail->Port = "$eport";

			$mail->Username = $uu;

			$mail->Password = $pp;

			$mail->SMTPAuth = true;

			$mail->SMTPDebug = 1;

			$mail->From = $uu;

			$mail->FromName = "$providername";

			if ($enggemail == '') {

				$enggemail = 'noreply@linkarise.in';

			}

			if ($enggemail != '' ) {

				$mail->AddAddress("$enggemail");



			}



			$mail->IsHTML(true);

			$mail->Subject = "$etemailsubject";

			$mail->AltBody = ".";

			$mail->Body = $emessage;



			if (!$mail->Send()) {

				$err = $mail->ErrorInfo;

				echo $err;

				//return;

			} else {

				//header("location:contact-us.php");

			}
			}
	}
	
	
	if($flagsendwhatsapptoengineer==1)
	{
	

	
	if($wastatus == 'Active')
	{
	  $wamessage = str_replace("#serviceengineer", "$enggname", $wamessage);
	$wamessage = str_replace("#customername", "$uname", $wamessage);
	$wamessage = str_replace("#companyname", "$safullname", $wamessage);
	$wamessage = str_replace("#ticketnumber", "$cmnowithprefix", $wamessage);

                 $wamessage = str_replace("#crmurl", "$crmurl", $wamessage); 
				 
				 
 $wamessage = urlencode($wamessage);
 $wamessage= preg_replace("/[\n\r]/", '<br />', $wamessage);
	
				$_SESSION['msg'] = "Record saved successfully";
				
				$eve11 = "select smslink from res_superadmin_master where samid=$samid";
	$re11 = mysqli_query($conn,$eve11);
	  if (mysqli_num_rows($re11) > 0) {

        while ($rt11 = mysqli_fetch_assoc($re11)) {

           
            $cmpwhatsapplink = $rt11['smslink'];
         
        }

    }
				$enggmobile="91".$enggmobile;
				
				$cmpwhatsapplink = str_replace("#umobile", "$enggmobile", $cmpwhatsapplink);
				$cmpwhatsapplink = str_replace("#wamessage", "$wamessage", $cmpwhatsapplink);
				
				 $smsurl="$cmpwhatsapplink";
				 
				 //$smsurl="https://skrumessage.com/api/send?number=91$umobile&type=text&message=$wamessage&instance_id=64DD9BD31CE9E&access_token=64dd9b4da664a";
				//$smsurl="https://skrumessage.com/api/send.php?number=91$cmobile&type=text&message=$idetails&instance_id=63CFC7E87816D&access_token=a4d3bdd4e537e329484fc357cf0767be";
				$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL,$smsurl);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
					if(strlen($enggmobile)>9 )
					{
						$content = curl_exec($ch);
						$msg="sent";
						$_SESSION['msg2'] =$content;
						
					}
					}
	
		else{
			
		}
	}
	
	}
	else
	{
		$_SESSION['msg1'] = "Error";
	}

	
  header('Location: complain.php');

 function push_notification_android($token,$title,$message,$imgurl)
			 {	
						$url = 'https://fcm.googleapis.com/fcm/send';
						$api_key = 'AAAAPGo7yLA:APA91bFikbSEZGrx_lmASSjsDhWKbLXRDJdL1EyBSzVnfwWjcIl1HhVTkl3JOBqkGFKlvjCfoStutKkpix9lay_Zw0yGjS4hCYOhrTJf9oUMES2FkDIthj1i6bTJfSme06k0v_E2cTWR';
						
						$fields = array
						(
							 'registration_ids' => array (
									$token
							),
							'data' => array (
										'title' => $title,
										'body' => $message,
										'imgurl' => $imgurl,
								),
							'priority' => 'high'
						);
					 
						//header includes Content type and api key
						$headers = array(
							'Content-Type:application/json',
							'Authorization:key='.$api_key
						);
							 
					 
						$ch = curl_init();
						curl_setopt($ch, CURLOPT_URL, $url);
						curl_setopt($ch, CURLOPT_POST, true);
						curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
						curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
						$result = curl_exec($ch);


						if ($result === FALSE) {
							die('FCM Send Error: ' . curl_error($ch));
							echo "error";

						}
						
						curl_close($ch);
						//return $result;
			}
	
					
?>


					
					
					
					
					
					
			