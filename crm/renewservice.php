<?php
session_start(); 

	include("connect.php");
	include("mylibrary.php");
	include("getcomplainno.php");
	include("getserviceno.php");
	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
		return;
	}
	$samid=$_SESSION['samid'];
	
	date_default_timezone_set("Asia/Kolkata");
	
	
	$mdate1= date('d-m-Y');
	$mdate= date('d-m-Y');
	//$custedate1 = date('d-m-Y',strtotime($mdate . "+365 days"));
	$custedate1 = date('d-m-Y',strtotime($mdate . "+365 days"));

	
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
        <title>Add Service (PPM) | Admin Panel</title>
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
     <?php
            require ('header.php');
			?>        <!-- END HEADER -->
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
							<i class="fa fa-gift"></i><small>Add Service(PPM)</small> </div>
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
							
							$sstartdate=date('d-m-Y',strtotime($rt['senddate']));
							$senddate=date('d-m-Y',strtotime($sstartdate . "+365 days"));
							$pdate=implode('-', array_reverse(explode('-', $rt['spurchasedate'])));
								$custfirstservicedate = date('d-m-Y',strtotime($sstartdate . "+30 days"));
							$sremarks=$rt['sremarks'];
							$sserialno=$rt['sserialno'];
							$servicetype=$rt['servicetype'];
							$snoofservice=$rt['snoofservice'];
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
					<form action="renewserviceadd2.php" method="POST" class="form-horizontal" enctype="multipart/form-data" id="myForm">
					
						<div class="form-body">
						
					
							<div class="row">
								
									<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-4 control-label"> Service No</label>
								<div class="col-md-8">
								<?php
								

								$sefordisplay=generateserviceno();
								
								?>
								<input type="hidden"  name="servicemid"  class="form-control" value="<?php echo $servicemid;?> " readonly>
									<input type="text"  name=""  class="form-control" value="<?php echo $sefordisplay;?> " readonly>
								</div>
							</div>
							</div>
							</div>
							<div class="row">
							<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-4 control-label"> Customer Name</label>
								<div class="col-md-8" >
									<?php
										$eve_main = "select * from res_user_master where umid=$custid1 and samid=$samid";
										$re_main = mysqli_query($conn, $eve_main);
										while($rt_main = mysqli_fetch_assoc($re_main))
										{

											$umid=$rt_main['umid'];
											$uname=$rt_main['uname'];
											$usite=$rt_main['usite'];
											$umobile=$rt_main['umobile'];
										
											$serviceengineerid=$rt_main['udefaultserviceengineer'];
											
										}
									?>
									<input type="hidden"  name="customerid"  class="form-control" value="<?php echo $umid;?> " readonly>
									<input type="text"  name=""  class="form-control" value="<?php echo $uname;?> " readonly>
								</div>
							</div>
							</div>
									
									<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-4 control-label"> Site</label>
								<div class="col-md-8" >
									<input type="text"  name="usite"  class="form-control" value="<?php echo $usite;?> " readonly>
								</div>
							</div>
							</div>
														
							
							</div>
						<div class="row">
						<div class="col-md-6">
														<div class="form-group">
                                                            <label class="col-md-4 control-label"> Mobile</label>
								<div class="col-md-8" >
									<input type="text"  name="umobile"  class="form-control" value="<?php echo $umobile;?> " readonly>
								</div>
							</div>
							</div>
											<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-4 control-label"> Email</label>
								<div class="col-md-8"  >
									<input type="text"  name="uemail"  class="form-control" value="<?php echo $uemail;?> " readonly>
								</div>
							</div>
							</div>	
								
								</div>
								<div class="row">
							<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-4 control-label"> Address</label>
								<div class="col-md-8" id="customeraddress">
									<textarea type="text"  name="uaddress"  class="form-control" value=" " readonly><?php echo $customeraddress;?></textarea>
								</div>
							</div>
							</div>
							<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-4 control-label"> City</label>
								<div class="col-md-8" >
									<input type="text"  name="ucity"  class="form-control" value="<?php echo $ucity;?> " readonly>
								</div>
							</div>
							</div>
							</div>
						
							<div class="row">
													
							<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-4 control-label">Project Manager Name</label>
								<div class="col-md-8">
									<input type="text"  name="managername"  class="form-control" value="<?php echo $managername;?> " readonly>
								</div>
							</div>
							</div>
							<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-4 control-label">Project Manager Mobile</label>
								<div class="col-md-8" >
									<input type="text"  name="managermobile"  class="form-control" value="<?php echo $managermobile;?> " readonly>
								</div>
							</div>
							</div>
							</div>
							<div class="row">
														
							<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-4 control-label">Project Incharge Name</label>
								<div class="col-md-8" >
									<input type="text"  name="inchargename"  class="form-control" value="<?php echo $inchargename;?> " readonly>
								</div>
							</div>
							</div>
							<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-4 control-label">Project Incharge Mobile</label>
								<div class="col-md-8" >
									<input type="text"  name="inchargemobile"  class="form-control" value="<?php echo $inchargemobile;?> " readonly>
								</div>
							</div>
							</div>
							</div>
						
							<div class="row">
														<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-4 control-label">Product/Service Package<span class="required">*</span></label>
								<div class="col-md-8">
									<select class="form-control select2" name="pmid" id="product" required>
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
							<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-4 control-label">Purchase Date</label>
								<div class="col-md-8">
									<input class="form-control form-control-inline  date-picker" data-date-format="dd-mm-yyyy" type="text" name="pdate" value="<?php echo $mdate;?>" required>
								</div>
							</div>
							</div>
						
													
							</div>
							<div class="row">
														<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-4 control-label">PO No<span class="required">*</span></label>
								<div class="col-md-8">
								
									<input type="text" name="sserialno" value="" class="form-control" aria-required="true" aria-invalid="false" aria-describedby="name-error" required>
								</div>
							</div>
							</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-4 control-label">Service Engineer</label>
							
								<div class="col-md-8" >
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
										
									</select>
								</div>
							</div>
							</div>
														
							</div>
								<div class="row">
														<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-4 control-label">Service Type</label>
								<div class="col-md-8">
								<select name="servicetype"  class="form-control">
										<?php
										$eve_main = "select * from res_servicetype_master where samid=$samid";
										$re_main = mysqli_query($conn, $eve_main);
										while($rt_main = mysqli_fetch_assoc($re_main))
										{

											
											$stypename=$rt_main['stypename'];
										
											if($servicetype==$stypename){
												echo "<option value='$stypename' selected>$stypename</option>";
											}
											else{
												echo "<option value='$stypename'>$stypename</option>";
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
								
									<input type="number" name="noofservice" value="4" class="form-control" aria-required="true" aria-invalid="false" aria-describedby="name-error" max=20 required>
								</div>
							</div>
							</div>
														
						
														
							</div>
							<div class="row">
							<div class="col-md-6">
							<div class="form-group" id="startdate">
								
								<label class="col-md-4 control-label">Start Date</label>
								<div class="col-md-8">
									<input class="form-control form-control-inline  date-picker" data-date-format="dd-mm-yyyy" type="text" name="sdate" value="<?php echo $sstartdate;?>" required>
								
							</div>
							
							</div>
							</div>
									<div class="col-md-6">
							<div class="form-group" id="enddate">
								
								<label class="col-md-4 control-label">End Date</label>
								<div class="col-md-8">
									<input class="form-control form-control-inline  date-picker" data-date-format="dd-mm-yyyy" type="text" name="edate" value="<?php echo $senddate;?>" data-date-start-date="+0d" required >
							
							</div>
							</div>					
							</div>
							</div>
							<div class="row">
							<div class="col-md-6">
							<div class="form-group" id="startdate">
								
								<label class="col-md-4 control-label">First Call Date</label>
								<div class="col-md-8">
									<input class="form-control form-control-inline  date-picker" data-date-format="dd-mm-yyyy" type="text" name="fsdate" value="<?php echo $custfirstservicedate;?>" required>
								
							</div>
							
							</div>
							</div>
									<div class="col-md-6">
							<div class="form-group" id="enddate">
								
								<label class="col-md-4 control-label">Ticket No</label>
								<div class="col-md-8">
									<?php
								

								$cmnowithprefix=generatecomplainno();
								
								?>
									<input type="text"  name=""  class="form-control" value="<?php echo $cmnowithprefix;?> " readonly>
							
							</div>
							</div>					
							</div>
							</div>
						<div class="row">
														<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-4 control-label">AMC Charge<span class="required">*</span></label>
								<div class="col-md-8">
								
									<input type="text" name="sservicecharge" value="" class="form-control" aria-required="true" aria-invalid="false" aria-describedby="name-error" required>
								</div>
							</div>
							</div>
						
														<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-4 control-label">Remark</label>
								<div class="col-md-8">
									<input type="text" name="custremarks"  class="form-control" aria-required="true" aria-invalid="false" aria-describedby="name-error" >
								</div>
							</div>
							</div>
							</div>
							
							
							
						<!-- /input-group -->
						
						<div class="form-actions">
							<div class="row">
								<div class="col-md-offset-3 col-md-9">
									<button type="submit" class="btn  green">Submit</button>
									<button type="button" class="btn  grey-salsa btn-outline" onclick="document.location.href='upcomingservicerenewal.php'">Cancel</button>
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
	
	
	<!--<script type="text/javascript">
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
</script>-->

	
		

    </body>

</html>