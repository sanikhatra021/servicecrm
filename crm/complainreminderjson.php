<?php  
session_start(); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	include("connect.php");	
	include("connectp.php");
	header("Access-Control-Allow-Origin: *");
    $samid=$_SESSION['samid'];
	 
	if(isset($_SESSION['date1']))
	{
		$lower = $_SESSION['date1'];
		$upper = $_SESSION['date2'];
	} 
	 
	//  $eve= "select * from res_complainreminder_master where addadby=$samid order by rreminderdate desc";
		$q = $db7->prepare("select * from res_complainreminder_master where addadby=$samid and rreminderdate between '$lower' and '$upper' order by rreminderdate desc");
	
	
	$q->execute();
	
	
	$response = array();
	$posts = array();
	
	$result="0";
	
	if ($q->rowCount() > 0)
	{
		$i=1;
		while($i<=$q->rowCount())
		{
			$rt = $q->fetch(PDO::FETCH_ASSOC);
			
			 	$crmid=$rt['crmid'];
				
				$addadon= date("d-m-Y", strtotime($rt['addadon']) );
				$rreminderdate= date("d-m-Y", strtotime($rt['rreminderdate']) );

				
				$customerid=$rt['customerid'];
				$complainid=$rt['complainid'];
				$rremarks=$rt['rremarks'];
				$addadby=$rt['addadby'];
				
				
				$pmid=0;
				$cmid=0;
				$cmno=0;
				$cmproblemtype='';
				$cmtype='';
				$cmdate='';
				  $eve11 = "select * from res_complain_master where cmid=$complainid";
				$re11 = mysqli_query($conn, $eve11) or die("failed1");
				while($rt11 = mysqli_fetch_assoc($re11))
				{
					$cmid=$rt11['cmid'];
					$cmphoto=$rt11['cmphoto'];
					$cmproblemtype=$rt11['cmproblemtype'];
					$cmtype=$rt11['cmtype'];
					$cmno=$rt11['cmno'];
					$cmserviceengineerid=$rt11['cmserviceengineerid'];
				 	$pmid=$rt11['pmid'];
					$cmupdatedby=$rt11['cmupdatedby'];
					
					
					$cmdate= date("d-m-Y", strtotime($rt11['cmdate']) );
				$cmupdatedon= date("d-m-Y", strtotime($rt11['cmupdatedon']) );
					
				}
				
				  $eve11 = "select * from res_user_master where umid=$customerid";
				$re11 = mysqli_query($conn, $eve11);
				$sename12="";
				while($rt11 = mysqli_fetch_assoc($re11))
				{
					$sename12=$rt11['uname'];
				}
				
				
				
				$pmname="";
			 	   $eve1 = "select * from res_product_master where pmid=$pmid";
				$re1 = mysqli_query($conn, $eve1);
				while($rt1 = mysqli_fetch_assoc($re1))
				{
					$pmname=$rt1['pmname'];
				} 
				
				
				
				$posts[] = array('srno'=> $i++,'cmdate'=> $cmdate,'pmname'=> $pmname,'sename12'=> $sename12,'cmid'=> $cmid,'cmno'=>$cmno,'cmproblemtype'=>$cmproblemtype,'rreminderdate'=>$rreminderdate,'rremarks'=>$rremarks,'cmtype'=>$cmtype);
		}
		 
		$response['posts'] = $posts;
		echo stripslashes(json_encode( array('data' => $posts)));
		//mysqli_close($conn);
		//return;
	}
	
   else
	{
		$result="0";
		$msg="Invalid Error";
		
		$posts[] = array('p1'=> $result,'p2'=> $msg);
	
		$response['posts'] = $posts;
		echo stripslashes(json_encode( array('item' => $posts)));
	}
   
	mysqli_close($conn);	
?>