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
	$cmtype=$_SESSION['servicecalltypedefault'];
	
	
	$customername=$_POST['customername'];
	$customersite=$_POST['customersite'];
	$customermobile=$_POST['customermobile'];
	$uemail=$_POST['uemail'];
	$customeraddress=$_POST['customeraddress'];
	$ucity=$_POST['ucity'];
	$managername=$_POST['managername'];
	$managermobile=$_POST['managermobile'];
	$inchargename=$_POST['inchargename'];
	$inchargemobile=$_POST['inchargemobile'];
	//$udefaultserviceengineer=$_POST['serviceengineerid'];
	$cmserviceengineerid=$_POST['serviceengineerid'];
	
	
	$cdate=$sstartdate;
	$startDate = new DateTime($sstartdate);
	$endDate = new DateTime($senddate);
	
	$difference = $endDate->diff($startDate);
	$days=$difference->format("%a");
	$daydiff=(int)$days / $snoofseat;
	$daydiff=(int)$daydiff;
	
	$snoofseat1=$snoofseat-1;
	
		if($custid=="New Customer")
		{	
			$eve12 = "INSERT INTO res_user_master (samid,uname,umobile,utype,emailid,uaddress,ucity,upriority,udefaultserviceengineer,usite,uprojectmanagername,uprojectmanagermobile,uprojectinchargename,uprojectinchargemobile) VALUES('$samid','$customername','$customermobile','customer','$uemail','$customeraddress','$ucity','Low','$cmserviceengineerid','$customersite','$managername','$managermobile','$inchargename','$inchargemobile')";	
			if ($conn->query($eve12) === TRUE)
			{
				$custid = $conn->insert_id;	
			}
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
	
			  $eve1 = "INSERT INTO res_service_master (samid,pmid,custid,sstartdate,senddate,sremarks,sserialno,servicetype,spurchasedate,snoofseat,sservicecharge,servicestatus,servicerenewalstatus,serviceno,seyear,senofordisplay,addedon,addedby) VALUES('$samid','$pmid','$custid','$sstartdate','$senddate','$sremarks','$sserialno','$servicetype','$pdate','$snoofseat','$sservicecharge','Active','Pending','$seno1','$seyear','$senofordisplay','$mdate1','$umid')";	
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
					$cmpmid1 = $conn->insert_id;
					$_SESSION['msg'] = "Record has been added successfully";
					$eve3 = "INSERT INTO res_complainallocation_detail (cmid,serviceengid,allocateddate,samid) VALUES($cmpmid1,$cmserviceengineerid,'$mdate',$samid)";
					if ($conn->query($eve3) === TRUE)
					{}
				}
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
					
				  $eve11 = "INSERT INTO res_complain_master (cmno,servicemid,cmdate,pmid,cmdetail,cstatus,cmstatusudate,customerid,samid,cmtype,cmnowithprefix,cmproblemtype,cmupdatedon,cmupdatedby,cmaddedby,cmaddedon,servicetype,cyear) VALUES($cmno1,'$last_id','$cdate','$pmid','Regular AMC','Scheduled','$mdate2','$custid','$samid','$cmtype','$cmnowithprefix','Regular Service','$mdate1','$umid','$umid','$mdate1','Service','$cyear')";
				
					if ($conn->query($eve11) === TRUE)
					{
							$cmid = $conn->insert_id;
						
					
						$eve3 = "INSERT INTO res_complainallocation_detail (cmid,serviceengid,allocateddate,samid) VALUES($cmid,$cmserviceengineerid,'$mdate',$samid)";
						if ($conn->query($eve3) === TRUE)
						{
							
						}
				
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