<?php
session_start(); 
	include("connect.php");
	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
	}
	$samid=$_SESSION['samid'];
	
	$conn->query("set names utf8");

 
	$mdate1= date('d-m-Y');
	$mdate= date('d-m-Y');
	$custedate1 = date('d-m-Y',strtotime($mdate . "+365 days"));
	
	
	$amcid=(int)mysqli_real_escape_string($conn,$_GET['id']);
	$umid=(int)mysqli_real_escape_string($conn,$_GET['id']);
	$_SESSION['userid']=$umid;
	$eve = "select * from res_user_master where umid=$umid";
	$re = mysqli_query($conn, $eve);
	if(mysqli_num_rows($re) > 0)
	{
		while($rt = mysqli_fetch_assoc($re))
		{
			$uname=$rt['uname'];
			$umobile=$rt['umobile'];
			$upassword=$rt['upassword'];
				$utype=$rt['utype'];
				$utype1="";
				if($utype=="customer")
				{
					$utype1="<span class='label label-sm label-success'>customer</span>";
				}
				else if($utype=="serviceengineer")
				{
					$utype1="<span class='label label-sm label-warning'>serviceengineer</span>";
				}
			$emailid=$rt['emailid'];
			$uaddress=$rt['uaddress'];
			$ucity=$rt['ucity'];
			$uloc1=$rt['uloc1'];
			$uloc2=$rt['uloc2'];	
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
<title>Customer AMC Detail| Admin Panel</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
<link href="../../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="../../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
<link href="../../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="../../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
<link href="../../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN THEME GLOBAL STYLES -->
<link href="../../assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
<link href="../../assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
<!-- END THEME GLOBAL STYLES -->
<!-- BEGIN THEME LAYOUT STYLES -->
<link href="../../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
<link href="../../assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="../../assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
<link href="../../assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<link href="../../assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
<link href="../../assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
<link href="../../assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
<!-- END THEME LAYOUT STYLES -->
<link href="../../assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css" />
<link href="../../assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="../../assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico" /> 

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

</head>
<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
<!-- BEGIN HEADER INNER -->
<div class="page-header-inner ">
<!-- BEGIN LOGO -->
<div class="page-logo">
<a href="#">
<img src="../../assets/layouts/layout/img/logo.png" alt="logo" class="logo-default" /> </div>
</div>
<!-- END LOGO -->
<!-- BEGIN RESPONSIVE MENU TOGGLER -->
<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
<!-- END RESPONSIVE MENU TOGGLER -->
<!-- BEGIN TOP NAVIGATION MENU -->
<div class="top-menu">
<ul class="nav navbar-nav pull-right">
<!-- BEGIN NOTIFICATION DROPDOWN -->
<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->

					<li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <img alt="" class="img-circle" src="../assets/layouts/layout/img/avatar3_small.png" />
                                <span class="username username-hide-on-mobile"> <?php echo $_SESSION['uname'];?> </span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">
                              
                                <li>
                                    <a href="changepassword.php">
                                        <i class="icon-lock"></i> Change Password </a>
                                </li>
                               
                                <li>
                                    <a href="logout.php">
                                        <i class="icon-logout"></i> Log Out </a>
                                </li>
                            </ul>
                        </li>

<!-- END NOTIFICATION DROPDOWN -->

</ul>
</div>
<!-- END TOP NAVIGATION MENU -->
</div>
<!-- END HEADER INNER -->
</div>
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
                                <div class="portlet-title">
						<div class="caption">
						<i class="fa fa-tv"></i>	<small>Complain Detail</small>
						</div>
						<div class="actions">
							
							<a class="btn white btn-outline sbold"  href="customeramc.php"><i class='fa fa-arrow-left'></i> Back </a>
						</div>
					</div>
					<div class="portlet-body">
		<div class="table-scrollable">
			<table class="table table-bordered">
				<tr>
					<th>User Name</th>
					<td><?php echo $uname;?></td>
				</tr>
				<tr>
					<th>User Type</th>
					<td><?php echo $utype1;?></td>
				</tr>
				<tr>
					<th>User Mobile</th>
					<td><?php echo $umobile;?></td>
				</tr>
				
				<tr>
					<th>User Email</th>
					<td><?php echo $emailid;?></td>
				</tr>
				
				<tr>
					<th>User Address</th>
					<td><?php echo $uaddress;?></td>
				</tr>
				<tr>
					<th>User City</th>
					<td><?php echo $ucity;?></td>
				</tr>
				<tr>
					<th>Latitude</th>
					<td><?php echo $uloc1;?></td>
				</tr>
				
				<tr>
					<th>Longitude</th>
					<td><?php echo $uloc2;?></td>
				</tr>
			</table>
		</div>
</div>
</div>
<?php if($utype!='serviceengineer'){?>
 <div class="portlet box blue">
                                <div class="portlet-title">
						<div class="caption">
							<small><i class='fa fa-plus'></i> AMC</small>
						</div>
						<div class="actions">
							<a href="customeramc.php" class="btn white btn-outline sbold" ><i class='fa fa-arrow-left'></i> Back </a>
						<a class="btn white btn-outline sbold" data-toggle="modal" href="#responsiveremark"><i class='fa fa-plus'></i> Add AMC</a>
							
						</div>
					</div>
					<div class="portlet-body">
					<form method="post">
						<table class="table table-bordered">
							<tr>
								<th>AMC ID</th>
								<th>Product</th>
								<th>Serial No</th>
								<th>Start Date </th>
								<th>End Date</th>
								<th>No Of Service Given</th>
								<th>Reamrks</th>
								<th>Operation</th>
								

							</tr>
							<?php		
											
											$count=1;
											$eve_deal = "select * from res_amc_master where umid=".$_GET['id'];
											$re_deal = mysqli_query($conn, $eve_deal);
											$t1=1;	
											$amcid1='';
											
											while($rt_deal = mysqli_fetch_assoc($re_deal))
											{
												
												$amcid=$rt_deal['amcid'];
												if($t1==1)
												{
													$amcid1 = $amcid1.$rt_deal['amcid'];
													$t1=0;
												}
												else
												{
													$amcid1 = $amcid1.",".$rt_deal['amcid'];
												}
												
												$customerid=$rt_deal['umid'];
												$pmid=$rt_deal['pmid'];
												$amcserial=$rt_deal['amcserial'];
												$amcnoofseat=$rt_deal['amcnoofseat'];
												$custremarks=$rt_deal['custremarks'];
												$amctype=$rt_deal['amctype'];
												
												$custsdate=implode('-', array_reverse(explode('-', $rt_deal['custsdate'])));
												
												//$custedate = date('d-m-Y', strtotime('+1 years'));
												$custedate=implode('-', array_reverse(explode('-', $rt_deal['custedate'])));
												
												$eve21 = "select * from res_product_master where pmid=$pmid";
												$re21 = mysqli_query($conn, $eve21);
												while($rt21 = mysqli_fetch_assoc($re21))
												{
													$pmname=$rt21['pmname'];
												} 
												
												
												$udelete="<a href='amcdelete.php?id=".$amcid ."' onclick='return confirm(&#39;Are you sure you want to delete ?&#39;);' data-toggle='tooltip' data-placement='top' title='Delete' class='fa fa-trash-o fa-lg'>  </a>";
								
												$op=$udelete;
								
												
										?>	
												<tr>
													<td><?php echo $amcid;?></td>
													<td><?php echo $pmname;?></td>
													<td><?php echo $amcserial;?></td>
													<td><?php echo $custsdate;?></td>
													<td><?php echo $custedate;?></td>
													<td><?php echo $amcnoofseat;?></td>
													<td><?php echo $custremarks;?></td>
													<td><?php echo $op;?></td>
												</tr>
										<?php
											}
										?>
						</table>
					</form>
					</div>
                </div>
							<?php }?>
							
							 <div class="portlet box green">
                                <div class="portlet-title">
						<div class="caption">
							<i class="fa fa-wrench"></i><small>Service Details</small>
						</div>
						<div class="actions">
							
						</div>
					</div>
					<div class="portlet-body">
					<form method="post">
						<table class="table table-bordered">
							<tr>
								<th>Serial No</th>
								<th>AMC ID</th>
								<th>Service ID</th>
								<th>Product</th>
								<th>Service Date</th>
								<th>Service Status</th>
								
							</tr>
							<?php		
											
											$count=1;
											$eve_deal = "select * from res_complain_master where samid=$samid and customerid=$umid and amcid in($amcid1)";
											$re_deal = mysqli_query($conn, $eve_deal);

											while($rt_deal = mysqli_fetch_assoc($re_deal))
											{
												$amcid=$rt_deal['amcid'];
												$cmid=$rt_deal['cmid'];
												$cstatus=$rt_deal['cstatus'];
												$pmid=$rt_deal['pmid'];
												$cmdate=implode('-', array_reverse(explode('-', $rt_deal['cmdate'])));
												
												$eve212 = "select * from res_product_master where pmid=$pmid";
												$re212 = mysqli_query($conn, $eve212);
												while($rt212 = mysqli_fetch_assoc($re212))
												
												{
													$pmname=$rt212['pmname'];
												} 
												
												$eve2122 = "select * from res_amc_master where amcid=$amcid";
												$re2122 = mysqli_query($conn, $eve2122);
												
												while($rt2122 = mysqli_fetch_assoc($re2122))
												{
													$amcserial=$rt2122['amcserial'];
												} 
												/* $udelete="<a href='servicedelete.php?id=".$cmid ."' onclick='return confirm(&#39;Are you sure you want to delete ?&#39;);' data-toggle='tooltip' data-placement='top' title='Delete' class='fa fa-trash-o fa-lg'>  </a>";
								
												$op=$udelete; */
								
										?>	
												<tr>
													<td><?php echo $amcserial;?></td>
													<td><?php echo $amcid;?></td>
													<td><?php echo $cmid;?></td>
													<td><?php echo $pmname;?></td>
													<td><?php echo $cmdate;?></td>
													<td><?php echo $cstatus;?></td>
													
												</tr>
										<?php
											}
										?>
						</table>
					</form>
					</div>
                </div>
							
							<!--<div class="portlet box blue-hoki black">
					<div class="portlet-title" style="background-color:purple;">
						<div class="caption">
							<i class="fa fa-gift"></i><small>Date List</small>
						</div>
						<div class="actions">
							<?php 
							$eve11 = "select * from res_amc_master where umid=$umid";
							$re11 = mysqli_query($conn, $eve11);
							/* if(mysqli_num_rows($re11) > 0)
							{}else{ */
						?>
					
						
							
						</div>
					</div>
					<div class="portlet-body">
					<form method="post">
						<table class="table table-bordered">
							<tr>
								<th>Sr No</th>
								<th>Date</th>
								
							</tr>
							<?php		
											$count=1;
											$eve_deal = "select * from res_amc_master where umid=".$_GET['id'];
											$re_deal = mysqli_query($conn, $eve_deal);

											while($rt_deal = mysqli_fetch_assoc($re_deal))
											{
												$amcid=$rt_deal['amcid'];
												
												/* $pmid=$rt_deal['pmid'];
												$amcserial=$rt_deal['amcserial'];
												$amcnoofseat=$rt_deal['amcnoofseat'];
												$custremarks=$rt_deal['custremarks'];
												$amctype=$rt_deal['amctype']; */
												
												$custsdate=implode('-', array_reverse(explode('-', $rt_deal['custsdate'])));
												$custedate = date('d-m-Y', strtotime('+1 years'));
												//$custedate=implode('-', array_reverse(explode('-', $rt_deal['custedate'])));
												
												/* $eve21 = "select * from res_product_master where pmid=$pmid";
												$re21 = mysqli_query($conn, $eve21);
												while($rt21 = mysqli_fetch_assoc($re21))
												{
													$pmname=$rt21['pmname'];
												}  */
												
												
												$udelete="<a href='amcdelete.php?id=".$amcid ."' onclick='return confirm(&#39;Are you sure you want to delete ?&#39;);' data-toggle='tooltip' data-placement='top' title='Delete' class='fa fa-trash-o fa-lg'>  </a>";
								
												$op=$udelete;
								
												
										?>	
												<tr>
													<td><?php echo $count++;?></td>
													<td><?php echo $custsdate;?></td>
													
												</tr>
										<?php
											}
										?>
						</table>
					</form>
					</div>
                </div>-->
</div>


					<div id="responsiveremark" class="modal fade" tabindex="-1" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								<h4 class="modal-title">Add New</h4>
						</div>
				<form method="post" action="useramcadd2.php" enctype="multipart/form-data" class="form-horizontal" >		
				<input type="hidden" name="umid" value="<?php echo $_GET['id'];?>">

				<div class="modal-body">						
				<div class="scroller" style="height:400px" data-always-visible="1" data-rail-visible1="1">							
				<div class="row">					
				<div class="col-md-12">							
				<table class="table table-bordered">
			 
						
				
							
								<div class="form-group">
								<label class="col-md-3 control-label">Product<span class="required">*</span></label>
								<div class="col-md-5">
									<select class="form-control" name="pmid" required>
										<option value="0">Select Product</option>
										<?php
										$eve_main = "select * from res_product_master where samid=$samid";
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
								<label class="col-md-3 control-label">Serial No<span class="required">*</span></label>
								<div class="col-md-5">
								
									<input type="text" name="amcserial" value="" class="form-control" aria-required="true" aria-invalid="false" aria-describedby="name-error" required>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-3 control-label">Start Date</label>
								<div class="col-md-5">
									<input class="form-control form-control-inline  date-picker" data-date-format="dd-mm-yyyy" type="text" name="custsdate" value="<?php echo $mdate;?>" required>
								</div>
							</div>
							
							
							<div class="form-group">
								<label class="col-md-3 control-label">End Date</label>
								<div class="col-md-5">
									<input class="form-control form-control-inline  date-picker" data-date-format="dd-mm-yyyy" type="text" name="custedate" value="<?php echo $custedate1;?>" data-date-start-date="+0d" required >
								</div>
							</div>
							
							
							<div class="form-group">
							
								<label class="col-md-3 control-label">No of Service Given<span class="required">*</span></label>
								<div class="col-md-5">
								
									<input type="number" name="amcnoofseat" value="2" class="form-control" aria-required="true" aria-invalid="false" aria-describedby="name-error" required>
								</div>
								
							</div>
							
							<div class="form-group">
								<label class="col-md-3 control-label">Remark</label>
								<div class="col-md-5">
									<input type="text" name="custremarks" value="" class="form-control" aria-required="true" aria-invalid="false" aria-describedby="name-error" >
								</div>
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
				
				<div id="responsiveremark1" class="modal fade" tabindex="-1" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								<h4 class="modal-title">Add New</h4>
						</div>
				<form method="post" action="useramcadd2.php" enctype="multipart/form-data" class="form-horizontal" >		
				<input type="hidden" name="umid" value="<?php echo $_GET['id'];?>">

				<div class="modal-body">						
				<div class="scroller" style="height:200px" data-always-visible="1" data-rail-visible1="1">							
				<div class="row">					
				<div class="col-md-12">							
				<table class="table table-bordered">
			 
				<label class="col-md-3 control-label">AMC Type<span class="required"></span></label>
				<label class="col-md-3 control-label"><?php echo $amctype?><span class="required"></span></label>
								
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
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<!-- BEGIN CORE PLUGINS -->

<script src="../../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="../../assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->


<script src="../../assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>


<script src="../../assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="../../assets/pages/scripts/ui-toastr.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-toastr/toastr.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
		<script src="../assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
		
		<script src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<!-- BEGIN PAGE LEVEL SCRIPTS -->

<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="../../assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
<script src="../../assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
<script src="../../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->


<script src="../../assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>


<script src="../../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>


<script src="../../assets/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
 
<script src="../../assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>



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
</body>

</html>