<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
session_start(); 

	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
	}
	
	include("connect.php");
	$conn->query("set names utf8");
	$cmid=$_SESSION['cmid'];
	$mdate= date('d-m-Y');
	$mdate11= date('Y-m-d');
	
	
	$cidid=(int)mysqli_real_escape_string($conn,$_GET['id']);
	$_SESSION['cidid']=$cidid;
	date_default_timezone_set("Asia/Kolkata");
	$_SESSION['pdfgeneratecomplain']=1;
	
	
	/* $thumb_name = $_SERVER['DOCUMENT_ROOT'].'/sminder/businesspanel/download/'.$cmid.'.pdf';
			if(!file_exists($thumb_name)) {
			} */
				//echo "No";
				/*  */
		/* if($_SESSION['pdfgeneratecomplain']==1)
		{
		header("Location: generatepdf/invoicepdf.php?cmid=$cidid");	
		$_SESSION['pdfgeneratecomplain']=0;
		}	 */	
	


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
        <title>Payment Receipt Detail | Admin Panel</title>
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
                    <a href="dashboard.php">
                        <img src="../assets/layouts/layout/img/logo.png" alt="logo" class="logo-default" /> </a>
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

						
                        <!-- END TODO DROPDOWN -->
                        <!-- BEGIN USER LOGIN DROPDOWN -->
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

					<div class="portlet-body form">
						<!-- BEGIN FORM-->
						<form action="" method="POST" class="form-horizontal" enctype="multipart/form-data" >
							<div class="form-body">
											
										<div class="portlet box blue">
                                <div class="portlet-title">
												<div class="caption">
													<i class='fa fa-credit-card'></i> Payment Receipt Details </div>
												<div class="actions">

												</div>
											</div>
	
											<div class="portlet-body">
												
												<div class="col-md-2">
													<button type="button" align="left" style="width:100%;" class="btn grey-salsa btn-outline" onclick="document.location.href='complain.php'"><i class="fa fa-arrow-left"></i> Back</button>
												</div>
												
												
										       <div class="col-md-2">
													<a href="paymentsendmail.php?id=<?php echo $cidid;?>" style="width:100%;" class="btn btn-sm btn-info"> <i class="fa fa-arrow-right"></i>  Send Email </a>
												</div>    
													
												</br>
												</br>
											</div>
											
												
										</div>

							
										 <div class="portlet box green">
											<div class="portlet-title">

												<div class="caption">
													<i class='fa fa-credit-card'></i> Payment Receipt No: <?php echo $cidid;?> </div>

												<div class="actions">

												</div>
											</div>

											<?php
											require_once 'Mobile_Detect.php';
											$detect = new Mobile_Detect;
											if ( $detect->isMobile() ) {
											?>

												<div style ="width:100%; height:auto;overflow:scroll;">
											<div class="portlet-body">
												<iframe src="mobilepdfview/web/viewer.html?file=http://arthtechno.tk/lacrm/download/<?php echo $cidid;?>.pdf" width="100%" height="500"></iframe>
											</div>


											</div>
											<?php
											}
											else{
											?>
											<div class="portlet-body">
												<embed src="download/<?php echo $cmid;?>.pdf?id=<?php echo rand(1,10000); ?>" width="100%" height="1000" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html">

											</div>
											<?php
											}
											?>



                                    </div>
						
						</form>
						<!-- END FORM-->
					</div>
				</div>




                <!--------------Follow-Up Popup--------------->
				<div id="responsive" class="modal fade" tabindex="-1" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								<h4 class="modal-title">Follow-Up</h4>
							</div>
							<form method="post" action="invoicefollowupadd2.php">
							<input type="hidden" name="invoicemid" value="<?php echo $invoicemid;?>">

							<div class="modal-body">
								<div class="scroller" style="height:250px" data-always-visible="1" data-rail-visible1="1">
									<div class="row">
										<div class="col-md-12">
											<h4>Date</h4>
											<p>
												<input class="form-control form-control-inline input-large date-picker" data-date-format="dd-mm-yyyy" size="16" type="text" name="fdate" value="<?php echo $cdate;?>" /></p>


										</div>
										<div class="col-md-12">
											<h4>Remarks</h4>
											<p>
											<textarea class="col-md-6 form-control input-large" name="remarks" rows="3"></textarea>
											</p>
										</div>
									</div>
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
								<input type="submit" class="btn green" value="Submit">
							</div>
							</form>
						</div>
					</div>
                </div>
				<!------------------------------------------->
				<!--------------Follow-Up Popup--------------->
				<div id="responsive2" class="modal fade" tabindex="-1" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								<h4 class="modal-title">Send SMS</h4>
							</div>
							<form method="post" action="quotationsendsms.php">
							<div class="modal-body">
								<div class="scroller" style="height:250px" data-always-visible="1" data-rail-visible1="1">
									<div class="row">
										<div class="col-md-12">
											<h4>Mobile Number</h4>
											<p>
												<input class="form-control form-control-inline input-large"  size="16" type="text" name="cpmobile" value="<?php echo $pmobile;?>" /></p>


										</div>
										<div class="col-md-12">
											<h4>Massage</h4>
											<p>
											<textarea class="col-md-6 form-control input-large" id="field121" onkeyup="countChar(this)" name="smsmessage" rows="3"><?php echo $smsmessage2;?></textarea>
											<div id="charNum"></div>
											</p>
										</div>
									</div>
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>
								<input type="submit" class="btn green" value="Submit">
							</div>
							</form>
						</div>
					</div>
                </div>
				<!------------------------------------------->


				<!--------------Reminder Popup--------------->
				<div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
					 <div class="modal-dialog">
						  <div class="modal-content">

							   <div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h4 class="modal-title">
										<i class="fa fa-envelope"></i> Send Email
									</h4>
									Quotation will be send as an Attachment (In PDF Format).
							   </div>
							   <form method="post" action="quotationreminder.php" enctype="multipart/form-data">
								  <div class="modal-body">

								   <div id="modal-loader" style="display: none; text-align: center;">
									<img src="ajax-loader.gif">
								   </div>

								   <!-- content will be load here -->
								   <div id="dynamic-content"></div>

								</div>
								<div class="modal-footer">
									  <input type="submit" class="btn green" value="Send Email">
									  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
								</form>
						 </div>
					  </div>
				</div>
				<!------------------------------------------->




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
        <script src="//mozilla.github.io/pdf.js/build/pdf.js"></script>


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
?>				
<script>
// If absolute URL from the remote server is provided, configure the CORS
// header on that server.
var url = 'download/<?php echo $_SESSION['mobileqno'];?>.pdf';

// Disable workers to avoid yet another cross-origin issue (workers need
// the URL of the script to be loaded, and dynamically loading a cross-origin
// script does not work).
// PDFJS.disableWorker = true;

// The workerSrc property shall be specified.
PDFJS.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';

// Asynchronous download of PDF
var loadingTask = PDFJS.getDocument(url);
loadingTask.promise.then(function(pdf) {
  console.log('PDF loaded');

  // Fetch the first page
  var pageNumber = 1;
  pdf.getPage(pageNumber).then(function(page) {
    console.log('Page loaded');

    var scale = 1.5;
    var viewport = page.getViewport(scale);

    // Prepare canvas using PDF page dimensions
    var canvas = document.getElementById('the-canvas');
    var context = canvas.getContext('2d');
    canvas.height = viewport.height;
    canvas.width = viewport.width;

    // Render PDF page into canvas context
    var renderContext = {
      canvasContext: context,
      viewport: viewport
    };
    var renderTask = page.render(renderContext);
    renderTask.then(function () {
      console.log('Page rendered');
    });
  });
}, function (reason) {
  // PDF loading error
  console.error(reason);
});
</script>

    </body>

</html>
