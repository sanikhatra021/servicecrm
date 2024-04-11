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
	
	$ctmid=(int)mysqli_real_escape_string($conn,$_GET['id']);
	$eve = "select * from res_complaintype_master where ctmid=$ctmid";
	$re = mysqli_query($conn, $eve);
	if(mysqli_num_rows($re) > 0)
	{
		while($rt = mysqli_fetch_assoc($re))
		{
			$ctmname=$rt['ctmname'];	
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
<title>Complain Type Detail | Admin Panel</title>
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

</head>
<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
<!-- BEGIN HEADER -->
<?php
            require ('header.php');
			?><!-- END HEADER -->
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
	
	 <div class="portlet box blue">
                                <div class="portlet-title">
			<div class="caption">
				<i class="fa fa-gear"></i>Complain Type Details</div>
			<div class="actions">
				<a href="complaintype.php" class="btn white btn-outline sbold" ><i class="fa fa-arrow-left"></i> Back </a>
			</div>
		</div>
		
		<div class="portlet-body">
		<div class="table-scrollable">
			<table class="table table-bordered">
				
				<tr>								
				
					<th>Complain Type Name</th>
					<td><?php echo $ctmname;?></td>
				</tr>
				
				
				
			</table>
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