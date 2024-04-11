<?php
session_start();

	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
		return;
	}


    $samid=$_SESSION['samid'];
	include("connect.php");

	$sid=$_POST['sid1'];
	$terms=$_POST['terms'];
	$terms2="";
	$taxper="";
	$taxper2="";

	$f1=$_POST['f1'];
	$f2=$_POST['f2'];
	$f3="";
	$f4="";
	$f5=$_POST['f5'];
	$f6=$_POST['f6'];
	$f7=$_POST['f7'];
	$proformaterms="";

	$cmpname="";
	$cmpcaddress="";
	$cmpcity="";
	$cmpstate=$_POST['cmpstate'];
	$cmpcountry="";
	$attention="";
	$declaration="";
	$emailmsg="";
	$emailsubject="";
	$invoiceemailsubject="";
	$invoiceemailmsg="";
	$enablesms=$_POST['enablesms'];
	$semailsubject=$_POST['semailsubject'];
	$semailmsg=$_POST['semailmsg'];
	
	$saprefix=$_POST['saprefix'];
	$serviceprefix=$_POST['serviceprefix'];
	$workorderprefix=$_POST['workorderprefix'];
	$dispatchprefix=$_POST['dispatchprefix'];
	$sacontractcalltypedefault=$_POST['sacontractcalltypedefault'];
	
	$ttsms="";
	if($enablesms==1)
	{
			$smsmsg="";
			$ttsms=",smsmessage='$smsmsg'";
	}
	
	$attach11="";
	$attach1="";
	$attach22="";
	if(empty($_FILES['file']['name']) == false  )
	{
		$image1=$_FILES['file']['name'];
		$ext = pathinfo($image1, PATHINFO_EXTENSION);
		$filename1 = date("YmdHis").$_FILES['file']['name'];
		$path = "allimages";
		if($ext=='png' || $ext=='jpg' || $ext=='jpeg')
		 {
		move_uploaded_file( $_FILES['file']['tmp_name'], $path ."/". $filename1 );

		$attach1 = ",headerimg='$filename1'";
		}
	}
	
	if(empty($_FILES['file11']['name']) == false  )
	{
		$image1=$_FILES['file11']['name'];
		$ext = pathinfo($image1, PATHINFO_EXTENSION);
		$filename2 = date("YmdHis").$_FILES['file11']['name'];
		$path = "images";
		if($ext=='png' || $ext=='jpg' || $ext=='jpeg')
		 {
		move_uploaded_file( $_FILES['file11']['tmp_name'], $path ."/". $filename2 );

		$attach11 = "loginimg='$filename2'";
		}
	}

	if(empty($_FILES['file1']['name']) == false  )
	{
		$image2=$_FILES['file1']['name'];
		$ext1 = pathinfo($image2, PATHINFO_EXTENSION);
		$filename11 = date("YmdHis").$_FILES['file1']['name'];
		$path = "allimages";
		if($ext1=='png' || $ext1=='jpg' || $ext1=='jpeg')
		 {
		move_uploaded_file( $_FILES['file1']['tmp_name'], $path ."/". $filename11 );

		$attach22 = ",footerimg='$filename11'";
		}
	}

	  $eve = "update res_generalsettings_master set terms='$terms',terms2='$terms2',taxper='$taxper',taxper2='$taxper2',cmpdetail1='$f1',cmpdetail2='$f2',cmpdetail3='$f3',cmpdetail4='$f4',cmpdetail5='$f5',cmpdetail6='$f6',cmpdetail7='$f7' $attach1 $attach22,cmpname='$cmpname',cmpcaddress='$cmpcaddress',cmpcity='$cmpcity',cmpstate='$cmpstate',cmpcountry='$cmpcountry',attention='$attention',declaration='$declaration',proformaterms='$proformaterms',invoiceemailsubject='$invoiceemailsubject',invoiceemailmsg='$invoiceemailmsg',semailsubject='$semailsubject',semailmsg='$semailmsg' $ttsms where samid=$samid";


	if ($conn->query($eve) === TRUE)
	{    

 $eve2 = "update res_generalsettings_master set $attach11";


	if ($conn->query($eve2) === TRUE)
	{
		$_SESSION['msg'] = "Image uploaded";
	}else{
		$_SESSION['msg1'] = "Image upload failed";
	}
		 $eve1 = "update res_superadmin_master set sacontractcalltypedefault='$sacontractcalltypedefault',saprefix='$saprefix',serviceprefix='$serviceprefix',workorderprefix='$workorderprefix',dispatchprefix='$dispatchprefix' where samid=$samid";
		 if ($conn->query($eve1) === TRUE)
	{
		 
		$_SESSION['msg'] = "General Settings Information Updated";

	}
	}
	header("Location: setting.php?id=$sid ");
?>
