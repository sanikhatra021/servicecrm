<?php
session_start();

	include("connect.php");

	if(!isset($_SESSION['lacomplainsuperadmin']))
	{
		header('Location: index.php');
		return;
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
        <title>Dashboard | Admin Panel</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="../../../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="../../../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="../../../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../../../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <link href="../../../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="../../../assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="../../../assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="../../../assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="../../../assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="../../../assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
		<link href="../../../assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="favicon.ico" />

		<link href="../../../assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />

		</head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="dashboard.php">
                        <img src="../../../assets/layouts/layout/img/logo.png" alt="logo" class="logo-default" /> </a>
                    <div class="menu-toggler sidebar-toggler"> </div>
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
                                <span class="username username-hide-on-mobile"> <?php echo $_SESSION['ausername']?> </span>
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
                        <!-- BEGIN INBOX DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->

                        <!-- END INBOX DROPDOWN -->
                        <!-- BEGIN TODO DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->

                        <!-- END TODO DROPDOWN -->
                        <!-- BEGIN USER LOGIN DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->

                        <!-- END USER LOGIN DROPDOWN -->
                        <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->

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
                    <!-- BEGIN THEME PANEL -->

                    <!-- END THEME PANEL -->
                    <!-- BEGIN PAGE BAR -->

                    <!-- END PAGE BAR -->
                    <!-- BEGIN PAGE TITLE-->




                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->

				<div class="row">
				<?php
					$ctotal=0;
					$eve="select count(*) as a from res_superadmin_master";
					$re= mysqli_query($conn, $eve);
					$ctotal=0;
					while($rt = mysqli_fetch_assoc($re))
					{
						$ctotal=$rt['a'];
					}
				?>
				  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="dashboard-stat blue">
							<div class="visual">
								<i class="fa fa-users"></i>
							</div>
							<div class="details">
								<div class="number">
									<span data-counter="counterup" data-value="<?php echo $ctotal;?>"></span>
								</div>
								<div class="desc"> Business </div>
							</div>
							<a class="more" href="superadmin.php"> Total <?php echo $ctotal;?>
								<i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
					</div>
					
			<?php
					$eve1="select count(*) as v1 from res_superadmin_master where sacurrentplanstatus='Active'";
						$re1= mysqli_query($conn, $eve1);
					$vtotal=0;
					while($rt1 = mysqli_fetch_assoc($re1))
					{
						$vtotal=$rt1['v1'];
					}
				?>
				  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="dashboard-stat green">
							<div class="visual">
								<i class="fa fa-users"></i>
							</div>
							<div class="details">
								<div class="number">
									<span data-counter="counterup" data-value="<?php echo $vtotal;?>"></span>
								</div>
								<div class="desc">Active Businesses</div>
							</div>
							<a class="more" href="activebusiness.php"> Total <?php echo $vtotal;?>
								<i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
				</div>
				<?php
					//$eve1="select count(*) as v1 from res_complain_master where cstatus='Pending'";
					//$re1= mysqli_query($conn, $eve1);
					$ptotal=0;
					//while($rt1 = mysqli_fetch_assoc($re1))
					{
						//$ptotal=$rt1['v1'];
					}
				?>
				
				  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="dashboard-stat blue">
							<div class="visual">
								<i class="fa fa-users"></i>
							</div>
							<div class="details">
								<div class="number">
									<span data-counter="counterup" data-value="<?php echo $ptotal;?>"></span>
								</div>
								<div class="desc">Test </div>
							</div>
							<a class="more" href=""> Total <?php echo $ptotal;?>
								<i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
				</div>
				
			<?php
					//$eve1="select count(*) as v1 from res_complain_master where cstatus='Completed'";
					//$re1= mysqli_query($conn, $eve1);
					$atotal=0;
					//while($rt1 = mysqli_fetch_assoc($re1))
					{
					//	$atotal=$rt1['v1'];
					}
				?>
				    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="dashboard-stat green">
							<div class="visual">
								<i class="fa fa-users"></i>
							</div>
							<div class="details">
								<div class="number">
									<span data-counter="counterup" data-value="<?php echo $atotal;?>"></span>
								</div>
								<div class="desc">Test</div>
							</div>
							<a class="more" href=""> Total <?php echo $atotal;?>
								<i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
				</div>
				</div>  
					
					
				<div class="row">
				    
                        <div class="col-md-12">

						 <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-user"></i>Business</div>
									<div class="tools">
										 <button id="sample_editable_1_new" class="btn white btn-outline sbold" onClick="document.location.href='superadmin.php'">
											 View All <i class='fa fa-tv'></i>
											
										</button>
										<div class="btn-group">
										
									</div>
                                        <!--<a href="javascript:;" class="collapse"> </a>
                                        <a href="javascript:;" class="remove"> </a>-->
                                    </div>
                                </div>

                                                

										 <div class="portlet-body">
											<div class="table-scrollable">
												<table class="table table-striped table-hover">
													<thead>

														<tr>
															<th class="sorting">Sr. No.</th>
															<th> Name </th>
															<th> Business URL </th>
															<th> Email ID</th>
															<th> Address </th>
															<th>Plan Expiry Date</th>
															<th> Plan Status</th>
															
														</tr>
													</thead>
													<tbody>

													<?php
													$i=1;
													/* if($_SESSION['utype']=='Admin')
													{ */
														
														 $eve1 = "select * from res_superadmin_master where sautype!='superadmin'limit 0,5";
														// $eve1 = "select * from res_complain_master where cstatus!='Completed' and samid=$samid and cmserviceengineerid=0 and customerid in(select umid from res_user_master) order by cmid desc limit 0,5";
														
													/* }
													else if($_SESSION['utype']=='customer')
													{
														
													  $eve1 = "select * from res_complain_master where samid =$samid and cstatus!='Completed' and customerid='".$_SESSION['umid']."' and cmserviceengineerid=0 and customerid in(select umid from res_user_master) order by cmid desc limit 0,5";
														
													
													} */
													$re1 = mysqli_query($conn, $eve1);
													while($rt1 = mysqli_fetch_assoc($re1))
													{
														$samid=$rt1['samid'];
														
														$safullname=$rt1['safullname'];
														$samobile=$rt1['samobile'];
														/* $sausername=$rt['sausername'];
														$sapassword=$rt['sapassword']; */
														
														$saemailid=$rt1['saemailid'];
														$saaddress=$rt1['saaddress'];
														$sacity=$rt1['sacity'];
														$sauloc1=$rt1['sauloc1'];
														$sauloc2=$rt1['sauloc2'];
														$sauserstatus=$rt1['sauserstatus'];
														$sacurrentplanname=$rt1['sacurrentplanname'];
														$sacurrentplantype=$rt1['sacurrentplantype'];
														$satotusers=$rt1['satotusers'];
														$saplanexpdate=implode('-', array_reverse(explode('-', $rt1['saplanexpdate'])));
														$sacurrentplanstatus=$rt1['sacurrentplanstatus'];
														$saurl=$rt1['saurl'];
														$saprefix=$rt1['saprefix'];
														
														if($saurl!='')
														{
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
															$main=$protocol.$hostName."/";
															//return;
															$saurl1=$main.$rt1['saurl'];
															
															$saurl="<a href='$saurl1' target='_blank'>$saurl</a>";
														}
														
														if($sacurrentplanstatus=="Active")
														{
															$sacurrentplanstatus="<span class='label label-sm label-success'>Active</span>";
														}
														else if($sacurrentplanstatus=="Inactive")
														{
															$sacurrentplanstatus="<span class='label label-sm label-danger'>Inactive</span>";
														}
														else if($sacurrentplanstatus=="Expired")
														{
															$sacurrentplanstatus="<span class='label label-sm label-danger'>Expired</span>";
														}
														else 
														{
															$sacurrentplanstatus="<span class='label label-sm label-warning'>$sacurrentplanstatus</span>";
														}
														
														
														$sautype=$rt1['sautype'];
														
												?>
												
												<tr>
																																				    <td> <?php echo $i++;  ?> </td> 
												 	<td><?php echo $safullname;?></td>
												 	<td><?php echo $saurl;?></td>
												 	<td><?php echo $saemailid;?></td>
													<td><?php echo $saaddress;?></td>
													<td><?php echo $saplanexpdate;?></td>
													<td><?php echo $sacurrentplanstatus;?></td>
												</tr>
                                          </li>
												<?php
													}
												?>
                                         </ul>
											</tbody>
											</table>
                                        </div>
                                    </div>

						</div>
						</div>
						 
						
			</div>
			
		
				<!------------vendor service area-------->
			<!--	<div class="row">
					<div class="col-md-12">
							<div class="portlet box blue">
								<div class="portlet-title">
									<div class="caption">
										<i class="fa fa-bullhorn"></i>Vendor Service Area
									</div>
									<div class="tools">
										<button type="button" align="center" class="btn white btn-outline sbold" onclick="document.location.href='vendorwiseservicelist.php'">View More</button>
									</div>
								</div>
							<div class="portlet-body">
								<div class="">
									<table class="table table-hover table-light">
										<thead>
											<tr class="uppercase">
												<th colspan="2">Sr. No.</th>
												<th>Vendor Name</th>
												<th>Pincode</th>
											</tr>
										</thead>

									
									<tr>
									<td class="fit">
									
									
								</div>
							</div>
							</div>
						</div>	
				</div>-->
				<!------------end row----------------->
				
					<!------------vendor service area-------->
				<!--<div class="row">
					<div class="col-md-12">
							<div class="portlet box green">
								<div class="portlet-title">
									<div class="caption">
										<i class="fa fa-bullhorn"></i>Drivers in map view
									</div>
									<div class="tools">
										
									</div>
								</div>
							<div class="portlet-body">
								<div class="">
									<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d19569608.75084757!2d-22.22771925890605!3d53.22021049841882!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x25a3b1142c791a9%3A0xc4f8a0433288257a!2sUnited%20Kingdom!5e0!3m2!1sen!2sin!4v1605780843752!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
								</div>
							</div>
							</div>
						<!------------end portlet----------------->
					</div>	
				</div>
				<!------------end row----------------->
			
			</div>
                   
				 <!--  <div class="row">



						  <div class="col-md-6 col-sm-6">
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption font-red">
                                        <span class="caption-subject bold uppercase">Welcome </span>
                                        <span class="caption-helper">...</span>
                                    </div>-->
                                    <!-- <div class="actions">
                                        <a href="#" class="btn btn-circle green btn-outline btn-sm">
                                            <i class="fa fa-pencil"></i> Export </a>
                                        <a href="#" class="btn btn-circle green btn-outline btn-sm">
                                            <i class="fa fa-print"></i> Print </a>
                                    </div>
									-->
                                <!--</div>
                                <div class="portlet-body">
                                    <div id="dashboard_amchart_3" class="CSSAnimationChart"></div>
                                </div>
                            </div>
                        </div>




					</div>

					<div class="row">
                        <div class="col-md-12">
                            <div class="portlet light portlet-fit bordered calendar">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-layers font-green"></i>
                                        <span class="caption-subject font-green sbold uppercase">Calendar</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div id="mycalendar2" class="has-toolbar"> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>-->


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
<script src="../../../assets/global/plugins/respond.min.js"></script>
<script src="../../../assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="../../../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="../../../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../../../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="../../../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="../../../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="../../../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="../../../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="../../../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
		<script src="../../../assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="../../../assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->


		  <script src="../../../assets/global/plugins/moment.min.js" type="text/javascript"></script>
        <script src="../../../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
        <script src="../../../assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
        <script src="../../../assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
        <script src="../../../assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
        <script src="../../../assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
      
		 
      
      

		 <!-- BEGIN PAGE LEVEL SCRIPTS -->
       
        <script src="../../../assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
      

		 <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="../../../assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="../../../assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="../../../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
		

		
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
		toastr.info(mymsg, "")

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
    $('#mycalendar2').fullCalendar({
    events: 'http://localhost/sample/json/jsontask.php',

	}
	);
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
		toastr.info(mymsg, "")
		
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
