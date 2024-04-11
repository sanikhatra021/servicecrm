<?php 
session_start();
include("connect.php");
$urin = explode('/', $_SERVER['REQUEST_URI']);
$uri1=$urin[1];
	
	$eve1 = "select * from res_superadmin_master where saurl='".$urin[1]."'";
	$re1 = mysqli_query($conn, $eve1);
	$saurl="";
	if(mysqli_num_rows($re1) > 0)
	{
		while($rt1 = mysqli_fetch_assoc($re1))
		{
			$samid=$rt1['samid'];
			$_SESSION['businessid']=$samid;
			$safullname=$rt1['safullname'];
			$_SESSION['cmpname']=$safullname;
			$saurl=$rt1['saurl'];
			$_SESSION['weburl']= $saurl;
			$_SESSION['saaddress']= $rt1['saaddress'];
			$_SESSION['saemailid']= $rt1['saemailid'];
			$_SESSION['samobile']= $rt1['sacarenumber'];
			$_SESSION['salogo'] = $rt1['salogo'];
		}
	}else{
		header('Location: index.php');
		
	}
		$samid=$_SESSION['businessid'];
	$customerid=$_SESSION['customerid'];
	$url=$_SESSION['weburl'];
	$cmobile=$_SESSION['cmobile'];
	
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>LinkArise Service</title>
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
        <?php include("header.php"); ?>
		
			
        
        <!-- my account wrapper start -->
        <div class="my-account-wrapper pt-60 pb-120">
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
                                        <a href="#order" class="active" data-toggle="tab"><i class="fa fa-dashboard"></i>
                                             My Complain</a>
											 <a href="#product" class="" data-toggle="tab"><i class="fa fa-plus"></i>
                                             New Complain</a>
                                        <a href="#dashboard" data-toggle="tab"><i class="fa fa-cart-arrow-down"></i> My Account</a>
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
                                        <div class="tab-pane fade show active" id="order" role="tabpanel">
												 <div class="myaccount-content">
												 
												 
												 
                                                <h3> My Complain</h3>
												
												
												
									      
									      
                                                <div class="myaccount-table table-responsive text-center">
                                                    <table class="table table-bordered">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Ticket No</th>
                                                                <th>Compain Date</th>
                                                                <th>Status</th>
                                                                <th>Product Name</th>
                                                                <th>Complain Type</th>
                                                                <th>Remark</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
															<?php 
																$eve55="select * from res_complain_master where samid=$samid and customerid=$customerid and servicetype = 'Complain' order by cmid desc";
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
																	$cmnowithprefix=$rt55['cmnowithprefix'];
															?>
                                                            <tr>
                                                                <td><?php echo $cmnowithprefix; ?></td>
                                                                <td><?php echo $cmdate; ?></td>
                                                                <td><?php echo $cstatus; ?></td>
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
                                        <div class="tab-pane fade " id="product" role="tabpanel">
                                                 <div class="myaccount-content">
                                                <h3>New Complain</h3>
												<form method="post" id="formadd" name="formadd" action="frntcompadd.php" enctype="multipart/form-data" class="form-horizontal" >		
												
													<div class="row">
			<input type="hidden" name="pmid" value="<?php echo $id; ?>">
			<input type="hidden" name="samid" value="<?php echo $samid; ?>">
			<input type="hidden" name="customerid" value="<?php echo $customerid; ?>">
			<?php if(!empty($pimage)){ ?>
		     <div class="col-lg-5 col-md-6 col-12 col-sm-12">
                                <div class="tab-content quickview-big-img">
                                    <div id="pro-1" class="tab-pane fade show active">
                                        <img src="./images/<?php echo $pimage; ?>" alt="<?php echo $pimage; ?>">
                                    </div>
                                </div>
                            </div>
			<?php } ?>
                            <div class="col-lg-7 col-md-6 col-12 col-sm-12">
                                <div class="product-details-content quickview-content">
                                    <h2><?php echo $pmname; ?></h2>
                                   
                                   <!-- <p>Seamlessly predominate enterprise metrics without performance based process improvements.</p>-->
                                    

                                   
									
									<label class="control-label">Standard Problem </label>
                                       <select class="form-control" name="problemname" id="problemname">
										<option value="0">Select Standard Problem</option>
										<?php
										$eve_main1 = "select * from res_problemtype_master where samid=$samid";
										$re_main1= mysqli_query($conn, $eve_main1);
										while($rt_main1 = mysqli_fetch_assoc($re_main1))
										{

											//$ptmid=$rt_main1['ptmid'];
											$ptmname=$rt_main1['ptmname'];
											$ptmrate=$rt_main1['ptmrate'];
											if($ptmrate==0)
											{
												$price="";
											}
											else
											{
												$price="(Rs. ".$ptmrate.")";
											}
											if($ptmname1==$ptmname)
											{
												echo "<option value='$ptmname' selected>$ptmname $price</option>";
											}
											else
											{
												echo "<option value='$ptmname'>$ptmname $price</option>";
											}

										}
									?>
									</select>
									
										<label class="control-label">Call Type </label>
                                       <select class="form-control" name="ctmname" id="ctmname">
										<option value="0">Select Call Type</option>
										<?php
										$eve_main1 = "select * from res_complaintype_master where samid=$samid";
										$re_main1= mysqli_query($conn, $eve_main1);
										while($rt_main1 = mysqli_fetch_assoc($re_main1))
										{

											//$ptmid=$rt_main1['ptmid'];
											$ctmname=$rt_main1['ctmname'];
											$ctmid=$rt_main1['ctmid'];
											
												echo "<option value='$ctmname'>$ctmname</option>";
											

										}
									?>
									</select>
									
										<label class="control-label">Problem Detail </label>
										<textarea type="text" name="cmdetail" class="form-control" aria-required="true" aria-invalid="false" aria-describedby="name-error"  ></textarea>
										<label class="control-label">Photo </label>
										<input class="form-control" type="file" name="cmphoto" accept="images/*" >
										<div class="modal-footer">
						
						<button type="submit" class="btn btn-success">Submit</button>
						
						
					</div>
                                    </div>
                                </div>
                            </div>
							</form>		
                                            </div>
                                       
                                        </div>   
										<!-- Single Tab Content Start -->
                                        <div class="tab-pane fade " id="dashboard" role="tabpanel">
                                              <div class="myaccount-content">
                                                <h3>My Account</h3>
												
												
												<?php
												    $eve="select * from res_user_master where  umobile=$cmobile and samid=$samid";
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
                                                <div class="single-input-item">
													<!--<p>Name : <?php echo $uname;?></p>
													<p>Mobile : <?php echo $umobile;?></p>
													<p>Email : <?php echo $emailid;?></p>
													<p>Address : <?php echo $uaddress;?></p>
													<p>City : <?php echo $ucity;?></p>-->
													<table class="table table-borderless" style="border: none !important; width: 300px;">
										    
											<tr style="border; none;">
											<td style='text-align: right; text: bold;'><b>Name : </b></td>
											
											<td><?php echo $uname;?> </td>
											
											</tr>
											<tr>
											<td style='text-align: right;'><b>Mobile : </b></td><td><?php echo $umobile;?></td>
											</tr>
											<tr>
											<td style='text-align: right;'><b>Email : </b></td><td><?php echo $emailid;?></td>
											</tr>
											<tr>
											<td style='text-align: right;'><b>Address : </b></td><td><?php echo $uaddress;?></td>
											</tr>
											<tr>
											<td style='text-align: right;'><b>City :</b></td><td><?php echo $ucity;?></td>
											</tr>
											
											
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
									</div>
									 </div>
                                </div> <!-- My Account Tab Content End -->
                            </div>
                        </div> <!-- My Account Page End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- my account wrapper end -->
      
         
		<!-- Modal -->
		<?php include("footer.php"); ?>
		<!-- Modal -->
			
		<!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
			<div class="modal-dialog">
			  <div class="modal-content">

				   <div class="modal-header">
						<h4 class="modal-title">
							<i class="glyphicon glyphicon-user"></i> Add Complain
						</h4><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				   </div>
					 <form  method="post" name="myForm" id="myForm" action="complainadd2.php" enctype="multipart/form-data">
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

    <!-- Use the minified version files listed below for better performance and remove the files listed above  
<script src="assets/js/vendor/vendor.min.js"></script>
<script src="assets/js/plugins/plugins.min.js"></script>  -->
    <!-- Main JS -->
    <script src="assets/js/main.js"></script>
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
?>
	<script>
	$(document).ready(function(){

		$(document).on('click', '#getUser', function(e){

			e.preventDefault();

			var uid = $(this).data('id');   // it will get id of clicked row

			$('#dynamic-content').html(''); // leave it blank before ajax call
			$('#modal-loader').show();      // load ajax loader

			$.ajax({
				url: 'complainadd.php',
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



</body>

</html>