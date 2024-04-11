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
			$aa='';
			$_SESSION['lowerdate']='';
			$_SESSION['upperdate']='';
		}else{		
		$aa="and Date(res_complain_master.cmaddedon) between '$lower' and '$upper'";
		//$aa="";
		}
		
	
		if($_SESSION['cstatus']=="Completed")
		{
		   $bb=" and res_complain_master.cstatus In ('Completed') ";
		}else if($_SESSION['cstatus']=="Cancel"){
			
			$bb=" and res_complain_master.cstatus In ('Cancel')";
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
		$dd = "and res_complain_master.cmserviceengineerid='$umid'";
	}else
	{
		
		$dd = "";
	}
	
	
			
		  //echo $eve= "select * from res_complain_master,res_user_master where res_complain_master.customerid=res_user_master.umid and res_user_master.samid=$samid $aa $bb  and res_user_master.utype='customer' order by res_complain_master.cstatus desc,res_complain_master.cmupdatedon desc"; 
		$q = $db7->prepare("select * from res_complain_master,res_user_master where res_complain_master.customerid=res_user_master.umid and res_user_master.samid=$samid $aa $bb $cc $dd and res_user_master.utype='customer'  order by res_complain_master.cstatus desc,res_complain_master.cmupdatedon desc");
	
	
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
				
				$uedit="<a href='complainedit.php?id=".$rt['cmid']."' data-toggle='tooltip' data-placement='top' title='Edit' style='color:blue;' class='fa fa-edit fa-lg  hidden-print'>  </a>";
				}
			
				//$udelete="<a href='complaindelete.php?id=".$rt['cmid']."' onclick='return confirm(&#39;Are you sure you want to delete ?&#39;);' data-toggle='tooltip' data-placement='top' title='Delete'  style='color:red;'  class='fa fa-trash-o fa-lg  hidden-print'>  </a>";
				
				$cmpdf="<a href='generatepdf/invoicepdf.php?cmid=".$rt['cmid']."' data-toggle='tooltip' data-placement='top' title='PDF'  style='color:Teal;' class='fa fa-file-pdf-o  hidden-print' >  </a>";
				 if($cdid != 0){ 
				$cmprint="<a href='complaindetailprint.php?id=".$cdid."&cmid=".$cmid."' data-toggle='tooltip' data-placement='top' title='Print'   style='color:DeepSkyBlue;' class='fa fa-print  hidden-print' >  </a>";
				}else{ $cmprint=''; }
				/* $view="<a href='complaindetail.php?id=".$rt['cmid']."' data-toggle='tooltip' data-placement='top' title='View' style='color:Green;' class='fa fa-eye fa-lg' >  </a>";   */
				
				//$cmpallocate="<a href='complaindetail.php?id=".$rt['cmid']."' title='Click Here' class='fa fa-eye' > </a>";
				
			/* 	$duplicate="<a href='customeradd.php?id=".$rt['customermid']."' data-toggle='tooltip' data-placement='top' title='Duplicate' class='fa fa-clone' >  </a>";
			 */	
				$op=$uedit."&nbsp;&nbsp;&nbsp; ".$cmpdf."&nbsp; &nbsp;".$cmprint;
				//$op=$uedit."&nbsp;&nbsp;&nbsp; ".$udelete;

				//$cmdate=implode('-', array_reverse(explode('-', $rt['cmdate'])));
				$cmdate=date("d-m-Y", strtotime($rt['cmdate']));
				//$cmupdatedon=implode('-', explode('-', $rt['cmupdatedon']));
				$cmaddedon=date("d-m-Y h:i:sa", strtotime($rt['cmaddedon']));
				$cmupdatedon=date("d-m-Y h:i:sa", strtotime($rt['cmupdatedon']));
				$cmupdatedby=$rt['cmupdatedby'];
				
				$eve11 = "select * from res_user_master where umid=$cmupdatedby";
				$re11 = mysqli_query($conn, $eve11);
				$sename1="";
				$umobile="";
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
				$servicemid=$rt['servicemid'];
				$cmno=$rt['cmno'];
				
				$servicecontract="No Contract";
				$eve = "select * from res_service_master where servicestatus='Active' and servicemid=$servicemid";
				$re = mysqli_query($conn, $eve);
				$amcid1='';
				
				if(mysqli_num_rows($re) > 0)
				{
					while($rt22 = mysqli_fetch_assoc($re))
					{
						
						   $serviceno=$rt22['senofordisplay'];
						   $servicetype=$rt22['servicetype'];
						    $servicestatus=$rt22['servicestatus'];
						    $servicecontract='#'.$serviceno.'('.$servicetype.'-'.$servicestatus.')';
						   	$servicecontract="<a href='servicedetail.php?id=$serviceno' data-toggle='tooltip' data-placement='top' title='eye'   hidden-print' > $servicecontract <span class='fa fa-eye'  style='color:green;'></span></a>";

					}
				}
				
				$cmserviceengineerid=$rt['cmserviceengineerid'];
				
				
				  if($cstatus=="Completed")
				{
					
					$cstatus1="<span class='label label-sm label-success'>Completed</span>";
				}
				else if($cstatus=="Cancel")
				{
					
					$cstatus1="<a href='complainstatus.php?id=".$rt['cmid']."' ><span class='label label-sm label-danger'>Cancel</span></a>";
				} 
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
				
				 
				if($upriority=="High")
				{
					
					$cmno="<span class='label label-sm label-danger'>$rt[cmnowithprefix]</span>";
				     $cmnonew="<a href='complaindetail.php?id=".$rt['cmid']."&page=ComComplain' title='Click Here' class=' hidden-print'> $cmno</a>";
				}
				else if($upriority=="Medium")
				{
					$cmno="<span class='label label-sm label-warning'>$rt[cmnowithprefix]</span>";
					$cmnonew="<a href='complaindetail.php?id=".$rt['cmid']."&page=ComComplain' title='Click Here' class=' hidden-print'> $cmno</a>";
				}
				else if($upriority=="Low")
				{
					$cmno="<span class='label label-sm label-success'>$rt[cmnowithprefix]</span>";
					$cmnonew="<a href='complaindetail.php?id=".$rt['cmid']."&page=ComComplain' title='Click Here' class=' hidden-print'>$cmno </a>";
				}
				else
				{
					$cmno="<span class='label label-sm label-danger'>$rt[cmnowithprefix]</span>";
					$cmnonew="<a href='complaindetail.php?id=".$rt['cmid']."&page=ComComplain' title='Click Here' class=' hidden-print'>$cmno </a>";
					
				}
				
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
						$staff="<button data-toggle='modal' data-target='#view-modal' data-id='$cmid' id='getUser' class='btn btn-xs btn-danger' >Select Engineer 	<span class='fa fa-pencil'></span></button>";
					}
				
				$posts[] = array('srno'=> $i++,'cmdetail'=> $cmdetail,'servicecontract'=> $servicecontract,'cmphoto'=> $cmphoto,'cmdate'=> $cmdate,'cstatus'=> $cstatus1,'pmname'=>$pmname,'staff'=> $staff,'uname'=> $uname,'sename1'=> $sename1,'cmid'=> $cmid,'cmno'=>$cmnonew,'cmproblemtype'=>$cmproblemtype,'cmtype'=>$cmtype,'cmmethod'=>$cmmethod,'op'=> $op,'umobile'=>$umobile);
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