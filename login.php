<?php 
session_start();
	include("connect.php");
	
	if(isset($_SESSION['businessid']))
	{
		$samid=$_SESSION['businessid'];
	}
	$url=$_SESSION['weburl'];
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">

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
                        <li class="active">Login - register </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="login-register-area pt-115 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                        <div class="login-register-wrapper">
                            <div class="login-register-tab-list nav">
                                <a class="active" data-toggle="tab" href="#lg1">
                                    <h4> login </h4>
                                </a>
                                <a data-toggle="tab" href="#lg2">
                                    <h4> register </h4>
                                </a>
                            </div>
							<center>
								 <?php
										if(isset($_SESSION['sloginmsg']))
										{
									?>
									<div style="color:green;" id="mydiv">
										<strong><?php echo $_SESSION['sloginmsg'];?></strong>
									</div>
									<?php
										}
										unset($_SESSION['sloginmsg']);
									?>

									<?php
										if(isset($_SESSION['sloginmsg1']))
										{
									?>
									<div style="color:red;" id="mydiv">
										<strong><?php echo $_SESSION['sloginmsg1'];?></strong>
									</div>
									<?php
										}
										unset($_SESSION['sloginmsg1']);
									?>
									 <?php
										if(isset($_SESSION['sregmsg']))
										{
									?>
									<div style="color:green;" id="mydiv">
										<strong><?php echo $_SESSION['sregmsg'];?></strong>
									</div>
									<?php
										}
										unset($_SESSION['sregmsg']);
									?>
									<?php
										if(isset($_SESSION['sregmsg1']))
										{
									?>
									<div style="color:red;" id="mydiv">
										<strong><?php echo $_SESSION['sregmsg1'];?></strong>
									</div>
									<?php
										}
										unset($_SESSION['sregmsg1']);
									?>
							  </center>
                            <div class="tab-content">
                                <div id="lg1" class="tab-pane active">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form action="login2.php" method="post">
                                                <input type="hidden" name="samid" value="<?php echo $samid; ?>">
                                                <input type="text" name="cmobile" placeholder="Mobile Or Email">
                                                <input type="password" name="cpassword" placeholder="Password">
                                                <div class="button-box">
                                                    <div class="login-toggle-btn">
                                                        <!--<input type="checkbox">
                                                        <label>Remember me</label>-->
                                                        <a href="forgotpassword.php">Forgot Password?</a>
                                                    </div>
                                                    <button type="submit">Login</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div id="lg2" class="tab-pane">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form action="register2.php" method="post">
                                                <input type="hidden" name="samid" value="<?php echo $samid; ?>">
                                                <input type="text" name="cname" placeholder="Name">
                                                <input type="text" name="cmobile" placeholder="Mobile">
												<input name="cemail" placeholder="Email" type="email">
                                                <input type="password" name="cpassword" placeholder="Password">
												<textarea type="text" name="caddress" placeholder="Address"></textarea>
												<input type="text" name="ccity" placeholder="City">
                                                <div class="button-box">
                                                    <button type="submit">Register</button>
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