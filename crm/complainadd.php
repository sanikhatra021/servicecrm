<?php
session_start(); 

	include("connect.php");
	include("mylibrary.php");
	include("getcomplainno.php");
	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
		return;
	}
	$samid=$_SESSION['samid'];
	$_SESSION['_token']=bin2hex(openssl_random_pseudo_bytes(16));

	
	date_default_timezone_set("Asia/Kolkata");
	$mdate1= date('Y-m-d H:i:s');
	$mdate2= date('d-m-Y');
	
	
	
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
        <title>Call Add | Admin Panel</title>
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
			?>     <!-- END HEADER -->
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
							<i class="fa fa-user-plus"></i><small>Add Call</small> </div>
						<div class="actions">
							
						</div>
					</div>
					
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
					
					<div class="portlet-body form">
					<?php
						$pmid="";
						$ctmid="";
						$umid="";
						$cmdetail="";
						$cmphoto="";
						$cmdate="";
						$cstatus="";
					
						
					
					?>
					
					<!-- BEGIN FORM-->
					<form action="complainadd2.php" method="POST" class="form-horizontal" enctype="multipart/form-data" id="myForm">
					<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">

					
						<div class="form-body">
						
					<div class="row">
								<div class="col-md-6">
								<div class="form-group">
								<label class="col-md-4 control-label">Select Customer<span class="required">*</span></label>
								<div class="col-md-8">
									<select class="form-control select2" name="customerid" id="customerid" data-placeholder="Select Customer"required>
										<option value="">Select Customer</option>
										<option value="New Customer" >New Customer</option>
										<?php
										$eve_main = "select * from res_user_master where utype='customer' and samid=$samid";
										$re_main = mysqli_query($conn, $eve_main);
										
										while($rt_main = mysqli_fetch_assoc($re_main))
										{

											$umid=$rt_main['umid'];
											$uname=$rt_main['uname'];
											$usite=$rt_main['usite'];
											$umobile=$rt_main['umobile'];
											
												echo "<option value='$umid'>$uname-$usite($umobile)</option>";
											

										}
									?>
									</select>
								</div>
							
							</div>
							</div>
							<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-4 control-label"> Ticket No</label>
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
								<label class="col-md-4 control-label"> Customer Name<span class="required">*</span></label>
								<div class="col-md-8" id="customername">
									
								</div>
							</div>
							</div>						
							<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-4 control-label"> Site</label>
								<div class="col-md-8" id="customersite">
									
								</div>
							</div>
							</div>
							</div>
						<div class="row">
						<div class="col-md-6">
														<div class="form-group">
                                                            <label class="col-md-4 control-label"> Mobile</label>
								<div class="col-md-8" id="customermobile">
									
								</div>
							</div>
							</div>
											<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-4 control-label"> Email</label>
								<div class="col-md-8" id="customeremail" >
									
								</div>
							</div>
							</div>	
								
								</div>
								<div class="row">
							<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-4 control-label"> Address</label>
								<div class="col-md-8" id="customeraddress" >
									
								</div>
							</div>
							</div>
								<div class="col-md-6" >
							<div class="form-group">
								<label class="col-md-4 control-label"> City</label>
								<div class="col-md-8" id="customercity">
									
								</div>
							</div>
							</div>
						
							<!--<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-4 control-label"> City</label>
								<div class="col-md-8" id="customercity">
									
								</div>
							</div>
							</div>-->
							</div>
						
						
							<div class="row hidden">
													
							<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-4 control-label">Project Manager Name</label>
								<div class="col-md-8" id="managername">
									
								</div>
							</div>
							</div>
							<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-4 control-label">Project Manager Mobile</label>
								<div class="col-md-8" id="managermobile">
									
								</div>
							</div>
							</div>
							</div>
							<div class="row hidden">
														
							<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-4 control-label">Project Incharge Name</label>
								<div class="col-md-8" id="inchargename">
									
								</div>
							</div>
							</div>
							<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-4 control-label">Project Incharge Mobile</label>
								<div class="col-md-8" id="inchargemobile">
									
								</div>
							</div>
							</div>
							</div>
						
							<div class="row">
								<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-4 control-label">Service Contract</label>
								<div class="col-md-8">
								
									<select class="form-control select"  name="servicecontractid" data-placeholder="Select Service Contract" id="servicecontractid">
								<option value="0">Select</option>
										
									</select>
								</div>
							</div>
							</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-4 control-label">Standard Problem</label>
								<div class="col-md-7">
									<select class="form-control select2" name="problemname" data-placeholder="Select Standard Problem" id="problem" >
										<option value="">Select</option>
										<?php
										$eve_main1 = "select * from res_problemtype_master where samid=$samid";
										$re_main1= mysqli_query($conn, $eve_main1);
										while($rt_main1 = mysqli_fetch_assoc($re_main1))
										{

											//$ptmid=$rt_main1['ptmid'];
											$ptmname=$rt_main1['ptmname'];
											$ptmrate=$rt_main1['ptmrate'];
											if($ptmrate==0)
											{
												$price="";
											}
											else
											{
												$price="(Rs. ".$ptmrate.")";
											}
											
											
												echo "<option value='$ptmname'>$ptmname $price</option>";
											

										}
									?>
									</select>
								</div>
								<a href="problemtypeadd.php?from=problem"><i style="font-size:150%; margin-top:1%;" class="fa fa-plus-circle fa-fw" aria-hidden="true"></i></a>
							</div>
							</div>
								
							
						
							</div>
							
							<div class="row">
										<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-4 control-label">Product<span class="required">*</span></label>
								<div class="col-md-7">
									<select class="form-control select2" name="pmid" id="product" required>
										<option value="0">Select Product</option>
										<?php
										$eve_main = "select * from res_product_master where samid=$samid and ptype='Product'";
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
								<a href="productadd.php?from=pro"><i style="font-size:150%; margin-top:1%;" class="fa fa-plus-circle fa-fw" aria-hidden="true"></i></a>
							</div>
							</div>
								<div class="col-md-6">
							
							<div class="form-group">
								<label class="col-md-4 control-label">Date</label>
								<div class="col-md-8">
									<input class="form-control form-control-inline  date-picker" data-date-format="dd-mm-yyyy" type="text" name="cmdate" value="<?php echo $mdate2;?>" required>
								</div>
							</div>
							</div>
												
							
					
							
							</div>
							<div class="row">
								<div class="col-md-6">
							
								
							<div class="form-group">
								<label class="col-md-4 control-label">Product Detail</label>
								<div class="col-md-8">
									<textarea type="text" name="sproductdetail" id="sproductdetail" rows="1" value="" class="form-control" aria-required="true" aria-invalid="false" aria-describedby="name-error" placeholder='Enter Machine Detail' ></textarea>
								</div>
							</div>
							</div>
								<div class="col-md-6">
							
								
							<div class="form-group">
								<label class="col-md-4 control-label">Call Detail</label>
								<div class="col-md-8">
									<textarea type="text" name="cmdetail" rows="1" value="<?php echo $cmdetail; ?>" class="form-control" aria-required="true" aria-invalid="false" aria-describedby="name-error" placeholder='Enter Call Detail'></textarea>
								</div>
							</div>
							</div>
							</div>
							<div class="row">
								<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-4 control-label">Call Type<span class="required">*</span></label>
								<div class="col-md-8">
									<select class="form-control select2" name="cmtype" id="cmtype" required>
										<option value="0">Select Call Type</option>
										
									<?php
										$eve_category1 = "select * from res_complaintype_master where  samid='$samid'";
										$re_category1 = mysqli_query($conn, $eve_category1);
										while($rt_category1 = mysqli_fetch_assoc($re_category1))
										{

											$umid1=$rt_category1['ctmid'];
											
											$uname1=urldecode($rt_category1['ctmname']);
											
											
												echo "<option value='$uname1' >$uname1</option>";
											

										}
									?>
										
									</select>
								</div>
							</div>
							</div>
									<div class="col-md-6">
							<div class="form-group">
							<label class="col-md-4 control-label">Photo</label>
							<div class="col-md-8">
								<input class="form-control" type="file" name="cmphoto" accept="images/*">
							 </div>
						</div>
						</div>								
							
							</div>
						
						<!--<div class="form-group">
								<label class="col-md-3 control-label">Status</label>
								<div class="col-md-5">
									<select class="form-control select2" name="cstatus">
										<option <?php if($cstatus=="1"){echo "selected";}?> value="Pending">Pending</option>
										<option <?php if($cstatus=="2"){echo "selected";}?> value="In Process">In Process</option>
										<option <?php if($cstatus=="3"){echo "selected";}?> value="Completed">Completed</option>
										<option <?php if($cstatus=="4"){echo "selected";}?> value="Cancel">Cancel</option>
									</select>
								</div>
							</div>-->
						
						
						<!--<div class="form-group">
							<label class="col-md-3 control-label">Added By</label>
							<div class="col-md-5">
								<input type="text" class="form-control"  id="createdby" name="createdby" placeholder="Name - Mobile Number" value="<?php //echo $_SESSION['uname']; ?>">
							</div>
						</div>-->
						<?php  
if($_SESSION['utype']=='Admin'){
?>	
					<div class="row">
														<div class="col-md-6">
							<div class="form-group">
								<label class="col-md-4 control-label">Service Engineer</label>
								<div class="col-md-8">
								
									<select class="form-control select"  name="serviceengineerid" data-placeholder="Select Service Engineer" id="sename">
								
										
									</select>
								</div>
							</div>
							</div>
							<div class="col-md-6">
							
							<div class="form-group">
								<label class="col-md-4 control-label">Service Charge</label>
								<div class="col-md-8">
									<input class="form-control "  type="text" name="servicecharge" value="0" >
								</div>
							</div>
							</div>
							</div>
<?php } ?>
							<?php  
if($_SESSION['utype']=='serviceengineer'){
			echo"<input type='hidden'  name='serviceengineerid'  value='$_SESSION[umid]' class='form-control'>";
}
?>	
						<!-- /input-group -->
						
						<div class="form-actions">
							<div class="row">
								<div class="col-md-offset-3 col-md-9">
									<button type="submit" class="btn  green"> <i class="fa fa-check"></i> Submit</button>
									<button type="button" class="btn  grey-salsa btn-outline" onclick="document.location.href='complain.php'"><i class="fa fa-arrow-left"></i> Cancel</button>
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
		<script src="../assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
		<script type="text/javascript">
		
		
	$(function()
	{
		$('#myForm').submit(function(e)
		{
			if($('#akash').val() == '0')
			{
				alert('Select Complain!');
				e.preventDefault();
				return;
			}

			if($('#product').val() == '0')
			{
				alert('Select Product!');
				e.preventDefault();
					return;
			}
			
			/* if($('#problem').val() == '0')
			{
				alert('Select Standard Problem!');
				e.preventDefault();
					return;
			} */
			
			if($('#cmtype').val() == '0')
			{
				alert('Select Call Type!');
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
	

	
	<script>
		
		$("#mask_number").inputmask({
            "mask": "9",
            "repeat": 10,
            "greedy": false
        });
		
		</script>
		
		
		
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
<script type="text/javascript">
	$(document).ready(function(){
		
			
			
			var customerid = $('#customerid').val();
			if(customerid){
				$.ajax({
					type:'POST',
					url:'customername.php',
					data:'customerid='+customerid,
					success:function(html){
						$('#customername').html(html);
					}
				});
			}else{
				$('#customername').html('<input type="text"  name="customername"   class="form-control">');
			}
		
	});
	</script>
	
		<script type="text/javascript">
	$(document).ready(function(){
		$('#customerid').on('change',function(){
			$("#customername").prop("selectedIndex", 0).change();
			
			var customerid = $(this).val();
			if(customerid){
				$.ajax({
					type:'POST',
					url:'customername.php',
					data:'customerid='+customerid,
					success:function(html){
						$('#customername').html(html);
					}
				});
			}else{
				$('#customername').html('<input type="text"  name="customername"  rows="1" class="form-control" >');
				
			}
		});
	});
	</script>
<script type="text/javascript">
	$(document).ready(function(){
		
			
			
			var customerid = $('#customerid').val();
			if(customerid){
				$.ajax({
					type:'POST',
					url:'customeraddress.php',
					data:'customerid='+customerid,
					success:function(html){
						$('#customeraddress').html(html);
					}
				});
			}else{
				$('#customeraddress').html('<textarea type="text"  name="customeraddress"  rows="1" class="form-control"></textarea>');
			}
		
	});
	</script>
	
		<script type="text/javascript">
	$(document).ready(function(){
		$('#customerid').on('change',function(){
			$("#customeraddress").prop("selectedIndex", 0).change();
			
			var customerid = $(this).val();
			if(customerid){
				$.ajax({
					type:'POST',
					url:'customeraddress.php',
					data:'customerid='+customerid,
					success:function(html){
						$('#customeraddress').html(html);
					}
				});
			}else{
				$('#customeraddress').html('<textarea type="text"  name="customeraddress"  rows="1" class="form-control" ></textarea>');
				
			}
		});
	});
	</script>
			<script type="text/javascript">
	$(document).ready(function(){
		
			
			
			var customerid = $('#customerid').val();
			if(customerid){
				$.ajax({
					type:'POST',
					url:'customermobile.php',
					data:'customerid='+customerid,
					success:function(html){
						$('#customermobile').html(html);
					}
				});
			}else{
				$('#customermobile').html('<input type="text"  name="customermobile"  rows="1" class="form-control">');
			}
		
	});
	</script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('#customerid').on('change',function(){
			$("#customermobile").prop("selectedIndex", 0).change();
			
			var customerid = $(this).val();
			if(customerid){
				$.ajax({
					type:'POST',
					url:'customermobile.php',
					data:'customerid='+customerid,
					success:function(html){
						$('#customermobile').html(html);
					}
				});
			}else{
				$('#customermobile').html('<input type="text"  name="customermobile"  rows="1" class="form-control">');
				
			}
		});
	});
	</script>

<script type="text/javascript">
	$(document).ready(function(){
		
			
			
			var customerid = $('#customerid').val();
			if(customerid){
				$.ajax({
					type:'POST',
					url:'customercity.php',
					data:'customerid='+customerid,
					success:function(html){
						$('#customercity').html(html);
					}
				});
			}else{
				$('#customercity').html('<input type="text"  name="customercity"  rows="1" class="form-control">');
			}
		
	});
	</script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('#customerid').on('change',function(){
			$("#customercity").prop("selectedIndex", 0).change();
			
			var customerid = $(this).val();
			if(customerid){
				$.ajax({
					type:'POST',
					url:'customercity.php',
					data:'customerid='+customerid,
					success:function(html){
						$('#customercity').html(html);
					}
				});
			}else{
				$('#customercity').html('<input type="text"  name="customercity"  rows="1" class="form-control">');
				
			}
		});
	});
	</script>
			<script type="text/javascript">
	$(document).ready(function(){
		
			
			
			var customerid = $('#customerid').val();
			if(customerid){
				$.ajax({
					type:'POST',
					url:'customeremail.php',
					data:'customerid='+customerid,
					success:function(html){
						$('#customeremail').html(html);
					}
				});
			}else{
				$('#customeremail').html('<input type="text"  name="customeremail"  rows="1" class="form-control">');
			}
		
	});
	</script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('#customerid').on('change',function(){
			$("#customeremail").prop("selectedIndex", 0).change();
			
			var customerid = $(this).val();
			if(customerid){
				$.ajax({
					type:'POST',
					url:'customeremail.php',
					data:'customerid='+customerid,
					success:function(html){
						$('#customeremail').html(html);
					}
				});
			}else{
				$('#customeremail').html('<input type="text"  name="customeremail"  rows="1" class="form-control">');
				
			}
		});
	});
	</script>	
	<script type="text/javascript">
	$(document).ready(function(){
		
			
			
			var customerid = $('#customerid').val();
			if(customerid){
				$.ajax({
					type:'POST',
					url:'managername.php',
					data:'customerid='+customerid,
					success:function(html){
						$('#managername').html(html);
					}
				});
			}else{
				$('#managername').html('<input type="text"  name="managername"  rows="1" class="form-control">');
			}
		
	});
	</script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('#customerid').on('change',function(){
			$("#managername").prop("selectedIndex", 0).change();
			
			var customerid = $(this).val();
			if(customerid){
				$.ajax({
					type:'POST',
					url:'managername.php',
					data:'customerid='+customerid,
					success:function(html){
						$('#managername').html(html);
					}
				});
			}else{
				$('#managername').html('<input type="text"  name="managername"  rows="1" class="form-control">');
				
			}
		});
	});
	</script>	
	<script type="text/javascript">
	$(document).ready(function(){
		
			
			
			var customerid = $('#customerid').val();
			if(customerid){
				$.ajax({
					type:'POST',
					url:'managermobile.php',
					data:'customerid='+customerid,
					success:function(html){
						$('#managermobile').html(html);
					}
				});
			}else{
				$('#managermobile').html('<input type="text"  name="managermobile"  rows="1" class="form-control">');
			}
		
	});
	</script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('#customerid').on('change',function(){
			$("#managermobile").prop("selectedIndex", 0).change();
			
			var customerid = $(this).val();
			if(customerid){
				$.ajax({
					type:'POST',
					url:'managermobile.php',
					data:'customerid='+customerid,
					success:function(html){
						$('#managermobile').html(html);
					}
				});
			}else{
				$('#managermobile').html('<input type="text"  name="managermobile"  rows="1" class="form-control">');
				
			}
		});
	});
	</script>	
	<script type="text/javascript">
	$(document).ready(function(){
		
			
			
			var customerid = $('#customerid').val();
			if(customerid){
				$.ajax({
					type:'POST',
					url:'inchargename.php',
					data:'customerid='+customerid,
					success:function(html){
						$('#inchargename').html(html);
					}
				});
			}else{
				$('#inchargename').html('<input type="text"  name="inchargename"  rows="1" class="form-control">');
			}
		
	});
	</script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('#customerid').on('change',function(){
			$("#m").prop("selectedIndex", 0).change();
			
			var customerid = $(this).val();
			if(customerid){
				$.ajax({
					type:'POST',
					url:'inchargename.php',
					data:'customerid='+customerid,
					success:function(html){
						$('#inchargename').html(html);
					}
				});
			}else{
				$('#inchargename').html('<input type="text"  name="inchargename"  rows="1" class="form-control">');
				
			}
		});
	});
	</script>	
	<script type="text/javascript">
	$(document).ready(function(){
		
			
			
			var customerid = $('#customerid').val();
			if(customerid){
				$.ajax({
					type:'POST',
					url:'inchargemobile.php',
					data:'customerid='+customerid,
					success:function(html){
						$('#inchargemobile').html(html);
					}
				});
			}else{
				$('#inchargemobile').html('<input type="text"  name="inchargemobile"  rows="1" class="form-control">');
			}
		
	});
	</script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('#customerid').on('change',function(){
			$("#inchargemobile").prop("selectedIndex", 0).change();
			
			var customerid = $(this).val();
			if(customerid){
				$.ajax({
					type:'POST',
					url:'inchargemobile.php',
					data:'customerid='+customerid,
					success:function(html){
						$('#inchargemobile').html(html);
					}
				});
			}else{
				$('#inchargemobile').html('<input type="text"  name="inchargemobile"  rows="1" class="form-control">');
				
			}
		});
	});
	</script>	
	<script type="text/javascript">
	$(document).ready(function(){
		
			
			
			var customerid = $('#customerid').val();
			if(customerid){
				$.ajax({
					type:'POST',
					url:'customersite.php',
					data:'customerid='+customerid,
					success:function(html){
						$('#customersite').html(html);
					}
				});
			}else{
				$('#customersite').html('<input type="text"  name="customersite"  rows="1" class="form-control">');
			}
		
	});
	</script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('#customerid').on('change',function(){
			$("#customersite").prop("selectedIndex", 0).change();
			
			var customerid = $(this).val();
			if(customerid){
				$.ajax({
					type:'POST',
					url:'customersite.php',
					data:'customerid='+customerid,
					success:function(html){
						$('#customersite').html(html);
					}
				});
			}else{
				$('#customersite').html('<input type="text"  name="customersite"  rows="1" class="form-control">');
				
			}
		});
	});
	</script>	
	
	<script type="text/javascript">
	$(document).ready(function(){
		
			
			
			var customerid = $('#customerid').val();
			if(customerid){
				$.ajax({
					type:'POST',
					url:'sename.php',
					data:'customerid='+customerid,
					success:function(html){
						$('#sename').html(html);
					}
				});
			}else{
				$('#sename').html('<option value=""></option>');
			}
		
	});
	</script>
	
		<script type="text/javascript">
	$(document).ready(function(){
		$('#customerid').on('change',function(){
			$("#sename").prop("selectedIndex", 0).change();
			
			var customerid = $(this).val();
			if(customerid){
				$.ajax({
					type:'POST',
					url:'sename.php',
					data:'customerid='+customerid,
					success:function(html){
						$('#sename').html(html);
					}
				});
			}else{
				$('#sename').html('<option value=""></option>');
				
			}
		});
	});
	</script>	
		<script type="text/javascript">
	$(document).ready(function(){
		$('#customerid').on('change',function(){
			$("#servicecontractid").prop("selectedIndex", 0).change();
			
			var customerid = $(this).val();
			if(customerid){
				$.ajax({
					type:'POST',
					url:'servicecontractfetch.php',
					data:'customerid='+customerid,
					success:function(html){
						$('#servicecontractid').html(html);
					}
				});
			}else{
				$('#servicecontractid').html('<option value="0">select</option>');
				
			}
		});
	});
	</script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('#customerid').on('change',function(){
			$("#sproductdetail").prop("selectedIndex", 0).change();
			
			var customerid = $(this).val();
			if(customerid){
				$.ajax({
					type:'POST',
					url:'serviceproductdetailapi.php',
					data:'customerid='+customerid,
					success:function(html){
						$('#sproductdetail').val(html);
					}
				});
			}else{
				$('#sproductdetail').val('');
				
			}
		});
	});
	</script>	
		<script type="text/javascript">
	$(document).ready(function(){
		$('#servicecontractid').on('change',function(){
			$("#sproductdetail").prop("selectedIndex", 0).change();
			
			var servicecontractid = $(this).val();
			if(servicecontractid){
				$.ajax({
					type:'POST',
					url:'serviceproductdetailapi.php',
					data:'servicecontractid='+servicecontractid,
					success:function(html){
						$('#sproductdetail').val(html);
					}
				});
			}else{
				$('#sproductdetail').val('');
				
			}
		});
	});
	</script>	
	
    </body>

</html>