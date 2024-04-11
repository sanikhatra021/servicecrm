<?php
session_start();

	include("connect.php");
	if(!isset($_SESSION['complain']))
	{
		header('Location: index.php');
		return;
	}
	
	date_default_timezone_set("Asia/Kolkata");
	$mdate1= date('Y-m-d H:i:s');
	$mdate= date('d-m-Y');
	$cdate= date('d-m-Y');

	
	$eve = "select * from res_superadmin_master where samid=".$_SESSION['samid'];
	$re = mysqli_query($conn, $eve);
	while($rt = mysqli_fetch_assoc($re))
	{
		$safullname=$rt['safullname'];
		$samobile=$rt['samobile'];
		$saemailid=$rt['saemailid'];
		$salogo=$rt['salogo'];
		$sacarenumber=$rt['sacarenumber'];
		
		if(strlen($salogo)>3)
		{
			$salogo1="<img src='images/$salogo' width='100px' height='100px'>";
		}
		else
		{
			$salogo1="<img src='images/noimage.jpg' width='100px' height='100px'>";
		}
		$editinfo="Edit "."<a data-toggle='modal' data-placement='top' title='Edit' class='' href='#responsive1'><i class='fa fa-pencil'></i></a>'";
/* 		$pencile="";
		$tmp=$salogopencile."&nbsp;&nbsp;&nbsp;".$pencile;
 */		$saaddress=$rt['saaddress'];
		$saurl=$rt['saurl'];
		$saqrimg=$rt['saqrimg'];
		
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
		$main=$protocol.$hostName.$pathInfo['dirname'];
		$main1=$protocol.$hostName."/";
		//return;
		
		$saurl1=$main1.$saurl;
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
        <title>My Profile : LinkArise CRM</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
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
        <link href="../assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="../assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
		<link href="../assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="favicon.ico" />
		 <link href="../assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="../assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
		 <link href="jquery-ui.css" rel="stylesheet" type="text/css" />
	</head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        <!-- BEGIN HEADER -->
    <?php
            require ('header.php');
			?>        <!-- END HEADER -->
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
					

                <div class="portlet box blue-hoki purple">
					<div class="portlet-title purple">
						<div class="caption">
							<i class="fa fa-file"></i><small>My Profile Details</small>
						</div>
						<div class="actions">
							<a class="btn white btn-outline sbold" data-toggle="modal" href="#responsive1">Edit <i class="fa fa-edit fa-lg"></i></a>
						</div>
					</div>
					<div class="portlet-body">
						<table class="table table-bordered">
							<tr>
								<th>Name</th>
								<td><?php echo $safullname;?></td>
								<th></th>
								<td style="text-align: right;"></td>
							</tr>
							<tr>
								<th>Business URL</th>
								<td><?php echo $saurl1;?></td>
								<th>Mobile</th>
								<td><?php echo $samobile;?></td>
							</tr>
							<tr>
								<th>Email Id</th>
								<td><?php echo $saemailid;?></td>
								<th>Address</th>
								<td><?php echo $saaddress;?></td>
							</tr>
							<tr>
							    <th>Customer Care Number</th>
							    <td><?php echo $sacarenumber; ?> </td>
								<th>Logo</th>
								<td><?php echo $salogo1;?></td>
								
							</tr>
							
						</table>
					</div>
                </div>
				<!------end profile datails--------------------->
				
				<!------Start General Information--------------------->
				 <div class="portlet box blue-hoki blue">
					<div class="portlet-title purple">
						<div class="caption">
							<i class="fa fa-gift"></i><small>My QR Code</small>
						</div>
						<div class="actions">
							
						</div>
					</div>
					<div class="portlet-body">
						<?php if($saqrimg!=''){?>
						<img src="../images/<?php echo $saqrimg; ?>" width="300px" height="300px" /><a href="../images/<?php echo $saqrimg; ?>" download><i style="font-size:20px;" class="fa fa-download"></i></a>
						<?php }?>
					</div>
                </div>

				<!------End General Information--------------------->
				<!------new portlet------->
				     <div class="portlet box blue-hoki green">
					<div class="portlet-title green">
						<div class="caption">
							<i class="fa fa-gift"></i><small>About Us</small>  </div>
						<div class="actions">

						</div>
					</div>

                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->

					<div class="portlet-body form">



									<?php
										$aumid=0;
										$samid=$_SESSION['samid'];
										$umid=$_SESSION['umid'];
										$eve = "select * from res_aboutus_master where umid=$umid and samid=$samid";
										$re = mysqli_query($conn, $eve);
										$aumcontent='';
										while($rt = mysqli_fetch_assoc($re))
										{
											$aumid=$rt['aumid'];
											$aumcontent=$rt['aumcontent'];
										}
	

									?>

                                                <!-- BEGIN FORM-->
                                                <form action="aboutusedit2.php" method="POST" class="form-horizontal" enctype="multipart/form-data">
												<input type="hidden" name="aumid" value="<?php echo $aumid; ?>">

                                                    <div class="form-body">

														<div class="form-group">

															<div class="col-md-12">
																<textarea type="text" name="aumcontent" id="terms" class="form-control ckeditor" placeholder="Edit Keywords"><?php echo $aumcontent;?></textarea>
															</div>
														</div>

													<!-- /input-group -->

													<div class="form-actions">
                                                        <div class="row">
                                                             <center> <div class="col-md-offset-3 col-md-7">
                                                                <button type="submit" class="btn green">Submit</button>
                                                                <button type="button" class="btn grey-salsa btn-outline" onclick="document.location.href='aboutusedit.php'">Cancel</button>  </center>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                                <!-- END FORM-->

                                            </div>
                                        </div>
                </div>
				<!------end new portlet------->

				<!--------------Edit Profie Popup--------------->
				<div id="responsive" class="modal fade" tabindex="-1" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
								<h4 class="modal-title">Edit Profile</h4>
							</div>
							<form method="post" action="profileedit2.php" enctype="multipart/form-data">
								<input type="hidden" name="samid" value="<?php echo $_SESSION['samid'];?>">
							<div class="modal-body">
								<div class="scroller" style="height:250px" data-always-visible="1" data-rail-visible1="1">
									<div class="row">
										<div class="col-md-12">							
											<table class="table table-bordered">
											<tr>									
											<td>Business Logo</td>							
											<td>									
												<input type="file" name="brbusinesslogo" class="form-control" accept="image/*">
												<?php if(strlen($brbusinesslogo)>3)
												{?>
												<a href="./superadmin/images/<?php echo $brbusinesslogo; ?>" target="_blank">Download</a>
												<?php } ?>
											</td>							
											</tr>
											<tr>									
											<td>Business Description</td>							
											<td>									
												<textarea type="text" name="brbusinessdesc" class="form-control"><?php echo urldecode($brbusinessdesc); ?></textarea>
											</td>							
											</tr>
											<tr>									
											<td>Email Alert On/ Off</td>							
											<td>									
												<select class="form-control" name="brbalert" >
													<option <?php if($rt['brcurrentplantype']==0){ echo "selected"; } ?> value="0">Off</option>
													<option <?php if($rt['brcurrentplantype']==1){ echo "selected"; } ?> value="1">On</option>
												</select>
											</td>							
											</tr>
											<tr>									
											<td>Alert Email Id</td>							
											<td>									
												<input type="email" name="brbalertemail1" class="form-control" placeholder="Enter Alert Email Id" value="<?php echo $brbalertemail1; ?>">
											</td>							
											</tr>
											</table>
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
				<!--------------------start----------------------->
					<!--------------Service Engineer Allocate--------------->
			<div id="responsive1" class="modal fade" tabindex="-1" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Customer Info Edit</h4>
						</div>
						
						<form method="post" action="infoedit.php" enctype="multipart/form-data" class="form-horizontal">		
						<input type="hidden" name="cmid" value="<?php echo $cmid;?>">
							<div class="modal-body">						
							<div class="" style="height:100px" data-always-visible="1" data-rail-visible1="1">							
							<div class="row">	
							
							<div class="col-md-12">
													
								<div class="form-group">
									<label class="col-md-5 control-label">Select Logo <span class="required">*</span></label>
									<div class="col-md-7">
										<input class="form-control" type="file" name="cmphoto" accept="images/*">
									</div>
								</div>	
									
							</div>		
                            <div class="col-md-12">
													
								<div class="form-group">
									<label class="col-md-5 control-label">Name <span class="required">*</span></label>
									<div class="col-md-7">
									<input  required type="text" name="name" value="<?php echo $safullname; ?>" class="form-control" aria-required="true" aria-invalid="false" aria-describedby="name-error" >
								</div>
							</div>
							</div>	

                          <div class="col-md-12">
													
								<div class="form-group">
									<label class="col-md-5 control-label">Address <span class="required">*</span></label>
									<div class="col-md-7">
									<textarea required type="text" name="address" value="" class="form-control" aria-required="true" aria-invalid="false" aria-describedby="name-error" ><?php echo $saaddress; ?></textarea>
								</div>
							</div>
							
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="col-md-5 control-label">Email Id <span class="required">*</span></label>
									<div class="col-md-7">
									<input  required type="text" name="saemailid" value="<?php echo $saemailid; ?>" class="form-control" aria-required="true" aria-invalid="false" aria-describedby="name-error" >
								</div>
							</div>
							</div>	
                           <div class="col-md-12">
								<div class="form-group">
									<label class="col-md-5 control-label">Customer Care Number <span class="required">*</span></label>
									<div class="col-md-7">
									<input  required type="text" name="sacarenumber" value="<?php echo $sacarenumber; ?>" class="form-control" aria-required="true" aria-invalid="false" aria-describedby="name-error" >
								</div>
							</div>
							</div>								
			</div>						
			</div>					
			<div class="modal-footer">				
			<button type="button" data-dismiss="modal" class="btn dark btn-outline"><i class="fa fa-arrow-left"></i> Close</button>				
				<button type="submit" class="btn green" value="Submit"><i class="fa fa-arrow-left"></i>  Submit</button>					
			</div>					
			</div>				
			</form>		


				</div>
				</div>
			</div>
				<!--------------------end----------------------->
           





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


		 
        <script src="../assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>

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

		<script src="../assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
		<script src="../assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>

		<script src="../assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
		<script src="../assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
		<script src="../assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
         <script src="../assets/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>

		<!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
		<script>
			$( function()
			{
				$( "#datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' }).val();
			} );
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


<?php


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
    </body>

</html>
