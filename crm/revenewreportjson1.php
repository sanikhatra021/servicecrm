<?php  
session_start(); 
	include("connect.php");	
	include("connectp.php");
	header("Access-Control-Allow-Origin: *");
    $samid=$_SESSION['samid'];
    $umid=$_SESSION['umid'];
	 
	date_default_timezone_set("Asia/Kolkata");
	$mdate1= date('Y-m-d H:i:s');
	$mdate= date('Y-m-d');
	
	$aa="";
	 $bb="";
	if(isset($_SESSION['cstatus']))
	{
		
		$cstatus = $_SESSION['cstatus'];
		$lower = $_SESSION['lowerdate'];
		$upper = $_SESSION['upperdate'];
		if($lower== '--' || $lower== '-- -' || $lower== '' ){
			$_SESSION['lowerdate']='';
			$_SESSION['upperdate']='';
			$aa='';
		}else{		
		$aa="and Date(res_complain_master.cmaddedon) between '$lower' and '$upper'";
		//$aa="";
		}
		
	
		if($_SESSION['cstatus']=="All")
		{
			$bb=" and res_complain_master.cstatus In ('Pending','In Process','Incomplete') ";
		  /*  $bb=" and res_complain_master.cstatus In ('Pending','In Process','Incomplete') ORDER BY 
    CASE 
        WHEN cstatus = 'Pending' THEN 1
        WHEN cstatus = 'In Process' THEN 2
        WHEN cstatus = 'Incomplete' THEN 3
        ELSE 4 -- This will handle any other status, if present, and place them at the end
    END;"; */
		}else if($_SESSION['cstatus']=="Unallocated"){
			
			$bb=" and res_complain_master.cstatus In ('Pending') and res_complain_master.cmid not in (select cmid from res_complainallocation_detail)";
		}else if($_SESSION['cstatus']=="Pending"){
			$bb=" and res_complain_master.cstatus In ('Pending') and res_complain_master.cmid in (select cmid from res_complainallocation_detail)";
		}
		else
		{
			$bb=" and res_complain_master.cstatus='$cstatus'";
	    }
	}
	if($_SESSION['cmtype'] == 'All')
	{
		$cc = "";
	}else
	{
		$cmtype = $_SESSION['cmtype'];
		$cc = "and res_complain_master.cmtype = '$cmtype'";
	}
	if($_SESSION['utype'] == 'serviceengineer')
	{
		$dd = "and res_complain_master.cmid in (select cmid from res_complainallocation_detail where serviceengid='$umid')";
	}else
	{
		
		$dd = "";
	}
	
			
		 // echo $eve= "select * from res_complain_master,res_user_master where res_complain_master.customerid=res_user_master.umid and res_user_master.samid=$samid $aa $bb $cc and res_user_master.utype='customer'   order by res_complain_master.cstatus desc,res_complain_master.cmupdatedon desc"; 
	$q = $db7->prepare("select * from res_complain_master,res_user_master where res_complain_master.customerid=res_user_master.umid and res_user_master.samid=$samid $aa $bb $cc $dd and res_user_master.utype='customer'  order by res_complain_master.cmid desc");
	
	
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
			
			 	$servicemid11=$rt['servicemid'];
				/*
				
				Code to take the service list starts
				
				*/
				
			 $serql = "select * from res_service_master where servicemid=$servicemid11";
				$serresult = mysqli_query($conn, $serql) or die("failed");
				$sservicecharge=0;
				$servicetype=0;
				while($sert = mysqli_fetch_assoc($serresult))
				{
				$servicemid=$sert['servicemid'];
			 	$servicestatus=$sert['servicestatus'];
				$sservicecharge=$sert['sservicecharge'];
				$servicetype=$sert['servicetype'];
				}
				
				/*
				
				Code to take the service list stop

				*/
				
				
			 	$cmid=$rt['cmid'];
				 $sql = "select * from res_complain_detail where cmid='$cmid' order by cdid desc limit 1";
				$result = mysqli_query($conn, $sql) or die("failed");
				$cdid=0;
				while($rt2 = mysqli_fetch_assoc($result))
				{
				
					 $cdid=$rt2['cdid'];
				}
				
				
				if($rt['cstatus']== 'Completed'){
					$uedit='';
				} else{
				
				$uedit="<a href='complainedit.php?id=".$rt['cmid']."' data-toggle='tooltip' data-placement='top' title='Edit' class='fa fa-edit fa-lg  hidden-print'>  </a>";
				}
			
				$udelete="<a href='complaindelete.php?id=".$rt['cmid']."' onclick='return confirm(&#39;Are you sure you want to delete ?&#39;);' data-toggle='tooltip' data-placement='top' title='Delete' class='fa fa-trash-o fa-lg  hidden-print'>  </a>";
				
				$cmpdf="<a href='generatepdf/invoicepdf.php?cmid=".$rt['cmid']."' data-toggle='tooltip' data-placement='top' title='PDF' class='fa fa-file-pdf-o  hidden-print' >  </a>";
				if($cdid != 0){ 
				$cmprint="<a href='complaindetailprint.php?id=".$cdid."&cmid=".$cmid."' data-toggle='tooltip' data-placement='top' title='Print' class='fa fa-print  hidden-print' >  </a>";
				}else{ $cmprint=''; }
				 
				
				$op=$uedit."&nbsp;&nbsp;".$cmpdf."&nbsp; &nbsp;".$cmprint;
				
				$cmdate=date("d-m-Y", strtotime($rt['cmdate']));
				$cmaddedon=date("d-m-Y h:i:sa", strtotime($rt['cmaddedon']));
				$cmupdatedon=date("d-m-Y h:i:sa", strtotime($rt['cmupdatedon']));
				$cmupdatedby=$rt['cmupdatedby'];
				
				$eve11 = "select * from res_user_master where umid=$cmupdatedby";
				$re11 = mysqli_query($conn, $eve11);
				$sename1="";
				while($rt11 = mysqli_fetch_assoc($re11))
				{
					$sename1=$rt11['uname'];
					
				}
				
				$cmdetail=$rt['cmdetail'];
				$cmphoto=$rt['cmphoto'];
				$cstatus=$rt['cstatus'];
				$cmproblemtype=$rt['cmproblemtype'];
				$cmtype=$rt['cmtype'];
				$cmmethod=$rt['cmmethod'];
				
				$cmno=$rt['cmno'];
				
				
				
				
				
				if($cstatus=="Pending")
				{
					
					$cstatus1="<span class='label label-sm label-warning'>Pending</span>";
				}
				else if($cstatus=="In Process")
				{
					
					/* $cstatus1="<a href='complainstatus.php?id=".$rt['cmid']."' ><span class='label label-sm label-danger'>In Process</span></a>"; */
					
					$cstatus1="<span class='label label-sm label-info'>In Process</span>";
				}
				/* else if($cstatus=="Completed")
				{
					
					$cstatus1="<span class='label label-sm label-success'>Completed</span>";
				}
				else if($cstatus=="Cancel")
				{
					
					$cstatus1="<a href='complainstatus.php?id=".$rt['cmid']."' ><span class='label label-sm label-danger'>Cancel</span></a>";
				} */
				else
				{
					$cstatus1="<span class='label label-sm label label-default'>$cstatus</span>";
				}
				$pmid=$rt['pmid'];
				$pmname="";
				$eve1 = "select * from res_product_master where pmid=$pmid";
				$re1 = mysqli_query($conn, $eve1);
				while($rt1 = mysqli_fetch_assoc($re1))
				{
					$pmname=$rt1['pmname'];
				}
				/* $ctmname="";
				$ctmid=$rt['ctmid'];
				$eve1 = "select * from res_complaintype_master where ctmid=$ctmid";
				$re1 = mysqli_query($conn, $eve1);
				while($rt1 = mysqli_fetch_assoc($re1))
				{
					$ctmname=$rt1['ctmname'];
				} */
				
				$customerid=$rt['customerid'];
				
				if(strlen($cmphoto)>3)
				{
					$cmphoto="<img src='images/$cmphoto' width='50px' height='50px'>";
				}
				else
				{
					$cmphoto="<img src='images/noimage.jpg' width='50px' height='50px'>";
				}
								$upriority="Low";

				//$customerid=$rt['customerid'];
				
					$uname=$rt['uname'];
					$umobile=$rt['umobile'];
					  $upriority=$rt['upriority'];
				
				 $cmno=$rt['cmnowithprefix'];
				 $cmcharge=$rt['cmservicecharge'];
				
				
				
					  $eve11 = "select uname from res_user_master where umid in(select serviceengid from res_complainallocation_detail where cmid=$cmid)";
					$re11 = mysqli_query($conn, $eve11);
					$staff="";
					
					if(mysqli_num_rows($re11) > 0)
					{
						$t1=1;
						while($rt11 = mysqli_fetch_assoc($re11))
						{
							
							if($t1==1)
							{
								 $staff = $staff.$rt11['uname'];
								$t1=0;
							}
							else
							{
								 $staff = $staff.", ".$rt11['uname'];
							}
						}
					}else{
						$staff="<span class='label label-sm label-danger' >Engineer not assigned</span>";
					}
				
				
				
											
											
				$posts[] = array('srno'=> $i++,'cmdate'=> $cmdate,'cstatus'=> $cstatus1,'pmname'=>$pmname,'staff'=> $staff,'uname'=> $uname,'cmno'=>$cmno,'cmcharge'=>$cmcharge,'cmproblemtype'=>$cmproblemtype,'cmtype'=>$cmtype,'umobile'=>$umobile,'servicetype'=>$servicetype,'sservicecharge'=>$sservicecharge);
		
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