<?php 
session_start();
include("connect.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

	$umid=$_GET['id'];
	$_SESSION['umidid']=$umid;
	$eve = "select samid,uname from res_user_master where umid=$umid";
	$re = mysqli_query($conn, $eve);
	$uname="";
	if(mysqli_num_rows($re) > 0)
	{
		while($rt = mysqli_fetch_assoc($re))
		{
			$uname=$rt['uname'];
			$samid=$rt['samid'];
		}
		
	}
	$_SESSION['samidid']=$samid;
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Sminder</title>
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



</head>

<body>

    <div class="main-wrapper">
        <?php include("headermywebpage.php"); ?>
		
		 <div class="slider-area bg-gray-8">
            <div class="container">
                <div class="hero-slider-active-2 nav-style-1 nav-style-1-modify-2 nav-style-1-blue">
                   <?php 
						$evebanner="select bannerimg from res_banner_master where samid=$samid";
						$rebanner = mysqli_query($conn, $evebanner);
						$bannerimg="";
						while($rtbanner = mysqli_fetch_assoc($rebanner))
						{
							$bannerimg=$rtbanner['bannerimg'];
							
							if(strlen($bannerimg)>0)
							{
								$bannerimg1="<img src='./businesspanel/images/$bannerimg' alt='$bannerimg' width='1680px' height='320px'>";
							}
							else
							{
								$bannerimg1="<img class='animated' src='../images/noimage.jpg' alt='noimage' width='1680px' height='320px'>";
							}
				   ?>
                    <div class="single-hero-slider single-hero-slider-hm9 single-animation-wrap">
                        <div class="row slider-animated-1">
                           
                            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                                <div class="hm9-hero-slider-img">
                                  
									<?php echo $bannerimg1; ?>
                                </div>
                            </div>
                        </div>
                    </div>
					<?php } ?>
                </div>
            </div>
        </div>
		
       
	   
		<a name="about"></a>
        <div class="about-us-area pt-60 pb-120">
            <div class="container">
                <div class="about-us-content-3 text-center">
					
					<?php
						$aumid=5;

						$eve = "select * from res_aboutus_master where aumid=$samid";
						$re = mysqli_query($conn, $eve);
						$aumcontent='';
						while($rt = mysqli_fetch_assoc($re))
						{
							$aumcontent=$rt['aumcontent'];
						}
						echo $aumcontent;

					?>
                </div>
            </div>
        </div>
        <a name="product"></a>
		<div class="product-area pt-15 pb-120">
            <div class="container">
                <div class="section-title-6 section-title-6-xs mb-60 text-center">
				      
					  <?php 
							if(isset($_SESSION['cmsg']))
							{
						?>
						<div style="color:green;" id="mydiv">
							<strong><?php echo $_SESSION['cmsg'];?></strong>
						</div>
						<?php
							}
							unset($_SESSION['cmsg']);
						?>
					  
				
                    <h2>Products & Services</h2>
                </div>
                <div class="row">
					<?php 
						$eve2 = "select pmid,pmname,prate,pimage from res_product_master where ptype='Product' and samid=$samid";
						$re2 = mysqli_query($conn, $eve2);
						if(mysqli_num_rows($re2) > 0)
						{
							while($rt2 = mysqli_fetch_assoc($re2))
							{
								$pmid=$rt2['pmid'];
								$pmname=$rt2['pmname'];
								$prate=$rt2['prate'];
								$pimage=$rt2['pimage'];
							
					?>
                    <div class="custom-col-5  mb-20">
                        <div class="single-product-wrap">
                            <div class="product-img product-img-border border-blue mb-20">
                                <a href="#">
                                    <img data-toggle="modal" data-target="#exampleModalnew" data-id="<?php echo $pmid; ?>" id="getUser1" src="./images/<?php echo $pimage; ?>" height="200px" width="100px" alt="<?php echo $pimage; ?>">
                                </a>
                                
                            </div>
                            <div class="product-content-wrap-3  text-center">
                                <h3 class="mrg-none"><?php echo $pmname; ?></a></h3>
                               
                              
								<div class="pro-add-to-cart-2">
									 
									 <button title="Add Companin" data-toggle="modal" data-target="#exampleModalnew" data-id="<?php echo $pmid; ?>" id="getUser1">Add Complain</button>
								</div>
                            </div>
                        </div>
                    </div>
					<?php }} ?>
				</div>
				<br>
             
            </div>
        </div>
         
		<!-- Modal -->
		<?php include("footermywebpage.php"); ?>
		<!-- Modal -->
			
		<!-- Modal -->
        <div class="modal fade" id="exampleModalnew" tabindex="-1" role="dialog">
			<div class="modal-dialog">
			  <div class="modal-content">

				   <div class="modal-header">
						<h4 class="modal-title">
							<i class="glyphicon glyphicon-user"></i> Add Complain
						</h4><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				   </div>
					 <form  method="post" name="myForm" id="myForm" action="complainwebadd2.php" enctype="multipart/form-data">
					   <div class="modal-body">
						 <div id="modal-loader" style="display: none; text-align: center;">
							<img src="ajax-loader.gif">
						   </div>

						   <!-- content will be load here -->
						   <div id="dynamic-content"></div>

						</div>
					<div class="modal-footer">
						
						<button type="submit" class="btn btn-success">Submit</button>
						
						
					</div>
				</form>
			 </div>
		  </div>
		</div>
        <!-- Modal end -->
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

    
    <!-- Main JS -->
    <script src="assets/js/main.js"></script>
	
	<script>
	$(document).ready(function(){

		$(document).on('click', '#getUser1', function(e){

			e.preventDefault();

			var uid = $(this).data('id');   // it will get id of clicked row

			$('#dynamic-content').html(''); // leave it blank before ajax call
			$('#modal-loader').show();      // load ajax loader

			$.ajax({
				url: 'complainwebadd.php',
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
	setTimeout(function() {
    $('#mydiv').fadeOut('fast');
}, 5000); // <-- time in milliseconds-->
</script>



</body>

</html>