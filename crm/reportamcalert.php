<?php
session_start(); 
	include("connect.php");
	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
	}
	$samid=$_SESSION['samid'];
	
	date_default_timezone_set("Asia/Kolkata");

	$mdate= date('Y/m/d');
	$mdate1= date('d-m-Y');
	
	if(isset($_POST['daterange']))
	{
		//$umid1 = $_POST['umid'];
		$p1 = $_POST['daterange'];
		
		$dd1 = substr($p1,0,2);
		$mm1 = substr($p1,3,2);
		$yy1 = substr($p1,6,4);

		$dd2 = substr($p1,13,2);
		$mm2 = substr($p1,16,2);
		$yy2 = substr($p1,19,4);
		
		
		//echo $dd1.$mm1.$yy1.$dd2.$mm2.$yy2;
		//return;
		
		$lower = "$yy1-$mm1-$dd1";
		$upper = "$yy2-$mm2-$dd2";
	}
	else
	{
		$lower = date('Y-m-d', strtotime($mdate)-1000);
		$upper = date('Y-m-d', strtotime($mdate));
	}
	
	$rdate2= date('d-m-Y', strtotime('-30 days'));
	
			
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
        <title>AMC Alert Report | Admin Panel</title>
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
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                 <!-- BEGIN LOGO -->
                <div class="page-logo">
                    
                    <div class="page-logo">
							<a href="#">
							<img src="../../assets/layouts/layout/img/logo.png" alt="logo" class="logo-default" /> </div>
							</div>
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
                                <span class="username username-hide-on-mobile"> <?php echo $_SESSION['uname'];?> </span>
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
                       
                        <!-- END QUICK SIDEBAR TOGGLER -->
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
                <!-- END PAGE HEADER-->
					
					
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet light bordered">
                            <div class="portlet-title">
							
                               <div class="caption font-dark">
                                    <i class="fa fa-warning"></i>
                                    <span class="caption-subject bold uppercase">AMC Alert Report</span>
								</div>
                                <div class="actions">
								
								</div>
								</div>
							
							
                            <div class="portlet-body">
                               
								
								<div class="row">
								
                        <div class="col-md-12 hidden-print">
                            <!-- BEGIN PORTLET-->
                     	
						<br><br>
								<div class="col-md-6"></div>
								<div class="col-md-6">
									<div class="btn-group pull-right">
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
									<br><br>
						</div>
								<br>
								<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_2">
                                    <thead>
                                        <tr>
                                			  
												 <th class="sorting" style="display:none;"></th>
												 <th> Sr. No.</th>
												 <th>PRODUCT NAME</th>
												 <th>CUSTOMER NAME</th>
												 <th>TYPE</th>
												 <th>NO OF SEAT</th>
												 <th>SERIAL NO</th>
												 <th>REMARKS</th>
												 <th>START DATE</th>
												 <th>END DATE</th>
												
                                        </tr>
                                    </thead>
                                    <tbody>
									
									<?php
									$i=1;
									$datenew = date('Y-m-d', strtotime('+30 days'));
									//$datenew=date('Y-m-d',strtotime('+30 days',strtotime($mdate1)));	        
								
								 $eve22 = "SELECT * FROM res_amc_master where custedate < '$datenew' and umid in(select umid from res_user_master) order by amcid desc";
								 $re22 = mysqli_query($conn, $eve22);

									 while($rt22 = mysqli_fetch_assoc($re22))
										{

										        $amcid =$rt22['amcid'];
										        $amctype =$rt22['amctype'];
										        $amcnoofseat =$rt22['amcnoofseat'];
										        $amcserial =$rt22['amcserial'];
										        $custremarks =$rt22['custremarks'];
										        $custsdate =implode('-', array_reverse(explode('-', $rt22['custsdate'])));
										        $custedate =implode('-', array_reverse(explode('-', $rt22['custedate'])));
												
												$pmid =$rt22['pmid'];
												$eve_main2 = "select pmname from res_product_master where pmid=$pmid";
												$re_main2 = mysqli_query($conn, $eve_main2);
												$pmnamenew="";
												while($rt_main2 = mysqli_fetch_assoc($re_main2))
												{
													$pmnamenew=$rt_main2['pmname'];
												}
												$umid =$rt22['umid'];
												$eve_main2 = "select uname from res_user_master where umid=$umid";
												$re_main2 = mysqli_query($conn, $eve_main2);
												$unamenew="";
												while($rt_main2 = mysqli_fetch_assoc($re_main2))
												{
													$unamenew=$rt_main2['uname'];
												}
												
										?>
									
									
										<tr class="odd gradeX">
											<td class="sorting" style="display:none;"></td>
											<td> <?php echo $i++; ?> </td>
											<td> <?php echo $pmnamenew; ?> </td>
											<td> <?php echo $unamenew; ?> </td>
											<td> <?php echo $amctype; ?> </td>
											<td> <?php echo $amcnoofseat; ?> </td>
											<td> <?php echo $amcserial; ?> </td>
											<td> <?php echo $custremarks; ?> </td>
											<td> <?php echo $custsdate; ?> </td>
											<td> <?php echo $custedate; ?> </td>
											</tr>
									
									<?php
										 
										}
										
									?>
                                    </tbody>
                                </table>
				
								
								<div>
								
								</div>
								
								
							<!--	<a class="btn btn-lg blue hidden-print margin-bottom-5" onclick="javascript:window.print();"> Print
                                    <i class="fa fa-print"></i>
                                </a>-->
								
								
								
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
        <script src="../assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
      

        <script src="../assets/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
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
		<script type="text/javascript" src="myjs/64/jquery.base64.js"/></script>	
		<script type="text/javascript" src="myjs/tableexport.js"/></script>	
		<script type="text/javascript" src="js/notification.js"/></script>	
		 <script src="../assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
		 
		<script src="../assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
  
		
			
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