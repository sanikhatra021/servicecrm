<?php
session_start(); 
//error_reporting(0);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
	include("getserviceno.php");
	include('date_functions.php');

	date_default_timezone_set("Asia/Kolkata");
	$mdate1= date('Y-m-d H:i:s');
	$mdate2= date('d-m-Y');
	$mdate= date('Y-m-d');
	
	$pmid=$_POST['pmid'];
	$servicemid=$_POST['servicemid'];
	$custid=$_POST['customerid'];
	
	$servicetype=$_POST['servicetype'];
	$servicedate=date('Y-m-d',strtotime($_POST['servicedate']));
	$cmserviceengineerid=$_POST['serviceengineerid'];
	$cmtype="";
	if($servicetype=="AMC")
	{
		$cmtype="AMC-Call";
	}
	else if($servicetype=="Warranty")
	{
		$cmtype="Warranty-Call";
	}
	else
	{
		$cmtype="None-Call";
    }		
	
					$cyear = getFinancialYear2($mdate);
					 $evemaxq = "SELECT max(cmno) AS maxcmno FROM res_complain_master where cyear='$cyear' and  samid=$samid";
					 $cmno1=0;
	$remaxq = mysqli_query($conn, $evemaxq);
	while($rtmaxq = mysqli_fetch_assoc($remaxq))
	{
		$cmno=$rtmaxq['maxcmno'];
	}
	$cmno1=$cmno+1;
					
						//$cmnowithprefix=$saprefix.$cmno1;
						$cmnowithprefix=generatecomplainno();
					
				  $eve11 = "INSERT INTO res_complain_master (cmno,servicemid,cmdate,pmid,cmdetail,cstatus,cmstatusudate,customerid,samid,cmtype,cmnowithprefix,cmproblemtype,cmupdatedon,cmupdatedby,cmaddedby,cmaddedon,servicetype,cyear) VALUES($cmno1,'$servicemid','$servicedate','$pmid','Regular AMC','Scheduled','$mdate2','$custid','$samid','$cmtype','$cmnowithprefix','Regular Service','$mdate1','$umid','$umid','$mdate1','Service','$cyear')";
				
					if ($conn->query($eve11) === TRUE)
					{
						$cmid = $conn->insert_id;
									
					$eve1 = "select * from res_product_master where pmid=$pmid";
				$re1 = mysqli_query($conn, $eve1);
				while($rt1 = mysqli_fetch_assoc($re1))
				{
					$pmname=$rt1['pmname'];
				}
					
					$eve3 = "INSERT INTO res_complainallocation_detail (cmid,serviceengid,allocateddate,samid) VALUES($cmid,$cmserviceengineerid,'$mdate',$samid)";
					if ($conn->query($eve3) === TRUE)
					{}
				
						updateComplaintStatus();
						$_SESSION['msg'] = "Record has been added successfully";
					}
				
			
			else
			{
				$_SESSION['msg1'] = "Error";
			}
		
		
header('Location: servicedetail.php?id='.$_SESSION['servicemid']);
?>