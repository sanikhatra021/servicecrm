<?php
session_start(); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("connect.php");
include("./businesspanel/getcomplainno.php");
	if(!isset($_SESSION['businessid']))
	{
		header('Location: index.php');
	}
	date_default_timezone_set("Asia/Kolkata");
	$mdate1= date('Y-m-d H:i:s');
	$mdate= date('d-m-Y');
	$mdate2= date('Y-m-d');
	
	
	$cmobile=$_SESSION['cmobile'];				
    $samid=$_SESSION['businessid'];
	$_SESSION['samid']=$samid;
	$umid=$_POST['umid'];
	
	//$addmobile=$_POST['cmobile'];
	$cname=$_POST['cname'];
	$emailid=$_POST['emailid'];
	$caddress=$_POST['caddress'];
	$password=$_POST['password'];
	$ccity=$_POST['ccity'];
	
	    $eve22 = "select * from res_user_master where utype='customer' and umobile='$cmobile' and samid=$samid";
		$re22 = mysqli_query($conn, $eve22);
		if(mysqli_num_rows($re22) >0 )
		{ 
		 while($rt22 = mysqli_fetch_assoc($re22))
				{
					  $customerid = $rt22['umid'];
					  $_SESSION['customerid'] = $rt22['umid'];
				}
			 $evenewpass33 = "update res_user_master set uname='$cname',emailid='$emailid',uaddress='$caddress',ucity='$ccity',upassword='$password' where utype='customer' and umobile='$cmobile' and samid='$samid'";
			 $re33 = mysqli_query($conn, $evenewpass33);
			 $_SESSION['sminderweb'] = "yes";
			 
			
       }
		else
	   {
		   
		     $evenewpass1 = "insert into res_user_master (umobile,samid,uname,emailid,uaddress,ucity,utype,upassword)values('$cmobile','$samid','$cname','$emailid','$caddress','$ccity','customer','$password')";
		   if ($conn->query($evenewpass1) === TRUE)
			{
				$last_id = $conn->insert_id;
				$_SESSION['customerid']=$last_id;
				$_SESSION['cmsg'] = "Record has been added successfully";
				$_SESSION['sminderweb'] = "yes";
				
			}
			else
			{
				$_SESSION['cmsg1'] = "Try Another Number";
			   header("Location: singup.php");	
			}
		   
	   }
		   
	
	
		
               
					
					
						
						if(isset($_SESSION['problemname']))
						{
							//FOR INSERT COMPLAIN
						$pmid=$_SESSION['pmidnew'];
						//$ctmname=$_SESSION['ctmname'];
						$problemname=$_SESSION['problemname'];
						$customerid=$_SESSION['customerid'];
						$_SESSION['umid']=$customerid;						
						$cmdetail=$_SESSION['cmdetail'];
						$cmupdatedby=$_SESSION['customerid']; 
						$cmdate=$_SESSION['mdate'];
						$cmupdatedon=$_SESSION['mdate'];
							
						//for service change				
						$ptmrate=0;
						$evemaxq1= "SELECT ptmrate FROM res_problemtype_master where ptmname='$problemname'";
						$remaxq1 = mysqli_query($conn, $evemaxq1);
						while($rtmaxq1 = mysqli_fetch_assoc($remaxq1))
						{
							$ptmrate=$rtmaxq1['ptmrate'];
						}
							
								$eve11 = "select udefaultserviceengineer from res_user_master where umid=$customerid and utype='customer'";
								$re11 = mysqli_query($conn, $eve11);
								$cmserviceengineerid=0;
								while($rt11 = mysqli_fetch_assoc($re11))
								{
									$cmserviceengineerid=$rt11['udefaultserviceengineer'];
								}
								
								
								$cmno1=0;
								$cyear = getFinancialYear2($mdate2);
								$evemaxq = "SELECT max(cmno) AS maxcmno FROM res_complain_master where cyear='$cyear' and  samid=$samid";
								$remaxq = mysqli_query($conn, $evemaxq);
								while($rtmaxq = mysqli_fetch_assoc($remaxq))
								{
									$cmno=$rtmaxq['maxcmno'];
								}
								
							 $cmno1=$cmno+1;
							 $cmnowithprefix=generatecomplainno();
							$cmphoto1=$_SESSION['cmpimage'];
							$_SESSION['cmnowithprefix']=$cmnowithprefix;
						 	
								
								 $eve1 = "INSERT INTO res_complain_master (cmno,samid,pmid,customerid,cmdetail,cmdate,cstatus,cmstatusudate,cmupdatedon,cmupdatedby,cmnowithprefix,cmserviceengineerid,cmaddedby,cmaddedon,cmproblemtype,cmtype,cmmethod,cmphoto,cmservicecharge,servicetype,cyear) VALUES($cmno1,'$samid','$pmid','$customerid','$cmdetail','$cmdate','Pending','$mdate','$mdate1','$cmupdatedby','$cmnowithprefix','$cmserviceengineerid','$customerid','$mdate1','$problemname','Chargeable','Online','$cmphoto1','$ptmrate','Complain','$cyear')";
                                   $re = mysqli_query($conn, $eve1);	
								$_SESSION['msg'] = "Record has been updated successfully";	
								header("Location: ticketnumber.php");
								
								
								
						}
						else
						{
							
							header("Location: myaccount.php");
						}
									
					
						
												
						
   	
	
	
?>