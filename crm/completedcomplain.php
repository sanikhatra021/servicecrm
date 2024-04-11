<?php
session_start(); 
		/* complain list page*/
	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
		return;
	}
	$samid=$_SESSION['samid'];
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('Y/m/d');
	$mdate1= date('d-m-y h:i:sa');				
	$mdate2= date('d-m-Y');
	$mdate3= date('d-m-Y');
	 if(isset($_POST['daterange']))
	{
		$p1 = $_POST['daterange'];

		$dd1 = substr($p1,0,2);
		$mm1 = substr($p1,3,2);
		$yy1 = substr($p1,6,4);

		$dd2 = substr($p1,13,2);
		$mm2 = substr($p1,16,2);
		$yy2 = substr($p1,19,4);

		$lower = "$yy1-$mm1-$dd1";
		$upper = "$yy2-$mm2-$dd2";
		//$cstatus = $_POST['cstatus'];
		$_SESSION['cstatus']=$_POST['cstatus'];
		$_SESSION['cmtype']=$_POST['cmtype'];
		  $_SESSION['daterange']=$_POST['daterange'];
		  $_SESSION['lowerdate']=$lower;
	  $_SESSION['upperdate']=$upper;
	}
	else if(isset($_GET['cstatus']))
	{
		$_SESSION['cstatus']=$_GET['cstatus'];
		$status=$_GET['cstatus'];
		$lower =  date('Y-m-d', strtotime('-1 months'));
		$upper =  date('Y-m-d',strtotime(date('Y-m-d')));
		$startdate =  date('d-m-Y', strtotime('-1 months'));
		$enddate =  date('d-m-Y',strtotime(date('Y-m-d')));
		//$lower =  $_SESSION['lowerdate'];
		//$upper =  $_SESSION['upperdate'];
		
		//$_SESSION['cstatus']="All";
		// $status='Pending';
		// $_SESSION['cstatus']="All";
	  $_SESSION['lowerdate']=$lower;
	  $_SESSION['upperdate']=$upper; 
	}
	else
	{
		/* $lower =  date('Y-m-d', strtotime('-1 months'));
		$upper =  date('Y-m-d',strtotime(date('Y-m-d')));
		$startdate =  date('d-m-Y', strtotime('-1 months'));
		$enddate =  date('d-m-Y',strtotime(date('Y-m-d'))); */
			$lower =  date('Y-m-d', strtotime('-1 months'));
		$upper =  date('Y-m-d',strtotime(date('Y-m-d')));
		$startdate =  date('d-m-Y', strtotime('-1 months'));
		$enddate =  date('d-m-Y',strtotime(date('Y-m-d')));
		//$_SESSION['cstatus']="All";
		// $status='Pending';
		// $_SESSION['cstatus']="All";
	//$_SESSION['cstatus']='Pending';
	//$status=$_SESSION['cstatus'];
	  $_SESSION['lowerdate']=$lower;
	  $_SESSION['upperdate']=$upper;
unset($_SESSION['cstatus']);	  
	}
	
	
	
  	/* $status=$_GET['status'];	
   $_SESSION['cstatus']=="$status"; */
	
	
	
	/* else
	{
      $_SESSION['daterange']='';
	} */
	 /* if($_GET['cid']='uac'){
		$status = 'Unallocated';
		$_SESSION['cstatus']='Unallocated';
	} elseif ($_GET['cid']== 'pc'){
		$status = 'Pending';
		$_SESSION['cstatus']='Pending';
	} else{
		$status = 'All';
		$_SESSION['cstatus']='All';
	} 
 */
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
        <title>Call | Admin Panel </title>
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
		<link href="../assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="favicon.ico" />
		<link href="../assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="favicon.ico" />
		<link href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
		<link href="../assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
		<link href="../assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />		
		<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
		
		</head>
		
    <!-- END HEAD -->

<?php

	include("connect.php");

	
				date_default_timezone_set("Asia/Kolkata");
				$mdate1= date('d-m-Y');
				$mdate= date('Y-m-d-m-Y h:i:sa');
								
				
?>

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <!-- BEGIN HEADER -->
  <?php
            require ('header.php');
			?>       <!-- END HEADER -->
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
					
                  
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
					
					
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption font-dark">
                                    <h3><i class="fa fa-user-plus"></i>
                                    <span class="caption-subject bold uppercase">Completed Call </span></h3>
                                </div>
                                <div class="actions">
							
									
									
									
								</div>
							</div>
							
							<div class="alert alert-block alert-info fade in hidden">
									<button type="button" class="close" data-dismiss="alert"></button>
									<p>Here we can see completed & cancel Call list.</p>
								</div>
							<!------------>
							
							<form method="post" class="form-horizontal form-bordered">
							<div class="form-body">
										
												<div class="form-group">
                                                
                                           	
												 <label class="col-md-1 control-label">Status </label>
													<div class="col-md-2">
														<select class="form-control select2" name="cstatus" id="cstatus">
														<option value='Completed' <?php if(isset($_SESSION['cstatus']) && $_SESSION['cstatus']=='Completed' ){ echo "selected";} ?> >Completed</option>
														<option value='Cancel' <?php if(isset($_SESSION['cstatus']) && $_SESSION['cstatus']=='Cancel'){ echo "selected";} ?> >Cancel</option>
														
														
														
														</select>
													</div> 
											
											<label class="col-md-1 control-label">Call Type </label>
													<div class="col-md-2">
															<select class="form-control select2" name="cmtype" id="cmtype">
														<option value='All' <?php if(isset($_SESSION['cmtype']) && $_SESSION['cmtype']=='All' ){ echo "selected";} ?> >All</option>
														<?php
										 $eve_category1 = "select cmtype from res_complain_master where  samid='$samid' group by cmtype";
										$re_category1 = mysqli_query($conn, $eve_category1);
										while($rt_category1 = mysqli_fetch_assoc($re_category1))
										{

											$cmtype=$rt_category1['cmtype'];
											
											
											if(isset($_SESSION['cmtype']) && $_SESSION['cmtype']==$cmtype){
												echo "<option value='$cmtype' selected>$cmtype</option>";
											}
											else{
												echo "<option value='$cmtype' >$cmtype</option>";
											}

										}
									?>
														
														
														</select>
													</div> 
													<label class="control-label col-md-1">Date Ranges</label>
                                                <div class="col-md-2">
                                                    <div class="input-group" id="defaultrange">
                                                       <input type="text" name="daterange" class="form-control" value="<?php if( isset($_POST['daterange']) ){ echo $_POST['daterange'];}else{ echo $startdate." - ".$enddate;}	?>">
                                                        <span class="input-group-btn">
                                                            <button class="btn default date-range-toggle" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                               <div class="col-md-1">
                                                    <button type="submit" name="btnsubmit" class="btn red">
                                                        <i class="fa fa-check"></i> Submit</button>
                                                   
                                                </div>
                                            
												</div>
												
                                        </div>
                                       
                                    </form>	
								
								
							<form method="post" action="">
								<div class="portlet-body">

									<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_5">
										
									</table>
								</div>
							</form>
							<a class="btn blue hidden-print margin-bottom" onclick="javascript:window.print();"> Print
                                    <i class="fa fa-print"></i>
                               </a>
							    	<div class="btn-group">
									<button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">
										Export
										<i class="fa fa-angle-down"></i>
										</button>
									<ul class="dropdown-menu">
										<li>
											<a href="javascript:;" onClick ="ExportToExcel('xlsx')" >
												<i class="fa fa-file-excel-o"></i> Export to Excel
											</a>
										</li>

									</ul>
								</div>
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
                    </div>
                </div>
					
                </div>
				
				<!------------------Start Vendor Document Submitted Status------------------------->
	
	<div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
		 <div class="modal-dialog">
			  <div class="modal-content">

				   <div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title">
							<i class="glyphicon glyphicon-user"></i> Allocate Service Engineer
						</h4>
				   </div>
					 <form name="form1" method="post" action="customerallocatedriver2.php">
					 <input type="hidden" name="from" value="cmpc">
				   <div class="modal-body">
					 <div id="modal-loader" style="display: none; text-align: center;">
						<img src="ajax-loader.gif">
					   </div>

					   <!-- content will be load here -->
					   <div id="dynamic-content"></div>

					</div>
					<div class="modal-footer">
						<button type="submit" class="btn green" value="Submit"><i class="fa fa-check"></i> Submit</button>
						  <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Close</button>
					</div>
				</form>
			 </div>
		  </div>
	</div>
	<!------------------End Vendor Document Submitted Status------------------------->
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
            <a href="javascript:;" class="page-quick-sidebar-toggler">
                <i class="icon-login"></i>
            </a>
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
	     <script src="../assets/pages/scripts/components-date-time-pickers.js" type="text/javascript"></script>

        <script src="../assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
		<script src="../assets/pages/scripts/ui-toastr.min.js" type="text/javascript"></script>
		<script src="../assets/global/plugins/bootstrap-toastr/toastr.min.js" type="text/javascript"></script>

		 <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="../assets/pages/scripts/dashboard.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="../assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->

		<script src="../assets/global/scripts/datatable.js" type="text/javascript"></script>
		<script src="../assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
		
		<script src="../assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
		<script src="../assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
		<!-- <script src="../assets/pages/scripts/table-datatables-buttons.min.js" type="text/javascript"></script> -->
		<script src="../assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
		<script src="../assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
		
		<script type="text/javascript" src="myjs/64/jquery.base64.js"/></script>
		<script type="text/javascript" src="myjs/tableexport.js"/></script>
		<script type="text/javascript" src="js/notification.js"/></script>
		
		

		
	
		
			
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
$(document).ready(function() {
    $('#sample_5').DataTable( {
        "ajax": "./completedcomplainjson.php",
		"language": {
			 "loadingRecords": "No Data found..."
		  }, 
        "columns": [
                
				{ "data": "srno","title":"#" },
				
				{ "data": "cmno","title":"Ticket" },
				{ "data": "cmdate","title":" Call Date" },
				{ "data": "uname","title":"Customer Name"},
				{ "data": "umobile","title":"Mobile No"},
				{ "data": "pmname","title":"Product Name" },
				{ "data": "cmproblemtype","title":"Call Category" },
				{ "data": "cstatus","title":"Status" },
				{ "data": "cmtype","title":"Call Type" },
				{ "data": "cmdetail","title":"Call Detail" },
				{ "data": "servicecontract","title":"Contract" },
				{ "data": "staff","title":"Staff" },
				{ "data": "op","title":"Operation" },
				//{ "data": "cmmethod","title":"Call Method" },
				
				
		   
			
        ],
	'order': [[0, 'asc']]
		
		
		
    } );
} );
</script>	

<script>
	$(document).ready(function(){

		$(document).on('click', '#getUser', function(e){

			e.preventDefault();

			var uid = $(this).data('id');   // it will get id of clicked row

			$('#dynamic-content').html(''); // leave it blank before ajax call
			$('#modal-loader').show();      // load ajax loader

			$.ajax({
				url: 'customerallocatedriver.php',
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
		<script>

          function ExportToExcel(type, fn, dl) {
              var elt = document.getElementById('sample_5');
              var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
              return dl ?
                  XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
                  XLSX.writeFile(wb, fn || ('Completed_Complain.' + (type || 'xlsx')));
          }

      </script>	
    </body>

</html>