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
	
	$cmid=$_POST['cmid'];
	$pmode=$_POST['pmode'];
	$payamount=$_POST['payamount'];
	$payremark=$_POST['payremark'];
	
	$pendingamount=$_POST['pendingamount'];
	$cmnetamount=0;
		$eve = "select * from res_complain_master where cmid=$cmid";
	    $re = mysqli_query($conn, $eve);
		while($rt = mysqli_fetch_assoc($re))
		{
				$cmnetamount=$rt['cmnetamount'];
		}
	$pendingamount1=$pendingamount-$payamount;
	
			
	  $eve1 = "update res_complain_master set cmpaystatus='Paid',cmpaymentmode = '$pmode',cmpayamount = '$payamount',cmpayremark = '$payremark',cmpendingamount='$pendingamount1' where cmid='$cmid' ";	
	
	if ($conn->query($eve1) === TRUE)
	{
		$last_id = $conn->insert_id;
		  $eve11 = "insert into res_complainpayment_detail (cmid,cmnetamount,cmpayamount,cmpaymentmode,cmpayremark,cmpendingamount,samid,cmpaymentdate) VALUES($cmid,'$cmnetamount','$payamount','$pmode','$payremark','$pendingamount1','$samid','$mdate2')";		
		$re11 = mysqli_query($conn, $eve11);
		$_SESSION['msg'] = "Record has been added successfully";
	}
	else
	{
		$_SESSION['msg1'] = "Error";
	}
	
header('Location: complaindetail.php?id='.$_SESSION['cmid']);
?>