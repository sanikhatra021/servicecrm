<?php
session_start(); 

	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
		return;
	}
	$samid=$_SESSION['samid'];

	include("connect.php");
	
	date_default_timezone_set("Asia/Kolkata");
	$mdate1= date('Y-m-d H:i:s');
	$mdate2= date('d-m-Y');
	
	

	$amcid=$_POST['amcid'];
	$pmid=$_POST['pmid'];
	$custid=$_POST['custid'];
	$sstartdate=date('Y-m-d',strtotime($_POST['sdate']));
	$senddate=date('Y-m-d',strtotime($_POST['edate']));
	$pdate=date('Y-m-d',strtotime($_POST['pdate']));
	$sremarks=$_POST['sremark'];
	$sserialno=$_POST['sserialno'];
	
    $eve = "update res_service_master set pmid='$pmid',custid='$custid',sstartdate='$sstartdate',senddate='$senddate',spurchasedate='$pdate',sremarks='$sremarks',sserialno='$sserialno' where amcid=$amcid and samid=$samid";
	if ($conn->query($eve) === TRUE)
	{
			
		$_SESSION['msg'] = "Record has been updated successfully";	
	}
	else
	{
		$_SESSION['msg1'] = "Error";
	}
	header('Location: amc.php');
?>