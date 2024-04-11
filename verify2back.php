<?php  
session_start(); 
	include("connectp.php");
	include("connect.php");
	$url=$_SESSION['weburl'];
	
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('y-m-d H:i:s');
	$mdate1= date('Y-m-d');
	
	$par1 = $_SESSION['cmobile'];

	
	$uforgototp = $_POST['uforgototp'];
	
	$eve = "select * from res_user_master where uforgototp=$uforgototp and umobile='$par1'";
	$re = mysqli_query($conn, $eve);
	
	  if(mysqli_num_rows($re) > 0)
	  {
			while($rt = mysqli_fetch_assoc($re))
			{
				$customerid=$rt['umid'];
				$evenewpass = "update res_user_master set uforgototpverify='1' where uforgototp=$uforgototp and (umobile='$par1' or emailid='$par1')";
				$renewpass = mysqli_query($conn, $evenewpass);
			}
			
			
			
			$samid=$_SESSION['samidcurrent'];
			$pmid=$_SESSION['pmidnew'];
			$ctmname=$_SESSION['ctmname'];
			$problemname=$_SESSION['problemname'];
			/* $customerid=$_SESSION['customerid']; */
			$cmdetail=$_SESSION['cmdetail'];
			$cmupdatedby=$_SESSION['customerid']; 
			$cmdate=$_SESSION['mdate'];
			$cmupdatedon=$_SESSION['mdate'];
			
		      $eve11 = "select udefaultserviceengineer from res_user_master where umid=$customerid and utype='customer'";
			$re11 = mysqli_query($conn, $eve11);
			$cmserviceengineerid=0;
			while($rt11 = mysqli_fetch_assoc($re11))
			{
				$cmserviceengineerid=$rt11['udefaultserviceengineer'];
			}
					
					
				$cmno1=0;
				$evemaxq = "SELECT max(cmno) AS maxcmno FROM res_complain_master where samid=$samid";
				$remaxq = mysqli_query($conn, $evemaxq);
				while($rtmaxq = mysqli_fetch_assoc($remaxq))
				{
					$cmno=$rtmaxq['maxcmno'];
				}
				$cmno1=$cmno+1;
				$saprefix=date("ymd");
				$cmnowithprefix=$saprefix.$cmno1;
				
				$cmphoto1="";
				 if(empty($_FILES['cmphoto']['name']) == false  )
				{
					$simplephoto11=$_FILES['cmphoto']['name'];
					$ext = pathinfo($simplephoto11, PATHINFO_EXTENSION);
					$fileexplode1 = explode(".",$simplephoto11);
					$fileend1 = end($fileexplode1);

					$cmphoto1= date("YmdHis").rand(100,999).".".$fileend1;
					$path = "./businesspanel/images";
					if($ext=='png' || $ext=='jpg' || $ext=='jpeg' || $ext=='gif' || $ext=='PNG' || $ext=='JPG' || $ext=='JPEG' || $ext=='GIF')
					{
					  move_uploaded_file( $_FILES['cmphoto']['tmp_name'], $path ."/". $cmphoto1);
					  $flag=1;
					}
					else 
					{
					  $_SESSION['cmsg1'] = "Only Upload Image";
					 header("Location: $url");
					  return;
					  $flag=0;
					}
				}

				        $eve1 = "INSERT INTO res_complain_master (cmno,samid,pmid,customerid,cmdetail,cmphoto,cmdate,cstatus,cmstatusudate,cmupdatedon,cmupdatedby,cmnowithprefix,cmserviceengineerid,cmaddedby,cmaddedon,cmproblemtype,cmtype,cmmethod) VALUES($cmno1,'$samid','$pmid','$customerid','$cmdetail','$cmphoto1','$cmdate','Pending','$mdate','$mdate1','$cmupdatedby','$cmnowithprefix','$cmserviceengineerid','$customerid','$mdate1','$problemname','$ctmname','Online')";	
					if ($conn->query($eve1) === TRUE)
					{
						$last_id = $conn->insert_id;
						/* 
						if($cmupdatedby!="0")
						{
							$eve2 = "INSERT INTO res_complain_detail (serviceengineerid,cmid,cdaddedon,cdupdatedon) VALUES($cmupdatedby,$last_id,'$mdate','$mdate')";
							if ($conn->query($eve2) === TRUE)
							{
							}
							
						} */
						$_SESSION['cmsg'] = "Record has been added successfully";
					}
					else
					{
						$_SESSION['cmsg1'] = "Error";
					}
			
			
			$result="1";
			$_SESSION['ssetnewmsg']= "OTP verification successfull";
			header("Location: $url");
		}
	   else
	   {
			$result="0";
			$_SESSION['sfotpmsg1']= "Invalid OTP";
			header("Location: verify.php");
	   }

?>