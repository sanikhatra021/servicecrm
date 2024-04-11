<?php
 	session_start();

	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
		return;
	}
	date_default_timezone_set("Asia/Kolkata");
	 $mdate1= date('Y-m-d');
	 
	//$brmid=$_SESSION['lacrmbrmid'];
	$umid = $_SESSION['umid'];


	include("connect.php");
	$samid=$_SESSION['samid'];
	$cmid=$_POST['cmid'];
	$fdate=implode('-', array_reverse(explode('-',$_POST['fdate'])));
 	//$fdate=$_POST['fdate'];
    $followup=$_POST['followup'];
    $remarks=$_POST['remarks'];
    $servicestatus=$_POST['servicestatus'];
	
	    $eve="select * from res_complain_master where cmid=$cmid";
		$re = mysqli_query($conn, $eve);
		while($rt = mysqli_fetch_assoc($re))
		{
			$customerid=$rt['customerid'];
			$cmid=$rt['cmid'];
			
		}
		$tt="";
		if($followup=="Yes")
		{
			$tt=",cmpcallreminder=1,cmpcallreminderdate='$fdate',cmpcallreminderremark='$remarks'";
		}
		
			 $eve2="update res_complain_master set cmadminstatus='Close' $tt where cmid='$cmid'";
			if ($conn->query($eve2) === TRUE)
		{
			
			$_SESSION['msg'] = "Record has been added successfully";
			
		}
		else
		{
			$_SESSION['msg1'] = "Error";
		}
	

	
	/*If($followup=="Yes")
	{
		     $eve1= "INSERT INTO res_complainreminder_master (customerid,complainid,rreminderdate,rremarks,addadon,addadby) VALUES ('$customerid','$cmid','$fdate','$remarks','$mdate1','$samid')";
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
		header("Location:complaindetail.php?id=$cmid");
	}*/
	
header("Location:complaindetail.php?id=$cmid");
	 
	

?>
