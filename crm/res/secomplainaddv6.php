<?php  
 
error_reporting(E_ERROR | E_PARSE);
	include("../connect.php");
	include("../mylibrary.php");
	include("../getcomplainno.php");
	
	$par1=$_GET['p1'];	//mobile
	$par2=$_GET['p2'];	//university
	//$par3=$_GET['p3'];	//complain type
	$par4=$_GET['p4'];	//iepercentage
	$par5=$_GET['p5'];	//ctmid
	$par6=$_GET['p6'];	//status
	$par7=$_GET['p7'];	//detail
	$par8=$_GET['p8'];	//problemtype
	$par9=$_GET['p9'];	//calltype
	if($par4=='')
	{
		$par4=0;
	}
	$myObj2 = new stdClass();
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('Y-m-d');
	$mdate1= date('Y-m-d H:i:s');
	
	$response = array();
	$posts = array();
	$result ="0";
	$msg = "";
	
	$eve_category =  "SELECT * FROM  res_user_master where umobile='$par1' and upassword='$par2'";
	$re_category = mysqli_query($conn,$eve_category);
	if(mysqli_num_rows($re_category) > 0)
    {
		while($rt_category = mysqli_fetch_assoc($re_category))
		{
				//$ctmid=$rt_category['ctmid'];
				//$pmid=$rt_category['pmid'];
				$umid=$rt_category['umid'];
				$upassword=$rt_category['upassword'];
				
				
			
				
				$samid=$rt_category['samid'];
				
					
					
					
				//$cmdate=implode('-', array_reverse(explode('-', $rt1['cmdate'])));
			
		}	
		$eve11 = "select saprefix from res_superadmin_master where samid=$samid";
		$re11 = mysqli_query($conn, $eve11);
		$saprefix="";
		while($rt11 = mysqli_fetch_assoc($re11))
		{
			$saprefix=$rt11['saprefix'];
		}
		
		$cyear = getFinancialYear2($mdate);
		$evemaxq = "SELECT max(cmno) AS maxcmno FROM res_complain_master where cyear='$cyear' and  samid=$samid";
		$remaxq = mysqli_query($conn, $evemaxq);
		while($rtmaxq = mysqli_fetch_assoc($remaxq))
		{
			$cmno=$rtmaxq['maxcmno'];
		}
		$cmno1=$cmno+1;
		//$saprefix=date("ymd");
		//$cmnowithprefix=$saprefix.$cmno1;
		//$cmnowithprefix=generatecomplainno($samid);
		$cmnowithprefix = generateNumber2($saprefix,$cmno1,$cyear);
		//for service change
		$eveservice = "SELECT ptmrate FROM res_problemtype_master where ptmname='$par8'";
		$reservice = mysqli_query($conn, $eveservice);
		while($rtservice = mysqli_fetch_assoc($reservice))
		{
			$ptmrate=$rtservice['ptmrate'];
		}
	
		   	   $eve1 = "insert into res_complain_master (cmno,cmtype,pmid,customerid,cmdate,cmdetail,cmproblemtype,cstatus,samid,cmserviceengineerid,cmupdatedon,cmupdatedby,cmaddedby,cmaddedon,cmnowithprefix,cmservicecharge,cmmethod,cmadminstatus,servicetype,cmnetamount,cyear) values($cmno1,'$par9','$par4','$par5','$par6','$par7','$par8','Pending','$samid','$umid','$mdate1','$umid','$umid','$mdate1','$cmnowithprefix','$ptmrate','offline','Open','complain','$ptmrate','$cyear')";
			
			if ($conn->query($eve1) === TRUE) 
			{
				$last_id = $conn->insert_id;
				
				 $eve123 = "insert into res_complainallocation_detail (cmid,serviceengid,allocateddate,samid) values ($last_id,$umid,'$mdate',$samid)";
				$re123 = mysqli_query($conn, $eve123); 
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				      //.......    1.---- Process to send email whatsapp for complain add to Customer is starts here//
					
	 $eveag = "select * from res_user_master where umid=$par5";

    $reag = mysqli_query($conn, $eveag);

    if (mysqli_num_rows($reag) > 0) {

        while ($rtag = mysqli_fetch_assoc($reag)) {

            $uname = $rtag['uname'];
         
            $uemail = $rtag['emailid'];
             
			
            $umobile = $rtag['umobile'];
			

        }

    } else {

        $uname = "";
        $utype = "";
		$uemail = "";
        $umobile = "";

    }
	
	

                                        



$eve14 = "select * from res_superadmin_master where samid=$samid";
$re14 = mysqli_query($conn, $eve14);

if(mysqli_num_rows($re14) > 0)
	{
	  while ($rt14 = mysqli_fetch_assoc($re14))
		{
		$sendwhatsapp = $rt14['sendwhatsapp'];
		$sendemail = $rt14['sendemail'];
		}
	}






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
	
	
 /*    $emessage2 = str_replace("#studentfirstname", "$ipname", $emessage2);
    $emessage2 = str_replace("#companyname", "$cmpname", $emessage2);
    
    $emessage2 = str_replace("#user_name", "$ipmobile", $emessage2);
    $emessage2 = str_replace("#password", "$ippassword", $emessage2);
    $emessage2 = str_replace("#username", "$ufullname", $emessage2);
    $emessage2 = str_replace("#userrole", "$utype", $emessage2);
    $emessage2 = str_replace("#companydetail", "$cmpwebsite", $emessage2);
    $emessage2 = str_replace("#companyemail", "$cmpemail", $emessage2);
    $emessage2 = str_replace("#companynumber", "$cmpmobile", $emessage2);*/
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
	/* $wamessage2 = str_replace("#studentfirstname", "$ipname", $wamessage2);
    $wamessage2 = str_replace("#companyname", "$cmpname", $wamessage2);
    
    $wamessage2 = str_replace("#user_name", "$ipmobile", $wamessage2);
    $wamessage2 = str_replace("#password", "$ippassword", $wamessage2);
    $wamessage2 = str_replace("#username", "$ufullname", $wamessage2);
    $wamessage2 = str_replace("#userrole", "$utype", $wamessage2);
    $wamessage2 = str_replace("#companydetail", "$cmpwebsite", $wamessage2);
    $wamessage2 = str_replace("#companyemail", "$cmpemail", $wamessage2);
    $wamessage2 = str_replace("#companynumber", "$cmpmobile", $wamessage2);*/
    $wamessage2 = str_replace("#crmurl", "$crmurl", $wamessage2); 
 $wamessage2 = urlencode($wamessage2);
 $wamessage2= preg_replace("/[\n\r]/", '<br />', $wamessage2);
	
				
				
				 $eve11 = "select * from res_superadmin_master where samid=$samid";
	$re11 = mysqli_query($conn,$eve11);
	  if (mysqli_num_rows($re11) > 0) {

        while ($rt11 = mysqli_fetch_assoc($re11)) {

           
            $cmpwhatsapplink = $rt11['smslink'];
//			$sendwhatsapp = $rt11['sendwhatsapp'];
	//		$sendemail = $rt11['sendemail'];
         
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
						
						
					}
					
	}
				
				
				
				$msg = "Success";
				$myObj2->status = "1";
				$myObj2->message = $msg;
				
				
				echo stripslashes(json_encode(array($myObj2)));	
				
				
				
			}
			else
		   {
				
				$result="0";
				$msg = "Failure";	
				$myObj2->status = $result;
				$myObj2->message = $msg;
				echo stripslashes(json_encode(array($myObj2)));
			
		   }
		
	}
	else
    {
	   $result="0";
	   $msg = "Invalid mobile OR password";
	   
		$myObj2->status = $result;
		$myObj2->message = $msg;
		echo stripslashes(json_encode(array($myObj2)));	
	
    }
   
    $response['posts'] = $posts;
	mysqli_close($conn);
	
	
?>