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
	
	// output: /myproject/index.php
	$currentPath = $_SERVER['PHP_SELF']; 
	
	// output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index ) 
	$pathInfo = pathinfo($currentPath); 
	
	// output: localhost
	$hostName = $_SERVER['HTTP_HOST'];
	// output: http://
	$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
	/* $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))==''; */
	
	// return: http://localhost/myproject/
	$main1=$protocol.$hostName.$pathInfo['dirname'];
	
	$main=$protocol.$hostName."/";
	
	//$amcid=(int)mysqli_real_escape_string($conn,$_GET['id']);
	$umid=(int)mysqli_real_escape_string($conn,$_GET['id']);
	$_SESSION['userid']=$umid;
	$eve = "select * from res_user_master where umid=$umid";
	$re = mysqli_query($conn, $eve);
	if(mysqli_num_rows($re) > 0)
	{
		while($rt = mysqli_fetch_assoc($re))
		{
			$uname=$rt['uname'];
			
			// output: localhost
			$hostName = $_SERVER['HTTP_HOST']; 
			
			// output: http://
			$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';
			/* $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))==''; */
			
			// return: http://localhost/myproject/
			$main=$protocol.$hostName;
											
			$uqrimg=$main."/images/".$rt['uqrimg'];
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
			$usite=$rt['usite'];
			$managername=$rt['uprojectmanagername'];
			$managermobile=$rt['uprojectmanagermobile'];
			$inchargename=$rt['uprojectinchargename'];
			$inchargemobile=$rt['uprojectinchargemobile'];
				
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
<title>Customer Detail| Admin Panel</title>
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
	
	<div class="portlet box blue-hoki">
	
		<div class="portlet-title" style="background-color:black;">
			<div class="caption">
				<i class="fa fa-gift"></i>Customer Details</div>
			<div class="actions">
				<a href="customer.php" class="btn white btn-outline sbold" > Back </a>
			</div>
		</div>
		
		<div class="portlet-body">
		<div class="table-scrollable">
			<table class="table table-bordered">
				
				<tr>
					<th>User Type</th>
					<td><?php echo $utype1;?></td>
				</tr>
				<tr>
					<th>User Name</th>
					<td><?php echo $uname;?></td>
					<th>User Mobile</th>
					<td><?php echo $umobile;?></td>
				</tr>
				
				<tr>
					<th>User Email</th>
					<td><?php echo $emailid;?></td>
					<th>User Address</th>
					<td><?php echo $uaddress;?></td>
				</tr>
				
				<tr>
					<th>User City</th>
					<td><?php echo $ucity;?></td>
						<th>User Site</th>
					<td><?php echo $usite;?></td>
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
				
				
			</table>
		</div>
</div>
</form>
<!-- END FORM-->


</div>

<div class="portlet box blue-hoki black" hidden>
					<div class="portlet-title" style="background-color:grey;">
						<div class="caption">
							<i class="fa fa-gift"></i><small>Customer Login</small>
						</div>
						<div class="actions">
							
						<a class="btn white btn-outline sbold" data-toggle="modal" href="custdetailsend.php?id=<?php echo $umid;?>">Send Email</a>
							
						</div>
					</div>
					<div class="portlet-body">
					
					<form action="" method="POST" class="form-horizontal">
												<input type="hidden" name="samid" value="<?php echo $samid; ?>">
												
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                         
                                                            <div class="col-md-9">
                                                             Dear <?php echo $uname; ?>,
															</BR></BR>
															Customer URL:</BR>
															<?php echo $main."/mywebpage.php?id=".$umid;?>
															</BR></BR>
															Download QR Code</BR>
															<?php echo $uqrimg;?>
															</BR></BR>
															Username: <?php echo $umobile; ?></BR>
															Password: <?php echo $upassword; ?>
															</BR></BR>
															Android App Link for your Complain: </BR> 
															<?php echo $_SESSION['appicationlink']; ?>
															</BR></BR>
															
															
															</BR></BR>
                                                            </div>
                                                        </div>
														
														
														
														
														
                                                    <!-- /input-group -->
                                                   	
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                               
                                                                <button type="button" class="btn green" onclick="document.location.href='customer.php'">Done</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
					</div>
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
									echo	$eve_main = "select * from res_product_master where samid=$samid";
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
								<br><br><br>
								
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