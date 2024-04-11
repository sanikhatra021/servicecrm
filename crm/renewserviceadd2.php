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
	$custid=$_POST['customerid'];
	
	$servicetype=$_POST['servicetype'];
	$sdate=$_POST['sdate'];
	$edate=$_POST['edate'];
	$sstartdate=date('Y-m-d',strtotime($_POST['sdate']));
	$senddate=date('Y-m-d',strtotime($_POST['edate']));
	$pdate=date('Y-m-d',strtotime($_POST['pdate']));
	$fsdate=date('Y-m-d',strtotime($_POST['fsdate']));
	$sremarks=$_POST['custremarks'];
	$sserialno=$_POST['sserialno'];
	$sservicecharge=$_POST['sservicecharge'];
	$snoofseat=$_POST['noofservice'];
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
	
	$servicemid=$_POST['servicemid'];
	
	
	

	//$udefaultserviceengineer=$_POST['serviceengineerid'];
	$cmserviceengineerid=$_POST['serviceengineerid'];
	
	
	$cdate=$sstartdate;
	$startDate = new DateTime($sstartdate);
	$endDate = new DateTime($senddate);
	
	$difference = $endDate->diff($startDate);
	$days=$difference->format("%a");
	$daydiff=(int)$days / $snoofseat;
	$daydiff=(int)$daydiff;
	
	$snoofseat=$snoofseat-1;
	
	
  $eve = "update res_service_master set servicerenewalstatus='Renew' where servicemid=$servicemid";
	 if ($conn->query($eve) === TRUE)
	{
			
	}
	$seyear = getFinancialYear21($mdate);
					  $seno1=0;
						$evemaxq = "SELECT max(serviceno) AS maxseno FROM res_service_master where seyear='$seyear' and  samid=$samid";
	$remaxq = mysqli_query($conn, $evemaxq);
	while($rtmaxq = mysqli_fetch_assoc($remaxq))
	{
		$seno=$rtmaxq['maxseno'];
	}
	$seno1=$seno+1;
						
						//$cmnowithprefix=$saprefix.$cmno1;
						$senofordisplay=generateserviceno();
			
			 $eve1 = "INSERT INTO res_service_master (samid,pmid,custid,sstartdate,senddate,sremarks,sserialno,servicetype,spurchasedate,snoofseat,sservicecharge,servicestatus,servicerenewalstatus,serviceno,seyear,senofordisplay,addedon,addedby) VALUES('$samid','$pmid','$custid','$sstartdate','$senddate','$sremarks','$sserialno','$servicetype','$pdate','$snoofseat','$sservicecharge','Inactive','Pending','$seno1','$seyear','$senofordisplay','$mdate1','$umid')";	
   //$s = mysqli_query($conn, $eve1) or die('Failed');
			if($conn->query($eve1) === TRUE)
			{
				 $last_id = $conn->insert_id;
				  $cyear = getFinancialYear2($mdate);
					  $cmno1=0;
						$evemaxq = "SELECT max(cmno) AS maxcmno FROM res_complain_master where cyear='$cyear' and  samid=$samid";
	$remaxq = mysqli_query($conn, $evemaxq);
	while($rtmaxq = mysqli_fetch_assoc($remaxq))
	{
		$cmno=$rtmaxq['maxcmno'];
	}
	$cmno1=$cmno+1;
						
						//$cmnowithprefix=$saprefix.$cmno1;
						$cmnowithprefix=generatecomplainno();
						$cdate=$fsdate;
					  $eve112 = "INSERT INTO res_complain_master (cmno,servicemid,cmdate,pmid,cmdetail,cstatus,cmstatusudate,customerid,samid,cmtype,cmnowithprefix,cmproblemtype,cmupdatedon,cmupdatedby,cmaddedby,cmaddedon,servicetype,cyear) VALUES($cmno1,'$last_id','$cdate','$pmid','Regular AMC','Scheduled','$mdate2','$custid','$samid','$cmtype','$cmnowithprefix','Regular Service','$mdate1','$umid','$umid','$mdate1','Service','$cyear')";
					  if ($conn->query($eve112) === TRUE)
					{
						$_SESSION['msg'] = "Record has been added successfully";
					}
				$i=0;
				while ($i < $snoofseat)
				{
					//$cout <<
					//$i << "\n";
					$i++;
					$cdate=date('Y-m-d', strtotime($cdate. ' + '.$daydiff.' days'));
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
					
				  $eve11 = "INSERT INTO res_complain_master (cmno,servicemid,cmdate,pmid,cmdetail,cstatus,cmstatusudate,customerid,samid,cmtype,cmnowithprefix,cmproblemtype,cmupdatedon,cmupdatedby,cmaddedby,cmaddedon,servicetype,cyear) VALUES($cmno1,'$last_id','$cdate','$pmid','Regular AMC','Scheduled','$mdate2','$custid','$samid','$cmtype','$cmnowithprefix','Regular Service','$mdate1','$umid','$umid','$mdate1','Service','$cyear')";
				
					if ($conn->query($eve11) === TRUE)
					{
						$cmid = $conn->insert_id;
									
				
					
					$eve3 = "INSERT INTO res_complainallocation_detail (cmid,serviceengid,allocateddate,samid) VALUES($cmid,$cmserviceengineerid,'$mdate',$samid)";
					if ($conn->query($eve3) === TRUE)
					{}
				
						updateComplaintStatus();
						$_SESSION['msg'] = "Record has been added successfully";
					}
				}
			}
			else
			{
				$_SESSION['msg1'] = "Error";
			}
		
		
header('Location: service.php');
?>