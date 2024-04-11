<?php
session_start(); 
	
	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
		return;
	}
	$samid=$_SESSION['samid'];

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
        <title> Service (PPM) Edit | Admin Panel</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
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
        <link href="../assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="../assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
		<link href="../assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="favicon.ico" /> 
		<link href="../assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		
		</head>
    <!-- END HEAD -->
<?php

	include("connect.php");
	
		date_default_timezone_set("Asia/Kolkata");
		$mdate1= date('Y-m-d H:i:s');
		$custedate1 = date('d-m-Y',strtotime($mdate1 . "+30 days"));
		
	/* 	$ipaddress = "";

		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
			$ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
		
		$userserver=$_SERVER['HTTP_USER_AGENT'];
		$eve1 = "insert into res_admin_log (alid,almobile,allastupdatedtime,alpagename,altaskname,alipaddress,aluseragentdetail) values(NULL,'$par1','$mdate1','Customer','Edit Customer','$ipaddress','$userserver')";
		$re1 = mysqli_query($conn, $eve1);
	 */
?>

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <!-- BEGIN HEADER -->
      <?php
            require ('header.php');
			?>  <!-- END HEADER -->
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
                   
					<div class="portlet box blue-hoki green">
					<div class="portlet-title green">
						<div class="caption">
							<i class="fa fa-gift"></i><small>Edit Service (PPM)</small>  </div>
						<div class="actions">
							
						</div>
					</div>
					
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
					
					<div class="portlet-body form">
					<?php
						$servicemid=(int)mysqli_real_escape_string($conn,$_GET['id']);
						$eve = "select * from res_service_master  where servicemid=$servicemid and samid=$samid";
						$re = mysqli_query($conn, $eve);
						while($rt = mysqli_fetch_assoc($re))
						{
							
							$pmid1=$rt['pmid'];
							$custid1=$rt['custid'];
							
							$sstartdate=implode('-', array_reverse(explode('-', $rt['sstartdate'])));
							$senddate=implode('-', array_reverse(explode('-', $rt['senddate'])));
							$pdate=implode('-', array_reverse(explode('-', $rt['spurchasedate'])));
							$sremarks=$rt['sremarks'];
							$sserialno=$rt['sserialno'];
							$servicetype=$rt['servicetype'];
							$snoofservice=$rt['snoofseat'];
							$sservicecharge=$rt['sservicecharge'];
								$customeraddress="";
						
							$umobile="";
							$uemail="";
							$usite="";
							$ucity="";
								$managername="";
							$managermobile="";
							$inchargename="";
							$inchargemobile="";
						 $eve1 = "select * from res_user_master  where umid=$custid1";
						$re1 = mysqli_query($conn, $eve1);
						while($rt1 = mysqli_fetch_assoc($re1))
						{
							$customeraddress=$rt1['uaddress'];
							$serviceengineerid=$rt1['udefaultserviceengineer'];
							$umobile=$rt1['umobile'];
							$uemail=$rt1['emailid'];
							$usite=$rt1['usite'];
							$ucity=$rt1['ucity'];
								$managername=$rt1['uprojectmanagername'];
							$managermobile=$rt1['uprojectmanagermobile'];
							$inchargename=$rt1['uprojectinchargename'];
							$inchargemobile=$rt1['uprojectinchargemobile'];
						}
						
					?>				
					
									
				<!-- BEGIN FORM-->
				<form action="servicenewedit2.php" method="POST" class="form-horizontal" enctype="multipart/form-data" id="myForm">
				<input type="hidden" name="servicemid" value="<?php echo $servicemid; ?>">
					<div class="form-body">
					
					
					
							<div class="row">
								<div class="col-md-6">
								<div class="form-group">
								<label class="col-md-4 control-label">Customer<span class="required">*</span></label>
							<div class="col-md-8">
									<select class="form-control select2" name="custid" required>
										<option value="0">Select Customer</option>
										<?php
										$eve_main = "select * from res_user_master where utype='customer' and samid=$samid";
										$re_main = mysqli_query($conn, $eve_main);
										while($rt_main = mysqli_fetch_assoc($re_main))
										{

											$umid=$rt_main['umid'];
											$uname=$rt_main['uname'];
											if($custid1==$umid)
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
						<div class="col-md-6" >
							<div class="form-group">
						
								<label class="col-md-4 control-label"> Site</label>
								<div class="col-md-8" id="customersite">
									<input class="form-control" type="text" name="usite" value="<?php echo $usite; ?>" readonly>
								</div>
							</div>
							</div>
							</div>
							<div class="row">
								<div class="col-md-6" >
							<div class="form-group">		
								<label class="col-md-4 control-label"> Mobile</label>
								<div class="col-md-8" >
									<input class="form-control" type="text" name="customermobile" value="<?php echo $umobile; ?>" readonly>
								</div>
							</div>
							</div>
								<div class="col-md-6" >
							<div class="form-group">
						
								<label class="col-md-4 control-label"> Email</label>
								<div class="col-md-8" >
									<input class="form-control" type="text" name="uemail" value="<?php echo $uemail; ?>" readonly>
								</div>
							</div>
							</div>
								
							</div>
							<div class="row">
								<div class="col-md-6" >
							<div class="form-group">
								<label class="col-md-4 control-label"> Address</label>
								<div class="col-md-8" id="customeraddress">
									<input class="form-control" type="text" name="uaddress" value="<?php echo $customeraddress; ?>" readonly>
								</div>
							</div>
							</div>
								<div class="col-md-6" >
							<div class="form-group">
								<label class="col-md-4 control-label"> City</label>
								<div class="col-md-8" id="customercity">
									<input class="form-control" type="text" name="ucity" value="<?php echo $ucity; ?>" readonly>
								</div>
							</div>
							</div>
							</div>
							<div class="row">
								<div class="col-md-6" >
							<div class="form-group">
								<label class="col-md-4 control-label">Project Manager Name</label>
								<div class="col-md-8" id="managername">
									<input class="form-control" type="text" name="managername" value="<?php echo $managername; ?>" readonly>
								</div>
							</div>
							</div>
								<div class="col-md-6" >
							<div class="form-group">
								<label class="col-md-4 control-label">Project Manager Mobile</label>
								<div class="col-md-8" id="managermobile">
									<input class="form-control" type="text" name="managermobile" value="<?php echo $managermobile; ?>" readonly>
								</div>
							</div>
							</div>
							</div>
							<div class="row">
								<div class="col-md-6" >
							<div class="form-group">
								<label class="col-md-4 control-label">Project Incharge Name</label>
								<div class="col-md-8" id="inchargename">
									<input class="form-control" type="text" name="inchargename" value="<?php echo $inchargename; ?>" readonly>
								</div>
							</div>
							</div>
								<div class="col-md-6" >
							<div class="form-group">
								<label class="col-md-4 control-label">Project Incharge Mobile</label>
								<div class="col-md-8" id="inchargemobile">
									<input class="form-control" type="text" name="inchargemobile" value="<?php echo $inchargemobile; ?>" readonly>
								</div>
							</div>
							</div>
							</div>
							<div class="row">
								<div class="col-md-6" >
							<div class="form-group">
								<label class="col-md-4 control-label">Service Engineer</label>
								<div class="col-md-8">
									<select class="form-control select2" name="serviceengineerid">
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
							</div>
					<div class="col-md-6" >
							<div class="form-group">
								<label class="col-md-4 control-label">Serial No<span class="required">*</span></label>
								<div class="col-md-8">
								
									<input type="text" name="sserialno" value="<?php  echo $sserialno; ?>" class="form-control" aria-required="true" aria-invalid="false" aria-describedby="name-error" required>
								</div>
							</div>
							</div>
							</div>
							<div class="row">
							<div class="col-md-6" >
							<div class="form-group">
								<label class="col-md-4 control-label">Product<span class="required">*</span></label>
								<div class="col-md-8">
									<select class="form-control select2" name="pmid" required>
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
							</div>
								<div class="col-md-6" >
							<div class="form-group">
								<label class="col-md-4 control-label">Purchase Date</label>
								<div class="col-md-8">
									<input class="form-control form-control-inline  date-picker" data-date-format="dd-mm-yyyy" type="text" name="pdate" value="<?php echo $pdate;?>" required>
								</div>
							</div>
							</div>
								
							</div>
							<div class="row">
							<div class="col-md-6" >
							<div class="form-group">
								<label class="col-md-4 control-label">Service Type</label>
								<div class="col-md-8">
									<select name="servicetype" id="servicetype" class="form-control">
										<?php
										$eve_main = "select * from res_servicetype_master where samid=$samid";
										$re_main = mysqli_query($conn, $eve_main);
										while($rt_main = mysqli_fetch_assoc($re_main))
										{

											$umid=$rt_main['stypemid'];
											$uname=$rt_main['stypename'];
										
											if($servicetype==$uname){
												echo "<option value='$uname' Selected>$uname</option>";
											}
											else{
												echo "<option value='$uname'>$uname</option>";
											}
										}
									?>
										
									</select>
								</div>
							</div>
							</div>
							<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-4 control-label"> No Of Services(PPM) Given<span class="required">*</span></label>
								<div class="col-md-8">
								
									<input type="number" name="noofservice" value="<?php echo $snoofservice;?>" class="form-control" aria-required="true" aria-invalid="false" aria-describedby="name-error" max=20 required>
								</div>
							</div>
							</div>
								
								</div>
							<div class="row">
								<div class="col-md-6" >
							<div class="form-group" id="startdate">
								
								<label class="col-md-4 control-label">Start Date</label>
								<div class="col-md-8">
									<input class="form-control form-control-inline  date-picker" data-date-format="dd-mm-yyyy" type="text" name="sdate" value="<?php echo $sstartdate;?>" required>
								
							</div>
							
							</div>
							</div>
								<div class="col-md-6" >
							<div class="form-group" id="enddate">
								
								<label class="col-md-4 control-label">End Date</label>
								<div class="col-md-8">
									<input class="form-control form-control-inline  date-picker" data-date-format="dd-mm-yyyy" type="text" name="edate" value="<?php echo $senddate;?>" data-date-start-date="+0d" required >
							
							</div>
							</div>
							</div>
							</div>
							<div class="row">
								<div class="col-md-6" >
							<div class="form-group">
								<label class="col-md-4 control-label">Service Change</label>
								<div class="col-md-8">
									<input type="text" name="sservicecharge" value="<?php echo $sservicecharge; ?>" class="form-control" aria-required="true" aria-invalid="false" aria-describedby="name-error" >
								</div>
							</div>
							</div>
								<div class="col-md-6" >
							<div class="form-group">
								<label class="col-md-4 control-label">Remark</label>
								<div class="col-md-8">
									<input type="text" name="sremark" value="<?php echo $sremarks; ?>" class="form-control" aria-required="true" aria-invalid="false" aria-describedby="name-error" >
								</div>
							</div>
							</div>
							</div>
							<!-- /input-group -->
					
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-3 col-md-9">
								<button type="submit" class="btn green">Submit</button>
								<button type="button" class="btn grey-salsa btn-outline" onclick="document.location.href='service.php'">Cancel</button>
							</div>
						</div>
					</div>
				</form>
			<?php
						}
				?>
				
				<!-- END FORM-->
			</div>
		</div>            
					
                </div>
            </div>
                <!-- END CONTENT BODY -->
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
	
        <script src="../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
		<script src="../assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
		
		<script src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
		
       <script src="../assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
		 
		<script src="../assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
		
    </body>

</html>