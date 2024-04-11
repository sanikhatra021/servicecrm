<?php
session_start(); 

	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
		return;
	}
	
	include("connect.php");
	
	date_default_timezone_set("Asia/Kolkata");
	$mdate1= date('Y-m-d H:i:s');
	$mdate2= date('d-m-Y');
	
	//$samid=$_SESSION['samid'];
	$cpmname=trim($_POST['cpmname']);
	$cpmcontacto=trim($_POST['cpmcontacto']);
	$cpmaddress=$_POST['cpmaddress'];
	$cpmwhatsappno=$_POST['cpmwhatsappno'];
	$cpmemail=$_POST['cpmemail'];
	$cpmcontactpname=$_POST['cpmcontactpname'];
	$cpmwebsitedetails=$_POST['cpmwebsitedetails'];

		
		$eve = "select cpmname from res_company_master where samid=$samid and cpmname='$cpmname'";
		$re = mysqli_query($conn, $eve);
		if(mysqli_num_rows($re) > 0)
		{
			$_SESSION['msg1'] = "Product Name already used.";
			header('Location: product.php');
		}
		else
		{	
			if($cpmname!='')
			{
			echo	$eve1 = "INSERT INTO res_company_master (cpmname,cpmcontacto,cpmaddress,cpmwhatsappno,cpmemail,cpmcontactpname,cpmwebsitedetails) VALUES('$cpmname','$cpmcontacto','$cpmaddress','$cpmwhatsappno','$cpmemail','$cpmcontactpname','$cpmwebsitedetails')";	
			if ($conn->query($eve1) === TRUE)
			{
				$last_id = $conn->insert_id;
				$_SESSION['msg'] = "Record has been added successfully";
			}
			else
			{
				$_SESSION['msg1'] = "Error";
			}
			}
			else
			{
				$_SESSION['msg1'] = "Please Input Product Name";
			}
		}
	
	
	//header('Location: company.php');
?>