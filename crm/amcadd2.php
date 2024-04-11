<?php
session_start(); 
error_reporting(0);
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
	
	
	$pmid=$_POST['pmid'];
	$custid=$_POST['custid'];
	$servicetype=$_POST['servicetype'];
	$sdate=$_POST['sdate'];
	$edate=$_POST['edate'];
	$sstartdate=date('Y-m-d',strtotime($_POST['sdate']));
	$senddate=date('Y-m-d',strtotime($_POST['edate']));
	$pdate=date('Y-m-d',strtotime($_POST['pdate']));
	$sremarks=$_POST['custremarks'];
	$sserialno=$_POST['sserialno'];
	$noofservice=$_POST['noofservice'];
	
	
	$cdate=$sstartdate;
	$startDate = new DateTime($sstartdate);
	$endDate = new DateTime($senddate);
	
	$difference = $endDate->diff($startDate);
	$days=$difference->format("%a");
	$daydiff=(int)$days / $noofservice;
	$daydiff=(int)$daydiff;
	
    $cmno1=0;
	$evemaxq = "SELECT max(cmno) AS maxcmno FROM res_complain_master where samid=$samid";
	$remaxq = mysqli_query($conn, $evemaxq);
	while($rtmaxq = mysqli_fetch_assoc($remaxq))
	{
		$cmno=$rtmaxq['maxcmno'];
	}
	$cmno1=$cmno+1;
	
	        $eve1 = "INSERT INTO res_service_master (samid,pmid,custid,sstartdate,senddate,sremarks,sserialno,servicetype,spurchasedate,snoofservice) VALUES('$samid','$pmid','$custid','$sstartdate','$senddate','$sremarks','$sserialno','$servicetype','$pdate','$noofservice')";	
			if($conn->query($eve1) === TRUE)
			{
				$last_id = $conn->insert_id;
				$i=0;
				while ($i < $noofservice)
				{
					//$cout <<
					$i << "\n";
					$i++;
					$cdate=date('Y-m-d', strtotime($cdate. ' + '.$daydiff.' days'));
					
					 $eve11 = "INSERT INTO res_complain_master (cmno,amcid,cmdate,pmid,cmdetail,cstatus,customerid,samid) VALUES($cmno1,'$last_id','$cdate','$pmid','Regular AMC','Scheduled','$custid','$samid')";
				
					if ($conn->query($eve11) === TRUE)
					{
						$last_id = $conn->insert_id;
						$_SESSION['msg'] = "Record has been added successfully";
					}
				}
			}
			else
			{
				$_SESSION['msg1'] = "Error";
			}
			
	header('Location: amc.php');
?>