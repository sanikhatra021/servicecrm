<?php
session_start(); 

	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
	}
 
	include("connect.php");
	$conn->query("set names utf8");

 
	$mdate= date('d-m-Y');
	$mdate11= date('Y-m-d');
	$cdid=(int)mysqli_real_escape_string($conn,$_GET['id']);

	
	
	$cmid=(int)mysqli_real_escape_string($conn,$_GET['id']);
	$_SESSION['cmid']=$cmid;
	$eve = "select * from res_complain_master where cmid=$cmid";
	$re = mysqli_query($conn, $eve);
	if(mysqli_num_rows($re) > 0)
	{
		while($rt = mysqli_fetch_assoc($re))
		{
				$cmdate=implode('-', array_reverse(explode('-', $rt['cmdate'])));
				$cmdetail=$rt['cmdetail'];
				$cmphoto=$rt['cmphoto'];
				$cstatus=$rt['cstatus'];
				if($cstatus=="Pending")
				{
					$cstatus1="<button data-toggle='modal' data-target='#view-modal' data-id='$cmid' id='getUser' class='btn btn-xs btn-success'>Pending</i></button>";
				}
				else if($cstatus=="In Process")
				{
					$cstatus1="<button data-toggle='modal' data-target='#view-modal' data-id='$cmid' id='getUser' class='btn btn-xs btn-warning'>In Process</button>";
				}
				else if($cstatus=="Completed")
				{
					
					$cstatus1="<button data-toggle='modal' data-target='#view-modal' data-id='$cmid' id='getUser' class='btn btn-xs btn-danger'>Completed</button>";
				}
				else if($cstatus=="Cancel")
				{
					
					$cstatus1="<button data-toggle='modal' data-target='#view-modal' data-id='$cmid' id='getUser' class='btn btn-xs btn-clear'>Cancel</button>";
				}
				$pmid=$rt['pmid'];
				$eve1 = "select * from res_product_master where pmid=$pmid";
				$re1 = mysqli_query($conn, $eve1);
				while($rt1 = mysqli_fetch_assoc($re1))
				{
					$pmname=$rt1['pmname'];
				}
				
				$ctmid=$rt['ctmid'];
				$eve1 = "select * from res_complaintype_master where ctmid=$ctmid";
				$re1 = mysqli_query($conn, $eve1);
				while($rt1 = mysqli_fetch_assoc($re1))
				{
					$ctmname=$rt1['ctmname'];
				}
				
				$customerid=$rt['customerid'];
				$eve11 = "select * from res_user_master where umid=$customerid";
				$re11 = mysqli_query($conn, $eve11);
				while($rt11 = mysqli_fetch_assoc($re11))
				{
					$uname=$rt11['uname'];
				}
				if(strlen($cmphoto)>3)
				{
					$cmphoto="<img src='images/$cmphoto' width='100px' height='100px'>";
				}
				else
				{
					$cmphoto="<img src='images/noimage.jpg' width='100px' height='100px'>";
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
<title>Attendance Detail | Admin Panel</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
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
<div class="page-header navbar navbar-fixed-top">
<!-- BEGIN HEADER INNER -->
<div class="page-header-inner ">
<!-- BEGIN LOGO -->
<div class="page-logo">
<a href="#">
<img src="../assets/layouts/layout/img/logo.png" alt="logo" class="logo-default" /> </div>
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
<div class="portlet box blue-hoki ">
					<div class="portlet-title" style="background-color:#00457C;">
						<div class="caption">
							<small>Attendance</small>
						</div>
						<div class="actions">
							<a class="btn white btn-outline sbold"  href="complain.php"> Back </a>
						</div>
					</div>
					<div class="portlet-body">
					<div class="table-scrollable">
		
						<table class="table table-bordered">
							<tr>
					<th>Status</th>
					<td><?php echo $cstatus1;?></td>				
				
					<th>Date</th>
					<td><?php echo $cmdate;?></td>
					
				</tr>
				<tr>								
					<th>Complain Type Name</th>
					<td><?php echo $ctmname;?></td>
					<th>Customer Name</th>
					<td><?php echo $uname;?></td>
					
				</tr>
				<tr>								
				
					<th>Product Name</th>
					<td><?php echo $pmname;?></td>
					<th>Detail</th>
					<td><?php echo $cmdetail;?></td>
				</tr>
				
				<tr>								
					<th>Photo</th>
					<td><?php echo $cmphoto;?></td>
				</tr>
				
							
						</table>
						
						</div>
					</div>
</div>

<div class="portlet box blue-hoki black">
					<div class="portlet-title" style="background-color:blue;">
						<div class="caption">
							<i class="fa fa-gift"></i><small>Complain Allocated To Service Engineer</small>
						</div>
						<div class="actions">
							<?php 
							$eve11 = "select * from res_complain_detail where cmid=$cmid";
							$re11 = mysqli_query($conn, $eve11);
							if(mysqli_num_rows($re11) > 0)
							{}else{
						?>
						<a class="btn white btn-outline sbold" data-toggle="modal" href="#responsiveremark">Add New</a>
							<?php } ?>
						</div>
					</div>
					<div class="portlet-body">
											<form method="post" action="astatus.php">
						<table class="table table-bordered">
							<tr>
								<th>Sr No</th>
								
								<th>Service Engineer Name</th>
								<th>Date</th>
								<th>Status</th>
								<th>Operation</th>

							</tr>
							<?php		
											
											$count=1;
											$eve_deal = "select * from res_complain_detail";
											$re_deal = mysqli_query($conn, $eve_deal);

											while($rt_deal = mysqli_fetch_assoc($re_deal))
											{
												$cmid=$rt_deal['cmid'];
												$cdid=$rt_deal['cdid'];
												//$mdate11=implode('-', array_reverse(explode('-', $rt['mdate11'])));
												$cdstatus=$rt_deal['cdstatus'];
												
												/* $eve2 = "select * from res_complain_master where ctmid=$ctmid";
												$re2 = mysqli_query($conn, $eve2);
												while($rt2 = mysqli_fetch_assoc($re2))
												{
													$ctmname=$rt2['ctmname'];
													
												} */
												
												$serviceengineerid=$rt_deal['serviceengineerid'];
												$eve1 = "select * from res_user_master where umid=$serviceengineerid";
												$re1 = mysqli_query($conn, $eve1);
												while($rt1 = mysqli_fetch_assoc($re1))
												{
													$uname=$rt1['uname'];
												}
			
												
												
											$udelete="<a href='cdelete.php?id=".$cdid ."' onclick='return confirm(&#39;Are you sure you want to delete ?&#39;);' data-toggle='tooltip' data-placement='top' title='Delete' class='fa fa-trash-o fa-lg'>  </a>";
								
											$op=$udelete;
								
												
										?>	
							<tr>
								<td><?php echo $count++;?></td>
								
								<td><?php echo $uname;?></td>
								<td><?php echo $mdate11;?></td>
								<td><?php echo $cdstatus;?></td>
								<td><?php echo $op;?></td>
								
							
								
							 
							</tr>
							<?php
								}
							?>
									
							</tr>
							
						</table>
						</form>
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
				<form method="post" action="cadd2.php" enctype="multipart/form-data" class="form-horizontal" >		
				<input type="hidden" name="cmid" value="<?php echo $_GET['id'];?>">

				<div class="modal-body">						
				<div class="scroller" style="height:100px" data-always-visible="1" data-rail-visible1="1">							
				<div class="row">					
				<div class="col-md-12">							
				<table class="table table-bordered">
			
						
					<div class="form-group">
								<label class="col-md-3 control-label">Customer<span class="required">*</span></label>
								<div class="col-md-5">
									<select class="form-control " name="custid" required>
										<option value="0">Select Customer</option>
										<?php
										$eve_main = "select * from res_user_master where utype='customer'";
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
								<label class="col-md-3 control-label">Service Engineer<span class="required">*</span></label>
								<div class="col-md-5">
									<select class="form-control" name="serviceengineerid" required>
										<option value="0">Select Service Engineer</option>
										<?php
										$eve_main = "select * from res_user_master where utype='serviceengineer'";
										$re_main = mysqli_query($conn, $eve_main);
										while($rt_main = mysqli_fetch_assoc($re_main))
										{

											$umid=$rt_main['umid'];
											$uname=$rt_main['uname'];
											if($serviceengineerid==$umid)
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
	</form>
	</div>

<div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		 <div class="modal-dialog">
			  <div class="modal-content">

				   <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title">
							<i class="glyphicon glyphicon-user"></i> Edit Attendance Status
						</h4>
				   </div>
					 <form name="form1" method="post" action="aedit2.php" enctype="multipart/form-data">
				   <div class="modal-body">
					 <div id="modal-loader" style="display: none; text-align: center;">
						<img src="ajax-loader.gif">
					   </div>

					   <!-- content will be load here -->
					   <div id="dynamic-content"></div>

					</div>
					<div class="modal-footer">
						<input type="submit" name="submit" class="btn green" value="Submit">
						  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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


<script src="../assets/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
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
<script type="text/javascript" src="js/notification.js"/></script>	
<script src="../assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>


<script src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>


<script src="../assets/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="../assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
 
<script src="../assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>


			
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



<script>
	$(document).ready(function(){

		$(document).on('click', '#getUser', function(e){

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
</body>

</html>