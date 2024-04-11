
<html lang="en">
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include "connect.php";
$mdate2= date('d-m-Y');

$NewDate=Date('d-m-Y', strtotime('+30 days'));


		$id = intval($_REQUEST['id']);
	    $eve="select cmadminstatus from res_complain_master where cmid=$id";
		$re = mysqli_query($conn, $eve);
		while($rt = mysqli_fetch_assoc($re))
		{
			$cmadminstatus=$rt['cmadminstatus'];
			
		}
		
		
$cdate= date('d-m-Y');
		$daydiff=+30;
		$nextday=date('d-m-Y', strtotime($cdate. ' + '.$daydiff.' days'));
		$cdate= date('d-m-Y');
		
?>
 <head>
        <meta charset="utf-8" />
        <title>Complain Add | Admin Panel</title>
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
	<body>
		<div class="table-responsive">
		<table class="table table-striped table-bordered">
			<input type="hidden" name="cmid" value="<?php echo $id; ?>">
		    <tr>
			  
				<td>
																<div class="form-group">
																		
																	<div class="form-group">
																		<label class="col-md-4 control-label">Remind For Call</label>
																		<div class="col-md-6">
																			<select name="followup" id="followup" class="form-control">
																				<option  value="Yes">Yes</option>

																				<option  value="No">No</option>
																			</select>
																		</div>
																	</div>
																	<br><br>
																	 
			 
																	 <div class="form-group" id="fdate">
																			<label class="col-md-4 control-label">Reminder Date</label>
																			<div class="col-md-6">
																				<div class="" data-date-format="dd-mm-yyyy" >
																					
																					<input class="form-control form-control-inline  date-picker" data-date-format="dd-mm-yyyy" type="text" name="fdate" value="<?php echo $NewDate;?>" required>
																				</div>
																			</div>
																		</div>
																	<br>
																	<br>
																	 <div class="form-group" id="remarks">
																			<label class="col-md-4 control-label">Remarks</label>
																			<div class="col-md-6">
																				
																					<input type="text" id="" name="remarks" class="form-control" value="" >
																				
																			</div>
																		</div>
																	
				</td>
			</tr>
			
		</table>
		
		
		
		 <script type="text/javascript">
	/* $(document).ready(function(){
		$("#fdate").hide();
		$("#remarks").hide();
		

        $("#followup").change(function () {
            if ($(this).val() == "No") {
                $("#fdate").hide();
				$("#remarks").hide();
				
            } else {
                $("#fdate").show(); 
				$("#remarks").show();
				
            }
        });
    });*/
</script>  


<script type="text/javascript">
	$(document).ready(function(){
		$("#fdate").show();
		$("#remarks").show();

        $("#followup").change(function () {
            if ($(this).val() == "Yes") {
                $("#fdate").show();
				$("#remarks").show();
            } else {
                $("#fdate").hide();
				$("#remarks").hide();
            }
        });
    });
</script>

		</div>
		</body>
		
		
		
		
			
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
		
