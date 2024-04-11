<?php 
session_start();
	include("connect.php");
	
	//$customerid=$_SESSION['userid'];
	if(!isset($_SESSION['businessid']))
	{
		header('Location: index.php');
	}
		 $samid=$_SESSION['businessid'];
	
	$url=$_SESSION['weburl'];
	$customerid=$_SESSION['customerid'];
	
	
	$cmobile=$_SESSION['cmobile'];
   
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Information</title>
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
       <!-- Start Header -->
	   <?php include("header.php"); ?>
       <!-- End Header -->
	   
       <div class="breadcrumb-area bg-gray">
            <div class="container">
                <div class="breadcrumb-content text-center">
                    <ul>
                        <li>
                            <a href="<?php echo $url; ?>">Home</a>
                        </li>
                        <li class="active"> Your Information </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="login-register-area pt-115 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                        <div class="login-register-wrapper">
                            <div class="tab-content">
                                <div id="lg1" class="tab-pane active">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
										<?php
										    $eve="select * from res_user_master where utype='customer' and umobile='$cmobile' and samid='$samid'";
												$re = mysqli_query($conn, $eve) or die("failed");
												$uname="";
												$emailid="";
												$uaddress="";
												$ucity="";
												$upassword="";
												while($rt = mysqli_fetch_assoc($re))
												{
													$umid=$rt['umid'];
													$uname=$rt['uname'];
													$emailid=$rt['emailid'];
													$uaddress=$rt['uaddress'];
													$ucity=$rt['ucity'];
													$upassword=$rt['upassword'];
												}
										?>
                                            <form action="infoedit.php" method="post">
                                                <input type="hidden" name="samid" value="<?php echo $samid; ?>">
                                                <input type="hidden" name="umid" value="<?php echo $umid; ?>">
                                                <input type="hidden" name="frompage" value="1">
												<div>Mobile Number</div>
                                                <input type="text" name="cmobile"  readonly placeholder="Enter Mobile Number"  value="<?php echo $cmobile; ?>">
												<div>Name</div>
                                                <input type="text" name="cname" placeholder=" Enter Name"  value="<?php echo $uname; ?>">
												<div>Email Id</div>
                                                <input type="text" name="emailid" placeholder=" Enter Emailid"  value="<?php echo $emailid; ?>">
												<div>Password</div>
                                                <input type="password" name="password" placeholder=" Enter password"  value="<?php echo $upassword; ?>">
												<div>Address</div>
                                                <input type="text" name="caddress" placeholder=" Enter Address"  value="<?php echo $uaddress; ?>">
												<div>City</div>
                                                <input type="text" name="ccity" placeholder=" Enter City"  value="<?php echo $ucity; ?>">
                                                <div class="button-box">
                                                   <center>
                                                    <button type="submit">Submit</button>
													</center>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
          
    
	<!------Start Footer--->
	<?php include("footer.php"); ?>
	<!-----End Footer----->
	
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