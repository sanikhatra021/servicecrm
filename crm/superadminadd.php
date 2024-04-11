<?php
session_start(); 
	if(!isset($_SESSION['lacomplainsuperadmin']))
	{
		header('Location: index.php');
		return;
	}
	if($_SESSION['lasuperadmintype']!='superadmin'){
			header('Location: index.php');
		return;
	}
	//$_SESSION['_token']=bin2hex(openssl_random_pseudo_bytes(16));
	
	
				date_default_timezone_set("Asia/Kolkata");
				$mdate1= date('Y-m-d H:i:s');
				$mdate= date('d-m-Y');
				$exprydate = date("d-m-Y", strtotime("+360 day"));
				
				
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
        <title>Business Account Add:Super Admin Panel</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
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
        <link href="../../assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="../../assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
		<link href="../../assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="favicon.ico" /> 
		
		
		<link href="../../assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
	
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
                        <img src="../../assets/layouts/layout/img/logo.png" alt="logo" class="logo-default" /> </a>
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
                        
						
						
                        <!-- END NOTIFICATION DROPDOWN -->
                        <!-- BEGIN INBOX DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        
                        <!-- END INBOX DROPDOWN -->
                        <!-- BEGIN TODO DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        
                        <!-- END TODO DROPDOWN -->
                        <!-- BEGIN USER LOGIN DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                        <li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <img alt="" class="img-circle" src="../../assets/layouts/layout/img/avatar3_small.png" />
                                <span class="username username-hide-on-mobile"> <?php echo $_SESSION['lasuperadmintype']?> </span>
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
                        <!-- END USER LOGIN DROPDOWN -->
                        <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                       
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
                    <!-- BEGIN THEME PANEL -->
                   
                    <!-- END THEME PANEL -->
                    <!-- BEGIN PAGE BAR -->
                   
                    <!-- END PAGE BAR -->
                    <!-- BEGIN PAGE TITLE-->
					
				
					
                   
					
					<div class="portlet box blue-hoki green">
					<div class="portlet-title green">
						<div class="caption">
							<i class="fa fa-user"></i><small>Add Business</small> </div>
						<div class="actions">
							
						</div>
					</div>
					
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
					
					<div class="portlet-body form">
					<?php
						$safullname="";
						$samobile="";
						$sausername="";
						$sapassword="";
						$sautype="";
						$saemailid="";
						$saaddress="";
						$sacity="";
						$sauloc1="";
						$sauloc2="";
						$sauserstatus="";
						$sacurrentplanname="";
						$sacurrentplantype="";
						$satotusers="";
						$saplanexpdate="";
						$sacurrentplanstatus="";
						$saplanexpdate = date('d-m-Y', strtotime('+15 days'));
					?>
					<!--<div class="alert alert-block alert-info fade in">
					<button type="button" class="close" data-dismiss="alert"></button>
					<h4 class="alert-heading">Add Customer </h4>
					<p>Using following form you can add your customer or clients. This customer details will be used when you are generating quotations. Make sure to double check email address and phone numbers, Your customer will get quotations by email and sms. 	</p>
					
					</div>-->
					
                                                <!-- BEGIN FORM-->
                             <form action="superadminadd2.php" method="POST" class="form-horizontal" enctype="multipart/form-data" id="myForm">
												
									<div class="form-body">			
                                                   	
							<div class="form-group">
								<label class="col-md-3 control-label">Full Name <span class="required">*</span></label>
								<div class="col-md-5">
								<input type="text" name="safullname" value="<?php echo $safullname; ?>" class="form-control" required>
								</div>
							</div>
							
						<div class="form-group">
							<label class="col-md-3 control-label"> Mobile No(Username) <span class="required">*</span></label>
							<div class="col-md-5">
								<input type="text" name="samobile" value="<?php echo $samobile; ?>" class="form-control"  required>
							 </div>
						</div>
						
							
							
						
						<div class="form-group">
							<label class="col-md-3 control-label">Password <span class="required">*</span></label>
							<div class="col-md-5">
								<input type="password" name="sapassword" value="<?php echo $sapassword; ?>" class="form-control" required>
							 </div>
						</div>
						
						
						<div class="form-group">
							<label class="col-md-3 control-label">Email <span class="required"></span></label>
							<div class="col-md-5">
								<input type="email" name="saemailid" value="<?php echo $saemailid; ?>" class="form-control" >
							 </div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label">Address</label>
							<div class="col-md-5">
								<textarea type="text"  class="form-control" name="saaddress" ></textarea>
							</div>
						</div>
						
						
						
						<div class="form-group">
							<label class="col-md-3 control-label">Total Users</label>
							<div class="col-md-5">
								<input type="number" name="satotusers" class="form-control"  value="1" required>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label">Service Engineer Name</label>
							<div class="col-md-5">
								<input type="text" name="sename" class="form-control" >
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label">Mobile/ Username</label>
							<div class="col-md-5">
								<input type="text" name="semobile" class="form-control" >
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label">Password</label>
							<div class="col-md-5">
								<input type="password" name="sepassword" class="form-control" >
							</div>
						</div>
						
						<div class="form-group">
								<label class="col-md-3 control-label">Expiry Date</label>
								<div class="col-md-5">
									<input class="form-control form-control-inline  date-picker" data-date-format="dd-mm-yyyy" type="text" name="saplanexpdate" value="<?php echo $saplanexpdate;?>" data-date-start-date="+0d" required >
								</div>
							</div>
							
						
						<div class="form-group">
								<label class="col-md-3 control-label">Current Plan Status</label>
								<div class="col-md-5">
									<select class="form-control select2" name="pstatus">
										<option  value="Active">Active</option>
										<option  value=" Inactive">Inactive</option>
										<option  value="Expired">Expired</option>
										
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Allow Whatsapp Status</label>
								<div class="col-md-5">
									<select class="form-control select2" name="wstatus">
										<option  value="1">Active</option>
										<option  value="0">Inactive</option>
									
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Allow Email Status</label>
								<div class="col-md-5">
									<select class="form-control select2" name="estatus">
										<option  value="1">Active</option>
										<option  value="0">Inactive</option>
								
										
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Business URL <span class="required">*</span></label>
								<div class="col-md-5">
								<input type="text" name="saurl" class="form-control" required>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-3 control-label">Complain Prefix</label>
								<div class="col-md-5">
								<input type="text" name="saprefix" class="form-control" value="TIC">
								</div>
							</div>
							
								<div class="form-group">
								<label class="col-md-3 control-label">Service Prefix</label>
								<div class="col-md-5">
								<input type="text" name="serviceprefix" class="form-control" value="SE">
								</div>
							</div>
								<div class="form-group">
								<label class="col-md-3 control-label">Work Order Prefix</label>
								<div class="col-md-5">
								<input type="text" name="workorderprefix" class="form-control" value="WO">
								</div>
							</div>
								<div class="form-group">
								<label class="col-md-3 control-label">Dispatch Prefix</label>
								<div class="col-md-5">
								<input type="text" name="dispatchprefix" class="form-control" value="DI">
								</div>
							</div>
							
							
														
														<div class="form-group">
															<label class="col-md-3 control-label">Upload New Admin Logo Image</label>
                                                            <div class="col-md-3">

																
                                                                    <input type="file" name="cmpadminlogo" class="form-control" accept=".jpg,.png,.jpeg">
                                                            </div>
															
															
														</div>
														
                                                    <!-- /input-group -->
                                                   	
					<div class="form-actions">
						<div class="row">
							<div class="col-md-offset-3 col-md-9">
								<button type="submit" class="btn  green"><i class="fa fa-check"></i> Submit</button>
								<button type="button" class="btn  grey-salsa btn-outline" onclick="document.location.href='superadmin.php'"><i class="fa fa-arrow-left"></i> Cancel</button>
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
        <script src="../../assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
        
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
		
    </body>

</html>