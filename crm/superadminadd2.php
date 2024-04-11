<?php
include 'phpqrcode/qrlib.php'; 
session_start(); 
/* error_reporting(E_ALL);
ini_set('display_errors', '1'); */
	
	if(!isset($_SESSION['lacomplainsuperadmin']))
	{
		header('Location: index.php');
		return;
	}
	if($_SESSION['lasuperadmintype']!='superadmin'){
			header('Location: index.php');
		return;
	}

	include("connect.php");
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('Y-m-d');
	
	$mdate2= date('Y-m-d H:i:s');
	
	//$exprydate = date("Y-m-d", strtotime("+360 day"));
	
	$fullname=$_POST['safullname'];
	$mobile=$_POST['samobile'];
	$username=$_POST['samobile'];
	$password=$_POST['sapassword'];
	$sename=$_POST['sename'];
	$semobile=$_POST['semobile'];
	$sepassword=$_POST['sepassword'];
	
	$emailid=$_POST['saemailid'];
	$address=trim($_POST['saaddress']);
	$city="";
	$uloc1="";
	$uloc2="";
	
	
	$satotusers=$_POST['satotusers'];
	$saplanexpdate=date("Y-m-d",strtotime($_POST['saplanexpdate']));
	$planstatus=$_POST['pstatus'];
	$estatus=$_POST['estatus'];
	$wstatus=$_POST['wstatus'];
	$saurl=trim($_POST['saurl']);
	$saprefix=trim($_POST['saprefix']);
	$serviceprefix=trim($_POST['serviceprefix']);
	$workorderprefix=trim($_POST['workorderprefix']);
	$dispatchprefix=trim($_POST['dispatchprefix']);
	
	include("mylibrary.php");
	if(empty($_FILES['cmpadminlogo']['name']) == false  )
	{
		$image1=checkvalidstring($_FILES['cmpadminlogo']['name']);
		$ext = pathinfo($image1, PATHINFO_EXTENSION);
		$cmpadminlogo = date("YmdHis").rand(1000,9999).'.'.$ext;
		$path = "../images";
		if($ext=='png' || $ext=='jpg' || $ext=='jpeg')
		 {
		move_uploaded_file( $_FILES['cmpadminlogo']['tmp_name'], $path ."/". $cmpadminlogo );

		$attach14 = "$cmpadminlogo";
		}
	}else{
		$attach14 ="sidelogo.png";
	}
	// output: /myproject/index.php
	$currentPath = $_SERVER['PHP_SELF']; 
	
	// output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index ) 
	$pathInfo = pathinfo($currentPath); 
	
	// output: localhost
	$hostName = $_SERVER['HTTP_HOST']; 
	
	// output: http://
	$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
	/* $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))==''; */
	
	// return: http://localhost/myproject/
	$main=$protocol.$hostName."/";
	//return;
	$saurl1=$main.$saurl;
	if($saurl!='')
	{
		$path = '../../images/';
		/* $file1 = uniqid().".png"; */
		$file1 = $saurl.".png";
		$file = $path.$file1;
		
		// $ecc stores error correction capability('L')
		$ecc = 'L';
		$pixel_Size = 10;
		$frame_Size = 10;
		  
		// Generates QR Code and Stores it in directory given
		QRcode::png($saurl1, $file, $ecc, $pixel_Size, $frame_Size);
		$saqrimg=$file1;
	}
	else
	{
		$saqrimg='';
	}
	
	
	
	$eve = "select * from res_superadmin_master where samobile='$mobile'";
	$re = mysqli_query($conn, $eve);
	if(mysqli_num_rows($re) > 0)
	{
		$_SESSION['msg1'] = "Mobile No. Already Inserted.";
		header('Location: superadmin.php');
	}
	else
	{	
		
			$smslink = 'https://skrumessage.com/api/send?number=#umobile&type=text&message=#wamessage&instance_id=64DD9BD31CE9E&access_token=64dd9b4da664a';
			$eve1 = "INSERT INTO res_superadmin_master (sacontractcalltypedefault,safullname,samobile,sautype,saemailid,saaddress,sacity,sauloc1,sauloc2,sauserstatus,sacurrentplanname,sacurrentplantype,satotusers,saplanexpdate,sacurrentplanstatus,saurl,saqrimg,saprefix,serviceprefix,workorderprefix,dispatchprefix,smslink,sendwhatsapp,sendemail,cmpadminlogo) VALUES 
			('Visit Call','$fullname','$mobile','business','$emailid', '$address','$city','$uloc1','$uloc2','active','premium','active','$satotusers','$saplanexpdate','$planstatus','$saurl','$saqrimg','$saprefix','$serviceprefix','$workorderprefix','$dispatchprefix','$smslink','$wstatus','$estatus','$attach14')";
			
			if ($conn->query($eve1) === TRUE)
			{
				$samid = $conn->insert_id;
				
				
				 $eve11 = "INSERT INTO res_user_master (samid,uname,umobile,upassword,utype,emailid,uaddress,ucity,uloc1,uloc2) VALUES('$samid','$fullname','$mobile','$password','Admin','$emailid','$address','$city','$uloc1','$uloc2')";
		
		
				if ($conn->query($eve11) === TRUE)
				{
					$last_id = $conn->insert_id;
					 $eve14 = "INSERT INTO res_user_master (samid,uname,umobile,upassword,utype) VALUES('$samid','$sename','$semobile','$sepassword','serviceengineer')";
					 $re14 = mysqli_query($conn, $eve14);
					$_SESSION['msg'] = "Record has been added successfully";
				}
				
				$eve12 = "INSERT INTO res_generalsettings_master (samid,taxper, taxper2, logo, terms, semailsubject, smsmessage, currency, headerimg, footerimg, qttype, cmpdetail, cmpdetail1, cmpdetail2, cmpdetail3, cmpdetail4, cmpdetail5, cmpdetail6, cmpdetail7, cmpname, cmpcaddress, cmpcity, cmpstate, cmpcountry, attention, declaration, terms2, semailmsg, proformaterms, byear, qyear, qprefix, invoiceemailsubject, invoiceemailmsg, iyear, iprefix, enablesms) VALUES ('$samid','0', '0', '', '', 'Please find Receipt', '', 'Rs.', 'header.png', 'footer.png', 'Tax', '', '', ' ', '', '', 'NOTE:', '2019-2020', 'Q', '', '', '', 'Gujarat', '', '', '', '', 'PFA', '', '2019', '2019-2020', 'Q', '', '', '2019-2020', 'T', '1')";
		        
		
				if ($conn->query($eve12) === TRUE)
				{
					/* $_SESSION['msg'] = "Record has been added successfully"; */
				}
				
				$eve13 = "INSERT INTO res_aboutus_master (samid,umid) VALUES($samid,$last_id)";
				$re13 = mysqli_query($conn, $eve13);
				
				$eve15 = "INSERT INTO res_product_master (samid,pmname,pmdesc,prate,ptype) VALUES($samid,'Machine1','Details of Machine1','5000','Product')";
				$re15 = mysqli_query($conn, $eve15);
				
				$eve16 = "INSERT INTO res_unit_master (samid,unitname) VALUES($samid,'Nos'),($samid,'Kgs'),($samid,'unit')";
				$re16 = mysqli_query($conn, $eve16);
				
				$eve17 = "INSERT INTO res_product_master (samid,pmname,pmdesc,pmunit,prate,ptype) VALUES($samid,'Spare1','Details of Spare1','Nos','200','Item')";
				$re17 = mysqli_query($conn, $eve17);
				
				
				$eve18 = "INSERT INTO res_problemtype_master (samid,ptmname) VALUES($samid,'Display Not Working'),($samid,'Power Not Starting')";
				$re18 = mysqli_query($conn, $eve18);
				
				$eve19 = "INSERT INTO res_complaintype_master (samid,ctmname) VALUES($samid,'Breakdown Call'),($samid,'Installation Call')";
				$re19 = mysqli_query($conn, $eve19);
				
				$eve20 = "INSERT INTO res_servicetype_master (samid,stypename) VALUES($samid,'Warranty'),($samid,'Comprehensive Service')";
				$re20 = mysqli_query($conn, $eve20);
				
				$eve21 = "INSERT INTO res_emailacc_master (emailaccid,providername,email,epassword,esmtp,eport,essltls,esecure,esendlimit,esendtoday,elastsenddatetime,etotalsend,eactive,samid) VALUES (NULL, 'LinkArise', 'noreply@linkarise.in', 'Pn}SXZ.nLcsb', 'linkarise.in', '465', 'ssl', 'yes', '0', '0', '', '0', '0', '$samid')";
				$re21 = mysqli_query($conn, $eve21);
				
				$eve2 = "INSERT INTO res_watemplate_master (wamid, wasubject, wamessage, wastatus, waaddedby, waaddedon, waupdatedby, waupdatedon, samid) VALUES (NULL, 'Complain add', 'Hi #customername!, We have register your complain with ticket number - #ticketnumber, your complain will be resolved by our team in 24 to 48 hours .Regards,#companyname.', 'Active', '374', '2023-10-20 15:44:27', '374', '2023-10-20 15:44:27', '$samid'), (NULL, 'Status Update', 'Hi #customername!Below are the details of your latest complain register with us,date - #updatedateticket no - #ticketnumberstatus - #nstatusremark - #remarksRegards, #companyname', 'Active', '374', '2023-10-20 16:39:27', '374', '2023-10-20 16:39:27', '$samid'), (NULL, 'Engineer Add', 'hello #serviceengineer! You have been allocated to #customername and ticket no is : #ticketnumber. More details visit application.', 'Active', '374', '2023-10-20 18:04:51', '374', '2023-10-20 18:04:51', '$samid')";
				$re2 = mysqli_query($conn, $eve2);
				
				$eve22 = "INSERT INTO res_emailtemplate_master (etmid, etsubject, etemailsubject, emessage, etstatus, etaddedby, etaddedon, etupdatedby, etupdatedon, samid) VALUES (NULL, 'Complain add', 'Received complain for - #problemname', '<p>Hi #customername!,</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We have register your complain with ticket number - #ticketnumber, your complain will be resolved by our team in 24 to 48 hours .</p><p>Regards,<br />#companyname.</p>', 'Active', '374', '2023-10-20 15:46:41', '374', '2023-10-20 15:46:41', '$samid'), (NULL, 'Status Update', 'Call status update', '<p>Hi #customername!</p><p><br />Below are the details of your latest complain register with us,</p><p><br />date - #updatedate<br />ticket no - #ticketnumber<br />status - #nstatus<br />remark - #remarks</p><p>Regards,<br />#companyname.</p>', 'Active', '374', '2023-10-20 16:45:00', '374', '2023-10-20 16:45:00', '$samid'), (NULL, 'Engineer Add', 'You are added as a Service engineer', '<p>hello #serviceengineer!</p><p>&nbsp;</p><p>&nbsp; &nbsp; &nbsp; You have been allocated to #customername and ticket no is : #ticketnumber. More details visit application.</p>', 'Active', '374', '2023-10-20 18:04:31', '374', '2023-10-20 18:04:31', '$samid')";
				$re22 = mysqli_query($conn, $eve22);
				
				
				$_SESSION['msg'] = "user successfully added.";
			
				
			}
			
	}
	header('Location: superadmin.php');
?>