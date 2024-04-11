<?php
session_start(); 

	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
	}
 
	include("connect.php");
	$conn->query("set names utf8");

    $samid=$_SESSION['samid'];
	$mdate= date('d-m-Y');
	$mdate11= date('Y-m-d');
	
	$amcid=(int)mysqli_real_escape_string($conn,$_GET['id']);
	$eve = "select * from res_service_master where amcid=$amcid";
	$re = mysqli_query($conn, $eve);
	$amcid1='';
	
	if(mysqli_num_rows($re) > 0)
	{
		while($rt = mysqli_fetch_assoc($re))
		{
			
			   $amcid=$rt['amcid'];
											
				$sstartdate=implode('-', array_reverse(explode('-', $rt['sstartdate'])));
				$senddate=implode('-', array_reverse(explode('-', $rt['senddate'])));
				$pdate=implode('-', array_reverse(explode('-', $rt['spurchasedate'])));
				$sremarks=$rt['sremarks'];
				$sserialno=$rt['sserialno'];
				$servicetype=$rt['servicetype'];
				
				$pmid=$rt['pmid'];
				$eve1 = "select * from res_product_master where pmid=$pmid";
				$re1 = mysqli_query($conn, $eve1);
				while($rt1 = mysqli_fetch_assoc($re1))
				{
					$pmname=$rt1['pmname'];
				}
				$umid=$rt['custid'];
				$eve1 = "select * from res_user_master where umid=$umid";
				$re1 = mysqli_query($conn, $eve1);
				while($rt1 = mysqli_fetch_assoc($re1))
				{
					$uname=$rt1['uname'];
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
<title>AMC Detail | Admin Panel</title>
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
	
	<div class="portlet box blue-hoki">
	
		<div class="portlet-title" style="background-color:black;">
			<div class="caption">
				<i class="fa fa-gift"></i>AMC Details</div>
			<div class="actions">
				<a href="amc.php" class="btn white btn-outline sbold" > Back </a>
			</div>
		</div>
		
		<div class="portlet-body">
		<div class="table-scrollable">
			<table class="table table-bordered">
				
				<tr>								
				
					<th>Product Name</th>
					<td><?php echo $pmname;?></td>
					<th>Customer Name</th>
					<td><?php echo $uname;?></td>
				</tr>
				<tr>								
				    <th>Purchase Date</th>
					<td><?php echo $pdate;?></td>
					<th>Remark</th>
					<td><?php echo $sremarks;?></td>
				</tr>
				<tr>								
				    <th>Start Date</th>
					<td><?php echo $sstartdate;?></td>
					<th>End Date</th>
					<td><?php echo $senddate;?></td>
				</tr>
				
				<tr>								
				    <th>Serial No</th>
					<td><?php echo $sserialno;?></td>
					<th>Service Type</th>
					<td><?php echo $servicetype;?></td>
				</tr>
				
				
				
			</table>
		</div>
</div>


</form>

<!-- END FORM-->


</div>
<!-- portlet end --->
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
								<th>Opretion</th>
								
							</tr>
							<?php		
											
											$count=1;
											$no=1;
											$eve_deal = "select * from res_complain_master where samid=$samid and customerid=$umid";
											$re_deal = mysqli_query($conn, $eve_deal);
											$t1=0;
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
												
											 	$eve2122 = "select * from res_service_master where amcid=$amcid";
												$re2122 = mysqli_query($conn, $eve2122);
												
												while($rt2122 = mysqli_fetch_assoc($re2122))
												{
													$sserialno=$rt2122['sserialno'];
												} 
												  // $udelete="<a href='servicedelete.php?id=".$cmid ."' onclick='return confirm(&#39;Are you sure you want to delete ?&#39;);' data-toggle='tooltip' data-placement='top' title='Delete' class='fa fa-pencile'>  </a>";
								
												// $op=$udelete;  
								
										?>	
												<tr>
													<td><?php echo $no;?></td>
													<td><?php echo $amcid;?></td>
													<td><?php echo $cmid;?></td>
													<td><?php echo $pmname;?></td>
													<td><?php echo $cmdate;?></td>
													<td><?php echo $cstatus;?></td>
													<td><?php ?></td>
													
												</tr>
										<?php
										$no++;
											}
											
										?>
						</table>
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




<script type="text/javascript">
$(function () {
$("#emailinput").hide();
$("#emailinput1").hide();
$("#emailinput2").hide();
$("#emailsubject").hide();
$("#emailc").change(function () {
if ($(this).val() == "1") {
$("#emailinput").show();
$("#emailinput1").show();
$("#emailinput2").show();
$("#emailsubject").show();
} else {
$("#emailinput").hide();
$("#emailinput1").hide();
$("#emailinput2").hide();
$("#emailsubject").hide();
}
});
});

$(function () {
$("#smsinput").hide();
$("#smsinput1").hide();
$("#smsmessage").hide();

$("#smsc").change(function () {
if ($(this).val() == "1") {
$("#smsinput").show();
$("#smsinput1").show();
$("#smsmessage").show();
} else {
$("#smsinput").hide();
$("#smsinput1").hide();
$("#smsmessage").hide();
}
});
});


$(function () {
$("#pono").hide();
$("#podate").hide();

$("#qstatus").change(function () 
{
if ($(this).val() == "Converted To Sales") 
{
$("#pono").show();
$("#podate").show();	
} 
else 
{
$("#pono").hide();
$("#podate").hide();
}
});
});




</script>


<script>
$(document).ready(function(){

$(document).on('click', '#getCustomer', function(e){

e.preventDefault();

var uid = $(this).data('id');   // it will get id of clicked row

$('#dynamic-content').html(''); // leave it blank before ajax call
$('#modal-loader').show();      // load ajax loader

$.ajax({
url: 'orderreminder1.php',
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

<script type="text/javascript">
$(function () 
{
$("#tmbankname").hide();
$("#tmchkno").hide();
$("#tmode").change(function () 
{
if ($(this).val() == "Cheque") 
{
$("#tmbankname").show();
$("#tmchkno").show();
}
else
{
$("#tmbankname").hide();
$("#tmchkno").hide();
}
});
});
</script>
</body>

</html>