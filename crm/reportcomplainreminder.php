<?php
session_start(); 
	
	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
		return;
	}
	$samid=$_SESSION['samid'];
	date_default_timezone_set("Asia/Kolkata");

	$mdate= date('Y/m/d');
	$rdate1= date('d-m-Y');
	
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
	}
	else
	{
		$lower = date('Y-m-d', strtotime($mdate)-1000);
		$upper = date('Y-m-d', strtotime($mdate));
	}
	
	$rdate2= date('d-m-Y', strtotime('-30 days'));
	
	if(isset($_POST['cstatus']))
	{
		$status=$_POST['cstatus'];
	}
	
?>
<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.5
Version: 4.5.2
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Pending Service Call Detail Report | Admin Panel</title>
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
		<link href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
		<link href="../assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
		<link href="../assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
		<link href="../assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
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
		
		<link href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
		 <link href="../assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link href="../assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />

        <link rel="shortcut icon" href="favicon.ico" /> </head>
    <!-- END HEAD -->

<?php

	include("connect.php");
	
	
	date_default_timezone_set("Asia/Kolkata");
	$mdate= date('d-m-Y');
	$rdate1= date('d-m-Y');
	$rdate2= date('d-m-Y', strtotime('-30 days'));
	
?>


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
                <!-- END PAGE HEADER-->
					
					
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet light bordered">
                          
							
							
                            <div class="portlet-body">
                               
								
								<div class="row">
								
                        <div class="col-md-12">
                            <!-- BEGIN PORTLET-->
                            <div class="portlet box" style="background-color:#0078BF;">
                                <div class="portlet-title">
                                    <div class="caption">
                                        Pending Service Call Report</div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                        <a href="javascript:;" class="reload"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <!-- BEGIN FORM-->
                                    <form  method="post" class="form-horizontal form-bordered">
                                      <div class="form-body">
									  
									  <div class="form-group">
                                                <label class="control-label col-md-2">Date Ranges</label>
                                                <div class="col-md-4">
                                                    <div class="input-group" id="defaultrange">
                                                        <input type="text" name="daterange" class="form-control" value="<?php if( isset($_POST['daterange']) ){ echo $_POST['daterange'];}else{echo $rdate2." - ".$rdate1;}		?>">
                                                        <span class="input-group-btn">
                                                            <button class="btn default date-range-toggle" type="button">
                                                                <i class="fa fa-calendar"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                         
							<div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-1">
                                                    <button type="submit" name="btnsubmit" class="btn red">
                                                        <i class="fa fa-check"></i> Submit</button>
                                                    
                                                </div>
                                            </div>
                                        </div>
								</div>
								
							
						 
											
							
									
                                    </form>

                                    <!-- END FORM-->
                                </div>
                            </div>
                            <!-- END PORTLET-->
                        </div>
						
					
								<div class="col-md-6"></div>
								<div class="col-md-6">
							
								
						</div>
								<br>
								<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_2">
                                    <thead>
                                        <tr>
                                			  
												 <th class="sorting" style="display:none;"></th>
												 <th> Sr. No.</th>
												 <th>Reminder Date</th>
												 <th>Rmark</th>
												 <th>Ticket</th>
												 <th>Customer</th>
												 <th>Mobile</th>
												 <th>Product</th>
												 <th>Call Type</th>
												 <th>Service Engineer </th>
												 <th>Status</th>
												 <th>Call Date</th>
												 <th>Completed Date</th>
												
											
												
											
                                        </tr>
                                    </thead>
                                    <tbody>
									
									<?php
									$i=1;
										        
									
										
										  /*  $eve22 = "SELECT * FROM res_complain_master where samid=$samid and cmdate between '$lower' and '$upper' $tt $tt2 and cmid in (select cmid from res_complain_detail where cmid!=-11 $tt1)and customerid in(select umid from res_user_master) order by cmid desc "; */
										  
										   $eve22 = "SELECT * FROM res_complain_master,res_user_master where res_complain_master.customerid=res_user_master.umid and res_user_master.samid=$samid and res_complain_master.cmpcallreminderdate between '$lower' and '$upper' and res_complain_master.cmpcallreminder=1  order by res_complain_master.cmpcallreminderdate desc ";
										  $re22 = mysqli_query($conn, $eve22);

									 while($rt22 = mysqli_fetch_assoc($re22))
										{
											$cmdate=date("d-m-Y", strtotime($rt22['cmdate']));
											$ctmid=$rt22['ctmid'];
											$cmid=$rt22['cmid'];
											$customerid=$rt22['customerid'];
											$ctmtype = $rt22['cmtype'];
											$problemtype = $rt22['cmproblemtype'];
											$cmpcallreminderremark = $rt22['cmpcallreminderremark'];
											$completeddate = date("d-m-Y", strtotime($rt22['cmupdatedon']));
											$cmpcallreminderdate = date("d-m-Y", strtotime($rt22['cmpcallreminderdate']));
											
											/* echo $eve12="select * from res_complaintype_master where ctmid=$ctmid";
											$re12 = mysqli_query($conn, $eve12);
											$ctmname="";
											while($rt12 = mysqli_fetch_assoc($re12))
											{
												 $ctmname=$rt12['ctmname'];
											} */
											$pmid=$rt22['pmid'];
											$eve123="select * from res_product_master where pmid=$pmid";
											$re123 = mysqli_query($conn, $eve123);
											$pmname="";
											while($rt123 = mysqli_fetch_assoc($re123))
											{
												$pmname=$rt123['pmname'];
											}
											
										
												 $customer=$rt22['uname'];
												 $umobile=$rt22['umobile'];
												 $usite=$rt22['usite'];
												  $upriority=$rt22['upriority'];
										
											
											 //$eve1289="select * from res_user_master where samid=$samid and umid in(select serviceengineerid from res_complain_detail where cmid=$cmid)";
											 $eve1289="select * from res_user_master where samid=$samid and umid in(SELECT serviceengid from  res_complainallocation_detail where cmid=$cmid)";
											$re1289 = mysqli_query($conn, $eve1289);
											$serviceengineer="";
											
											while($rt1289 = mysqli_fetch_assoc($re1289))
											{
												 $serviceengineer=$rt1289['uname'];
												
											}
											
											$cstatus=$rt22['cstatus'];
												 if($cstatus!='Completed')
												 {
													 $completeddate="";
												 }
				
				 
				if($upriority=="High")
				{
					
					$cmno="<span class='label label-sm label-danger'>$rt22[cmnowithprefix]</span>";
				     $cmnonew="<a href='complaindetail.php?id=".$rt22['cmid']."&page=Complain' title='Click Here' class=' hidden-print'> $cmno</a>";
				}
				else if($upriority=="Medium")
				{
					$cmno="<span class='label label-sm label-warning'>$rt22[cmnowithprefix]</span>";
					$cmnonew="<a href='complaindetail.php?id=".$rt22['cmid']."&page=Complain' title='Click Here' class=' hidden-print'> $cmno</a>";
				}
				else if($upriority=="Low")
				{
					$cmno="<span class='label label-sm label-success'>$rt22[cmnowithprefix]</span>";
					$cmnonew="<a href='complaindetail.php?id=".$rt22['cmid']."&page=Complain' title='Click Here' class=' hidden-print'>$cmno </a>";
				}
				else
				{
					$cmno="<span class='label label-sm label-danger'>$rt22[cmnowithprefix]</span>";
					$cmnonew="<a href='complaindetail.php?id=".$rt22['cmid']."&page=Complain' title='Click Here' class=' hidden-print'>$cmno </a>";
					
				}
				
										?>
									
										<tr class="odd gradeX">
											<td class="sorting" style="display:none;"></td>
											<td> <?php echo $i++; ?> </td>
											<td> <?php echo $cmpcallreminderdate; ?> </td>
											<td> <?php echo $cmpcallreminderremark; ?> </td>
											<td> <?php echo $cmnonew; ?> </td>
											<td> <?php echo $customer; ?> </td>
											<td> <?php echo $umobile; ?> </td>
												<td> <?php echo $pmname; ?> </td>
										
											<td> <?php echo $ctmtype; ?> </td>
											<td> <?php echo $serviceengineer; ?> </td>
											<td> <?php echo $cstatus; ?> </td>
											<td> <?php echo $cmdate; ?> </td>
											<td> <?php echo $completeddate; ?> </td>
											
											
										</tr>
									
									<?php
										 
										}
										
									?>
                                    </tbody>
                                </table>
						
								<a class="btn blue hidden-print margin-bottom" onclick="javascript:window.print();"> Print
                                    <i class="fa fa-print"></i>
                               </a>
										<div class="btn-group">
										
										<button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">
											Export
											<i class="fa fa-angle-down"></i>
											</button>
										<ul class="dropdown-menu pull-right">
											<li>
												<a href="javascript:;" onClick ="$('#sample_2').tableExport({type:'excel',escape:'false'});" >
													<i class="fa fa-file-excel-o"></i> Export to Excel
												</a>
											</li>

											<li>
												<a href="javascript:;" onClick ="$('#sample_2').tableExport({type:'csv',escape:'false'});" >
													<i class="fa fa-file-excel-o"></i> Export to CSV
												</a>
											</li>
										</ul>
									</div>
								<div>
								
								</div>
								
                            </div>
							
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
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
            <div class="page-footer-inner">&copy; Arth Technology.
               
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
		<script src="../assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>


<script src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
		<script src="../assets/global/scripts/datatable.js" type="text/javascript"></script>
		<script src="../assets/global/plugins/datatables/datatables.js" type="text/javascript"></script>
		<script src="../assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
		<script src="../assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
		<!-- <script src="../assets/pages/scripts/table-datatables-buttons.min.js" type="text/javascript"></script> -->

		<script src="../assets/pages/scripts/components-date-time-pickers.js" type="text/javascript"></script>
		
		 <script src="../assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
		 
		<script src="../assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="../assets/myjs/64/jquery.base64.js"/></script>
		<script type="text/javascript" src="../assets/myjs/tableexport.js"/></script>

		
			
<?php
if(isset($_SESSION['refid']))
{
	
?>
		<script lang="javascript">
	
			//$('#sample_2').DataTable().search('<?php echo "#".$_SESSION['refid'];  ?>').draw(); 
		
			$('#sample_2').dataTable({ 
			"paging": false,
			 "info": false});
		</script>
<?php
unset($_SESSION['refid']);
}


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
?>				
		
	<script type="text/javascript">
			$(document).ready(function(){
				$('#pmid').on('change',function(){
					$("#bmid").prop("selectedIndex", 0).change();
					var pmid = $(this).val();
					if(pmid){
						$.ajax({
							type:'POST',
							url:'farmerblockdata.php',
							data:'pmid='+pmid,
							success:function(html){
								$('#bmid').html(html);
							}
					});
							
					}
				});
			});
	</script>	
	<script type="text/javascript">
			$(document).ready(function(){
				$('#bmid').on('change',function(){
					var bmid = $(this).val();
					if(bmid){
						$.ajax({
							type:'POST',
							url:'farmerzonedata.php',
							data:'bmid='+bmid,
							success:function(html){
								$('#zonemid').html(html);
							}
						});
					}else{
						$('#zonemid').html('<option value=""></option>');
					}
				});
			});
	</script>	
	
	<script type="text/javascript">
			$(document).ready(function(){
				$('#zonemid').on('change',function(){
					var zonemid = $(this).val();
					if(zonemid){
						$.ajax({
							type:'POST',
							url:'farmersubzonedata.php',
							data:'zonemid='+zonemid,
							success:function(html){
								$('#szonemid').html(html);
							}
						});
					}else{
						$('#szonemid').html('<option value=""></option>');
					}
				});
			});
	</script>
	
    </body>

</html>