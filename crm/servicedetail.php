<?php
session_start(); 

	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
	}
 
	include("connect.php");
	include('date_functions.php');

	$conn->query("set names utf8");

    $samid=$_SESSION['samid'];
	$mdate= date('d-m-Y');
	$mdate11= date('Y-m-d');
	
	updateComplaintStatus();
	
	$servicemid=(int)mysqli_real_escape_string($conn,$_GET['id']);
	$eve = "select * from res_service_master where servicemid=$servicemid";
	$re = mysqli_query($conn, $eve);
	$amcid1='';
	
	if(mysqli_num_rows($re) > 0)
	{
		while($rt = mysqli_fetch_assoc($re))
		{
			
			   $servicemid=$rt['servicemid'];
			   $serviceno=$rt['senofordisplay'];
			  $_SESSION['servicemid'] = $rt['servicemid'];
											
				$sstartdate=implode('-', array_reverse(explode('-', $rt['sstartdate'])));
				$senddate=implode('-', array_reverse(explode('-', $rt['senddate'])));
				$pdate=implode('-', array_reverse(explode('-', $rt['spurchasedate'])));
				$sremarks=$rt['sremarks'];
				$sserialno=$rt['sserialno'];
				$servicetype=$rt['servicetype'];
				$sservicecharge=$rt['sservicecharge'];
				
				$pmid=$rt['pmid'];
				$eve1 = "select * from res_product_master where pmid=$pmid";
				$re1 = mysqli_query($conn, $eve1);
				while($rt1 = mysqli_fetch_assoc($re1))
				{
					$pmname=$rt1['pmname'];
				}
					$sename="";
				$umid=$rt['custid'];
				$eve1 = "select * from res_user_master where umid=$umid";
				$re1 = mysqli_query($conn, $eve1);
				while($rt1 = mysqli_fetch_assoc($re1))
				{
					$uname=$rt1['uname'];
					$customeraddress=$rt1['uaddress'];
				
							$umobile=$rt1['umobile'];
							$uemail=$rt1['emailid'];
							$usite=$rt1['usite'];
							$ucity=$rt1['ucity'];
							$managername=$rt1['uprojectmanagername'];
							$managermobile=$rt1['uprojectmanagermobile'];
							$inchargename=$rt1['uprojectinchargename'];
							$inchargemobile=$rt1['uprojectinchargemobile'];
				$serviceengineerid=$rt1['udefaultserviceengineer'];
				$eve11 = "select * from res_user_master where umid=$serviceengineerid";
				$re11 = mysqli_query($conn, $eve11);
			
				while($rt11 = mysqli_fetch_assoc($re11))
				{
					$sename=$rt11['uname'];
				}
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
<title>Service Contract Detail | Admin Panel</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="httpss://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
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
<link rel="stylesheet" href="stylesheet.css" type="text/css" charset="utf-8" />

</head>
<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
<!-- BEGIN HEADER -->
<?php
            require ('header.php');
			?><!-- END HEADER -->
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
	
	<div class="portlet box blue-hoki">
	
		<div class="portlet-title" style="background-color:black;">
			<div class="caption">
				<i class="fa fa-gift"></i>Service Contract Details</div>
			<div class="actions">
				<a href="service.php" class="btn white btn-outline sbold" > Back </a>
			</div>
		</div>
		
		<div class="portlet-body">
		<div class="table-scrollable">
			<table class="table table-bordered">
				
				<tr>								
				
					 <th>Contract No</th>
					<td><?php echo $serviceno; ?> </td>
					<th>Customer Name</th>
					<td><?php echo $uname;?></td>
				</tr>
				<tr>								
				
					<th>Mobile No.</th>
					<td><?php echo $umobile;?></td>
					<th>Email Id</th>
					<td><?php echo $uemail;?></td>
				</tr>
				<tr>								
					<th>Service Engineer</th>
					<td><?php echo $sename;?></td>
					<th>Address</th>
					<td><?php echo $customeraddress;?></td>
			
				</tr>
				<tr>								
				
					<th>City</th>
					<td><?php echo $ucity;?></td>
					<th>Site</th>
					<td><?php echo $usite;?></td>
				</tr>
				
				<tr>								
				    <th>Purchase Date</th>
					<td><?php echo $pdate;?></td>
					<th>Remark</th>
					<td><?php echo $sremarks;?></td>
				</tr>
				<tr>								
				    <th>Start Date</th>
					<td><?php echo $sstartdate;?></td>
					<th>End Date</th>
					<td><?php echo $senddate;?></td>
				</tr>
				
				<tr>								
				    <th>Serial No</th>
					<td><?php echo $sserialno;?></td>
					<th>Product Name</th>
					<td><?php echo $pmname;?></td>
				</tr>
				<tr>								
				
					<th>Project Manager Name</th>
					<td><?php echo $managername;?></td>
					<th>Project Manager Mobile</th>
					<td><?php echo $managermobile;?></td>
				</tr>
				<tr class="hidden">							
				
					<th>Project Incharge Name</th>
					<td><?php echo $inchargename;?></td>
					<th>Project Incharge Mobile</th>
					<td><?php echo $inchargemobile;?></td>
				</tr>
				<tr>
				
				   <th>Contract Type</th>
					<td><?php echo $servicetype;?></td>
					<th>Contract Charge</th>
					<td><?php echo $sservicecharge; ?> </td>
				</tr>
				
				
				
			</table>
		</div>
</div>


</form>

<!-- END FORM-->


</div>
<!-- portlet end --->
 <div class="portlet box green">
                                <div class="portlet-title">
						<div class="caption">
							<i class="fa fa-wrench"></i><small>Service PPM Call Details</small>
						</div>
						<div class="actions">
							<a class="btn white btn-outline sbold" data-toggle="modal" href="#responsiveremark21"> Add New <i class="fa fa-plus"></i></a>
						</div>
					</div>
					<div class="portlet-body">
					<form method="post">
						<table class="table table-bordered">
							<tr>
								<th>Serial ID</th>
								
								<th>Ticket ID</th>
								<th>Product</th>
								<th>Call Type</th>
								<th>Service Date</th>
								<th>Service Status</th>
								
								
							</tr>
							<?php		
											
											$count=1;
											$no=1;
										    $eve_deal = "select * from res_complain_master where samid=$samid and servicemid=$servicemid";
											$re_deal = mysqli_query($conn, $eve_deal);
											$t1=0;
											while($rt_deal = mysqli_fetch_assoc($re_deal))
											{
												
												$servicemid=$rt_deal['servicemid'];
												$cmnowithprefix=$rt_deal['cmnowithprefix'];
												$cmid=$rt_deal['cmid'];
												$cstatus=$rt_deal['cstatus'];
												$cmtype=$rt_deal['cmtype'];
												$pmid=$rt_deal['pmid'];
												$cmdate=implode('-', array_reverse(explode('-', $rt_deal['cmdate'])));
												$cmdaytenew="<button data-toggle='modal' data-target='#view-modal' data-id='$cmid' id='getUser' class='btn btn-xs btn-danger'>$cmdate <i class='fa fa-pencil'></i></button>";
												
												$eve212 = "select * from res_product_master where pmid=$pmid";
												$re212 = mysqli_query($conn, $eve212);
												while($rt212 = mysqli_fetch_assoc($re212))
												
												{
													$pmname=$rt212['pmname'];
												} 
												
											 	$eve2122 = "select * from res_service_master where servicemid=$servicemid";
												$re2122 = mysqli_query($conn, $eve2122);
												
												while($rt2122 = mysqli_fetch_assoc($re2122))
												{
													$sserialno=$rt2122['sserialno'];
												} 
												/* if($cstatus=="Pending")
												{
													$cstatus1="<button data-toggle='modal' data-target='#view-modal1' data-id='$cmid' id='getUser1' class='btn btn-xs btn-success'>Pending</i></button>";
												}
												else if($cstatus=="In Process")
												{
													$cstatus1="<button data-toggle='modal' data-target='#view-modal1' data-id='$cmid' id='getUser1' class='btn btn-xs btn-warning'>In Process</button>";
												}
												else if($cstatus=="Completed")
												{
													$cstatus1="<button data-toggle='modal'  data-id='$cmid' id='getUser1' class='btn btn-xs btn-danger'>Completed</button>";
												}
												else if($cstatus=="Cancel")
												{
													$cstatus1="<button data-toggle='modal' data-target='#view-modal1' data-id='$cmid' id='getUser1' class='btn btn-xs btn-clear'>Cancel</button>";
												}
												else if($cstatus=="Scheduled")
												{
													$cstatus1="<button data-toggle='modal' data-target='#view-modal1' data-id='$cmid' id='getUser1' class='btn btn-xs btn-primary'>Scheduled</button>";
												} */
												
								
										?>	
												<tr>
													<td><?php echo $no;?></td>
													
													<td><?php echo $cmnowithprefix;?></td>
													<td><?php echo $pmname;?></td>
													<td><?php echo $cmtype;?></td>
													<td><?php echo $cmdaytenew;?></td>
													<td><?php echo $cstatus;?></td>
													
													 
												</tr>
										<?php
										$no++;
											}
											
										?>
						</table>
					</form>
					</div>
                </div>
				<?php if(1===2) { ?>
		<div class="portlet box blue">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-file-archive-o"></i><small>Item Detail</small>
						</div>
						<div class="actions">
						
						
						<a class="btn white btn-outline sbold" data-toggle="modal" href="#responsiveremark2"> Add New <i class="fa fa-plus"></i></a>
						</div>
					</div>
					<div class="portlet-body">
					<form method="post" action="#">
						<table class="table table-bordered">
							<tr>
								<th>Sr No</th>
								<th>Operation</th>
								<th>Date</th>
								<th>Name</th>
								<th>QTY</th>
								<th>Rate</th>
								<th>Total Amount</th>
								<th>Service Engineer</th>
								
								

							</tr>
							<?php		
											
											$count=1;
											$totamount=0;
												$engname="";
											$eve_deal = "select * from res_serviceitem_detail where servicemid=$servicemid";
											$re_deal = mysqli_query($conn, $eve_deal);

											while($rt_deal = mysqli_fetch_assoc($re_deal))
											{
												$cmid=$rt_deal['servicemid'];
												$cidid=$rt_deal['sitemdid'];
												$cidqty=$rt_deal['sidqty'];
												$cidrate=$rt_deal['sidrate'];
												$date=$rt_deal['sitemdate'];
												$serviceengid=$rt_deal['serviceengid'];
												$amount=$rt_deal['sidrate']*$cidqty;
												$totamount=$totamount+$amount;
												
												$pmid=$rt_deal['pmid'];
												$eve2 = "select * from res_product_master where pmid=$pmid";
												$re2 = mysqli_query($conn, $eve2);
												while($rt2 = mysqli_fetch_assoc($re2))
												{
													$pmname=$rt2['pmname'];
													
												} 
											
												$eve21 = "select * from res_user_master where umid=$serviceengid";
												$re21= mysqli_query($conn, $eve21);
												while($rt21 = mysqli_fetch_assoc($re21))
												{
													$engname=$rt21['uname'];
													
												} 
												$uedit="<a href='sitemdetailedit.php?id=".$cidid."' data-toggle='tooltip' data-placement='top' title='Edit' class='fa fa-edit fa-lg'>  </a>";
											
												$udelete="<a href='sitemdetaildelete.php?id=".$cidid ."' onclick='return confirm(&#39;Are you sure you want to delete ?&#39;);' data-toggle='tooltip' data-placement='top' title='Delete' class='fa fa-trash-o fa-lg'>  </a>";
												
												//$mail="<a  href='paymentsendmail.php?id=".$cidid ."'   onclick=' data-toggle='tooltip' data-placement='top' title='Email' class='fa fa-envelope'></a>";
												
												$op=$uedit."&nbsp;&nbsp;&nbsp; ".$udelete;
												
										?>	
							<tr>
								<td><?php echo $count++;?></td>
								<td><?php echo $op;?></td>
								<td><?php echo $date;?></td>
								<td><?php echo $pmname;?></td>
								<td><?php echo $cidqty;?></td>
								<td><?php echo $cidrate;?></td>
								<td><?php echo $amount;?></td>
								<td><?php echo $engname;?></td>
								
								
							</tr>
							
										<?php
											}
											
										?>
									<tr>
										    <th colspan="5" ></th>
										    <th >Total</th>
											<td><?php echo $totamount;?></td>
											</tr>
						</table>
						</form>
					</div>
                </div>
				<?php } ?>



</div>
</div>
<div id="responsiveremark21" class="modal fade" tabindex="-1" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								<h4 class="modal-title"><i class="fa fa-plus"></i> Add New Service</h4>
						</div>
				<form method="post" action="servicenewadd2.php" enctype="multipart/form-data" class="form-horizontal" >		
				<input type="hidden" name="servicemid" value="<?php echo $_GET['id'];?>">
				<input type="hidden" name="customerid" value="<?php echo $umid;?>">

				<div class="modal-body">						
				<div class="scroller" style="height:220px" data-always-visible="1" data-rail-visible1="1">							
				<div class="row">					
				<div class="col-md-12">							
				<table class="table table-bordered">
			 <?php 
			  $eve12 = "select * from res_complain_master where samid=$samid and servicemid=$servicemid";
											$re12= mysqli_query($conn, $eve12);
										
											while($rt12 = mysqli_fetch_assoc($re12))
											{
												
												
												
												$pmid1=$rt12['pmid'];
												
												
												$eve2121 = "select * from res_product_master where pmid=$pmid1";
												$re2121 = mysqli_query($conn, $eve2121);
												while($rt2121 = mysqli_fetch_assoc($re2121))
												
												{
													$pmname1=$rt2121['pmname'];
												} 
											}
			 ?>
			 <div class="form-group">
								<label class="col-md-3 control-label">Product</label>
								<div class="col-md-5">
								<input class="form-control" type="hidden" name="pmid" value="<?php echo $pmid1;?>" readonly>
									<input class="form-control" type="text" name="productname" value="<?php echo $pmname1;?>" readonly>
								</div>
						</div>
			 
					<div class="form-group">
								<label class="col-md-3 control-label">Service Type</label>
								<div class="col-md-5">
								
									<input class="form-control" type="text" name="servicetype" value="<?php echo $servicetype;?>" readonly>
								</div>
						</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Service Date</label>
								<div class="col-md-5">
								
									<input class="form-control form-control-inline  date-picker" data-date-format="dd-mm-yyyy" type="text" name="servicedate" value="<?php echo $mdate;?>" required>
								</div>
						</div>
						<div class="form-group">
								<label class="col-md-3 control-label">Service Engineer</label>
								<div class="col-md-5">
								
									<select class="form-control select" name="serviceengineerid">
										<?php
										$eve_category1 = "select * from res_user_master where utype='serviceengineer' and samid='$samid'";
										$re_category1 = mysqli_query($conn, $eve_category1);
										while($rt_category1 = mysqli_fetch_assoc($re_category1))
										{

											$umid1=$rt_category1['umid'];
											
											$uname1=urldecode($rt_category1['uname']);
											
											if($serviceengineerid==$umid1){
												echo "<option value='$umid1' selected>$uname1</option>";
											}
											else{
												echo "<option value='$umid1'>$uname1</option>";
											}

										}
									?>
									</select>
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
	
				<div id="responsiveremark2" class="modal fade" tabindex="-1" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								<h4 class="modal-title"><i class="fa fa-plus"></i> Add New</h4>
						</div>
				<form method="post" action="serviceitemadd2.php" enctype="multipart/form-data" class="form-horizontal" >		
				<input type="hidden" name="servicemid" value="<?php echo $_GET['id'];?>">

				<div class="modal-body">						
				<div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1">							
				<div class="row">					
				<div class="col-md-12">							
				<table class="table table-bordered">
			 
							
								<div class="form-group">
								<label class="col-md-3 control-label">Item<span class="required">*</span></label>
								<div class="col-md-5">
									<select class="form-control" name="pmid" id="skills" for="skills" onchange="skills" required>
										<option value="">Select Item</option>
										<?php
									 	$eve_main = "select * from res_product_master where samid=$samid and ptype='Item'";
								
										$re_main = mysqli_query($conn, $eve_main);
										while($rt_main = mysqli_fetch_assoc($re_main))
										{

											$pmid=$rt_main['pmid'];
											$pmname=$rt_main['pmname'];
											if($pmid1==$pmid)
											{
												echo "<option value='$pmid' selected>$pmname</option>";
											}
											else
											{
												echo "<option value='$pmid'>$pmname</option>";
											}

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
								
									<input type="text" name="cidrate" id="dcontact11"  class="form-control" aria-required="true" aria-invalid="false" aria-describedby="name-error" required>
								</div>
						</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Date</label>
								<div class="col-md-5">
								
									<input class="form-control form-control-inline  date-picker" data-date-format="dd-mm-yyyy" type="text" name="itemdate" value="<?php echo $mdate;?>" required>
								</div>
						</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Service Engineer</label>
								<div class="col-md-5">
									<select class="form-control" name="serviceengineerid">
										<?php
										$eve_category1 = "select * from res_user_master where utype='serviceengineer' and samid='$samid'";
										$re_category1 = mysqli_query($conn, $eve_category1);
										while($rt_category1 = mysqli_fetch_assoc($re_category1))
										{

											$umid1=$rt_category1['umid'];
											
											$uname1=urldecode($rt_category1['uname']);
											
										
												echo "<option value='$umid1'>$uname1</option>";
										
										}
									?>
									</select>
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


	
<!------------------Start Driver Allocation------------------------->
	
					<div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		 <div class="modal-dialog">
			  <div class="modal-content">

				   <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title">
							<i class="glyphicon glyphicon-user"></i> Select PPM Date
						</h4>
				   </div>
					 <form name="form1" method="post" action="servicedate2.php">
					 <input type="hidden" name="servicemid" value="<?php echo $_GET['id'];?>">
						<input type="hidden" name="customerid" value="<?php echo $umid;?>">
				   <div class="modal-body">
					 <div id="modal-loader" style="display: none; text-align: center;">
						<img src="ajax-loader.gif">
					   </div>

					   <!-- content will be load here -->
					   <div id="dynamic-content1"></div>

					</div>
					<div class="modal-footer">
						<button type="submit" class="btn green" value="Submit"><i class="fa fa-check"></i> Submit</button>
						  <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-arrow-left"></i>  Close</button>
					</div>
				</form>
			 </div>
		  </div>
	</div>
				<!------------------End Driver Allocation------------------------->
				<div id="view-modal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		 <div class="modal-dialog">
			  <div class="modal-content">

				   <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title">
							<i class="glyphicon glyphicon-user"></i> Edit Complain Status
						</h4>
				   </div>
				<form name="form1" method="post" action="aedit2.php?type=service&sid=<?php echo $servicemid; ?>" enctype="multipart/form-data">
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




<script type="text/javascript">
$(function () {
$("#emailinput").hide();
$("#emailinput1").hide();
$("#emailinput2").hide();
$("#emailsubject").hide();
$("#emailc").change(function () {
if ($(this).val() == "1") {
$("#emailinput").show();
$("#emailinput1").show();
$("#emailinput2").show();
$("#emailsubject").show();
} else {
$("#emailinput").hide();
$("#emailinput1").hide();
$("#emailinput2").hide();
$("#emailsubject").hide();
}
});
});

$(function () {
$("#smsinput").hide();
$("#smsinput1").hide();
$("#smsmessage").hide();

$("#smsc").change(function () {
if ($(this).val() == "1") {
$("#smsinput").show();
$("#smsinput1").show();
$("#smsmessage").show();
} else {
$("#smsinput").hide();
$("#smsinput1").hide();
$("#smsmessage").hide();
}
});
});


$(function () {
$("#pono").hide();
$("#podate").hide();

$("#qstatus").change(function () 
{
if ($(this).val() == "Converted To Sales") 
{
$("#pono").show();
$("#podate").show();	
} 
else 
{
$("#pono").hide();
$("#podate").hide();
}
});
});




</script>


<script>
$(document).ready(function(){

$(document).on('click', '#getCustomer', function(e){

e.preventDefault();

var uid = $(this).data('id');   // it will get id of clicked row

$('#dynamic-content').html(''); // leave it blank before ajax call
$('#modal-loader').show();      // load ajax loader

$.ajax({
url: 'orderreminder1.php',
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

<script type="text/javascript">
$(function () 
{
$("#tmbankname").hide();
$("#tmchkno").hide();
$("#tmode").change(function () 
{
if ($(this).val() == "Cheque") 
{
$("#tmbankname").show();
$("#tmchkno").show();
}
else
{
$("#tmbankname").hide();
$("#tmchkno").hide();
}
});
});
</script>



<script>
	$(document).ready(function(){

		$(document).on('click', '#getUser', function(e){

			e.preventDefault();

			var uid = $(this).data('id');   // it will get id of clicked row

			$('#dynamic-content1').html(''); // leave it blank before ajax call
			$('#modal-loader').show();      // load ajax loader

			$.ajax({
				url: 'servicedate.php',
				type: 'POST',
				data: 'id='+uid,
				dataType: 'html'
			})
			.done(function(data){
				console.log(data);
				$('#dynamic-content1').html('');
				$('#dynamic-content1').html(data); // load response
				$('#modal-loader').hide();		  // hide ajax loader
			})
			.fail(function(){
				$('#dynamic-content1').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
				$('#modal-loader').hide();
			});

		});

	});

</script>
<script>
	$(document).ready(function(){

		$(document).on('click', '#getUser1', function(e){

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

			$('#skills').on('change',function(){

			$.get("itemrate.php", { skills : $(this).val() }, function(response) {

			//alert(response);
			//set the value of description text box
			$('#dcontact11').val( $.trim(response) );

			});
			
			});
		</script>	
</body>

</html>