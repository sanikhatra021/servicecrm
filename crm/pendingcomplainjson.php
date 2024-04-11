<?php  
session_start(); 
	include("connect.php");	
	include("connectp.php");
	header("Access-Control-Allow-Origin: *");
    $samid=$_SESSION['samid'];
	 
	
	$mdate= date('Y/m/d');
	$aa="";
	if(isset($_SESSION['daterange']))
	{
		$p1 = $_SESSION['daterange'];
		
		$dd1 = substr($p1,0,2);
		$mm1 = substr($p1,3,2);
		$yy1 = substr($p1,6,4);

		$dd2 = substr($p1,13,2);
		$mm2 = substr($p1,16,2);
		$yy2 = substr($p1,19,4);
		
		$lower = "$yy1-$mm1-$dd1";
		$upper = "$yy2-$mm2-$dd2";
		
		$aa="and cmdate between '$lower' and '$upper'";
	
		

	}else {
		$lower = date('Y-m-d', strtotime($mdate)-1000);
		$upper = date('Y-m-d', strtotime($mdate));
		
		$aa="";
	}
	
	/* if($_SESSION['daterange']=''){
		$aa=''
	}else{
		$aa="and cmdate between '$lower' and '$upper'";
	}
	
	 */
	
	 //$bb="";
	/* if(isset($_SESSION['cstatus']))
	{
		if($_SESSION['cstatus']=="all")
		{
		   $bb=" and cstatus!='Scheduled'";
		}
		else
		{
			$cstatus = $_SESSION['cstatus'];
			$bb=" and cstatus='$cstatus'";
	    }
	} */
	
	
			
		 /* echo $eve= "select * from res_complain_master where  samid=$samid and  $bb  $aa and customerid in(select umid from res_user_master) order by cmid desc"; */
		
		//$q = $db7->prepare("select * from res_complain_master where samid=$samid $aa and customerid in(select umid from res_user_master) and cstatus='Pending' ");
		$q = $db7->prepare("select * from res_complain_master,res_user_master where res_complain_master.customerid=res_user_master.umid and res_user_master.samid=$samid and res_complain_master.cmserviceengineerid!=0 and res_complain_master.cstatus='pending' and res_user_master.utype='customer' ");
	
	
	$q->execute();
	
	
	$response = array();
	$posts = array();
	
	$result="0";
	
	if ($q->rowCount() > 0)
	{
		$i=1;
		while($i<=$q->rowCount())
		{
			$rt1 = $q->fetch(PDO::FETCH_ASSOC);
			
			 	$pmid=$rt1['pmid'];
														$cmtype=$rt1['cmtype'];
														$eve11 = "select * from res_product_master where pmid=$pmid";
														$re11 = mysqli_query($conn, $eve11);
														while($rt11 = mysqli_fetch_assoc($re11))
														{
															$pmname=$rt11['pmname'];
														}
														
														$ctmid=$rt1['ctmid'];
														$eve118 = "select * from res_complaintype_master where ctmid=$ctmid";
														$re118 = mysqli_query($conn, $eve118);
														while($rt118 = mysqli_fetch_assoc($re118))
														{
															$ctmname=$rt118['ctmname'];
														}
														$cstatus=$rt1['cstatus'];
														if($cstatus=="Pending")
														{
															$cstatus1="<span class='label label-sm label-success'>Pending</span>";
														}
														else if ($cstatus=="In Process")
														{
															$cstatus1="<span class='label label-sm label-danger'>In Process</span>";
														}
														else if($cstatus=="Completed")
														{
															$cstatus1="<span class='label label-sm label-warning'>Completed</span>";
														}
														else
														{
															$cstatus1="<span class='label label-sm label-danger'>Cancel</span>";
														}
														
														$cmdate=implode('-', array_reverse(explode('-',$rt1['cmdate'])));
														
														$customerid=$rt1['customerid'];
														
															$uname=$rt1['uname'];
															$cmserviceengineerid=$rt1['cmserviceengineerid'];
														
														
														
														$cmid=$rt1['cmid'];
														$eve113 = "select * from res_user_master where umid=$cmserviceengineerid";
														$re113 = mysqli_query($conn, $eve113);
														if(mysqli_num_rows($re113) > 0)
														{
															
																while($rt113 = mysqli_fetch_assoc($re113))
															{
																$staff=$rt113['uname'];
															}
															
														}
														else
														{
															$staff="<button data-toggle='modal' data-target='#view-modal' data-id='$cmid' id='getUser' class='btn btn-xs btn-warning'>Select Service Engineer</button>";
														}
		
				
				$posts[] = array('srno'=> $i++,'cname'=> $uname,'ctype'=> $cmtype,'pmname'=>$pmname,'cstatus'=> $cstatus1,'cmdate'=> $cmdate,'staff'=> $staff);
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