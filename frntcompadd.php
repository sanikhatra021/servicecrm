<?php 
session_start();
include("connect.php");
$urin = explode('/', $_SERVER['REQUEST_URI']);
$uri1=$urin[1];
	
	$eve1 = "select * from res_superadmin_master where saurl='".$urin[1]."'";
	$re1 = mysqli_query($conn, $eve1);
	$saurl="";
	if(mysqli_num_rows($re1) > 0)
	{
		while($rt1 = mysqli_fetch_assoc($re1))
		{
			$samid=$rt1['samid'];
			$_SESSION['businessid']=$samid;
			$safullname=$rt1['safullname'];
			$_SESSION['cmpname']=$safullname;
			$saurl=$rt1['saurl'];
			$_SESSION['weburl']= $saurl;
			$_SESSION['saaddress']= $rt1['saaddress'];
			$_SESSION['saemailid']= $rt1['saemailid'];
			$_SESSION['samobile']= $rt1['sacarenumber'];
			$_SESSION['salogo'] = $rt1['salogo'];
		}
	}else{
		header('Location: index.php');
		
	}
		$samid=$_SESSION['businessid'];
	$customerid=$_SESSION['customerid'];
	$url=$_SESSION['weburl'];
	$cmobile=$_SESSION['cmobile'];
	include("getcomplainno.php");
	
	
	$cyear = getFinancialYear2($mdate);
	$evemaxq = "SELECT max(cmno) AS maxcmno FROM res_complain_master where cyear='$cyear' and  samid=$samid";
	$remaxq = mysqli_query($conn, $evemaxq);
	while($rtmaxq = mysqli_fetch_assoc($remaxq))
	{
		$cmno=$rtmaxq['maxcmno'];
	}
	$cmno1=$cmno+1;
	
$cmnowithprefix=generatecomplainno();
	$customerid=$_SESSION['customerid'];
	$par1=$_POST['problemname'];
	$par2=$_POST['ctmname'];
	$par3=$_POST['cmdetail'];
	$mdate2= date('Y-m-d');
	
	include("mylibrary.php");
	if(empty($_FILES['cmphoto']['name']) == false  )
	{
		$image1=checkvalidstring($_FILES['cmphoto']['name']);
		$ext = pathinfo($image1, PATHINFO_EXTENSION);
		$cmphoto = date("YmdHis").rand(1000,9999).'.'.$ext;
		$path = "/images";
		if($ext=='png' || $ext=='jpg' || $ext=='jpeg')
		 {
		move_uploaded_file( $_FILES['cmphoto']['tmp_name'], $path ."/". $cmphoto );

		$attach14 = "$cmphoto";
		}
	}
	
	// new complain adding start...
	$eve2 = "Insert Into res_complain_master (cmno,samid,customerid,cmdetail,cmphoto,cmdate,cstatus,cmupdatedby,cmnowithprefix,cmaddedby,cmproblemtype,cmtype,cyear) Values ('$cmno1','$samid','$customerid','$par3','$attach14','$mdate2','Pending','$samid','$cmnowithprefix','$samid','$par1','$par2','$ctype')";
	if ($conn->query($eve2) === TRUE){
		
	$_SESSION['msg'] = "Record has been added successfully";
	}else{
		$_SESSION['msg'] = "Error";
	}
		 header('Location: home.php');
?>