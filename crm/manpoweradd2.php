<?php
session_start(); 
	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
		return;
	}
$samid=$_SESSION['samid'];
	include("connect.php");
	include("connectp.php");
	include("removespecial.php");
	
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('Y-m-d H:i:s');
	$mdate1= date('Y-m-d');
	
	/* if($_SESSION['utype']!='admin')
	{
		header('Location: index.php');
		return;
	} */
	
	if($_SERVER['REQUEST_METHOD'] === 'POST')
	{
		if(!isset($_POST['_token']) || ($_POST['_token']!==$_SESSION['_token'] ) )
		{
			header('Location: index.php');
			return;
		}
	}
	else
	{
		header('Location: index.php');
		return;
	}
	$_SESSION['_token']=bin2hex(openssl_random_pseudo_bytes(16));
	
   
	$imid=$_POST['imid'];
	$umid=$_SESSION['umid'];
	$expenseremark=removespecialchar($_POST['expenseremark']);
	$expensetotalamount=$_POST['expenseamount'];
	$serviceengname=$_POST['serviceengname'];
	
	$expensedate=date("Y-m-d",strtotime($_POST['expensedate']));
	
	
	
	
	
	
	$sql = "INSERT INTO res_manpowerexpense_detail(workordermid,manpowerremark,manpoweramount,manpowerdate,samid,serviceengname) VALUES (?,?,?,?,?,?)";
	$stmt= $db7->prepare($sql);
	if($stmt->execute([$imid,$expenseremark,$expensetotalamount,$expensedate,$samid,$serviceengname]))
	{
		
		
		
		
		$_SESSION['msg'] = "Record saved successfully";
	}
	else
	{
		$_SESSION['msg1'] = "Error";
	}
	
	header("Location: workorderdetail.php?id=$imid");
	
	mysqli_close($conn);	
?>