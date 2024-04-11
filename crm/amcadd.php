<?php
session_start(); 

	include("connect.php");
	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
		return;
	}
	$samid=$_SESSION['samid'];
	
	date_default_timezone_set("Asia/Kolkata");
	$mdate1= date('Y-m-d H:i:s');
	$mdate2= date('d-m-Y');
	
	$mdate1= date('Y-m-d');
	$mdate= date('Y-m-d');
	$custedate1 = date('Y-m-d',strtotime($mdate . "+365 days"));
	
	
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
        <title>AMC Add | Admin Panel</title>
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

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="#">
                        <img src="../assets/layouts/layout/img/logo.png" alt="logo" class="logo-default" /> </a>
                    <div class="menu-toggler sidebar-toggler"> </div>
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
                                <span class="username username-hide-on-mobile"> <?php echo $_SESSION['utype'];?> </span>
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
						
                        <!-- END QUICK SIDEBAR TOGGLER -->
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
                    
					<div class="portlet box blue-hoki green">
					<div class="portlet-title green">
						<div class="caption">
							<i class="fa fa-gift"></i><small>Add AMC</small> </div>
						<div class="actions">
							
						</div>
					</div>
					
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
					
					<div class="portlet-body form">
					<?php
						$pmid="";
						$umid="";
						$custsdate="";
						$custedate="";
						$custremarks="";
					
						
					
					?>
					
					<!-- BEGIN FORM-->
					<form action="amcadd2.php" method="POST" class="form-horizontal" enctype="multipart/form-data" id="myForm">
					
						<div class="form-body">
							
							<div class="form-group">
								<label class="col-md-3 control-label">Customer<span class="required">*</span></label>
								<div class="col-md-5">
									<select class="form-control select2" name="custid" id="customer" required>
										<option value="0">Select Customer</option>
										<?php
										$eve_main = "select * from res_user_master where utype='customer' and samid=$samid";
										$re_main = mysqli_query($conn, $eve_main);
										while($rt_main = mysqli_fetch_assoc($re_main))
										{

											$umid=$rt_main['umid'];
											$uname=$rt_main['uname'];
											if($custid==$umid)
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
							
							<div class="form-group">
								<label class="col-md-3 control-label">Product<span class="required">*</span></label>
								<div class="col-md-5">
									<select class="form-control select2" name="pmid" id="product"required>
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
								<label class="col-md-3 control-label"> No Of Services Given<span class="required">*</span></label>
								<div class="col-md-5">
								
									<input type="text" name="noofservice" value="" class="form-control" aria-required="true" aria-invalid="false" aria-describedby="name-error" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Serial No<span class="required">*</span></label>
								<div class="col-md-5">
								
									<input type="text" name="sserialno" value="" class="form-control" aria-required="true" aria-invalid="false" aria-describedby="name-error" required>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Purchase Date</label>
								<div class="col-md-5">
									<input class="form-control form-control-inline  date-picker" data-date-format="dd-mm-yyyy" type="text" name="pdate" value="<?php echo $mdate;?>" required>
								</div>
							</div>
								
							<div class="form-group">
								<label class="col-md-3 control-label">Service Type</label>
								<div class="col-md-5">
									<select name="servicetype" id="servicetype" class="form-control">
										<option value="AMC">AMC</option>
                                        <option value="Warranty">Warranty</option>
										<option value="None">None</option>
									</select>
								</div>
							</div>
							<div class="form-group" id="startdate">
								
								<label class="col-md-3 control-label">Start Date</label>
								<div class="col-md-5">
									<input class="form-control form-control-inline  date-picker" data-date-format="yyyy-mm-dd" type="text" name="sdate" value="<?php echo $mdate;?>" required>
								
							</div>
							
							</div>
							<div class="form-group" id="enddate">
								
								<label class="col-md-3 control-label">End Date</label>
								<div class="col-md-5">
									<input class="form-control form-control-inline  date-picker" data-date-format="yyyy-mm-dd" type="text" name="edate" value="<?php echo $custedate1;?>" data-date-start-date="+0d" required >
							
							</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-3 control-label">Remark</label>
								<div class="col-md-5">
									<input type="text" name="custremarks" value="<?php echo $custremarks; ?>" class="form-control" aria-required="true" aria-invalid="false" aria-describedby="name-error" >
								</div>
							</div>
							
						<!-- /input-group -->
						
						<div class="form-actions">
							<div class="row">
								<div class="col-md-offset-3 col-md-9">
									<button type="submit" class="btn  green">Submit</button>
									<button type="button" class="btn  grey-salsa btn-outline" onclick="document.location.href='amc.php'">Cancel</button>
								</div>
							</div>
						</div>
					</form>
					<!-- END FORM-->
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
            <div class="page-footer-inner">&copy; 2021
               
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
        <script src="../assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
        
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
		
		<script src="../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
		<script src="../assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
		
		<script src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
       <script src="../assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
		 
		<script src="../assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
		<script type="text/javascript">
	$(function()
	{
		$('#myForm').submit(function(e)
		{
			if($('#product').val() == '0')
			{
				alert('Select Product!');
				e.preventDefault();
				return;
			}

		
			if($('#customer').val() == '0')
			{
				alert('Select Customer!');
				e.preventDefault();
				return;
			}

		});
	});
	</script>
	
	
	<script type="text/javascript">
	$(document).ready(function(){
		$("#startdate").show();
		$("#enddate").show();

        $("#servicetype").change(function () {
            if ($(this).val() == "AMC") {
                $("#startdate").show();
				$("#enddate").show();
            }
			else if ($(this).val() == "Warranty") {
                $("#startdate").show();
				$("#enddate").show();
            }			
			else {
                $("#startdate").hide();
				$("#enddate").hide();
            }
        });
    });
</script>
    </body>

</html>