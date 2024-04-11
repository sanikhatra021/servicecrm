<?php

 // mobile photo
 include("../connect.php");
 
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('Y/m/d H:i:s');
	$mdate1= date('Y-m-d');
	
	
	$par1 = $_GET['p1'];	//ummobile
	$par2 = $_GET['p2'];	//umpassword
	$par3 = $_GET['p3'];	//seid
	$par4 = $_GET['p4'];	//custid
	$par5 = 0;	//cmid
	$par6 =0;	//remark
	$par7 = $_GET['p7'];	//status
	$par8 = $_GET['p8'];	//charge
	$par9 = $_GET['p9'];	//cmid
	$par10 = $_GET['p10'];	//solution
	$par11 = $_GET['p11'];	//cdmachinemodel
	$par12 = $_GET['p12'];	//cdmachinesrno
	$par13 = $_GET['p13'];	//cdmachinelocation
	$par14 = $_GET['p14'];	//cdworkdone
	$par15 = $_GET['p15'];	//cdpendingwok
	$par16 = $_GET['p16'];	//cdsign
	$par17 = $_GET['p17'];	//cdcustremarks
	$par18 = $_GET['p18'];	// paystatus 
	$par19 = $_GET['p19'];	//paymentmode
	$par20 = $_GET['p20'];	//payamount
	$par21 = $_GET['p21'];	//paymentremark
	$par22 = $_GET['p22'];	//cdid
	
	
	$cdphoto1="";
	$cdsign1="";
	 if($_SERVER['REQUEST_METHOD']=='POST')
	 {
		$cdphoto1="";
		 if(empty($_FILES['image']['name']) == false  )
		 {
			$simplephoto11=$_FILES['image']['name'];
			$ext = pathinfo($simplephoto11, PATHINFO_EXTENSION);
			$fileexplode1 = explode(".",$simplephoto11);
			$fileend1 = end($fileexplode1);

			$cdphoto1= date("YmdHis").rand(100,999).".".$fileend1;
			$path = "../images";
			
			move_uploaded_file( $_FILES['image']['tmp_name'], $path ."/". $cdphoto1);
		  }
		
		$cdsign1="";
		 if(empty($_FILES['sign']['name']) == false  )
		 {
			$simplephoto112=$_FILES['sign']['name'];
			$ext = pathinfo($simplephoto112, PATHINFO_EXTENSION);
			$fileexplode12 = explode(".",$simplephoto112);
			$fileend12 = end($fileexplode12);

			$cdsign1= date("YmdHis").rand(100,999).".".$fileend12;
			$path1 = "../images";
			
			move_uploaded_file( $_FILES['sign']['tmp_name'], $path1 ."/". $cdsign1);
		  }
		
	 }
	
	 $eve_category3 = "SELECT * FROM  res_user_master where  umobile='$par1' and upassword='$par2'";
	$re_category3 = mysqli_query($conn, $eve_category3);
	$umid=0;
	if(mysqli_num_rows($re_category3) > 0)
    {
		while($rt_category3 = mysqli_fetch_assoc($re_category3))
		{
			$samid = $rt_category3['samid'];
			/* $serviceengineerid=$rt_category3['serviceengineerid'];
			$custid=$rt_category3['custid']; */
		}
	
		    $eve1 = "update res_complain_detail set custid ='$par4',cdphoto='$cdphoto1',cdstatus='$par7',cdendtime='$mdate',cdupdatedon='$mdate',cdservicecharge='$par8',cdmachinemodel='$par11',cdmachinesrno='$par12',cdmachinelocation='$par13',cdworkdone='$par14',cdpendingwok='$par15',cdsign='$cdsign1',cdcustremarks='$par17',cdremark ='$par10',cactive = 0  where cdid='$par22' and cactive=1"; 
		 
		 /*  $eve1 = "INSERT INTO res_complain_detail (cmid,samid,custid,serviceengineerid,cdstatus,cdservicecharge,cdremark,assigndate,cdphoto,cdaddedon,cdmachinemodel,cdmachinesrno,cdmachinelocation,cdworkdone,cdpendingwok,cdsign,cdcustremarks) VALUES('$par9','$samid','$par4','$par3','$par7','$par8','$par10','$mdate1','$cdphoto1','$mdate','$par11','$par12','$par13','$par14','$par15','$cdsign1','$par17')"; */
		  
		if ($conn->query($eve1) === TRUE) 
		{
			
			/*  $eve2 = "update res_complain_master set cstatus='$par7',cmstatusudate='$mdate1',cmupdatedon='$mdate',cmupdatedby='$par3',cmsolution='$par10',cmservicecharge='$par8' where cmid='$par9'"; */
			 $eve_category37 = "SELECT cactive FROM  res_complain_detail where cmid = $par9 and cactive = 1";
			$re_category37 = mysqli_query($conn, $eve_category37);
			$cmactive = 0;
			if(mysqli_num_rows($re_category37) > 0)
			{
				$cmactive = 1;
			}
			$tt="";
			if($par18=='Paid')
			{
				$tt=",cmpaystatus='Paid',cmpaymentmode = '$par19',cmpayamount = cmpayamount+$par20,cmpayremark = '$par21',cmpendingamount=cmnetamount-$par20";
				$eve11 = "insert into res_complainpayment_detail (cmid,cmnetamount,cmpayamount,cmpaymentmode,cmpayremark,cmpendingamount,samid,cmpaymentdate) VALUES($par9,'$cmnetamount','$par20','$par19','$par21','$par21','$samid','$mdate1')";		
				$re11 = mysqli_query($conn, $eve11);
			}				
					
					
			 $eve2 = "update res_complain_master set cstatus='$par7',cmstatusudate='$mdate1',cmupdatedon='$mdate',cmupdatedby='$par3',cmsolution='$par10',cmservicecharge='$par8',cmactive = '$cmactive' $tt where cmid =$par9";
			 if ($conn->query($eve2) === TRUE) 
			{
				
			} 
			 
			$result="1";

			$posts[] = array('p1'=> $result,'p2'=> "Successful");

			$response['posts'] = $posts;	
// mail whatsapp process start..................
		
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
         

					
	$flagsendemailtoengineer=0;	
	$flagsendwhatsapptoengineer=0;		
					
	if($sendemail==1)
	{
					$etemailsubject='';
$emessage='';
$etstatus='';

					
					 $eve33 = "select * from res_emailtemplate_master where etsubject='Status Update' and (etstatus='Active') and samid=$samid";

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
			  $eve110 = "select * from res_watemplate_master where wasubject='Status Update' and (wastatus='Active') and samid=$samid";
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
			 $eveag = "select * from res_user_master where umid=$par4";

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



   
   
   $eve2 = "select * from res_complain_master where cmid=$par9";
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
    $emessage = str_replace("#remarks", "$par10", $emessage);
    $emessage = str_replace("#nstatus", "$par7", $emessage);
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
	
	
	$wamessage = str_replace("#customername", "$uname", $wamessage);
    $wamessage = str_replace("#ticketnumber", "$ticketno", $wamessage);
    $wamessage = str_replace("#updatedate", "$mdate1", $wamessage);
    $wamessage = str_replace("#remarks", "$par10", $wamessage);
    $wamessage = str_replace("#nstatus", "$par7", $wamessage);
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
		else
		{
			$result="0";
			
			$posts[] = array('p1'=> $result,'p2'=> "Failed");

			$response['posts'] = $posts;	
	   }
	}
	else
	{
		$result="0";
		
		$posts[] = array('p1'=> $result,'p2'=> "Failed");

		$response['posts'] = $posts;	
   }		
	  echo stripslashes(json_encode( array('item' => $posts)));
 
 
 ?>