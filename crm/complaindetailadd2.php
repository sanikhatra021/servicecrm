<?php
if(!isset($_SESSION)) { 
  session_start(); 
} 

	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
		return;
	}
	
	include("connect.php");
	
	date_default_timezone_set("Asia/Kolkata");
	$mdate1= date('Y-m-d H:i:s');
	$mdate2= date('Y-m-d');
	
	$samid=$_SESSION['samid'];
	
	
	$umid=$_SESSION['umid'];
	$cmid=$_POST['cmid'];
	
	$customerid=$_POST['customerid'];
	$cmserviceengineerid=$_POST['cmserviceengineerid'];
	
	$remarks=$_POST['cdstatus'];
	$cdstatus=$_POST['cdstatus'];
	$cdservicecharge=$_POST['cdservicecharge'];
	$cdremark=$_POST['cdremark'];
	$cdmachinemodel=$_POST['cdmachinemodel'];
	$cdmachinesrno=$_POST['cdmachinesrno'];
	$cdmachinelocation=$_POST['cdmachinelocation'];
	$cdworkdone=$_POST['cdworkdone'];
	$cdpendingwok=$_POST['cdpendingwok'];
	$cdcustremarks=$_POST['cdcustremarks'];
	//$cdsign=$_POST['cdsign'];
	
	
	
	$cdphoto1="";
	 if(empty($_FILES['cdphoto']['name']) == false  )
	{
		$simplephoto11=$_FILES['cdphoto']['name'];
		$ext = pathinfo($simplephoto11, PATHINFO_EXTENSION);
		$fileexplode1 = explode(".",$simplephoto11);
		$fileend1 = end($fileexplode1);

		$cdphoto1= date("YmdHis").rand(100,999).".".$fileend1;
		$path = "images";
		if($ext=='png' || $ext=='jpg' || $ext=='jpeg' || $ext=='gif' || $ext=='PNG' || $ext=='JPG' || $ext=='JPEG' || $ext=='GIF')
		{
		  move_uploaded_file( $_FILES['cdphoto']['tmp_name'], $path ."/". $cdphoto1);
		  $flag=1;
		}
		else 
		{
		  $_SESSION['msg1'] = "Only Upload Image";
		  header('Location: complaindetail.php?id='.$_SESSION['cmid']);
		  return;
		  $flag=0;
		}
	}
	
	$cdsign1="";
	 if(empty($_FILES['cdsign']['name']) == false  )
	{
		$simplephoto11=$_FILES['cdsign']['name'];
		$ext = pathinfo($simplephoto11, PATHINFO_EXTENSION);
		$fileexplode1 = explode(".",$simplephoto11);
		$fileend1 = end($fileexplode1);

		$cdsign1= date("YmdHis").rand(100,999).".".$fileend1;
		$path = "images";
		if($ext=='png' || $ext=='jpg' || $ext=='jpeg' || $ext=='gif' || $ext=='PNG' || $ext=='JPG' || $ext=='JPEG' || $ext=='GIF')
		{
		  move_uploaded_file( $_FILES['cdsign']['tmp_name'], $path ."/". $cdsign1);
		  $flag=1;
		}
		else 
		{
		  $_SESSION['msg1'] = "Only Upload Image";
		  header('Location: complaindetail.php?id='.$_SESSION['cmid']);
		  return;
		  $flag=0;
		}
	}
	
	 $eve1 = "update res_complain_detail set cdstatus='$cdstatus', cdservicecharge='$cdservicecharge',cdremark='$cdremark',cdphoto='$cdphoto1',cdmachinemodel='$cdmachinemodel', cdmachinesrno='$cdmachinesrno',cdmachinelocation='$cdmachinelocation',cdworkdone='$cdworkdone',cdpendingwok='$cdpendingwok',cdsign='$cdsign1',cdcustremarks='$cdcustremarks',cactive=0,cdendtime='$mdate1' where cmid='$cmid' and serviceengineerid=$cmserviceengineerid and samid=$samid and cactive=1";		
	
	if ($conn->query($eve1) === TRUE)
	{
		$last_id = $conn->insert_id;
		
		$eve2 = "update res_complain_master set cstatus='$cdstatus',cmstatusudate='$mdate2',cmupdatedon='$mdate1',cmupdatedby='$umid',cmsolution='$cdremark',cmservicecharge='$cdservicecharge',cmserviceengineerid=$cmserviceengineerid where cmid='$cmid'";
		if ($conn->query($eve2) === TRUE) 
		{
		} 
			
		$_SESSION['msg'] = "Record has been added successfully";
		
		
		// mail whatsapp process start..................
		
	 

/* $eveag = "select cmpname,cmpwebsite,cmpmobile,cmpemail from res_company_master  LIMIT 0,1";

    $reag = mysqli_query($conn, $eveag);

    if (mysqli_num_rows($reag) > 0) {

        while ($rtag = mysqli_fetch_assoc($reag)) {

            $cmpname = $rtag['cmpname'];
            $cmpwebsite = $rtag['cmpwebsite'];
            $cmpmobile = $rtag['cmpmobile'];
            $cmpemail = $rtag['cmpemail'];
            

        }

    } else {

        $cmpname = "";
      
        $cmpwebsite = "";
        $cmpmobile = "";
        $cmpemail = "";

    } */
$sendwhatsapp = $_SESSION['sendwhatsapp'];
$sendemail = $_SESSION['sendemail'];
         

					
	$flagsendemailtoengineer=0;	
	$flagsendwhatsapptoengineer=0;		
					
	if($sendemail==1)
	{
					$etemailsubject='';
$emessage='';
$etstatus='';

					
					 $eve33 = "select * from res_emailtemplate_master where etsubject='Status Update' and (etstatus='Active')";

    $re33 = mysqli_query($conn, $eve33);



    if (mysqli_num_rows($re33) > 0) 
	{

        while ($rt33 = mysqli_fetch_assoc($re33))
		{

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
			  $eve110 = "select * from res_watemplate_master where wasubject='Status Update' and (wastatus='Active')";
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
		$uname = "";
				$utype = "";
				$uemail = "";
				$umobile = "";
		 if($flagsendemailtoengineer==1 || $flagsendwhatsapptoengineer==1 ){
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
			 
		 }
	
	
	$url1 = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$url = substr($url1, 0, strrpos( $url1, '/'));
	$url = substr($url, 0, strrpos( $url, '/'));
	 $crmurl = $url."/student/";
	 
	 if($flagsendemailtoengineer==1)
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



   
   
   $eve2 = "select * from res_complain_master where cmid=$cmid";
	$re2 = mysqli_query($conn,$eve2);
	  if (mysqli_num_rows($re2) > 0) {

        while ($rt2 = mysqli_fetch_assoc($re2)) {

           
            $ticketno = $rt2['cmnowithprefix'];
         
        }

    }

   
   
   
	
	

$eve2 = "select safullname from res_superadmin_master where samid=$samid";
	$re2 = mysqli_query($conn,$eve2);
	  if (mysqli_num_rows($re2) > 0) {

        while ($rt2 = mysqli_fetch_assoc($re2)) {

           
            $safullname = $rt2['safullname'];
         
        }

    }

   

    $emessage = str_replace("#customername", "$uname", $emessage);
    $emessage = str_replace("#ticketnumber", "$ticketno", $emessage);
    $emessage = str_replace("#updatedate", "$mdate1", $emessage);
    $emessage = str_replace("#remarks", "$cdremark", $emessage);
    $emessage = str_replace("#nstatus", "$cdstatus", $emessage);
    $emessage = str_replace("#companyname", "$safullname", $emessage);
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

    if ($uemail == '') {

        $uemail = 'noreply@linkarise.in';

    }

    if ($uemail != '' ) {

        $mail->AddAddress("$uemail");



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
	
	if($flagsendwhatsapptoengineer==1)
	{
	if($wastatus == 'Active')
	{
	
	$wamessage = str_replace("#customername", "$uname", $wamessage);
    $wamessage = str_replace("#ticketnumber", "$ticketno", $wamessage);
    $wamessage = str_replace("#updatedate", "$mdate1", $wamessage);
    $wamessage = str_replace("#remarks", "$cdremark", $wamessage);
    $wamessage = str_replace("#nstatus", "$cdstatus", $wamessage);
    $wamessage = str_replace("#companyname", "$safullname", $wamessage);
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
				$umobile="91".$umobile;
				
				$cmpwhatsapplink = str_replace("#umobile", "$umobile", $cmpwhatsapplink);
				$cmpwhatsapplink = str_replace("#wamessage", "$wamessage", $cmpwhatsapplink);
				
				 $smsurl="$cmpwhatsapplink";
			
		//	$smsurl="https://skrumessage.com/api/send?number=91$umobile&type=text&message=$wamessage&instance_id=64DD9BD31CE9E&access_token=64dd9b4da664a";
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
	}
		
	}
	else
	{
		$_SESSION['msg1'] = "Error";
	}
	
header('Location: complaindetail.php?id='.$_SESSION['cmid']);
?>