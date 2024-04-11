<?php 
session_start();
	include("connect.php");
	
	$samid=$_SESSION['businessid'];
	 $customerid=$_SESSION['customeridnew'];
	
	
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
		$uaddress=$rt['uaddress'];
		$ucity=$rt['ucity'];
		
	}
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>My Profile</title>
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
                        <li class="active">my profile </li>
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
						
                            <!-- My Account Tab Menu Start -->
                            <div class="row">
                               
                                <!-- My Account Tab Menu End -->
                                <!-- My Account Tab Content Start -->
                                <div class="col-lg-12 col-md-12">
                                    <div class="tab-content" id="myaccountContent">
                                        <!-- Single Tab Content Start -->
                                        <div class="tab-pane fade show active" id="dashboad" role="tabpanel">
                                            <div class="myaccount-content">
                                                <h3>My Account</h3>
                                                <form action="profileedit.php" method="post">
                                                <input type="hidden" name="samid" value="<?php echo $samid; ?>"> 
                                                <input type="hidden" name="customerid" value="<?php echo $customerid; ?>"> 
                                               <p>Name :<input type="text" name="cname" value="<?php echo $uname; ?>" placeholder="Name"> </p>
                                               <p>Mobile : <input type="text" value="<?php echo $umobile; ?>" readonly name="cmobile" placeholder="Mobile"> </p>
											   <p>Email :<input name="cemail"  value="<?php echo $emailid; ?>" placeholder="Email" type="email"> </p>
                                               <!--<p>Name :<input type="password" name="cpassword" placeholder="Password"> </p>  -->
											   <p>Address :<textarea type="text" name="caddress" placeholder="Address"><?php echo $uaddress; ?> </textarea> </p>
											  <p>City :<input type="text" value="<?php echo $ucity; ?>" name="ccity" placeholder="City"> </p>
                                                <div class="button-box">
                                                    <button type="submit">Save </button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                        <!-- Single Tab Content End -->
                                        <!-- Single Tab Content Start -->
                                           
									
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