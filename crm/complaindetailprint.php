<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
		$saemailid=$rt['saemailid'];
		
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
 */	    $saaddress=$rt['saaddress'];
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
	
	$cdid=(int)mysqli_real_escape_string($conn,$_GET['id']);

	//$cidid=(int)mysqli_real_escape_string($conn,$_GET['id']);
	//$pumdid=(int)mysqli_real_escape_string($conn,$_GET['id']);
	$cdid=(int)mysqli_real_escape_string($conn,$_GET['id']);
	 $cmid=(int)mysqli_real_escape_string($conn,$_GET['cmid']);
	// $cmid=$_SESSION['cmid'];
	//$page = $_GET['page'];
	//$_SESSION['cmid']=$cmid;
	//$_SESSION['pumdid']=$pumdid;
	$_SESSION['pdfgeneratecomplain']=1;
	
	
	$eve = "select * from res_complain_master where cmid=$cmid";
	$re = mysqli_query($conn, $eve);
	if(mysqli_num_rows($re) > 0)
	{
		while($rt = mysqli_fetch_assoc($re))
		{
				$cmdate=implode('-', array_reverse(explode('-', $rt['cmdate'])));
				$cmstatusudate=implode('-', array_reverse(explode('-', $rt['cmstatusudate'])));
				$cmdetail=$rt['cmdetail'];
				$cmphoto=$rt['cmphoto'];
				$cmsolution=$rt['cmsolution'];
				$cstatus=$rt['cstatus'];
				$cmservicecharge=$rt['cmservicecharge'];
				$cmupdatedon=date("d-m-Y H:i:s",strtotime($rt['cmupdatedon']));
				$cmupdatedby=$rt['cmupdatedby'];
				$cmserviceengineerid=$rt['cmserviceengineerid'];
				$cmproblemtype=$rt['cmproblemtype'];
				$cmadminstatus=$rt['cmadminstatus'];
				$cmnowithprefix=$rt['cmnowithprefix'];
				
				$cmadminstatusnew="<button data-toggle='modal' data-target='#view-modal5' data-id='$cmid' id='getUser5' class='btn btn-xs btn-success'>$cmadminstatus <i class='fa fa-pencil'></i></button>";
				$eve11 = "select * from res_user_master where umid=$cmserviceengineerid";
				$re11 = mysqli_query($conn, $eve11);
				$sename1="Select Service Engineer";
				while($rt11 = mysqli_fetch_assoc($re11))
				{
					$sename1=$rt11['uname'];
				}
				$seedit="<a data-toggle='modal' data-placement='top' title='Edit' class='' href='#responsive1'>
				<span class='label label-sm label-success'>$sename1 <i class='fa fa-edit fa-lg'></i></span></a>";
				
				
				if($cstatus=="Pending")
				{
					$cstatus1="<button data-toggle='modal' data-target='#view-modal' data-id='$cmid' id='getUser' class='btn btn-xs btn-success'>Pending</i></button>";
				}
				else if($cstatus=="In Process")
				{
					$cstatus1="<button data-toggle='modal' data-target='#view-modal' data-id='$cmid' id='getUser' class='btn btn-xs btn-warning'>In Process</button>";
				}
				else if($cstatus=="Completed")
				{
					$cstatus1="<button data-toggle='modal'  data-id='$cmid' id='getUser' class='btn btn-xs btn-danger'>Completed</button>";
				}
				else if($cstatus=="Cancel")
				{
					$cstatus1="<button data-toggle='modal' data-target='#view-modal' data-id='$cmid' id='getUser' class='btn btn-xs btn-clear'>Cancel</button>";
				}
				$pmid=$rt['pmid'];
				$eve1 = "select * from res_product_master where pmid=$pmid";
				$re1 = mysqli_query($conn, $eve1);
				$pmname="";
				while($rt1 = mysqli_fetch_assoc($re1))
				{
					$pmname=$rt1['pmname'];
				}
				
				$ctmid=$rt['ctmid'];
				$eve1 = "select * from res_complaintype_master where ctmid=$ctmid";
				$re1 = mysqli_query($conn, $eve1);
				$ctmname="";
				while($rt1 = mysqli_fetch_assoc($re1))
				{
					$ctmname=$rt1['ctmname'];
				}
				
				
				$customerid=$rt['customerid'];
				$eve11 = "select * from res_user_master where umid=$customerid";
				$re11 = mysqli_query($conn, $eve11);
				$uname="";
				while($rt11 = mysqli_fetch_assoc($re11))
				{
					$uname=$rt11['uname'];
					$uaddress=$rt11['uaddress'];
				}
				if(strlen($cmphoto)>3)
				{
					$cmphoto="<img src='images/$cmphoto' width='100px' height='100px'>";
				}
				else
				{
					$cmphoto="<img src='images/noimage.jpg' width='100px' height='100px'>";
				}
		}
	}
	
	$eve21 = "select * from res_complain_detail where cdid=$cdid order by cdid desc";
								$re21 = mysqli_query($conn, $eve21);
								while($rt21 = mysqli_fetch_assoc($re21))
								{
									$assigndate=date("d-m-Y",strtotime($rt21['assigndate']));
									$cdstatus=$rt21['cdstatus'];
									$cdremark=$rt21['cdremark'];
									$serviceengineerid=$rt21['serviceengineerid'];
									$cdservicecharge=$rt21['cdservicecharge'];
									$cdphoto=$rt21['cdphoto'];
									$cdmachinemodel=$rt21['cdmachinemodel'];
									$cdmachinesrno=$rt21['cdmachinesrno'];
									$cdmachinelocation=$rt21['cdmachinelocation'];
									$cdaddedon=date("d-m-Y",strtotime($rt21['cdaddedon']));
									$cdtime=date("h:i:sa",strtotime($rt21['cdaddedon']));
									$cdworkdone=$rt21['cdworkdone'];
									$cdpendingwok=$rt21['cdpendingwok'];
									$cdsign=$rt21['cdsign'];
									$cdcustremarks=$rt21['cdcustremarks'];
									$paystatus=$rt21['paystatus'];
									$paymentmode=$rt21['paymentmode'];
									$payamount=$rt21['payamount'];
									$paymentremark=$rt21['paymentremark'];
									
									$eve112 = "select uname from res_user_master where umid=$serviceengineerid";
									$re112 = mysqli_query($conn, $eve112);
									$sename12="";
									while($rt112 = mysqli_fetch_assoc($re112))
									{
										$sename12=$rt112['uname'];
									}
									
									if(strlen($cdphoto)>3)
									{
										$cdphoto="<img src='./images/$cdphoto' width='50px' height='50px'>";
									}
									else
									{
										$cdphoto="<img src='images/noimage.jpg' width='50px' height='50px'>";
									}
									
										if(strlen($cdsign)>3)
										{
											$cdsign="<img src='./images/$cdsign' width='100px' height='100px'>";
										}
										else
										{
											$cdsign="<img src='images/noimage.jpg' width='100px' height='100px'>";
										}
					
									if($cdstatus=="Pending")
									{
										$cdstatus="<span class='label label-sm label-primary'>Pending</span>";
									}
									else if($cdstatus=="In Process")
									{
										$cdstatus="<span class='label label-sm label-warning'>In Process</span>";
									}
									else if($cdstatus=="Completed")
									{
										$cdstatus="<span class='label label-sm label-success'>Completed</span>";
									}
									else if($cdstatus=="Cancel")
									{
										$cdstatus="<span class='label label-sm label-danger'>Cancel</span>";
									}
									else
									{
										$cdstatus="<span class='label label-sm label label-success'>$cdstatus</span>";
									}
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
<title>Complain Detail Report</title>
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
<link href="../assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
<link href="../assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
<!-- END THEME LAYOUT STYLES -->
<link href="../assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="../assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="favicon.ico" /> 

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

</head>
<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
<!-- BEGIN HEADER -->
<?php
            require ('header.php');
			?><!-- END HEADER -->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div class="page-container">
<?php
            require ('sidebar.php');
			?>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
<!-- BEGIN CONTENT BODY -->
<div class="page-content">
<!-- BEGIN PAGE HEADER-->
<!-- BEGIN THEME PANEL -->

<div class="row">
					
                    <div class="col-md-12">
					
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet light bordered">
						   <div class="portlet-title row">
								<div class="col-xs-9">
									<?php echo $salogo1; ?>
									<?php echo $safullname; ?>
								</div>
								<div class="col-xs-3">
								 <b>NO:</b>   <?php echo $cmnowithprefix; ?><br><br>
								 <b>DATE:</b> <?php echo $cdaddedon; ?> <br><br>
								 <b>TIME:</b> <?php echo $cdtime; ?> <br>
								</div>
                            </div>
							<hr style="height: 1px;color:black;background-color:black"/>
							<center><div><?php echo $saaddress;?></div>
							<div><?php echo $samobile.'|'.$saemailid;?></div></center><br>
							<div style="background-color: blue !important;text-align: center; color: white;border: 1px;" class='border'>COMPLAINT REPORT</div>
							
							  
							  <table class="table table-borderless row" style='padding-top: 50px;'>
							    <tr>
									<th class="col-xs-4">CLIENT NAME:</th>
									<td><?php echo $uname;?></td>
								</tr>
								<tr>
									<th class="col-xs-4">ADD.:</th>
									<td><?php echo $uaddress;?></td>
								</tr>
								<tr>
									<th class="col-xs-4">PAYMENT STATUS</th>
									<td><?php echo $paystatus;?></td>
								</tr> 
								<?php 
								   if($paystatus == 'Paid'){
								?>
								<tr>
									<th class="col-xs-4">PAYMENT MODE</th>
									<td><?php echo $paymentmode;?></td>
								</tr>
								<tr>
									<th class="col-xs-4">PAYMENT AMOUNT</th>
									<td><?php echo $payamount;?>&#8377</td>
								</tr>
								<tr>
									<th class="col-xs-4">PAYMENT REMARK</th>
									<td><?php echo $paymentremark;?></td>
								</tr>
								   <?php } ?>
								<tr class="hidden" >
									<th class="col-xs-4">MACHINE MODEL</th>
									<td><?php echo $cdmachinemodel;?></td>
								</tr>
								<tr class="hidden">
									<th class="col-xs-4">MACHINE SERIAL NO.</th>
									<td><?php echo $cdmachinesrno;?></td>
								</tr>
								<tr class="hidden">
									<th class="col-xs-4">MACHINE LOCATION</th>
									<td><?php echo $cdmachinelocation;?></td>
								</tr>
								<tr>
									<th class="col-xs-4">PROBLEM</th>
									<td><?php echo $cmproblemtype;?></td>
								</tr>
								<tr>
									<th class="col-xs-4">SERVICE ENGINEER</th>
									<td><?php echo $sename12;?></td>
								</tr>
								<tr>
									<th class="col-xs-4">SERVICE CHARGE</th>
									<td><?php echo $cdservicecharge;?>&#8377</td>
								</tr>
								<tr>
									<th class="col-xs-4">WORK DETAILS</th>
									<td><?php echo $cdworkdone;?></td>
								</tr>
								
								<tr  class="hidden" >
									<th class="col-xs-4">PENDING WORK</th>
									<td><?php echo $cdpendingwok;?></td>
								</tr>
								
								<tr>
									<th class="col-xs-4">CUSTOMER'S SIGN & REMARK</th>
									<td> <?php echo $cdsign.'  &nbsp;'.$cdcustremarks;?></td>
								</tr>

							  </table>
							  <a class="btn btn-lg blue hidden-print margin-bottom-5" onclick="javascript:window.print();"> Print
                                    <i class="fa fa-print"></i>
                                </a>
								
								<a class="btn btn-lg blue hidden-print margin-bottom-5" href="completedcomplain.php?cstatus=Completed"> Back </a>

							  </div>
							  
							  
							  
                        
							
							
                        </div>
						</div>
                        <!-- END EXAMPLE TABLE PORTLET-->
                    
			</div>
		</div>
	</div>
	</div>
	</div>