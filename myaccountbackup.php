<?php 
session_start();
	include("connect.php");
	if(!isset($_SESSION['sminderweb']))
	{
		$_SESSION['loginmsg1'] = "Please login first.";
		header('Location: login.php');
		return;
	}
	$samid=$_SESSION['businessid'];
	$customerid=$_SESSION['customerid'];
	$url=$_SESSION['weburl'];
	
	$eve="select uname,umobile,emailid from res_user_master where samid=$samid and umid=$customerid";
	$re = mysqli_query($conn, $eve);
	$uname="";
	$umobile="";
	$emailid="";
	while($rt = mysqli_fetch_assoc($re))
	{
		$uname=$rt['uname'];
		$umobile=$rt['umobile'];
		$emailid=$rt['emailid'];
	}
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>My Account</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
   <link rel="icon" href="assets/img/favicon.ico" type="image/png">
   <!--  <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">  -->
	<link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">

    <!-- All CSS is here
	============================================ -->

    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/vendor/signericafat.css">
    <link rel="stylesheet" href="assets/css/vendor/cerebrisans.css">
    <link rel="stylesheet" href="assets/css/vendor/simple-line-icons.css">
    <link rel="stylesheet" href="assets/css/vendor/elegant.css">
    <link rel="stylesheet" href="assets/css/vendor/linear-icon.css">
    <link rel="stylesheet" href="assets/css/plugins/nice-select.css">
    <link rel="stylesheet" href="assets/css/plugins/easyzoom.css">
    <link rel="stylesheet" href="assets/css/plugins/slick.css">
    <link rel="stylesheet" href="assets/css/plugins/animate.css">
    <link rel="stylesheet" href="assets/css/plugins/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/plugins/jquery-ui.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Use the minified version files listed below for better performance and remove the files listed above
    <link rel="stylesheet" href="assets/css/vendor/vendor.min.css">
    <link rel="stylesheet" href="assets/css/plugins/plugins.min.css">
    <link rel="stylesheet" href="assets/css/style.min.css"> -->

</head>

<body>

    <div class="main-wrapper">
       
	   <!-- Mobile menu start -->
		<?php include("header.php"); ?>
        <!-- mini cart start -->
		
        <div class="breadcrumb-area bg-gray">
            <div class="container">
                <div class="breadcrumb-content text-center">
                    <ul>
                        <li>
                            <a href="<?php echo $url; ?>">Home</a>
                        </li>
                        <li class="active">my account </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- my account wrapper start -->
        <div class="my-account-wrapper pt-120 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- My Account Page Start -->
                        <div class="myaccount-page-wrapper">
						<center>
								 <?php
										if(isset($_SESSION['scpmsg']))
										{
									?>
									<div style="color:green;" id="mydiv">
										<strong><?php echo $_SESSION['scpmsg'];?></strong>
									</div>
									<?php
										}
										unset($_SESSION['scpmsg']);
									?>

									<?php
										if(isset($_SESSION['scpmsg1']))
										{
									?>
									<div style="color:red;" id="mydiv">
										<strong><?php echo $_SESSION['scpmsg1'];?></strong>
									</div>
									<?php
										}
										unset($_SESSION['scpmsg1']);
									?>
									</center>
                            <!-- My Account Tab Menu Start -->
                            <div class="row">
                                <div class="col-lg-3 col-md-4">
                                    <div class="myaccount-tab-menu nav" role="tablist">
                                        <a href="#dashboad" class="active" data-toggle="tab"><i class="fa fa-dashboard"></i>
                                            My Account</a>
                                        <a href="#orders" data-toggle="tab"><i class="fa fa-cart-arrow-down"></i> Complain</a>
                                        <!--<a href="#download" data-toggle="tab"><i class="fa fa-cloud-download"></i> Download</a>
                                        <a href="#payment-method" data-toggle="tab"><i class="fa fa-credit-card"></i> Payment
                                            Method</a>
                                        <a href="#address-edit" data-toggle="tab"><i class="fa fa-map-marker"></i> address</a>
                                        <a href="#account-info" data-toggle="tab"><i class="fa fa-user"></i> Account Details</a>-->
										<!--- <a href="#changepassword" data-toggle="tab"><i class="fa fa-key"></i> Change Password</a>  -->
                                        <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                                    </div>
                                </div>
                                <!-- My Account Tab Menu End -->
                                <!-- My Account Tab Content Start -->
                                <div class="col-lg-9 col-md-8">
                                    <div class="tab-content" id="myaccountContent">
                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>My Account</h3>
                                                <div class="single-input-item">
													<p>Name : <?php echo $uname;?></p>
													<p>Mobile : <?php echo $umobile;?></p>
													<p>Email : <?php echo $emailid;?></p>
												</div>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->
                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade" id="orders" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Complain</h3>
                                                <div class="myaccount-table table-responsive text-center">
                                                    <table class="table table-bordered">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Compain Date</th>
                                                                <th>Status</th>
                                                                <th>Complain Type</th>
                                                                <th>Product Name</th>
                                                                <th>Problem Type</th>
                                                                <th>Complain Detail</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
															<?php 
																$eve55="select * from res_complain_master where samid=$samid and customerid=$customerid order by cmid desc";
																$re55 = mysqli_query($conn, $eve55);
																$cmdetail="";
																while($rt55 = mysqli_fetch_assoc($re55))
																{
																	$cmdate=date("d-m-Y",strtotime($rt55['cmdate']));
																	$cstatus=$rt55['cstatus'];
																	//$ctmid=$rt55['ctmid'];
																	$pmid=$rt55['pmid'];
																	$cmdetail=$rt55['cmdetail'];
																	$cmtype=$rt55['cmtype'];
																	
																	/* $eve15 = "select * from res_complaintype_master where ctmid=$ctmid";
																	$re15 = mysqli_query($conn, $eve15);
																	$ctmname="";
																	while($rt15 = mysqli_fetch_assoc($re15))
																	{
																		$ctmname=$rt15['ctmname'];
																	} */
																	
																	$eve16 = "select * from res_product_master where pmid=$pmid";
																	$re16 = mysqli_query($conn, $eve16);
																	$pmname="";
																	while($rt16 = mysqli_fetch_assoc($re16))
																	{
																		$pmname=$rt16['pmname'];
																	}
																	$cmproblemtype=$rt55['cmproblemtype'];
															?>
                                                            <tr>
                                                                <td><?php echo $cmdate; ?></td>
                                                                <td><?php echo $cstatus; ?></td>
                                                                <td><?php echo $cmtype; ?></td>
                                                                <td><?php echo $pmname; ?></td>
                                                                <td><?php echo $cmproblemtype; ?></td>
                                                                <td><?php echo $cmdetail; ?></td>
                                                            </tr>
														<?php }?>
														</tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->
										
                                        <!-- Single Tab Content Start -->
                                         <!-- Single Tab Content Start -->
                                        <!---<div class="tab-pane fade" id="changepassword" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>Change Password</h3>
                                                <div class="account-details-form">
                                                    <form action="changepassword2.php" method="post" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="first-name" class="required">Current Password *</label>
                                                                    <input type="password" id="first-name" name="password1"  required />
                                                                </div>
                                                            </div>
														</div>
														<div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="last-name" class="required">New Password *</label>
                                                                    <input type="password" id="last-name" name="password2" required />
                                                                </div>
                                                            </div>
                                                        </div>
														
                                                        
                                                        <div class="single-input-item">
                                                            <button class="check-btn sqr-btn " name="btnsubmit">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div> --->
										<!-- Single Tab Content End -->
										<!-- Single Tab Content End -->
									</div>
                                </div> <!-- My Account Tab Content End -->
                            </div>
                        </div> <!-- My Account Page End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- my account wrapper end -->
      
	  <!----Footer----------->
	  <?php include("footer.php"); ?>
	  <!-----Footer---------->
	  
	  </div>

    <!-- All JS is here
============================================ -->

    <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="assets/js/vendor/jquery-3.5.1.min.js"></script>
    <script src="assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="assets/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="assets/js/plugins/slick.js"></script>
    <script src="assets/js/plugins/jquery.syotimer.min.js"></script>
    <script src="assets/js/plugins/jquery.instagramfeed.min.js"></script>
    <script src="assets/js/plugins/jquery.nice-select.min.js"></script>
    <script src="assets/js/plugins/wow.js"></script>
    <script src="assets/js/plugins/jquery-ui-touch-punch.js"></script>
    <script src="assets/js/plugins/jquery-ui.js"></script>
    <script src="assets/js/plugins/magnific-popup.js"></script>
    <script src="assets/js/plugins/sticky-sidebar.js"></script>
    <script src="assets/js/plugins/easyzoom.js"></script>
    <script src="assets/js/plugins/scrollup.js"></script>
    <script src="assets/js/plugins/ajax-mail.js"></script>

    <!-- Use the minified version files listed below for better performance and remove the files listed above  
<script src="assets/js/vendor/vendor.min.js"></script>
<script src="assets/js/plugins/plugins.min.js"></script>  -->
    <!-- Main JS -->
    <script src="assets/js/main.js"></script>
	<script>
	setTimeout(function() {
    $('#mydiv').fadeOut('fast');
}, 5000); // <-- time in milliseconds-->
</script>
</body>

</html>