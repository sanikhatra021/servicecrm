<?php
session_start(); 

	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
		return;
	}
	$samid=$_SESSION['samid'];
 $umid=$_SESSION['umid'];
	include("connect.php");
	include("getcomplainno.php");
	include("getserviceno.php");
	include('date_functions.php');
	date_default_timezone_set("Asia/Kolkata");
	$mdate1= date('Y-m-d H:i:s');
	$mdate2= date('d-m-Y');
	$mdate= date('Y-m-d');
	

	$servicemid=$_POST['servicemid'];
	$pmid=$_POST['pmid'];
	$custid=$_POST['custid'];
	$sstartdate=date('Y-m-d',strtotime($_POST['sdate']));
	$senddate=date('Y-m-d',strtotime($_POST['edate']));
	$pdate=date('Y-m-d',strtotime($_POST['pdate']));
	$sremarks=$_POST['sremark'];
	$sserialno=$_POST['sserialno'];
	$servicetype=$_POST['servicetype'];
	$sservicecharge=$_POST['sservicecharge'];
	$snoofseat=$_POST['noofservice'];
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
	
		$eve1 = "delete from res_complain_master where servicemid=$servicemid and cstatus in('Scheduled','Pending')";
		$result= mysqli_query($conn, $eve1) or die("Error");
	
      $eve = "update res_service_master set pmid='$pmid',custid='$custid',sstartdate='$sstartdate',senddate='$senddate',spurchasedate='$pdate',sremarks='$sremarks',sserialno='$sserialno',servicetype='$servicetype',sservicecharge='$sservicecharge',updatedby='$umid',updatedon='$mdate1',snoofseat='$snoofseat' where servicemid=$servicemid and samid=$samid";

	if ($conn->query($eve) === TRUE)
	{
			 $eve2 = "select count(servicemid) as cc from res_complain_master where servicemid=$servicemid";
				$re2 = mysqli_query($conn, $eve2);
				while($rt2 = mysqli_fetch_assoc($re2))
				{
					 $noofservice=$rt2['cc'];
				}
				if($noofservice==0){
					$snoofseat1=$snoofseat-$noofservice;
					$cdate=$sstartdate;
	$startDate = new DateTime($sstartdate);
	$endDate = new DateTime($senddate);
	
	$difference = $endDate->diff($startDate);
	$days=$difference->format("%a");
	$daydiff=(int)$days / $snoofseat1;
	$daydiff=(int)$daydiff;
	
	
				$i=0;
				while ($i < $snoofseat1)
				{
					//$cout <<
					//$i << "\n";
					$i++;
					$cdate=date('Y-m-d', strtotime($cdate. ' + '.$daydiff.' days'));
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
					
				  $eve11 = "INSERT INTO res_complain_master (cmno,servicemid,cmdate,pmid,cmdetail,cstatus,cmstatusudate,customerid,samid,cmtype,cmnowithprefix,cmproblemtype,cmupdatedon,cmupdatedby,cmaddedby,cmaddedon,servicetype,cyear) VALUES($cmno1,'$servicemid','$cdate','$pmid','Regular AMC','Scheduled','$mdate2','$custid','$samid','$cmtype','$cmnowithprefix','Regular Service','$mdate1','$umid','$umid','$mdate1','Service','$cyear')";
				
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
				else{
					$snoofseat1=$snoofseat-$noofservice;
					 $eve3 = "select max(cmdate) as cc from res_complain_master where servicemid=$servicemid";
				$re3 = mysqli_query($conn, $eve3);
				while($rt3 = mysqli_fetch_assoc($re3))
				{
					  $newsstartdate=$rt3['cc'];
				}
					
					$cdate=$newsstartdate;
	$startDate = new DateTime($newsstartdate);
	$endDate = new DateTime($senddate);
	
	$difference = $endDate->diff($startDate);
	$days=$difference->format("%a");
	$daydiff=(int)$days / $snoofseat1;
	$daydiff=(int)$daydiff;
	
	
				$i=0;
				while ($i < $snoofseat1)
				{
					//$cout <<
					//$i << "\n";
					$i++;
					$cdate=date('Y-m-d', strtotime($cdate. ' + '.$daydiff.' days'));
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
					
				 $eve11 = "INSERT INTO res_complain_master (cmno,servicemid,cmdate,pmid,cmdetail,cstatus,cmstatusudate,customerid,samid,cmtype,cmnowithprefix,cmproblemtype,cmupdatedon,cmupdatedby,cmaddedby,cmaddedon,servicetype,cyear) VALUES($cmno1,'$servicemid','$cdate','$pmid','Regular AMC','Scheduled','$mdate2','$custid','$samid','$cmtype','$cmnowithprefix','Regular Service','$mdate1','$umid','$umid','$mdate1','Service','$cyear')";
				
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
				
	
		$_SESSION['msg'] = "Record has been updated successfully";	
	}
	else
	{
		$_SESSION['msg1'] = "Error";
	}
	header('Location: service.php');
?>