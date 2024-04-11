<?php
session_start(); 
/* ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL); */
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
	$cdate= date('Y-m-d');
	
	$samid=$_SESSION['samid'];
	$pmid=$_POST['pmid'];
	$umid=$_POST['umid'];
	
	$custsdate=date('Y-m-d', strtotime($_POST['custsdate']));
	$custedate=date('Y-m-d', strtotime($_POST['custedate']));
	$custremarks=$_POST['custremarks'];
	$amcserial=$_POST['amcserial'];
	$amcnoofseat=$_POST['amcnoofseat'];
	$customerid=$_POST['umid'];
	
	$cdate=$custsdate;
	$startDate = new DateTime($custsdate);
	$endDate = new DateTime($custedate);

	$difference = $endDate->diff($startDate);
	$days=$difference->format("%a");
	$daydiff=(int)$days / $amcnoofseat;
	$daydiff=(int)$daydiff;
	
	
	
	  $eve1 = "INSERT INTO res_amc_master 	(samid,pmid,custsdate,custedate,custremarks,amcserial,amcnoofseat,umid,amctype,custid) VALUES('$samid','$pmid','$custsdate','$custedate','$custremarks','$amcserial','$amcnoofseat','$umid','AMC','$customerid')";	
			if ($conn->query($eve1) === TRUE)
			{
				$last_id = $conn->insert_id;
				$i=0;
				while ($i < $amcnoofseat)
				{
					//$cout <<
					$i << "\n";
					$i++;
					$cdate=date('Y-m-d', strtotime($cdate. ' + '.$daydiff.' days'));
					
					$eve11 = "INSERT INTO res_complain_master (amcid,cmdate,pmid,cmdetail,cstatus,customerid,samid) VALUES('$last_id','$cdate','$pmid','Regular AMC','Scheduled','$customerid','$samid')";
				
					if ($conn->query($eve11) === TRUE)
					{
						
					}
					
					
				}
			}
			else
			{
				$_SESSION['msg1'] = "Error";
			}
			
	header("Location: customeramcdetail.php?id=$umid");
?>