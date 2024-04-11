<?php
session_start(); 

	if(!isset($_SESSION['lacomplainsuperadmin']))
	{
		header('Location: index.php');
	}
 
	 include("connect.php");
	$conn->query("set names utf8");

 
	$mdate1= date('d-m-Y');
	$mdate= date('d-m-Y');


	$samid=(int)mysqli_real_escape_string($conn,$_GET['id']);
	$eve = "select * from res_superadmin_master where samid=$samid";
	$re = mysqli_query($conn, $eve);
	if(mysqli_num_rows($re) > 0)
	{
		while($rt = mysqli_fetch_assoc($re))
		{
				$safullname=$rt['safullname'];
				$samobile=$rt['samobile'];
				$sausername=$rt['sausername'];
				$sapassword=$rt['sapassword'];
				
				$saemailid=$rt['saemailid'];
				$saaddress=$rt['saaddress'];
				$sacity=$rt['sacity'];
				$sauloc1=$rt['sauloc1'];
				$sauloc2=$rt['sauloc2'];
				$sauserstatus=$rt['sauserstatus'];
				$sacurrentplanname=$rt['sacurrentplanname'];
				$sacurrentplantype=$rt['sacurrentplantype'];
				$satotusers=$rt['satotusers'];
				$saplanexpdate=implode('-', array_reverse(explode('-', $rt['saplanexpdate'])));
				$sacurrentplanstatus=$rt['sacurrentplanstatus'];
				$sautype=$rt['sautype'];
							
				
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
<title>Super Admin Detail| Admin Panel</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />
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
<div class="page-header navbar navbar-fixed-top">
<!-- BEGIN HEADER INNER -->
<div class="page-header-inner ">
<!-- BEGIN LOGO -->
<div class="page-logo">
<a href="#">
<img src="../../assets/layouts/layout/img/logo.png" alt="logo" class="logo-default" /> </div>
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
<div class="portlet box blue-hoki green">
<div class="portlet-title green">
						<div class="caption">
							<i class="fa fa-user"></i><small> Business Detail </small>  </div>
						<div class="actions">
							
						</div>
					</div>

<div class="portlet-body form">
<!-- BEGIN FORM-->
									<?php
										$samid=(int)mysqli_real_escape_string($conn,$_GET['id']);
										
										$eve = "select * from res_superadmin_master where samid=$samid";
										$re = mysqli_query($conn, $eve);
										while($rt = mysqli_fetch_assoc($re))
										{
											$saurl=$rt['saurl'];
											$saqrimg=$rt['saqrimg'];
											$safullname=$rt['safullname'];
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
											$main=$protocol.$hostName;
											$main1=$protocol.$hostName."/";
											//return;
											
											$saurl1=$main1."fieldservice/".$saurl;
											
											$eve1 = "select umobile,upassword from res_user_master where samid=$samid and utype in('Admin')";
											$re1 = mysqli_query($conn, $eve1);
											while($rt1 = mysqli_fetch_assoc($re1))
											{
												$umobile=$rt1['umobile'];
												$upassword=$rt1['upassword'];
											}
											$eve11 = "select umobile,upassword from res_user_master where samid=$samid and utype in('serviceengineer') order by umid asc limit 1";
											$re11 = mysqli_query($conn, $eve11);
											while($rt11 = mysqli_fetch_assoc($re11))
											{
												$semobile=$rt11['umobile'];
												$sepassword=$rt11['upassword'];
											}
										}
										
										$eve12 = "select sapplink from res_settings_master limit 1";
										$re12 = mysqli_query($conn, $eve12);
										while($rt12 = mysqli_fetch_assoc($re12))
										{
											$sapplink=$rt12['sapplink'];
										}	
									?>
									
									<form action="" method="POST" class="form-horizontal">
												<input type="hidden" name="samid" value="<?php echo $samid; ?>">
												
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                         
                                                            <div class="col-md-9">
                                                             Dear <?php echo $safullname; ?>,
															</BR></BR>
															Customer Inquiry Link:</BR>
															<?php echo $saurl1; ?></BR>
															Download QR Code<br>
															<?php echo $main1."images/".$saqrimg; ?>
															</BR></BR>	
															Your Admin Panel URL:</BR>
															<?php echo $main."/businesspanel/"; ?>
															</BR>
															Username: <?php echo $umobile; ?></BR>
															Password: <?php echo $upassword; ?>
															</BR></BR>
															Android App Link for your Complain: </BR> 
															<?php echo $sapplink; ?>
															</BR>
															Username: <?php echo $semobile; ?></BR>
															Password: <?php echo $sepassword; ?>
															</BR></BR>
															For any technical support please call to 9727733126
															</BR></BR>
															Regards,
															
															</BR></BR>
                                                            </div>
                                                        </div>
														
														
														
														
														
                                                    <!-- /input-group -->
                                                   	
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                               
                                                                <button type="button" class="btn green" onclick="document.location.href='superadmin.php'"><i class="fa fa-check"></i> Done</button>
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
<div class="page-footer-inner">&copy; 2020

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
<script src="../../assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>


<script src="../../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>


<script src="../../assets/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
<script src="../../assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
 
<script src="../../assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>




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