<?php
session_start();
	include("connect.php");
	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
		return;
	}
	
	
	$umid=$_SESSION['umid'];
	$samid=$_SESSION['samid'];
	date_default_timezone_set("Asia/Kolkata");
	$mdate1= date('Y-m-d H:i:s');

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
        <title>General Settings Edit | Admin Panel</title>
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

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <!-- BEGIN HEADER -->
      <?php
            require ('header.php');
			?>         <!-- END HEADER -->
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
							<a class="btn white-salsa" href="javascript:history.go(-1)" style='color:white';><i class="fa fa-arrow-left" aria-hidden="true"></i> </a><small>Edit General Settings Information</small> </div>
						<div class="actions">

						</div>
					</div>
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->

					<div class="portlet-body form">

									<?php
								    $eve = "select * from res_generalsettings_master where samid='$samid'";
	

	                                $re = mysqli_query($conn, $eve);
									while($rt = mysqli_fetch_assoc($re))
									{
									$img1=$rt['headerimg'];
									$enablesms=$rt['enablesms'];
									$path = "allimages/".$img1;
									$type = pathinfo($path, PATHINFO_EXTENSION);
									$data = file_get_contents($path);
									$imgfooter=$rt['footerimg'];
									$loginimg=$rt['loginimg'];
									$pathfooter = "allimages/".$imgfooter;
									$typefooter = pathinfo($pathfooter, PATHINFO_EXTENSION);
									$datafooter = file_get_contents($pathfooter);
									?>

                                                <!-- BEGIN FORM-->
				<form action="settingedit3.php" method="POST" class="form-horizontal" enctype="multipart/form-data">

				<input type="hidden" name="sid1" value="1">
				<input type="hidden" name="enablesms" value="<?php echo $enablesms;?>">

					<div class="form-body">
		
						<div class="portlet box blue-hoki">
						<div class="portlet-title" style="background-color:grey;">
							<div class="caption">
								<i class="fa fa-plus"></i>Edit  Header / Footer</div>

						</div>

						<div class="portlet-body">
							<div class="scroller" style="height:auto" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">

								<table border="1" cellspacing="10" cellpadding="10" class="table table-bordered table-hover">
									<tr> 
										<th>Current Header Image </th>
										<td>
											<img src="data:image/<?php echo $type;?>;base64,<?php echo base64_encode($data);?>" height='120' width='500px' ></img>
										</td>
									</tr>
									<tr>
										<th>Upload New Header Image </th>
										<td>
											<input type="file" name="file" class="form-control" accept=".jpg,.png,.jpeg">
										</td>
										</tr>
										
										<tr> 
										<th>Current Login background-Image</th>
										<td>
											<img src="images/<?php echo $loginimg;?>" height='120' width='500px' ></img>
										</td>
									</tr>
									<tr>
										<th>Upload New Login background-Image </th>
										<td>
											<input type="file" name="file11" class="form-control" accept=".jpg,.png,.jpeg">
										</td>
										</tr>
									
									<tr> 
										<th>Current Footer Image </th>
										<td>
											<img src="data:image/<?php echo $typefooter;?>;base64,<?php echo base64_encode($datafooter);?>" height='50' width='500px' ></img>
										</td>
									</tr>

										<tr> 
										<th>Upload New Footer Image </th>
										<td>
											<input type="file" name="file1" class="form-control" accept=".jpg,.png,.jpeg">
										</td>
									</tr>
									
								</table>

								</div>
						</div>
					</div>
						
		<!-----------------end portlet------------------->	
		
		<!------------------strat portlet------------------>
<div class="portlet box blue-hoki">
						<div class="portlet-title" style="background-color:grey;">
							<div class="caption">
								<i class="fa fa-plus"></i>Edit  Invoice Details</div>

						</div>

						<div class="portlet-body">
							<div class="scroller" style="height:auto" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">

								<table border="1" cellspacing="10" cellpadding="10" class="table table-bordered table-hover">
								
														
								<tr> 
										<th>Invoice Field1 </th>
										<td>
												<input type="text" name="f1" class="form-control" placeholder="" value="<?php echo $rt['cmpdetail1'];?>">

										</td>
									</tr><tr> 
										<th>Invoice Field2 </th>
										<td>
												<input type="text" name="f2" class="form-control" placeholder="" value="<?php echo $rt['cmpdetail2'];?>">

										</td>
									</tr><tr> 
										<th>Invoice Field3 </th>
										<td>
												<input type="text" name="f5" class="form-control" placeholder="" value="<?php echo $rt['cmpdetail5'];?>">

										</td>
									</tr>
									<tr> 
										<th>State </th>
										<td>
											<select name="cmpstate" class="form-control" data-required="1">
													<option <?php if($rt['cmpstate']=='Gujarat'){ echo "selected";}?> value="Gujarat">Gujarat</option>
													<option <?php if($rt['cmpstate']=='Maharashtra'){ echo "selected";}?> value="Maharashtra">Maharashtra</option>
												</select>
										</td>
									</tr>
									<tr> 
										<th>Invoice Year</th>
										<td>
												<input type="text" name="f6" class="form-control" placeholder="" value="<?php echo $rt['qyear'];?>">

										</td>
									</tr>
									<tr> 
										<th>Invoice Prifix </th>
										<td>
												<input type="text" name="f7" class="form-control" placeholder="" value="<?php echo $rt['qprefix'];?>">

										</td>
									</tr>
									<tr> 
										<th>Terms & Condition </th>
										<td>
											<textarea class="form-control" name="terms" rows="6" data-error-container="#editor2_error"><?php echo $rt['terms'];?></textarea>
											<div id="editor2_error"> </div>
										</td>
									</tr>
									
									
									
									
									
								</table>

								</div>
						</div>
					</div>
								
		<!---------------end portlet--------------------->				
		
		
		<!------------------strat portlet------------------>
		<div class="portlet box blue-hoki">
						<div class="portlet-title" style="background-color:grey;">
							<div class="caption">
								<i class="fa fa-envelope"></i>Edit Details</div>

						</div>

						<div class="portlet-body">
							<div class="scroller" style="height:auto" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">
<?php
								    $eve1 = "select * from res_superadmin_master where samid='$samid'";
	

	                                $re1 = mysqli_query($conn, $eve1);
									while($rt1 = mysqli_fetch_assoc($re1))
									{
									
									?>

								<table border="1" cellspacing="10" cellpadding="10" class="table table-bordered table-hover">
								
														
								<tr> 
										<th>Service Contract Call Type</th>
										<td>
												<input type="text" name="sacontractcalltypedefault" class="form-control" placeholder="" value="<?php echo $rt1['sacontractcalltypedefault'];?>">

										</td>
								</tr>
								<tr> 
										<th>Complain Prefix</th>
										<td>
												<input type="text" name="saprefix" class="form-control" placeholder="" value="<?php echo $rt1['saprefix'];?>">

										</td>
								</tr>
								
									<tr> 
										<th>Service Prefix</th>
										<td>
											<input class="form-control" name="serviceprefix" value="<?php echo $rt1['serviceprefix'];?>">
											<div id="editor2_error"> </div>
										</td>
									</tr>
									
									<tr> 
										<th>Workorder Prefix</th>
										<td>
											<input class="form-control" name="workorderprefix" value="<?php echo $rt1['workorderprefix'];?>">
											<div id="editor2_error"> </div>
										</td>
									</tr>
									
									<tr> 
										<th>Dispatch Prefix</th>
										<td>
											<input class="form-control" name="dispatchprefix" value="<?php echo $rt1['dispatchprefix'];?>">
											<div id="editor2_error"> </div>
										</td>
									</tr>
									
									
								</table>
									<?php } ?>
								</div>
						</div>
					</div>
								
						
		<!---------------end portlet--------------------->				
<!------------------strat portlet------------------>
		<div class="portlet box blue-hoki">
						<div class="portlet-title" style="background-color:grey;">
							<div class="caption">
								<i class="fa fa-envelope"></i>Edit Email Details</div>

						</div>

						<div class="portlet-body">
							<div class="scroller" style="height:auto" data-rail-visible="1" data-rail-color="yellow" data-handle-color="#a1b2bd">

								<table border="1" cellspacing="10" cellpadding="10" class="table table-bordered table-hover">
								
														
								<tr> 
										<th>Email Subject</th>
										<td>
												<input type="text" name="semailsubject" class="form-control" placeholder="" value="<?php echo $rt['semailsubject'];?>">

										</td>
								</tr>
								
									<tr> 
										<th>Email Message </th>
										<td>
											<textarea class="form-control" name="semailmsg" rows="6" data-error-container="#editor2_error"><?php echo $rt['semailmsg'];?></textarea>
											<div id="editor2_error"> </div>
										</td>
									</tr>
									
									
									
									
									
								</table>

								</div>
						</div>
					</div>		

					<div class="form-actions" align="center">
						<div class="row">
							<div class="col-md-offset-3 col-md-9">
								<button type="submit" class="btn green">Submit</button>
								  &nbsp;<button type="button" class="btn grey-salsa btn-outline" onclick="document.location.href='dashboard.php'">Cancel</button>
							</div>
						</div>
					</div>
				</form>
				<!-- END FORM-->

	<?php
		}
	?>
	</div>
                               </div>

                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
            <!-- END QUICK SIDEBAR -->
        </div>
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

    </body>

</html>
