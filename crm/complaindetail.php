<?php
session_start(); 
   
	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
	}
	$samid=$_SESSION['samid'];
		$_SESSION['_token']=bin2hex(openssl_random_pseudo_bytes(16));
	include("connect.php");
	$conn->query("set names utf8");

	$mdate= date('d-m-Y');
	$mdate11= date('Y-m-d');
	
	
	$cdid=(int)mysqli_real_escape_string($conn,$_GET['id']);

	$cidid=(int)mysqli_real_escape_string($conn,$_GET['id']);
	$pumdid=(int)mysqli_real_escape_string($conn,$_GET['id']);
	$cmid=(int)mysqli_real_escape_string($conn,$_GET['id']);
	$page = $_GET['page'];
	$_SESSION['page'] = $page;
	$_SESSION['cmid']=$cmid;
	$_SESSION['pumdid']=$pumdid;
	$_SESSION['pdfgeneratecomplain']=1;
	
	$cstatus1="";
	$eve = "select * from res_complain_master where cmid=$cmid";
	$re = mysqli_query($conn, $eve);
	if(mysqli_num_rows($re) > 0)
	{
		while($rt = mysqli_fetch_assoc($re))
		{
				$cmdate=implode('-', array_reverse(explode('-', $rt['cmdate'])));
				$cmstatusudate=implode('-', array_reverse(explode('-', $rt['cmstatusudate'])));
				$cmdetail=$rt['cmdetail'];
				$cmphoto=$rt['cmphoto'];
				$cmsolution=$rt['cmsolution'];
				$cstatus=$rt['cstatus'];
				$cmservicecharge=$rt['cmservicecharge'];
				$cmupdatedon=date("d-m-Y H:i:s",strtotime($rt['cmupdatedon']));
				$cmupdatedby=$rt['cmupdatedby'];
				$cmpproductdetail=$rt['cmpproductdetail'];
			
				
				$cmproblemtype=$rt['cmproblemtype'];
				$cmadminstatus=$rt['cmadminstatus'];
				$cmpcallreminder=$rt['cmpcallreminder'];
				$cmpcallreminderdate=$rt['cmpcallreminderdate'];
				$cmpcallremindername="No";
				if($cmpcallreminder==1){
					$cmpcallremindername="Yes($cmpcallreminderdate)";
				}
				$cmadminstatusnew="<button data-toggle='modal' data-target='#view-modal5' data-id='$cmid' id='getUser5' class='btn btn-xs btn-success'>$cmpcallremindername <i class='fa fa-pencil'></i></button>";
				
				 $eve11 = "select * from res_user_master where umid in(select serviceengid from res_complainallocation_detail where cmid=$cmid)";
				$re11 = mysqli_query($conn, $eve11);
				$t1=1;
				$sename1="";
				$cmserviceengineerid=0;
				if(mysqli_num_rows($re11) > 0)
				{
					while($rt11 = mysqli_fetch_assoc($re11))
					{
						//$sename1=$rt11['uname'];
						$cmserviceengineerid=$rt11['umid'];
						if($t1==1)
								{
									$sename1 = $sename1.$rt11['uname'];
									$t1=0;
								}
								else
								{
									$sename1 = $sename1.", ".$rt11['uname'];
								}
					}
					$seedit="<span class='label label-sm label-success'>$sename1 </span>";
				}
				else
				{
					$sename1="Select Service Engineer";
				$seedit="<a data-toggle='modal' data-placement='top' title='Edit' class='' href='#responsive1'>
				<span class='label label-sm label-success'>$sename1 <i class='fa fa-edit fa-lg'></i></span></a>";
				}
if($_SESSION['utype']=='serviceengineer'){
	
	$seedit="<span class='label label-sm label-success'>$sename1 </span>";
	
}
	
				
				if($cstatus=="Pending")
				{
					$cstatus1="<button data-toggle='modal' data-target='#view-modal' data-id='$cmid' id='getUser' class='btn btn-xs btn-success'>Pending</i></button>";
				}
				else if($cstatus=="In Process")
				{
					$cstatus1="<button data-toggle='modal' data-target='#view-modal' data-id='$cmid' id='getUser' class='btn btn-xs btn-warning'>In Process</button>";
				}
				else if($cstatus=="Completed")
				{
					$cstatus1="<button data-toggle='modal'  data-id='$cmid' id='getUser' class='btn btn-xs btn-danger'>Completed</button>";
				}
				else if($cstatus=="Cancel")
				{
					$cstatus1="<button data-toggle='modal' data-target='#view-modal' data-id='$cmid' id='getUser' class='btn btn-xs btn-clear'>Cancel</button>";
				}
				else if($cstatus=="Scheduled")
				{
					$cstatus1="<button data-toggle='modal' data-target='#view-modal' data-id='$cmid' id='getUser' class='btn btn-xs btn-warning'>Scheduled</button>";
				}
				if($_SESSION['utype']=='serviceengineer'){
	
	if($cstatus=="Pending")
				{
					$cstatus1="<span class='label label-sm label-success'>Pending</span>";
				}
				else if($cstatus=="In Process")
				{
					$cstatus1="<span class='label label-sm label-warning'>In Process</span>";
				}
				else if($cstatus=="Completed")
				{
					$cstatus1="<span class='label label-sm label-danger'>Completed </span>";
				}
				else if($cstatus=="Cancel")
				{
					$cstatus1="<span class='label label-sm label-clear'>Cancel </span>";
				}
	
}
				$pmid=$rt['pmid'];
				$eve1 = "select * from res_product_master where pmid=$pmid";
				$re1 = mysqli_query($conn, $eve1);
				$pmname="";
				while($rt1 = mysqli_fetch_assoc($re1))
				{
					$pmname=$rt1['pmname'];
				}
				
				$ctmid=$rt['ctmid'];
				$eve1 = "select * from res_complaintype_master where ctmid=$ctmid";
				$re1 = mysqli_query($conn, $eve1);
				$ctmname="";
				while($rt1 = mysqli_fetch_assoc($re1))
				{
					$ctmname=$rt1['ctmname'];
				}
				
				
				$customerid=$rt['customerid'];
				$eve11 = "select * from res_user_master where umid=$customerid";
				$re11 = mysqli_query($conn, $eve11);
				$uname="";
				while($rt11 = mysqli_fetch_assoc($re11))
				{
					$uname=$rt11['uname'];
					$uaddress=$rt11['uaddress'];
					$umobile=$rt11['umobile'];
					$managername=$rt11['uprojectmanagername'];
					$managermobile=$rt11['uprojectmanagermobile'];
					$inchargename=$rt11['uprojectinchargename'];
					$inchargemobile=$rt11['uprojectinchargemobile'];
				}
				if(strlen($cmphoto)>3)
				{
					$cmphoto="<img src='images/$cmphoto' width='100px' height='100px'>";
				}
				else
				{
					$cmphoto="<img src='images/noimage.jpg' width='100px' height='100px'>";
				}
		}
	}
	
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
<meta charset="utf-8" />
<title>Call Detail | Admin Panel</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
<link href="../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
<link href="../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN THEME GLOBAL STYLES -->
<link href="../assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
<link href="../assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
<!-- END THEME GLOBAL STYLES -->
<!-- BEGIN THEME LAYOUT STYLES -->
<link href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
<link href="../assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
<!-- END THEME LAYOUT STYLES -->
<link href="../assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico" /> 

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

</head>
<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
<!-- BEGIN HEADER -->
<?php
            require ('header.php');
			?>
			<!-- END HEADER -->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div class="page-container">
<!-- BEGIN SIDEBAR -->
<?php
require ('sidebar.php');
?>
<!-- END SIDEBAR -->
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
<!-- BEGIN CONTENT BODY -->
<div class="page-content">
<!-- BEGIN PAGE HEADER-->
<!-- BEGIN THEME PANEL -->


<div class="portlet-body form">
<!-- BEGIN FORM-->
	<form action="" method="POST" class="form-horizontal" enctype="multipart/form-data" >
		<div class="form-body">
			
			<!--------------Order Event Detail---------------------------->
				<div class="portlet box green">
					<div class="portlet-title" >
						<div class="caption">
						<?php 
						$eve = "select * from res_complain_detail where cmid=$cmid";
	$re = mysqli_query($conn, $eve);
	$cactive=0;
	if(mysqli_num_rows($re) > 0)
	{
		while($rt = mysqli_fetch_assoc($re))
		{
			
				$cactive=$rt['cactive'];
		}
		
	}
	
	if($cactive==1){
	$callactive='Active Call';
	}
	else{
		$callactive='Inactive Call';
	}
				?>
						<i class="fa fa-user-plus"></i>	<small>Call Information: <?php echo $callactive;?> </small>
						</div>
						<div class="actions">
							<?php if($page == 'Complain'){ ?>
							<a class="btn white btn-outline sbold"  href="complain.php"><i class="fa fa-arrow-left"></i> Back </a>
							<?php }else if($page == 'ComComplain'){ ?>
							<a class="btn white btn-outline sbold"  href="completedcomplain.php"><i class="fa fa-arrow-left"></i> Back </a>
							<?php }else if($page == 'Service'){ ?>
							<a class="btn white btn-outline sbold"  href="servicelist.php"><i class="fa fa-arrow-left"></i> Back </a>
							<?php }else { ?>
							<a class="btn white btn-outline sbold"  href="completedservicelist.php"><i class="fa fa-arrow-left"></i> Back </a>
							<?php } ?>
						</div>
					</div>
					<div class="portlet-body">
					<div class="table-scrollable">
		
			<table class="table table-bordered">
			   <tr>	
					<th>Customer Name</th>
					<td><?php echo $uname;?></td>
					<th>Call Category</th>
					<td><?php echo $cmproblemtype;?></td>
					
				</tr>
			
				<tr>
					<th>Customer Mobile No</th>
					<td><?php echo $umobile;?></td>	
					<th>Customer Address</th>
					<td><?php echo $uaddress;?></td>
								
					</tr>
		<tr>
					<th>Project Manager  Name</th>
					<td><?php echo $managername;?></td>	
					<th>Project Manager Mobile</th>
					<td><?php echo $managermobile;?></td>
								
					</tr>
					<tr class='hidden'>
					<th>Project Incharge Name</th>
					<td><?php echo $inchargename;?></td>	
					<th>Project Incharge Mobile</th>
					<td><?php echo $inchargemobile;?></td>
								
					</tr>
					<tr>
					<th>Product Name</th>
					<td><?php echo $pmname."\n".$cmpproductdetail;?></td>	
					<th>Call Type</th>
					<td><?php echo $ctmname;?></td>
								
					</tr>
				
				<tr>								
					<th>Problem</th>
					<td><?php echo $cmdetail;?></td>
					<th>Call Photo</th>
					<td><?php echo $cmphoto;?></td>
					
				</tr>
			
				<tr>
					<th>Allocated To</th>
					<td><?php echo $seedit;?></td>
					<th>Status</th>
					<td><?php echo $cstatus1;?></td>
				</tr>
				
				<tr>	
					<th>Status Date</th>
					<td><?php echo $cmstatusudate;?></td>	
					<th>Service Charge</th>
					<td><?php echo $cmservicecharge;?></td>
				</tr>
				
				<tr>
					<th>Remarks</th>
					<td><?php echo $cmsolution;?></td>
					<th>Updated On</th>
					<td><?php echo $cmupdatedon;?></td>
				</tr>
				<tr>
				<th>Date</th>
					<td><?php echo $cmdate;?></td>
				<th>Call Reminder</th>
					<td><?php echo $cmadminstatusnew;?></td>
				</tr>
							</table>
			
			</div>
		</div>
</div>
	
	<!-------Start Complain Detail--------------->
	<div class="portlet box purple">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-file"></i><small>Call Detail</small>
						</div>
						<div class="actions">
							<?php
								
							if($cmserviceengineerid!=0 && $cactive==0){?>
							<a class="btn white btn-outline sbold" data-toggle="modal" href="#responsive21">Start Call<i class="fa fa-plus"></i></a>
								<?php } else if($cmserviceengineerid!=0 ){?>
							<a class="btn white btn-outline sbold" data-toggle="modal" href="#responsive21">Start Call<i class="fa fa-plus"></i></a>
							<a class="btn white btn-outline sbold" data-toggle="modal" href="#responsive2">End Call<i class="fa fa-plus"></i></a>
							<?php } ?>
						</div>
					</div>
					<div class="portlet-body">
					<form method="post" action="#">
						<div class="table-scrollable">
						<table class="table table-bordered">
							<tr>
								<th>Sr. No.</th>
								<th>Operation</th>
								<th>Service Engineer</th>
								<th>Date</th>
								<th>Start Time</th>
								<th>End Time</th>
								<th>Status</th>
								
								<th>Image</th>
								<!--<th>Machine Model</th>
								<th>Machine Sr. No.</th>
								<th>Machine Location</th>-->
								<th>Work Details</th>
								<!--<th>Pending Work</th>-->
								<th>Sign</th>
								<th>Customer Remarks</th>
								<th>Location</th>
							</tr>
							<?php		
								$count=1;
								$eve21 = "select * from res_complain_detail where cmid=$cmid order by cdid desc";
								$re21 = mysqli_query($conn, $eve21);
								while($rt21 = mysqli_fetch_assoc($re21))
								{
									$cdid=$rt21['cdid'];
									$assigndate=date("d-m-Y",strtotime($rt21['assigndate']));
									$cdstatus=$rt21['cdstatus'];
									$starttime=$rt21['cdstarttime'];
									$endtime=$rt21['cdendtime'];
									$cdremark=$rt21['cdremark'];
									$serviceengineerid=$rt21['serviceengineerid'];
									$cdservicecharge=$rt21['cdservicecharge'];
									$cdphoto=$rt21['cdphoto'];
									$cdmachinemodel=$rt21['cdmachinemodel'];
									$cdmachinesrno=$rt21['cdmachinesrno'];
									$cdmachinelocation=$rt21['cdmachinelocation'];
									$cdworkdone=$rt21['cdworkdone'];
									$cdpendingwok=$rt21['cdpendingwok'];
									$cdsign=$rt21['cdsign'];
									$cdcustremarks=$rt21['cdcustremarks'];
									$paystatus=$rt21['paystatus'];
									$paymentmode=$rt21['paymentmode'];
									$payamount=$rt21['payamount'];
									$paymentremark=$rt21['paymentremark'];
									$cactive=$rt21['cactive'];
									
									if($cactive == 1){
									$clongitude = $rt21['cdstartlongitude'];;
									$clatitude = $rt21['cdstartlatitude'];
									}
									elseif($cactive == 0){
									$clongitude = $rt21['cdendlongitude'];;
									$clatitude = $rt21['cdendlatitude'];
									}
									$url="https://www.google.com/maps/search/?api=1&query=$clatitude,$clongitude";
									
									$eve112 = "select uname from res_user_master where umid=$serviceengineerid";
									$re112 = mysqli_query($conn, $eve112);
									$sename12="";
									while($rt112 = mysqli_fetch_assoc($re112))
									{
										$sename12=$rt112['uname'];
									}
									
									if(strlen($cdphoto)>3)
									{
										$cdphoto="<img src='./images/$cdphoto' width='50px' height='50px'>";
									}
									else
									{
										$cdphoto="<img src='images/noimage.jpg' width='50px' height='50px'>";
									}
									
										if(strlen($cdsign)>3)
										{
											$cdsign="<img src='./images/$cdsign' width='100px' height='100px'>";
										}
										else
										{
											$cdsign="<img src='images/noimage.jpg' width='100px' height='100px'>";
										}
					
									if($cdstatus=="Pending")
									{
										$cdstatus="<span class='label label-sm label-primary'>Pending</span>";
									}
									else if($cdstatus=="In Process")
									{
										$cdstatus="<span class='label label-sm label-warning'>In Process</span>";
									}
									else if($cdstatus=="Completed")
									{
										$cdstatus="<span class='label label-sm label-success'>Completed</span>";
									}
									else if($cdstatus=="Cancel")
									{
										$cdstatus="<span class='label label-sm label-danger'>Cancel</span>";
									}
									else
									{
										$cdstatus="<span class='label label-sm label label-success'>$cdstatus</span>";
									}
									$cmprint="<a href='complaindetailprint.php?id=".$rt21['cdid']."&cmid=".$cmid."' data-toggle='tooltip' data-placement='top' title='PDF' class='fa fa-file-pdf-o' >  </a>";
							?>	
							<tr>
								<td><?php echo $count++;?></td>
								<td><?php echo $cmprint;?></td>
								<td><?php echo $sename12;?></td>
								<td><?php echo $assigndate;?></td>
								<td><?php echo $starttime;?></td>
								<td><?php echo $endtime;?></td>
								<td><?php echo $cdstatus;?></td>
								
								
								
								<td><?php echo $cdphoto;?></td>								
								<!--<td><?php  //echo $cdmachinemodel;?></td>								
								<td><?php //echo $cdmachinesrno;?></td>								
								<td><?php //echo $cdmachinelocation;?></td>	-->							
								<td><?php echo $cdworkdone;?></td>								
								<td><?php echo $cdsign;?></td>								
								<td><?php echo $cdcustremarks;?></td>								
								<td ><a href="<?php echo $url; ?>" target="_blank"><i class="fa fa-map-marker"></i> <?php echo $clatitude ." ".$clongitude;?></a></td>								
							</tr>
							<?php
								}
							?>
						</table>
						</div>
						</form>
					</div>
                </div>

	<!-------End Complain Detail---------------->
<!---------Inquiry Allocation----------->
				<?php if($_SESSION['utype']=='Admin')
							{	?>
				<div class="portlet box blue-hoki blue">
					<div class="portlet-title blue">
						<div class="caption">
							<i class="fa fa-user"></i><small>Complain Allocation</small>
						</div>
						<div class="actions">
							<a class="btn white btn-outline sbold" data-toggle="modal" href="#responsive12"> Add New <i class="fa fa-plus"></i></a>
						</div>
					</div>
					<div class="portlet-body">
						<table class="table table-bordered">
							<tr>
								<th>Sr. No.</th>								
								<th>Staff Name </th>
								<th>Operation </th>
							</tr>			
							<?php
								$eve21 = "select callocationmid,serviceengid from res_complainallocation_detail where cmid =$cmid";
								$re21= mysqli_query($conn, $eve21);
								$i=1;
								while($rt21 = mysqli_fetch_assoc($re21))
								{	
									$iadid=$rt21['callocationmid'];
									$umid=$rt21['serviceengid'];
									
									$eve22 = "select uname from res_user_master where umid=$umid";
									$re22= mysqli_query($conn, $eve22);
									while($rt22 = mysqli_fetch_assoc($re22))
									{
										$ufullname=$rt22['uname'];
									}
									
									$idelete="<a href='complainallocationdelete.php?id=$iadid&cmid=$cmid' onclick='return confirm(&#39;Are you sure you want to delete ?&#39;);' data-toggle='tooltip' data-placement='top' title='Delete' class='fa fa-trash-o'>  </a>";
							?>		
							<tr>	
								<td><?php echo $i++;?></td>								
								<td><?php echo $ufullname;?></td>
								<td><?php echo $idelete;?></td>
							</tr>
							<?php
								}	
							?>	
						</table>
					</div>
                </div>
							<?php }?>
				<!---------Inquiry Allocation----------->
	<div class="portlet box blue">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-file-archive-o"></i><small>Item Detail</small>
						</div>
						<div class="actions">
							<?php 
							$eve11 = "select * from res_prodmaintainance_detail where pumdid=$pumdid";
							$re11 = mysqli_query($conn, $eve11);
							//if(mysqli_num_rows($re11) > 0)
							//{}else{
						?>
						
						<a class="btn white btn-outline sbold"  href="generatepdf/invoicepdf.php?cmid=<?php echo $cmid;?>"><i class="fa fa-file"></i> Generate Invoice </a>	
						<a class="btn white btn-outline sbold" data-toggle="modal" href="#responsiveremark2"> Add New <i class="fa fa-plus"></i></a>
						</div>
					</div>
					<div class="portlet-body">
					<form method="post" action="#">
						<table class="table table-bordered">
							<tr>
								<th>Sr No</th>
								<th>Operation</th>
								<th>Name</th>
								<th>QTY</th>
								<th>Rate</th>
								<th>Total Amount</th>
								
								

							</tr>
							<?php		
											
											$count=1;
											$totamount=0;
											$eve_deal = "select * from res_complainitem_detail where cmid=$cmid";
											$re_deal = mysqli_query($conn, $eve_deal);

											while($rt_deal = mysqli_fetch_assoc($re_deal))
											{
												$cmid=$rt_deal['cmid'];
												$cidid=$rt_deal['cidid'];
												$cidqty=$rt_deal['cidqty'];
												$cidrate=$rt_deal['cidrate'];
												$amount=$rt_deal['cidrate']*$cidqty;
												$totamount=$totamount+$amount;
												
												$pmid=$rt_deal['pmid'];
												$eve2 = "select * from res_product_master where pmid=$pmid";
												$re2 = mysqli_query($conn, $eve2);
												while($rt2 = mysqli_fetch_assoc($re2))
												{
													$pmname=$rt2['pmname'];
													
												} 
												
												$uedit="<a href='itemdetailedit.php?id=".$cidid."' data-toggle='tooltip' data-placement='top' title='Edit' class='fa fa-edit fa-lg'>  </a>";
											
												$udelete="<a href='itemdetaildelete.php?id=".$cidid ."' onclick='return confirm(&#39;Are you sure you want to delete ?&#39;);' data-toggle='tooltip' data-placement='top' title='Delete' class='fa fa-trash-o fa-lg'>  </a>";
												
												//$mail="<a  href='paymentsendmail.php?id=".$cidid ."'   onclick=' data-toggle='tooltip' data-placement='top' title='Email' class='fa fa-envelope'></a>";
												
												$op=$uedit."&nbsp;&nbsp;&nbsp; ".$udelete;
												
										?>	
							<tr>
								<td><?php echo $count++;?></td>
								<td><?php echo $op;?></td>
								<td><?php echo $pmname;?></td>
								<td><?php echo $cidqty;?></td>
								<td><?php echo $cidrate;?></td>
								<td><?php echo $amount;?></td>
								
								
							</tr>
							
										<?php
											}
											$amt = $totamount+$cmservicecharge;
											$sql22 = "update res_complain_master set cmtotalamount='$totamount',cmnetamount = '$amt' where cmid='$cmid'";
											
											$re22 = mysqli_query($conn, $sql22);
											
											$eve12 = "select sum(cmpayamount) as cc from res_complainpayment_detail where cmid=$cmid";
	    $re12 = mysqli_query($conn, $eve12);
		while($rt12 = mysqli_fetch_assoc($re12))
		{
				 $receivedamount=$rt12['cc'];
				
		}
		$eve1 = "select * from res_complain_master where cmid=$cmid";
	    $re1 = mysqli_query($conn, $eve1);
		while($rt1 = mysqli_fetch_assoc($re1))
		{
				 $cmnetamount=$rt1['cmnetamount'];
		}
		
$pendingamount=$cmnetamount-$receivedamount;
		$eve11 = "update res_complain_master set cmpendingamount='$pendingamount' where cmid=$cmid";
	    $re11 = mysqli_query($conn, $eve11);
										?>
									
						
											<tr>
										    <th colspan="4" ></th>
										    <th >Service Charge</th>
											<td><?php echo $cmservicecharge;?> &nbsp; <a data-toggle='modal'  data-target='#view-modal1' data-id='$cmid' id='getUser'  ><i class="fa fa-pencil"></i></a></td>
											</tr>
											<tr>
										    <th colspan="4" ></th>
										    <th >Total</th>
											<td><?php echo $totamount+$cmservicecharge;?></td>
											</tr>
												
						</table>
						</form>
					</div>
                </div>
	<!-------Start Payment Detail--------------->
	<div class="portlet box purple">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-file"></i><small>Payment Detail</small>
						</div>
						<div class="actions">
							<?php if($cmserviceengineerid!=0){?>
							<a class="btn white btn-outline sbold" data-toggle="modal" href="#responsiveremark3"> Add New <i class="fa fa-plus"></i></a>
							<?php } ?>
						</div>
					</div>
					<div class="portlet-body">
					<form method="post" action="#">
						<div class="table-scrollable">
						<table class="table table-bordered">
							<tr>
								<th>Sr. No.</th>
								
								
								<th>Payment Status</th>
								<th>Payment Mode</th>
								<th>Payment Amount</th>
								<th>Payment Remark</th>
								
								
							</tr>
							<?php		
								$count=1;
								$totalamount=0;
								$eve21 = "select * from res_complainpayment_detail where cmid=$cmid ";
								$re21 = mysqli_query($conn, $eve21);
								while($rt21 = mysqli_fetch_assoc($re21))
								{
									
									$paystatus="Paid";
									$paymentmode=$rt21['cmpaymentmode'];
									$payamount=$rt21['cmpayamount'];
									$paymentremark=$rt21['cmpayremark'];
									
										$totalamount=$totalamount+$payamount;
									
							?>	
							<tr>
								<td><?php echo $count++;?></td>
								
								<td><?php echo $paystatus;?></td>
								<td><?php echo $paymentmode;?></td>
								<td><?php echo $payamount;?></td>
								<td><?php echo $paymentremark;?></td>
																
							</tr>
							<?php
								}
							?>
							 <tr>
										<td style="display:none;">  </td>
										<td></td>
										<td></td>
								
										<td><b>Total</b></td>
										<td> <?php echo $totalamount; ?></td>
										<td></td>
									</tr>
						</table>
						</div>
						</form>
					</div>
                </div>

<div class="portlet box green">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-cogs"></i><small>Product Under Maintenance</small>
						</div>
						<div class="actions">
							<?php 
							$eve11 = "select * from res_prodmaintainance_detail where pumdid=$pumdid";
							$re11 = mysqli_query($conn, $eve11);
							//if(mysqli_num_rows($re11) > 0)
							//{}else{
						?>
						<a class="btn white btn-outline sbold" data-toggle="modal" href="#responsiveremark1">Add New <i class="fa fa-plus"></i></a>
							
						</div>
					</div>
					<div class="portlet-body">
					<form method="post" action="#">
						<table class="table table-bordered">
							<tr>
								<th>Sr No</th>
								<th>Product Detail</th>
								<th>Status</th>
								<th>Date</th>
								<th>By</th>
								<th>Given To</th>
								<th>Contact Person</th>
								<th>Contact Number</th>
								<th>Date</th>
								<th>Expected Service Amount</th>
								<th>Expected Return Date</th>
								<th>Actual Return Date</th>
								<th>Return To Customer Date</th>
								<th>Operation</th>

							</tr>
							<?php		
											
											$count=1;
											$eve_deal = "select * from res_prodmaintainance_detail where cmid=$cmid";
											$re_deal = mysqli_query($conn, $eve_deal);

											while($rt_deal = mysqli_fetch_assoc($re_deal))
											{
												$cmid=$rt_deal['cmid'];
												$pumdid=$rt_deal['pumdid'];
												$pumdetail=$rt_deal['pumdetail'];
												$pumdcollectby=$rt_deal['pumdcollectby'];
												$pumdgivento=$rt_deal['pumdgivento'];
												$pumdconatctper=$rt_deal['pumdconatctper'];
												$pumdconatctno=$rt_deal['pumdconatctno'];
												$pumdexpamt=$rt_deal['pumdexpamt'];	
												
												$pumddcollectate=implode('-', array_reverse(explode('-', $rt_deal['pumddcollectate'])));
												$pumdgivendate=implode('-', array_reverse(explode('-', $rt_deal['pumdgivendate'])));
												$pumdexpreturndate=implode('-', array_reverse(explode('-', $rt_deal['pumdexpreturndate'])));
												$pumdactualdate=implode('-', array_reverse(explode('-', $rt_deal['pumdactualdate'])));
												$pumdcustdate=implode('-', array_reverse(explode('-', $rt_deal['pumdcustdate'])));
												
												$smid=$rt_deal['smid'];
												$eve2 = "select * from res_status_master where smid=$smid";
												$re2 = mysqli_query($conn, $eve2);
												while($rt2 = mysqli_fetch_assoc($re2))
												{
													$smname=$rt2['smname'];
													
												} 
												
												$uedit="<a href='maintenanceedit.php?id=".$pumdid."' data-toggle='tooltip' data-placement='top' title='Edit' class='fa fa-edit fa-lg'>  </a>";
											
												$udelete="<a href='maintenancedelete.php?id=".$pumdid ."' onclick='return confirm(&#39;Are you sure you want to delete ?&#39;);' data-toggle='tooltip' data-placement='top' title='Delete' class='fa fa-trash-o fa-lg'>  </a>";
								
												$op=$uedit."&nbsp;&nbsp;&nbsp; ".$udelete;
								
												
										?>	
							<tr>
								<td><?php echo $count++;?></td>
								<td><?php echo $pumdetail;?></td>
								<td><?php echo $smname;?></td>
								<td><?php echo $pumddcollectate;?></td>
								<td><?php echo $pumdcollectby;?></td>
								<td><?php echo $pumdgivento;?></td>
								<td><?php echo $pumdconatctper;?></td>
								<td><?php echo $pumdconatctno;?></td>
								<td><?php echo $pumdgivendate;?></td>
								<td><?php echo $pumdexpamt;?></td>
								<td><?php echo $pumdexpreturndate;?></td>
								<td><?php echo $pumdactualdate;?></td>
								<td><?php echo $pumdcustdate;?></td>
								<td><?php echo $op;?></td>
								
							</tr>
										<?php
											}
										?>
									
							</tr>
							
						</table>
						</form>
					</div>
                </div>
				
			
		</div>
		
				<!--------------Inquiry Allocation-------------->   
				<div id="responsive12" class="modal fade" tabindex="-1" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								<h4 class="modal-title">Allocation</h4>
							</div>
							<form method="post" action="complainallocation2.php">
								<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
								<input type="hidden" name="cmid" value="<?php echo $cmid; ?>">
							<div class="modal-body">
								<div class="scroller" style="height:50px" data-always-visible="1" data-rail-visible1="1">
									<div class="row">
										<div class="form-group">
											<label class="col-md-4 control-label"> Service Engineer </label>
											<div class="col-md-8">
												<select class="form-control " name="serviceengid" id="serviceengid">
												<option value="0">Select</option>
												<?php	
													$eve_category = "select * from res_user_master where umid not in(select serviceengid from res_complainallocation_detail where cmid=".$_GET['id'].") and utype in('serviceengineer') and samid=$samid";
													$re_category = mysqli_query($conn, $eve_category);
													while($rt_category = mysqli_fetch_assoc($re_category))
													{
														echo "<option value='$rt_category[umid]'>$rt_category[uname]</option>";
													}		
												?>	
												</select>
											</div>
										</div>
									</div>
								</div>
								
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn green">Submit <i class="fa fa-check"></i></button>
								<button type="button" data-dismiss="modal" class="btn dark btn-outline">Close <i class="fa fa-close"></i></button>
							</div>
							</form>
						</div>
					</div>
                </div>  
				<!-----------------Inquiry Allocation---------------------> 
					
				
				<div id="responsiveremark2" class="modal fade" tabindex="-1" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								<h4 class="modal-title"><i class="fa fa-plus"></i> Add New</h4>
						</div>
				<form method="post" id="formitemadd" name="formitemadd" action="padd2.php" enctype="multipart/form-data" class="form-horizontal" >		
				<input type="hidden" name="cmid" value="<?php echo $_GET['id'];?>">

				<div class="modal-body">						
				<div class="scroller" style="height:200px" data-always-visible="1" data-rail-visible1="1">							
				<div class="row">					
				<div class="col-md-12">							
				<table class="table table-bordered">
			 
							
								<div class="form-group">
								<label class="col-md-3 control-label">Item<span class="required">*</span></label>
								<div class="col-md-5">
									<select class="form-control" name="pmid" id="pmid" required>
										<option value="0">Select Item</option>
										<?php
									 	$eve_main = "select * from res_product_master where samid=$samid and ptype='Item'";
								
										$re_main = mysqli_query($conn, $eve_main);
										while($rt_main = mysqli_fetch_assoc($re_main))
										{

											$pmid=$rt_main['pmid'];
											$pmname=$rt_main['pmname'];
											
												echo "<option value='$pmid'>$pmname</option>";
											

										}
									?>
									</select>
								</div>
					
							</div>
							
							<div class="form-group">
								<label class="col-md-3 control-label">QTY<span class="required">*</span></label>
								<div class="col-md-5">
								
									<input type="text" name="cidqty" value="1" class="form-control" aria-required="true" aria-invalid="false" aria-describedby="name-error" required>
								</div>
							</div>
						
						<div class="form-group">
								<label class="col-md-3 control-label">Rate<span class="required">*</span></label>
								<div class="col-md-5">
								
									<input type="text" name="cidrate" id="getrate"  class="form-control" aria-required="true" aria-invalid="false" aria-describedby="name-error" required>
								</div>
						</div>
						
				</table>
				</div>							
				</div>						
				</div>	
				<div class="modal-footer">				
				<button type="button" data-dismiss="modal" class="btn dark btn-outline"><i class="fa fa-arrow-left"></i> Close</button>				
				<button type="submit" class="btn green" value="Submit"><i class="fa fa-arrow-left"></i>  Submit</button>
               </div>					
				</div>				
				</form>		
	
	
					</div>
					</div>
                </div>
				<div id="responsiveremark3" class="modal fade" tabindex="-1" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								<h4 class="modal-title"><i class="fa fa-plus"></i> Add Payment</h4>
						</div>
				<form method="post" action="payadd2.php" enctype="multipart/form-data" class="form-horizontal" >		
				<input type="hidden" name="cmid" value="<?php echo $_GET['id'];?>">

				<div class="modal-body">						
				<div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1">							
				<div class="row">					
				<div class="col-md-12">							
				<table class="table table-bordered">
			 
							     <?php
							  	$eve = "select * from res_complain_master where cmid=$cmid";
	    $re = mysqli_query($conn, $eve);
		while($rt = mysqli_fetch_assoc($re))
		{
				$cmnetamount=$rt['cmnetamount'];
				$cmpendingamount=$rt['cmpendingamount'];
		?>
		<div class="form-group">
								<label class="col-md-3 control-label">Total Amount</label>
								<div class="col-md-5">
								
									<input class="form-control" aria-required="true" aria-invalid="false" aria-describedby="name-error" type="number" name="netamount" value="<?php echo $cmnetamount; ?>" readonly>
								</div>
							</div> 
	
		
							<div class="form-group">
								<label class="col-md-3 control-label">Pending Amount</label>
								<div class="col-md-5">
								
									<input class="form-control" aria-required="true" aria-invalid="false" aria-describedby="name-error" type="number" name="pendingamount" value="<?php echo $cmpendingamount; ?>" readonly>
								</div>
							</div> 
		<?php } ?>			
											
								<div class="form-group">
								<label class="col-md-3 control-label">Payment Mode<span class="required">*</span></label>
								<div class="col-md-5">
									<select id="getrate"  class="form-control" aria-required="true" aria-invalid="false" aria-describedby="name-error" name="pmode" id="pmode">
													<option value="Cash">Cash</option>
													<option  value="Cheque">Cheque</option>
													<option  value="Online">Online</option>
													
											</select>
								</div>
					
							</div>
							
							<div class="form-group">
								<label class="col-md-3 control-label">Payment Amount<span class="required">*</span></label>
								<div class="col-md-5">
								
									<input id="getrate"  class="form-control" aria-required="true" aria-invalid="false" aria-describedby="name-error" type="number" name="payamount" / required>
								</div>
							</div>
						
						<div class="form-group" >
								<label class="col-md-3 control-label">Payment Remark</label>
								<div class="col-md-5">
								
									<textarea type="text" name="payremark" id="getrate"  class="form-control" aria-required="true" aria-invalid="false" aria-describedby="name-error"></textarea>
								</div>
						</div>
						
				</table>
				</div>							
				</div>						
				</div>	
				<div class="modal-footer">				
				<button type="button" data-dismiss="modal" class="btn dark btn-outline"><i class="fa fa-arrow-left"></i> Close</button>				
				<button type="submit" class="btn green" value="Submit"><i class="fa fa-arrow-left"></i>  Submit</button>
               </div>					
				</div>				
				</form>		
	
	
					</div>
					</div>
                </div>
				
				
				<div id="responsiveremark1" class="modal fade" tabindex="-1" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								<h4 class="modal-title"><i class="fa fa-plus"></i> Add New</h4>
						</div>
				<form method="post" action="maintenanceadd2.php" id="maintance2" enctype="multipart/form-data" class="form-horizontal" >		
				<input type="hidden" name="cmid" value="<?php echo $_GET['id'];?>">

				<div class="modal-body">	
				
				<div class="scroller" style="height:630px" data-always-visible="1" data-rail-visible1="1">	
						
				<div class="row">					
				<div class="col-md-12">							
				<table class="table table-bordered">
			 
						
						<div class="form-group">
								<label class="col-md-4 control-label">Product Detail<span class="required">*</span></label>
								<div class="col-md-5">
								
									<textarea type="text" name="pumdetail" value="" class="form-control" aria-required="true" aria-invalid="false" aria-describedby="name-error" required></textarea>
								</div>
						</div>
							
						<div class="form-group">
								<label class="col-md-4 control-label" >Status<span class="required">*</span></label>
								<div class="col-md-5">
									<select class="form-control" name="smid" id="smid" required>
										<option value="0">Select Status</option>
										<option value="1">Collected</option>
										<?php
										$eve_main = "select * from res_status_master";
										$re_main = mysqli_query($conn, $eve_main);
										while($rt_main = mysqli_fetch_assoc($re_main))
										{

											$smid=$rt_main['smid'];
											$smname=$rt_main['smname'];
										
												echo "<option value='$smid'>$smname</option>";
										

										}
									?>
									</select>
								</div>
						</div>
								
						<div class="form-group">
								<label class="col-md-4 control-label">Collection Date</label>
								<div class="col-md-5">
									<input class="form-control form-control-inline  date-picker" data-date-format="dd-mm-yyyy" type="text" name="pumddcollectate" value="<?php echo $mdate;?>" required>
								</div>
						</div>
						<div class="form-group">
								<label class="col-md-4 control-label">Collected By<span class="required">*</span></label>
								<div class="col-md-5">
								
									<input type="text" name="pumdcollectby" value="" class="form-control" aria-required="true" aria-invalid="false" aria-describedby="name-error" required>
								</div>
						</div>
							
						<div class="form-group">
								<label class="col-md-4 control-label">Given To<span class="required">*</span></label>
								<div class="col-md-5">
								
									<input type="text" name="pumdgivento" value="" class="form-control" aria-required="true" aria-invalid="false" aria-describedby="name-error" required>
								</div>
						</div>
							
						<div class="form-group">
								<label class="col-md-4 control-label">Contact Person<span class="required">*</span></label>
								<div class="col-md-5">
								
									<input type="text" name="pumdconatctper" value="" class="form-control" aria-required="true" aria-invalid="false" aria-describedby="name-error" required>
								</div>
						</div>
							
						<div class="form-group">
								<label class="col-md-4 control-label">Given To Contact No<span class="required">*</span></label>
								<div class="col-md-5">
								
									<input type="text" name="pumdconatctno" value="" class="form-control" aria-required="true" aria-invalid="false" aria-describedby="name-error" required>
								</div>
						</div>
							
						<div class="form-group">
								<label class="col-md-4 control-label">Given Date</label>
								<div class="col-md-5">
									<input class="form-control form-control-inline  date-picker" data-date-format="dd-mm-yyyy" type="text" name="pumdgivendate" value="<?php echo $mdate;?>" required>
								</div>
						</div>
							
						<div class="form-group">
								<label class="col-md-4 control-label">Expected Amount<span class="required">*</span></label>
								<div class="col-md-5">
								
									<input type="text" name="pumdexpamt" value="" class="form-control" aria-required="true" aria-invalid="false" aria-describedby="name-error" required>
								</div>
						</div>
							
						<div class="form-group">
								<label class="col-md-4 control-label">Expected Return Date</label>
								<div class="col-md-5">
									<input class="form-control form-control-inline  date-picker" data-date-format="dd-mm-yyyy" type="text" name="pumdexpreturndate" value="<?php echo $mdate;?>" required>
								</div>
						</div>
							
						<div class="form-group">
								<label class="col-md-4 control-label">Actual Return Date</label>
								<div class="col-md-5">
									<input class="form-control form-control-inline  date-picker" data-date-format="dd-mm-yyyy" type="text" name="pumdactualdate" value="<?php echo $mdate;?>" required>
								</div>
						</div>
							
						<div class="form-group">
								<label class="col-md-4 control-label">Customer Date</label>
								<div class="col-md-5">
									<input class="form-control form-control-inline  date-picker" data-date-format="dd-mm-yyyy" type="text" name="pumdcustdate" value="<?php echo $mdate;?>" required>
								</div>
						</div>
							
							</div>
				</table>
				</div>							
				</div>						
				</div>	
				<div class="modal-footer">				
				<button type="button" data-dismiss="modal" class="btn dark btn-outline"><i class="fa fa-arrow-left"></i> Close</button>				
				<button type="submit" class="btn green" value="Submit"><i class="fa fa-arrow-left"></i>  Submit</button>
               </div>					
				</div>				
				</form>		
	
	
					</div>
					</div>
		
					
					
					
					
                </div>
	</form>
	</div>
  <!--- start --->
<div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		 <div class="modal-dialog">
			  <div class="modal-content">

				   <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title">
							<i class="glyphicon glyphicon-user"></i> Edit Call Status
						</h4>
				   </div>
				<form name="form1" method="post" action="aedit2.php" enctype="multipart/form-data">
				   <div class="modal-body">
					 <div id="modal-loader" style="display: none; text-align: center;">
						<img src="ajax-loader.gif">
					   </div>

					   <!-- content will be load here -->
					   <div id="dynamic-content"></div>

					</div>
					<div class="modal-footer">
						<button type="button" data-dismiss="modal" class="btn dark btn-outline"><i class="fa fa-arrow-left"></i> Close</button>				
				<button type="submit" class="btn green" value="Submit"><i class="fa fa-arrow-left"></i>  Submit</button>
					</div>
				</form>
			 </div>
		  </div>
	</div>
	
	
	<!--- end --->
	<!--- Start --->
	<div id="view-modal5" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		 <div class="modal-dialog">
			  <div class="modal-content">

				   <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title">
							<i class="glyphicon glyphicon-user"></i> Call Reminder
						</h4>
				   </div>
				<form name="form1" method="post" action="complainstatusdetail2.php" enctype="multipart/form-data">
				   <div class="modal-body">
					 <div id="modal-loader" style="display: none; text-align: center;">
						<img src="ajax-loader.gif">
					   </div>

					   <!-- content will be load here -->
					   <div id="dynamic-content5"></div>

					</div>
					<div class="modal-footer">
						<button type="button" data-dismiss="modal" class="btn dark btn-outline"><i class="fa fa-arrow-left"></i> Close</button>				
				<button type="submit" class="btn green" value="Submit"><i class="fa fa-arrow-left"></i>  Submit</button>
					</div>
				</form>
			 </div>
		  </div>
	</div>
	<!--- end --->
	
	
			<!--------------Service Engineer Allocate--------------->
			<div id="responsive1" class="modal fade" tabindex="-1" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Edit Service Engineer</h4>
						</div>
						
						<form method="post" action="serviceengineeredit2.php" enctype="multipart/form-data" class="form-horizontal">		
						<input type="hidden" name="cmid" value="<?php echo $cmid;?>">
							<div class="modal-body">						
							<div class="scroller" style="height:100px" data-always-visible="1" data-rail-visible1="1">							
							<div class="row">					
							<div class="col-md-12">
													
								<div class="form-group">
									<label class="col-md-4 control-label">Service Engineer <span class="required">*</span></label>
									<div class="col-md-8">
										<select class="form-control" name="umid">
											<?php
											$evedriver = "select umid,uname from res_user_master where utype='serviceengineer' and samid=$samid";
											$redriver = mysqli_query($conn, $evedriver);
											$uname="";
											
											while($rtdriver = mysqli_fetch_assoc($redriver))
											{
												$umid=$rtdriver['umid'];
												$uname=$rtdriver['uname'];
												
												if($cmupdatedby==$umid)
												{
													echo "<option value='$umid' selected>$uname</option>";
												}
												else
												{
													echo "<option value='$umid'>$uname</option>";
												}
											}
										?>
										</select>
									</div>
								</div>	
									
							</div>							
			</div>						
			</div>					
			<div class="modal-footer">				
			<button type="button" data-dismiss="modal" class="btn dark btn-outline"><i class="fa fa-arrow-left"></i> Close</button>				
				<button type="submit" class="btn green" value="Submit"><i class="fa fa-arrow-left"></i>  Submit</button>					
			</div>					
			</div>				
			</form>		


				</div>
				</div>
			</div>
			
				<div id="responsiveremark" class="modal fade" tabindex="-1" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								<h4 class="modal-title">Add New</h4>
						</div>
				<form method="post" action="cadd2.php" enctype="multipart/form-data" class="form-horizontal" >		
				<input type="hidden" name="cmid" value="<?php echo $_GET['id'];?>">

				<div class="modal-body">						
				<div class="scroller" style="height:100px" data-always-visible="1" data-rail-visible1="1">							
				<div class="row">					
				<div class="col-md-12">							
				<table class="table table-bordered">
			 
								<div class="form-group">
								<label class="col-md-3 control-label">Service Engineer<span class="required">*</span></label>
								<div class="col-md-5">
									<select class="form-control" name="serviceengineerid" required>
										<option value="0">Select Service Engineer</option>
										<?php
										$eve_main = "select * from res_user_master where utype='serviceengineer' and samid=$samid and umid not in(select serviceengineerid from res_complain_detail where cmid=".$_GET['id'].")";
										$re_main = mysqli_query($conn, $eve_main);
										while($rt_main = mysqli_fetch_assoc($re_main))
										{

											$token=$rt_main['ufcmtoken'];
											$umid=$rt_main['umid'];
											$uname=$rt_main['uname'];
											if($serviceengineerid==$umid)
											{
												echo "<option value='$umid' selected>$uname</option>";
											}
											else
											{
												echo "<option value='$umid'>$uname</option>";
											}

										}
									?>
									</select>
								</div><br><br><br>
								
				
							</div>
				</table>
				</div>							
				</div>						
				</div>	
				<div class="modal-footer">				
				<button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>				
				<input type="submit" class="btn green" value="Submit">
               </div>	

				</div>				
				</form>		
	
	
					</div>
					</div>
                </div>
				
				<!------->
				<div id="view-modal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		 <div class="modal-dialog">
			  <div class="modal-content">

				   <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title">
							<i class="glyphicon glyphicon-user"></i> Edit Service Charge
						</h4>
				   </div>
				<form name="form1" method="post" action="serviceedit.php" enctype="multipart/form-data">
				   <div class="modal-body">
				  
                   <?php				  
				   $eve = "select * from res_complain_master where cmid=$cmid";
				 
	               $re = mysqli_query($conn, $eve);
	
		while($rt = mysqli_fetch_assoc($re))
		{
				
				$cmservicecharge=$rt['cmservicecharge'];
				  $cmid=$rt['cmid'];
					?>
					     <div class="form-group">
								<label class="col-md-3 control-label"> Service Charge </label>
								
								<input type="text" name="scharge" value="<?php echo $cmservicecharge; ?>" class="form-control" required>
								<input type="hidden" name="cmid" value="<?php echo $cmid; ?>" > 
							
						</div>
                <?php
		}
		?>
					</div>
					<div class="modal-footer">
						<button type="submit" name="submit" class="btn green" value="Submit"><i class="fa fa-check"></i> Submit </button>
						  <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Close</button>
					</div>
				</form>
			 </div>
		  </div>
	</div>
				
	<!------------------------------------------->
			<!--------------Add Complain Detail--------------->
				<div id="responsive21" class="modal fade" tabindex="-1" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								<h4 class="modal-title"><i class="fa fa-user-plus"></i>Start Call</h4>
							</div>
							<form method="post" action="complaindetailstart.php" id="myForm" enctype="multipart/form-data">
								<input type="hidden" name="cmid" value="<?php echo $_GET['id'];?>">
								<input type="hidden" name="customerid" value="<?php echo $customerid;?>">
								
							<div class="modal-body">
								<div class="scroller" style="height:200px" data-always-visible="1" data-rail-visible1="1">
									<div class="row">
										<div class="col-md-12">							
											<table class="table table-bordered">
											<tr>									
											<td>Service Engineer<span style="color:red;">*</span></td>							
											<td>									
											
												<select class="form-control" name="cmserviceengineerid" id="skills" required>
													<option value='0' selected>Select Service Engineer</option>
												<?php
												$eve11 = "select * from res_user_master where umid in(select serviceengid from res_complainallocation_detail where cmid=$cmid) and umid not in(select serviceengineerid from res_complain_detail where cactive=1 and cmid=$cmid) and samid=$samid";
					$re11 = mysqli_query($conn, $eve11);
					
				
					if(mysqli_num_rows($re11) > 0)
					{
						
						while($rt11 = mysqli_fetch_assoc($re11))
						{
							 $staff =$rt11['uname'];
							 $serviceengid =$rt11['umid'];
							 
							echo "<option value='$serviceengid'>$staff</option>";
						}
					}
					?>
											</select>
											</td>							
											</tr>
											<tr>									
											<td>Status</td>							
											<td>									
												
												<input type="text" name="cdstatus" value="<?php echo $cstatus;?>" class="form-control" readonly>
													
											</td>							
											</tr>
											<tr>									
											<td>Start Time</td>							
											<td>									
												<div class="col-md-6">
																
																<input class="form-control form-control-inline  date-picker" data-date-format="dd-mm-yyyy" type="text" id="datepicker1" name="startdate"  value="<?php echo $mdate; ?>">
															</div>
															 <div class="col-md-6">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control timepicker timepicker-24" name="starttime">
                                                        <span class="input-group-btn">
                                                            <button class="btn default" type="button">
                                                                <i class="fa fa-clock-o"></i>
                                                            </button>
                                                        </span>
                                                    </div>
											</td>							
											</tr>
											
											
											
											
											</table>
										</div>
									</div>
								</div>

							</div>
							<div class="modal-footer">
								<button type="submit" class="btn green">Submit <i class="fa fa-check"></i></button>
								<button type="button" data-dismiss="modal" class="btn dark btn-outline">Close <i class="fa fa-arrow-left"></i></button>
							</div>
							</form>
						</div>
					</div>
                </div>
				<!------------------Add Complain detail---------------------->
	
		<!--------------Add Complain Detail--------------->
				<div id="responsive2" class="modal fade" tabindex="-1" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								<h4 class="modal-title"><i class="fa fa-user-plus"></i>End Call</h4>
							</div>
							<form method="post" action="complaindetailadd2.php" id="myForm1" enctype="multipart/form-data">
								<input type="hidden" name="cmid" value="<?php echo $_GET['id'];?>">
								<input type="hidden" name="customerid" value="<?php echo $customerid;?>">
								<input type="hidden" name="cdservicecharge" value="<?php echo $cdservicecharge;?>">
								
								
							<div class="modal-body">
								<div class="scroller" style="height:550px" data-always-visible="1" data-rail-visible1="1">
									<div class="row">
										<div class="col-md-12">							
											<table class="table table-bordered">
											<tr>									
											<td>Service Engineer</td>							
											<td>									
											
												<select class="form-control" name="cmserviceengineerid" id="skills1" required>
													<option value='0' selected>Select Service Engineer</option>
												<?php
												$eve11 = "select * from res_user_master where umid in(select serviceengid from res_complainallocation_detail where cmid=$cmid) and umid in(select serviceengineerid from res_complain_detail where cactive=1 and cmid=$cmid) and samid=$samid";
					$re11 = mysqli_query($conn, $eve11);
					
				
					if(mysqli_num_rows($re11) > 0)
					{
						
						while($rt11 = mysqli_fetch_assoc($re11))
						{
							 $staff =$rt11['uname'];
							 $serviceengid =$rt11['umid'];
							 
							echo "<option value='$serviceengid'>$staff</option>";
						}
					}
					?>
											</select>
											</td>							
											</tr>
											<tr>									
											<td>Status</td>							
											<td>									
												<select class="form-control" name="cdstatus">
													<option <?php if($cstatus=='Pending'){ echo'selected';}?> value="Pending">Pending</option>
													<option <?php if($cstatus=='In Process'){ echo'selected';}?> value="In Process">In Process</option>
													<option <?php if($cstatus=='Incomplete'){ echo'selected';}?> value="Incomplete">Incomplete</option>
													<option <?php if($cstatus=='Completed'){ echo'selected';}?> value="Completed">Completed</option>
													
													
											</select>
											</td>							
											</tr>
											
											
											
											<tr>									
											<td>Photo</td>							
											<td>									
												<input class="form-control" type="file" name="cdphoto" accept="images/*" />
											</td>							
											</tr>
											<tr>									
											<td>Remarks</td>							
											<td>									
												<textarea type="text" name="cdremark" class="col-md-12 form-control"></textarea>
											</td>							
											</tr>
											<tr>									
											<td>Machine Model</td>							
											<td>									
												<input type="text" name="cdmachinemodel" class="col-md-12 form-control">
											</td>							
											</tr>
											<tr>									
											<td>Machine Sr. No.</td>							
											<td>									
												<input type="text" name="cdmachinesrno" class="col-md-12 form-control">
											</td>							
											</tr>
											<tr>									
											<td>Machine Location</td>							
											<td>									
												<input type="text" name="cdmachinelocation" class="col-md-12 form-control">
											</td>							
											</tr>
											<tr>									
											<td>Work Done</td>							
											<td>									
												<input type="text" name="cdworkdone" class="col-md-12 form-control">
											</td>							
											</tr>
											<tr>									
											<td>Pending Work</td>							
											<td>									
												<input type="text" name="cdpendingwok" class="col-md-12 form-control">
											</td>							
											</tr>
											<tr>									
											<td>Sign</td>							
											<td>									
												<input class="form-control" type="file" name="cdsign" accept="images/*" />
											</td>							
											</tr>
											<tr>									
											<td>Customer Remarks</td>							
											<td>									
												<input type="text" name="cdcustremarks" class="col-md-12 form-control">
											</td>							
											</tr>
										
											
											</table>
										</div>
									</div>
								</div>

							</div>
							<div class="modal-footer">
								<button type="submit" class="btn green">Submit <i class="fa fa-check"></i></button>
								<button type="button" data-dismiss="modal" class="btn dark btn-outline">Close <i class="fa fa-arrow-left"></i></button>
							</div>
							</form>
						</div>
					</div>
                </div>
				<!------------------Add Complain detail---------------------->

<!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
<!-- BEGIN QUICK SIDEBAR -->
<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
<div class="page-footer">
<div class="page-footer-inner">&copy; Arth Technology

</div>
<div class="scroll-to-top">
<i class="icon-arrow-up"></i>
</div>
</div>
</div>
<!-- END FOOTER -->
<!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<!-- BEGIN CORE PLUGINS -->

<script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->


<script src="../assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>


<script src="../assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="../assets/pages/scripts/ui-toastr.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap-toastr/toastr.min.js" type="text/javascript"></script>

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="../assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
<script src="../assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
<script src="../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->
<script src="../assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>


<script src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>


<script src="../assets/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="../assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
 
<script src="../assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>


			
<?php

if(isset($_SESSION['msg']))
{
	$tt = $_SESSION['msg'];
	echo "<input type=\"hidden\" id=\"mymsg\" value=\"$tt\"/>";
	unset($_SESSION['msg']);
	
	
?>	
								
		<script lang="javascript">

var a = [
    function () {
	

		var mymsg = document.getElementById("mymsg").value;
		toastr.success(mymsg, "Operation Completed")
		
    },
    function () {
        $('span').show();
    },
    function () {
        $('p').fadeIn(100);
    }
];		
					

a[0]();
</script>
	
<?php

}

if(isset($_SESSION['msg1']))
{
	$tt1 = $_SESSION['msg1'];
	echo "<input type=\"hidden\" id=\"mymsg1\" value=\"$tt1\"/>";
	unset($_SESSION['msg1']);
	
	
	?>	
								
		<script lang="javascript">

var a = [
    function () {
	

		var mymsg = document.getElementById("mymsg1").value;
		toastr.warning(mymsg, "Error")
		
    },
    function () {
        $('span').show();
    },
    function () {
        $('p').fadeIn(100);
    }
];		
					

a[0]();
</script>
	
<?php

}
?>				

<script>
	$(function()
	{
		$('#myForm').submit(function(e)
		{
			if($('#skills').val() == '0')
			{
				alert('Select Service Engineer!');
				e.preventDefault();
			}

		});
	});
</script>

<script>
	$(function()
	{
		$('#myForm1').submit(function(e)
		{
			if($('#skills1').val() == '0')
			{
				alert('Select Service Engineer!');
				e.preventDefault();
			}

		});
	});
</script>


<script>
	$(document).ready(function(){

		$(document).on('click', '#getUser', function(e){

			e.preventDefault();

			var uid = $(this).data('id');   // it will get id of clicked row

			$('#dynamic-content').html(''); // leave it blank before ajax call
			$('#modal-loader').show();      // load ajax loader

			$.ajax({
				url: 'astatus.php',
				type: 'POST',
				data: 'id='+uid,
				dataType: 'html'
			})
			.done(function(data){
				console.log(data);
				$('#dynamic-content').html('');
				$('#dynamic-content').html(data); // load response
				$('#modal-loader').hide();		  // hide ajax loader
			})
			.fail(function(){
				$('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
				$('#modal-loader').hide();
			});

		});

	});


</script>	
<script>
	$(document).ready(function(){

		$(document).on('click', '#getUser5', function(e){

			e.preventDefault();

			var uid = $(this).data('id');   // it will get id of clicked row

			$('#dynamic-content5').html(''); // leave it blank before ajax call
			$('#modal-loader').show();      // load ajax loader

			$.ajax({
				url: 'complainstatusdetail.php',
				type: 'POST',
				data: 'id='+uid,
				dataType: 'html'
			})
			.done(function(data){
				console.log(data);
				$('#dynamic-content5').html('');
				$('#dynamic-content5').html(data); // load response
				$('#modal-loader').hide();		  // hide ajax loader
			})
			.fail(function(){
				$('#dynamic-content5').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
				$('#modal-loader').hide();
			});

		});

	});

</script>	



<script>
	$(function()
	{
		$('#maintance2').submit(function(e)
		{
			if($('#smid').val() == '0')
			{
				alert('Select Status');
				e.preventDefault();
			}

		});
	});
</script><script>
	$(function()
	{
		$('#formitemadd').submit(function(e)
		{
			if($('#pmid').val() == '0')
			{
				alert('Select Item');
				e.preventDefault();
			}

		});
	});
</script>
		<script>
			
			$('#pmid').on('change',function(){
				

			$.get("getrate.php", { pmid : $(this).val() }, function(response) {

			//alert(response);
			//set the value of description text box
			$('#getrate').val( $.trim(response) );

			});
				
			});
			
			
			

		</script>
		<script type="text/javascript">
			$(function ()
			{
				$("#pamount").hide();
				$("#premark").hide();
				$("#paymode").hide();
				$("#pstatus").change(function ()
				{
					if ($(this).val() == "Paid")
					{
						$("#pamount").show();
						$("#premark").show();
						$("#paymode").show();
					}
					else
					{
						$("#pamount").hide();
						$("#premark").hide();
						$("#paymode").hide();
		            }
		        });
		    });
		</script>
</body>

</html>