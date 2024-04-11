<?php
session_start(); 
error_reporting(E_ALL);
ini_set('display_errors', '1');
	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
		return;
	}
	$samid=$_SESSION['samid'];
	include("connect.php");
	include("connectp.php");
	
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('Y-m-d H:i:s');
	$mdate1= date('Y-m-d');
	
	/* if($_SESSION['utype']!='admin')
	{
		header('Location: index.php');
		return;
	} */
	
	if($_SERVER['REQUEST_METHOD'] === 'POST')
	{
		if(!isset($_POST['_token']) || ($_POST['_token']!==$_SESSION['_token'] ) )
		{
			header('Location: index.php');
			return;
		}
	}
	else
	{
		header('Location: index.php');
		return;
	}
	$_SESSION['_token']=bin2hex(openssl_random_pseudo_bytes(16));
	
   
	$cmid=$_POST['cmid'];
	$serviceengid=$_POST['serviceengid'];
	
	$query1 = "select cmid from res_complainallocation_detail where cmid=:cmid and serviceengid=:serviceengid";
	$stmt1 = $db7->prepare($query1);
	$stmt1->bindValue(':cmid', "$cmid");
	$stmt1->bindValue(':serviceengid', "$serviceengid");
	$stmt1->execute();
	if ($stmt1->rowCount() > 0)
	{
		$_SESSION['msg1'] = "Service Engineer Already Added..";
		header("Location: complaindetail.php?id=$cmid");
	}
	else
	{
		$sql = "INSERT INTO res_complainallocation_detail (cmid,serviceengid,allocateddate,samid) VALUES (?,?,?,?)";
		$stmt= $db7->prepare($sql);
		if($stmt->execute([$cmid,$serviceengid,$mdate,$samid]))
		{
			$last_id = $db7->lastInsertId();
			$_SESSION['msg'] = "Record saved successfully";
			
			
			
			
			
	                            //.......    1.---- Process to send email whatsapp for Customer is starts here//
	
	
	
	
$sendwhatsapp = $_SESSION['sendwhatsapp'];
$sendemail = $_SESSION['sendemail'];
         

					
	$flagsendemailtoengineer=0;	
	$flagsendwhatsapptoengineer=0;		
	
		

	if($sendemail==1)
	{	
$etemailsubject='';
$emessage='';
$etstatus='';

					
					 $eve33 = "select * from res_emailtemplate_master where etsubject='Engineer Add' and (etstatus='Active') and samid=$samid";

    $re33 = mysqli_query($conn, $eve33);



    if (mysqli_num_rows($re33) > 0) {

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
	  if (mysqli_num_rows($re110) > 0) {

        while ($rt110 = mysqli_fetch_assoc($re110)) {

           
            $wastatus = $rt110['wastatus'];
            $wamessage = strip_tags($rt110['wamessage']);

			$flagsendwhatsapptoengineer=1;
        }

    }
	
	
	}
	
				$uname = "";
				
	if($flagsendemailtoengineer==1 || $flagsendwhatsapptoengineer==1)
	{
	 $eve14 = "select * from res_complain_master where cmid='$cmid'";

    $re14 = mysqli_query($conn, $eve14);



    if (mysqli_num_rows($re14) > 0) 
	{

        while ($rt14 = mysqli_fetch_assoc($re14)) 
		{

            
            

					$umid=$rt14['customerid'];
					
					$cmnowithprefix=$rt14['cmnowithprefix'];
		}
	}	
	
	
	 $eve30 = "select * from res_user_master where umid='$umid'";

    $re30 = mysqli_query($conn, $eve30);



    if (mysqli_num_rows($re30) > 0) {

        while ($rt30 = mysqli_fetch_assoc($re30)) {

            
            

					$uname=$rt30['uname'];
				
		}
	}			
	
	

						
						 $eve31 = "select * from res_user_master where umid='$serviceengid'";

    $re31 = mysqli_query($conn, $eve31);



    if (mysqli_num_rows($re31) > 0) 
	{

        while ($rt31 = mysqli_fetch_assoc($re31)) 
		{

            
            

					$enggname=$rt31['uname'];
					$enggemail=$rt31['emailid'];
					$enggmobile=$rt31['umobile'];
		}
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
	
   // $emessage = str_replace("#applink", "$_SESSION[appicationlink]", $emessage);
   // $emessage = str_replace("#mobile", "$enggmobile", $emessage);
   // $emessage = str_replace("#password", "$upassword", $emessage);
 /*    $emessage = str_replace("#studentfirstname", "$ipname", $emessage);
    $emessage = str_replace("#companyname", "$cmpname", $emessage);
    
    $emessage = str_replace("#user_name", "$ipmobile", $emessage);
    $emessage = str_replace("#password", "$ippassword", $emessage);
    $emessage = str_replace("#username", "$ufullname", $emessage);
    $emessage = str_replace("#userrole", "$utype", $emessage);
    $emessage = str_replace("#companydetail", "$cmpwebsite", $emessage);
    $emessage = str_replace("#companyemail", "$cmpemail", $emessage);
    $emessage = str_replace("#companynumber", "$cmpmobile", $emessage);*/
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
	/* $wamessage = str_replace("#studentfirstname", "$ipname", $wamessage);
    $wamessage = str_replace("#companyname", "$cmpname", $wamessage);
    
    $wamessage = str_replace("#user_name", "$ipmobile", $wamessage);
    $wamessage = str_replace("#password", "$ippassword", $wamessage);
    $wamessage = str_replace("#username", "$ufullname", $wamessage);
    $wamessage = str_replace("#userrole", "$utype", $wamessage);
    $wamessage = str_replace("#companydetail", "$cmpwebsite", $wamessage);
    $wamessage = str_replace("#companyemail", "$cmpemail", $wamessage);
    $wamessage = str_replace("#companynumber", "$cmpmobile", $wamessage);*/
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
	}
	
    
	
			
			
			
			
			
			
			
			
		} 
		else
		{
			$_SESSION['msg1'] = "Error";
		}
	}
	header("Location: complaindetail.php?id=$cmid");
	
	mysqli_close($conn);	
?>