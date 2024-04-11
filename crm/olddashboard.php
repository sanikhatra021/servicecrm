<?php
session_start();
	/* dashboard list page*/
	error_reporting(0);
	include("connect.php");

	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
		return;
	}
	date_default_timezone_set("Asia/Kolkata");
	$mdate1= date('Y-m-d H:i:s');
	 $mdate2= date('d-m-Y' );
	 $cdate= date('Y-m-d');
		$daydiff=30;
		$nextday=date('Y-m-d', strtotime($cdate. ' + '.$daydiff.' days'));
		$cdate= date('Y-m-d');
	
	$evenextday="update res_complain_master set cstatus='Pending' where cstatus='Scheduled' and cmdate<'$nextday'";
	$renextday=mysqli_query($conn,$evenextday);
	
	$samid=$_SESSION['samid'];
	
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
					$eve1="select count(*) as v1 from res_complain_master where samid=$samid and customerid in(select umid from res_user_master)";
					$re1= mysqli_query($conn, $eve1);
					$vtotal=0;
					while($rt1 = mysqli_fetch_assoc($re1))
					{
						$vtotal=$rt1['v1'];
					}
				?>
				  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="dashboard-stat blue">
							<div class="visual">
								<i class="fa fa-user-plus"></i>
							</div>
							<div class="details">
								<div class="number">
									<span data-counter="counterup" data-value="<?php echo $vtotal;?>"></span>
								</div>
								<div class="desc">Complain</div>
							</div>
							<a class="more" href="complain.php"> Total <?php echo $vtotal;?>
								<i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
				</div>
				<?php
					$eve1="select count(*) as v1 from res_complain_master where samid=$samid and customerid in(select umid from res_user_master) and cstatus='Pending'";
					$re1= mysqli_query($conn, $eve1);
					$ptotal=0;
					while($rt1 = mysqli_fetch_assoc($re1))
					{
						$ptotal=$rt1['v1'];
					}
				?>
				
				  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="dashboard-stat green" >
							<div class="visual">
								<i class="fa fa-exclamation-triangle"></i>
							</div>
							<div class="details">
								<div class="number">
									<span data-counter="counterup" data-value="<?php echo $ptotal;?>"></span>
								</div>
								<div class="desc">Pending </div>
							</div>
							<a class="more" href="complain.php"> Total <?php echo $ptotal;?>
								<i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
				</div>
				
				<?php
					$eve1="select count(*) as v1 from res_complain_master where samid=$samid and cstatus='In Process'";
					$re1= mysqli_query($conn, $eve1);
					$ptotal=0;
					while($rt1 = mysqli_fetch_assoc($re1))
					{
						$ptotal=$rt1['v1'];
					}
				?>
				
				  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="dashboard-stat blue">
							<div class="visual">
								<i class="fa fa-refresh"></i>
							</div>
							<div class="details">
								<div class="number">
									<span data-counter="counterup" data-value="<?php echo $ptotal;?>"></span>
								</div>
								<div class="desc">In Process </div>
							</div>
							<a class="more" href="complain.php"> Total <?php echo $ptotal;?>
								<i class="m-icon-swapright m-icon-white"></i>
							</a>
						</div>
				</div>
				
			<?php
					$eve1="select count(*) as v1 from res_complain_master where samid=$samid and cstatus='Completed'";
					$re1= mysqli_query($conn, $eve1);
					$atotal=0;
					while($rt1 = mysqli_fetch_assoc($re1))
					{
						$atotal=$rt1['v1'];
					}
				?>
				    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="dashboard-stat green">
							<div class="visual">
								<i class="fa fa-upload"></i>
							</div>
							<div class="details">
								<div class="number">
									<span data-counter="counterup" data-value="<?php echo $atotal;?>"></span>
								</div>
								<div class="desc">Completed</div>
							</div>
							<a class="more" href="complain.php"> Total <?php echo $atotal;?>
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
                                        <i class="fa fa-user"></i>Unallocation Complain</div>
									<div class="tools">
										 <button id="sample_editable_1_new" class="btn white btn-outline sbold" onClick="document.location.href='complain.php'">
											 View All <i class='fa fa-tv'></i>
											
										</button>
										<div class="btn-group">
										
									</div>
                                        <!--<a href="javascript:;" class="collapse"> </a>
                                        <a href="javascript:;" class="remove"> </a>-->
                                    </div>
                                </div>

                                                <?php
													

													?>

										 <div class="portlet-body">
											<div class="table-scrollable">
												<table class="table table-striped table-hover">
													<thead>

														<tr>
															<th class="sorting">Sr. No.</th>
															<th> Customer Name </th>
															<th> Complain Type </th>
															<th> Product Name</th>
															<th> Status </th>
															<th> Date</th>
															<th> Service Engineer</th>
															
														</tr>
													</thead>
													<tbody>

													<?php
													$i=1;
													if($_SESSION['utype']=='Admin')
													{
														$eve1 = "select * from res_complain_master where cstatus='Pending' and samid=$samid and cmserviceengineerid=0 and customerid in(select umid from res_user_master) order by cmid desc limit 0,5";
													}
													else if($_SESSION['utype']=='customer')
													{
														
														 $eve1 = "select * from res_complain_master where samid =$samid and cstatus='Pending' and customerid='".$_SESSION['umid']."' and cmserviceengineerid=0 and customerid in(select umid from res_user_master) order by cmid desc limit 0,5";
													
													}
													$re1 = mysqli_query($conn, $eve1);
													while($rt1 = mysqli_fetch_assoc($re1))
													{
														
														$pmid=$rt1['pmid'];
														$cmtype=$rt1['cmtype'];
														$eve11 = "select * from res_product_master where pmid=$pmid";
														$re11 = mysqli_query($conn, $eve11);
														while($rt11 = mysqli_fetch_assoc($re11))
														{
															$pmname=$rt11['pmname'];
														}
														
														$ctmid=$rt1['ctmid'];
														$eve118 = "select * from res_complaintype_master where ctmid=$ctmid";
														$re118 = mysqli_query($conn, $eve118);
														while($rt118 = mysqli_fetch_assoc($re118))
														{
															$ctmname=$rt118['ctmname'];
														}
														$cstatus=$rt1['cstatus'];
														if($cstatus=="Pending")
														{
															$cstatus1="<span class='label label-sm label-success'>Pending</span>";
														}
														else if ($cstatus=="In Process")
														{
															$cstatus1="<span class='label label-sm label-danger'>In Process</span>";
														}
														else if($cstatus=="Completed")
														{
															$cstatus1="<span class='label label-sm label-warning'>Completed</span>";
														}
														else
														{
															$cstatus1="<span class='label label-sm label-danger'>Cancel</span>";
														}
														
														$cmdate=implode('-', array_reverse(explode('-',$rt1['cmdate'])));
														
														$customerid=$rt1['customerid'];
														$eve11 = "select * from res_user_master where umid=$customerid";
														$re11 = mysqli_query($conn, $eve11);
														while($rt11 = mysqli_fetch_assoc($re11))
														{
															$uname=$rt11['uname'];
														}
														
														
														$cmid=$rt1['cmid'];
														$eve113 = "select * from res_complain_detail where cmid=$cmid";
														$re113 = mysqli_query($conn, $eve113);
														if(mysqli_num_rows($re113) > 0)
														{
															$eve118 = "select * from res_user_master where umid in(select serviceengineerid from res_complain_detail where cmid=$cmid)";
															$re118 = mysqli_query($conn, $eve118);
															$staff="";
															while($rt118 = mysqli_fetch_assoc($re118))
															{
																$staff=$rt118['uname'];
															}
														}
														else
														{
															$staff="<button data-toggle='modal' data-target='#view-modal' data-id='$cmid' id='getUser' class='btn btn-xs btn-warning'>Select Service Engineer</button>";
														}
														
												?>
												
												<tr>
																																							                    <td> <?php echo $i++;  ?> </td> 
												 	<td><?php echo $uname;?></td>
												 	<td><?php echo $cmtype;?></td>
												 	<td><?php echo $pmname;?></td>
													<td><?php echo $cstatus1;?></td>
													<td><?php echo $cmdate;?></td>
													<td><?php echo $staff;?></td>
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
				    <div class="col-md-12">

						 <div class="portlet box blue">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-user"></i>Complain</div>
									<div class="tools">
										<button id="sample_editable_1_new" class="btn white btn-outline sbold" onClick="document.location.href='complainadd.php'">
											Add New
											<i class="fa fa-plus"></i>
										</button>
										 <button id="sample_editable_1_new" class="btn white btn-outline sbold" onClick="document.location.href='complain.php'">
											 View All <i class='fa fa-tv'></i>
											
										</button>
									
                                        <!--<a href="javascript:;" class="collapse"> </a>
                                        <a href="javascript:;" class="remove"> </a>-->
                                    </div>
                                </div>

                                                <?php
													

													?>

										 <div class="portlet-body">
											<div class="table-scrollable">
												<table class="table table-striped table-hover">
													<thead>

														<tr>
															<th class="sorting">Sr. No.</th>
															<th> Customer Name </th>
															<th> Complain Type </th>
															<th> Product Name</th>
															<th> Status </th>
															<th> Date</th>
															<th> Photo</th>
															
														</tr>
													</thead>
													<tbody>



													<?php
													$i=1;
													if($_SESSION['utype']=='Admin')
													{
														
														$eve1 = "select * from res_complain_master where cstatus='Pending' and samid=$samid  and customerid in(select umid from res_user_master) order by cmid desc limit 0,5";
														$re1 = mysqli_query($conn, $eve1);
													}
													else if($_SESSION['utype']=='customer')
													{
														$eve1 = "select * from res_complain_master where samid =$samid and cstatus='Pending' and customerid='".$_SESSION['umid']."' order by cmid desc limit 0,5";
														$re1 = mysqli_query($conn, $eve1);
													}
													
													while($rt1 = mysqli_fetch_assoc($re1))
													{
														
														$pmid=$rt1['pmid'];
														$cmtype=$rt1['cmtype'];
														$eve11 = "select * from res_product_master where pmid=$pmid";
														$re11 = mysqli_query($conn, $eve11);
														while($rt11 = mysqli_fetch_assoc($re11))
														{
															$pmname=$rt11['pmname'];
														}
														
														$ctmid=$rt1['ctmid'];
														$eve118 = "select * from res_complaintype_master where ctmid=$ctmid";
														$re118 = mysqli_query($conn, $eve118);
														$ctmname="";
														while($rt118 = mysqli_fetch_assoc($re118))
														{
															$ctmname=$rt118['ctmname'];
														}
														$cstatus=$rt1['cstatus'];
														if($cstatus=="Pending")
														{
															$cstatus1="<span class='label label-sm label-success'>Pending</span>";
														}
														else if ($cstatus=="In Process")
														{
															$cstatus1="<span class='label label-sm label-danger'>In Process</span>";
														}
														else if($cstatus=="Completed")
														{
															$cstatus1="<span class='label label-sm label-warning'>Completed</span>";
														}
														else
														{
															$cstatus1="<span class='label label-sm label-danger'>Cancel</span>";
														}
														
														$cmdate=implode('-', array_reverse(explode('-',$rt1['cmdate'])));
														$cmphoto=$rt1['cmphoto'];
														if(strlen($cmphoto)>3)
														{
															$cmphoto1="<img src='images/$cmphoto' width='50px' height='50px'>";
														}
														else
														{
															$cmphoto1="<img src='images/noimage.jpg' width='50px' height='50px'>";
														}
														$customerid=$rt1['customerid'];
														$eve11 = "select * from res_user_master where umid=$customerid";
														$re11 = mysqli_query($conn, $eve11);
														while($rt11 = mysqli_fetch_assoc($re11))
														{
															$uname=$rt11['uname'];
														}
														
												?>
												
												<tr>
																																									<td> <?php echo $i++;  ?> </td> 
												 	<td><?php echo $uname;?></td>
												 	<td><?php echo $cmtype;?></td>
												 	<td><?php echo $pmname;?></td>
													<td><?php echo $cstatus1;?></td>
													<td><?php echo $cmdate;?></td>
													<td><?php echo $cmphoto1;?></td>
													
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
				   <div class="modal-body">
					 <div id="modal-loader" style="display: none; text-align: center;">
						<img src="ajax-loader.gif">
					   </div>

					   <!-- content will be load here -->
					   <div id="dynamic-content"></div>

					</div>
					<div class="modal-footer">
						<input type="submit" class="btn green" value="Submit">
						  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</form>
			 </div>
		  </div>
	</div>
	<!------------------End Vendor Document Submitted Status------------------------->

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
        
		<script src="../assets/pages/scripts/dashboard.js" type="text/javascript"></script>
		


       
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
		 

       
        <script src="../../../assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
        <script src="../../../assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
        <script src="../../../assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
        <script src="../../../assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
        <script src="../../../assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
		<script src="../../../assets/pages/scripts/ui-toastr.min.js" type="text/javascript"></script>
		<script src="../../../assets/global/plugins/bootstrap-toastr/toastr.min.js" type="text/javascript"></script>

		 <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="../../../assets/pages/scripts/dashboard.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="../../../assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="../../../assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="../../../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
		
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
