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
        <title>Customer Edit | Admin Panel</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
		<link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"  type='text/css'>
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
        <link href="../../assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="../../assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
		<link href="../../assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="favicon.ico" /> 
		<link href="../../assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		
		</head>
    <!-- END HEAD -->
<?php

	include("connect.php");
	
		date_default_timezone_set("Asia/Kolkata");
		$mdate1= date('Y-m-d H:i:s');
		$mdate= date('d-m-Y');
		
		
	
?>

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
                   
					<div class="portlet box blue-hoki green">
					<div class="portlet-title green">
						<div class="caption">
							<i class="fa fa-user"></i><small>Edit Customer</small>  </div>
						<div class="actions">
							
						</div>
					</div>
					
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
					
					<div class="portlet-body form">
							
					<?php
						$umid=(int)mysqli_real_escape_string($conn,$_GET['id']);
						$eve = "select * from res_user_master where umid=$umid and samid=$samid";
						$re = mysqli_query($conn, $eve);

						 while($rt = mysqli_fetch_assoc($re))
						 {
							$uname=$rt['uname'];
							$umobile=$rt['umobile'];
							$upassword=$rt['upassword'];
							$utype1=$rt['utype'];
							$emailid=$rt['emailid'];
							$uaddress=$rt['uaddress'];
							$ucity=$rt['ucity'];
							$uloc1=$rt['uloc1'];
							$uloc2=$rt['uloc2'];
							$upriority=$rt['upriority'];
							$usite=$rt['usite'];
							$managername=$rt['uprojectmanagername'];
							$managermobile=$rt['uprojectmanagermobile'];
							$inchargename=$rt['uprojectinchargename'];
							$inchargemobile=$rt['uprojectinchargemobile'];
							$udefaultserviceengineer=$rt['udefaultserviceengineer'];
					?>
									
				<!-- BEGIN FORM-->
				<form action="customeredit2.php" method="POST" class="form-horizontal" enctype="multipart/form-data" id="myForm">
				<input type="hidden" name="umid" value="<?php echo $umid; ?>">
				
					<div class="form-body">
					
						
						<div class="row">
													
							<div class="col-md-6">
						<div class="form-group">
								<label class="col-md-4 control-label">  Name <span class="required">*</span></label>
								<div class="col-md-8">
								<input type="text" name="uname" value="<?php echo $uname; ?>" class="form-control" required>
								</div>
							</div>
							</div>		
							<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-4 control-label"> Site <span class="required"></span></label>
							<div class="col-md-8">
								<input type="text" name="usite" value="<?php echo $usite; ?>" class="form-control" >
							 </div>
						</div>
						</div>	
							
						</div>
							<div class="row">
										<div class="col-md-6">
							<div class="form-group">
							<label class="col-md-4 control-label"> Mobile No <span class="required">*</span></label>
							<div class="col-md-8">
								<input type="text" name="umobile" value="<?php echo $umobile; ?>" class="form-control" id="mask_number" required>
							 </div>
						</div>
						</div>			
							<!--<div class="col-md-6" hidden>
							<div class="form-group">
							<label class="col-md-4 control-label">Password <span class="required">*</span></label>
							<div class="col-md-8">
								<input type="password" name="upassword" value="<?php /* echo $upassword; */ ?>" class="form-control" required>
							 </div>
						</div>
						</div>	-->	
						<div class="col-md-6">
					<div class="form-group">
							<label class="col-md-4 control-label">Email <span class="required"></span></label>
							<div class="col-md-8">
								<input type="email" name="emailid" value="<?php echo $emailid; ?>" class="form-control" >
							 </div>
						</div>
						</div>		
							
						</div>
						<div class="row">
											
							<div class="col-md-6">
						<div class="form-group">
									<label class="col-md-4 control-label">Address</label>
									<div class="col-md-8">
										<textarea type="text"  class="form-control" name="uaddress" ><?php echo $uaddress; ?></textarea>
									</div>
								</div>
								</div>			
							<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-4 control-label"> City <span class="required"></span></label>
							<div class="col-md-8">
								<input type="text" name="ucity" value="<?php echo $ucity; ?>" class="form-control" >
							 </div>
						</div>
						</div>
						</div>
						<div class="row">
													
									
							<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-4 control-label"> Project Manager Name <span class="required"></span></label>
							<div class="col-md-8">
								<input type="text" name="uprojectmanagername" value="<?php echo $managername; ?>" class="form-control" >
							 </div>
						</div>
						</div>
							<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-4 control-label"> Project Manager Mobile <span class="required"></span></label>
							<div class="col-md-8">
								<input type="text" name="uprojectmanagermobile" value="<?php echo $managermobile; ?>" class="form-control" >
							 </div>
						</div>
						</div>
						</div>
							<div class="row hidden">
													
									
							<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-4 control-label"> Project Incharge Name <span class="required"></span></label>
							<div class="col-md-8">
								<input type="text" name="uprojectinchargename" value="<?php echo $inchargename; ?>" class="form-control" >
							 </div>
						</div>
						</div>
							<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-4 control-label"> Project Incharge Mobile <span class="required"></span></label>
							<div class="col-md-8">
								<input type="text" name="uprojectinchargemobile" value="<?php echo $inchargemobile; ?>" class="form-control" >
							 </div>
						</div>
						</div>
						</div>
							<div class="row">
													
									
							<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-4">Priority</label>
							<div class="col-md-8">
								<select class="form-control select2" name="upriority">
								<option <?php if($upriority=="High"){ echo "selected";}?> value='High'>High</option>
								<option <?php if($upriority=="Medium"){ echo "selected";}?> value='Medium'>Medium</option>
								<option <?php if($upriority=="Low"){ echo "selected";}?> value='Low'>Low</option>
							   </select>
							</div>
						</div>
						</div>
							<div class="col-md-6">
						<div class="form-group">
							<label class="col-md-4 control-label">Default Service Engineer</label>
							<div class="col-md-8">
								<select class="form-control select2" name="udefaultserviceengineer" >
									<option value="0">Select Service Engineer</option>
									<?php
										$samid=$_SESSION['samid'];
										$eve_main = "select * from res_user_master where utype='serviceengineer' and samid=$samid";
										$re_main = mysqli_query($conn, $eve_main);
										while($rt_main = mysqli_fetch_assoc($re_main))
										{
											$umid=$rt_main['umid'];
											$uname=$rt_main['uname'];
											
											if($umid==$udefaultserviceengineer)
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
				
					
					<!-- /input-group -->
					
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-3 col-md-9">
								<button type="submit" class="btn green"><i class="fa fa-check"></i>  Submit</button>
								<button type="button" class="btn grey-salsa btn-outline" onclick="document.location.href='customer.php'">  <i class="fa fa-arrow-left"></i>  Cancel</button>
							</div>
						</div>
					</div>
				</form>
				<!-- END FORM-->
				
			<?php }?>
				
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

		 <!-- BEGIN PAGE LEVEL SCRIPTS -->
       
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="../../assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="../../assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="../../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
		
		
		<script src="../../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
		<script src="../../assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
		
		<script src="../../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
		
       <script src="../../assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
		 
		<script src="../../assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
		<script src="../../assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
		<script src="../../assets/pages/scripts/form-input-mask.js" type="text/javascript"></script>
    </body>

</html>