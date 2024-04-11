<?php
$eve = "select applink from res_setting_master where smid=1";
$re = mysqli_query($conn, $eve);
while($rt = mysqli_fetch_assoc($re))
{
	$applink=$rt['applink'];
}
?>
<style>
.current
{
	background: #3e4b5c!important;
}
.page-sidebar .page-sidebar-menu>li.active.open>a, .page-sidebar .page-sidebar-menu>li.active>a, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu>li.active.open>a, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu>li.active>a
{
	background: #121515 !important;
}
</style>
<div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                        <li class="sidebar-toggler-wrapper hide">
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <div class="sidebar-toggler"> </div>
                            <!-- END SIDEBAR TOGGLER BUTTON -->
                        </li>
                        <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
						
						
                        <li class="sidebar-search-wrapper">
                            
                        </li>
						<?php if($_SESSION['latcutype']=='admin'){?>
						<li class="nav-item start <?php if (basename($_SERVER['PHP_SELF'])=='dashboard.php') {echo 'current';}?>">
                            <a href="dashboard.php" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
						<li class="nav-item  <?php if ((basename($_SERVER['PHP_SELF'])=='region.php') || (basename($_SERVER['PHP_SELF'])=='regionadd.php') || (basename($_SERVER['PHP_SELF'])=='regionedit.php')) {echo 'current';}?>">
							<a href="region.php" class="nav-link ">
								<i class="fa fa-flag"></i><span class="title"> Region </span>
							</a>
						</li>
						<li class="nav-item   <?php if ((basename($_SERVER['PHP_SELF'])=='usernew.php') || (basename($_SERVER['PHP_SELF'])=='usernewadd.php') || (basename($_SERVER['PHP_SELF'])=='usernewedit.php')) {echo 'current';}?>">
							<a href="usernew.php" class="nav-link ">
								<i class="fa fa-user"></i><span class="title"> Users </span>
							</a>
						</li>
						
						<li class="nav-item <?php if ((basename($_SERVER['PHP_SELF'])=='product.php') || (basename($_SERVER['PHP_SELF'])=='productadd.php') || (basename($_SERVER['PHP_SELF'])=='productedit.php') || (basename($_SERVER['PHP_SELF'])=='subproduct.php') || (basename($_SERVER['PHP_SELF'])=='subproductadd.php') || (basename($_SERVER['PHP_SELF'])=='subproductedit.php') || (basename($_SERVER['PHP_SELF'])=='document.php') || (basename($_SERVER['PHP_SELF'])=='documentadd.php') || (basename($_SERVER['PHP_SELF'])=='documentedit.php') || (basename($_SERVER['PHP_SELF'])=='checklist.php') || (basename($_SERVER['PHP_SELF'])=='checklistadd.php') || (basename($_SERVER['PHP_SELF'])=='checklistedit.php') || (basename($_SERVER['PHP_SELF'])=='bank.php') || (basename($_SERVER['PHP_SELF'])=='bankadd.php') || (basename($_SERVER['PHP_SELF'])=='bankedit.php') || (basename($_SERVER['PHP_SELF'])=='applicationtype.php') || (basename($_SERVER['PHP_SELF'])=='applicationtypeadd.php') || (basename($_SERVER['PHP_SELF'])=='applicationtypeedit.php')) {echo 'active open';}?>">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-tasks"></i>
                                <span class="title">Master</span>
                                <span class="arrow"></span>
                            </a>
							<ul class="sub-menu">
								<li class="nav-item <?php if ((basename($_SERVER['PHP_SELF'])=='product.php') || (basename($_SERVER['PHP_SELF'])=='productadd.php') || (basename($_SERVER['PHP_SELF'])=='productedit.php')) {echo 'current';}?>">
									<a href="product.php" class="nav-link ">
										<i class="fa fa-th"></i><span class="title"> Products </span>
									</a>
								</li>
								<li class="nav-item <?php if ((basename($_SERVER['PHP_SELF'])=='subproduct.php') || (basename($_SERVER['PHP_SELF'])=='subproductadd.php') || (basename($_SERVER['PHP_SELF'])=='subproductedit.php')) {echo 'current';}?>">
									<a href="subproduct.php" class="nav-link ">
										<i class="fa fa-th"></i><span class="title"> Sub Products </span>
									</a>
								</li>
								<li class="nav-item <?php if ((basename($_SERVER['PHP_SELF'])=='document.php') || (basename($_SERVER['PHP_SELF'])=='documentadd.php') || (basename($_SERVER['PHP_SELF'])=='documentedit.php')) {echo 'current';}?> ">
									<a href="document.php" class="nav-link ">
										<i class="fa fa-file"></i><span class="title"> Document </span>
									</a>
								</li>
								<li class="nav-item  <?php if ((basename($_SERVER['PHP_SELF'])=='checklist.php') || (basename($_SERVER['PHP_SELF'])=='checklistadd.php') || (basename($_SERVER['PHP_SELF'])=='checklistedit.php')) {echo 'current';}?>">
									<a href="checklist.php" class="nav-link ">
										<i class="fa fa-list"></i><span class="title"> Checklist </span>
									</a>
								</li>
								<li class="nav-item  <?php if ((basename($_SERVER['PHP_SELF'])=='bank.php') || (basename($_SERVER['PHP_SELF'])=='bankadd.php') || (basename($_SERVER['PHP_SELF'])=='bankedit.php')) {echo 'current';}?>">
									<a href="bank.php" class="nav-link ">
										<i class="fa fa-bank"></i><span class="title"> Bank </span>
									</a>
								</li>
								<li class="nav-item  <?php if ((basename($_SERVER['PHP_SELF'])=='applicationtype.php') || (basename($_SERVER['PHP_SELF'])=='applicationtypeadd.php') || (basename($_SERVER['PHP_SELF'])=='applicationtypeedit.php')) {echo 'current';}?>">
									<a href="applicationtype.php" class="nav-link ">
										<i class="fa fa-file"></i><span class="title"> Application Type </span>
									</a>
								</li>
							</ul>
						</li>
						<?php }else if($_SESSION['latcutype']=='branchhead'){?>
						<li class="nav-item start ">
                            <a href="dashboard.php" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
						<li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-tasks"></i>
                                <span class="title">Master</span>
                                <span class="arrow"></span>
                            </a>
							<ul class="sub-menu">
								<li class="nav-item  ">
									<a href="user.php" class="nav-link ">
										<i class="fa fa-user"></i><span class="title"> Users </span>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item  ">
							<a href="leadalloacation.php" class="nav-link ">
								<i class="fa fa-user"></i><span class="title"> Lead Pending Allocation</span>
							</a>
						</li>
						<li class="nav-item  ">
							<a href="lead.php" class="nav-link ">
								<i class="fa fa-user"></i><span class="title"> Lead In Process</span>
							</a>
						</li>
						<li class="nav-item  ">
							<a href="leadclosed.php" class="nav-link ">
								<i class="fa fa-user"></i><span class="title"> Lead Closed</span>
							</a>
						</li>
						<?php }else if($_SESSION['latcutype']=='telehead'){?>
						<li class="nav-item start ">
                            <a href="dashboard.php" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
						<li class="nav-item  ">
							<a href="campaign.php" class="nav-link ">
								<i class="fa fa-tasks"></i><span class="title"> Campaign Management</span>
							</a>  
						</li>
									
						
						<li class="nav-item  ">
							<a href="reportcampaignwise.php" class="nav-link ">
								<i class="fa fa-file"></i><span class="title">Campaign wise Statistics </span>
							</a>  
						</li>
						
						<li class="nav-item  ">
							<a href="reportuserperformance.php" class="nav-link ">
								<i class="fa fa-file-o"></i><span class="title">User Performance Statistics </span>
							</a>  
						</li><li class="nav-item  ">
							<a href="reportuserdailycall.php" class="nav-link ">
								<i class="fa fa-file-o"></i><span class="title">User Daily Call Report </span>
							</a>  
						</li>
						<li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-info-circle"></i>
                                <span class="title">Reports</span>
                                <span class="arrow"></span>
                            </a>
							<ul class="sub-menu">
								<li class="nav-item  ">
							<a href="reportstatuswiseallocation.php" class="nav-link ">
								<i class="fa fa-info-circle"></i><span class="title"> Report prospect status wise </span>
							</a>  
							</li>
								<li class="nav-item  ">
								<a href="reportfollowup.php" class="nav-link ">
									<i class="fa fa-info-circle"></i><span class="title"> Report FollowUp </span>
								</a>  
							</li>
							<li class="nav-item  ">
								<a href="reportcomfirmprospect.php" class="nav-link ">
									<i class="fa fa-check"></i><span class="title"> Confirm Call </span>
								</a>  
							</li>
						</ul>
						</li>
						
						
						<!--<li class="nav-item  ">
							<a href="reportcampaignexport.php" class="nav-link ">
								<i class="fa fa-info-circle"></i><span class="title"> Export Campaign Data</span>
							</a>  
						</li>-->
						<!--</li><li class="nav-item  ">
							<a href="reportconfirmcalls.php" class="nav-link ">
								<i class="fa fa-repeat"></i><span class="title"> Report Delete Prospects  Status Wise </span>
							</a>  
						</li>
						-->
						
						<li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-cog"></i>
                                <span class="title">Master</span>
                                <span class="arrow"></span>
                            </a>
							<ul class="sub-menu">
								
						
						<li class="nav-item  ">
							<a href="sms.php" class="nav-link ">
								<i class="fa fa-envelope"></i><span class="title">WhatsApp Message Templates</span>
							</a>
						</li>
						
						<li class="nav-item  ">
							<a href="remarks.php" class="nav-link ">
								<i class="fa fa-comments-o"></i><span class="title"> Remarks Templates</span>
							</a>
						</li>
						
						<li class="nav-item  ">
							<a href="disposition.php" class="nav-link ">
								<i class="fa fa-comments-o"></i><span class="title"> Disposition</span>
							</a>
						</li>
						
						
						
						<li class="nav-item  ">
							<a href="user.php" class="nav-link ">
								<i class="fa fa-user"></i><span class="title"> TeleCaller </span>
							</a>
						</li>
				
							</ul>
						</li>
						<!--<li class="nav-item start ">
						<a target="_BLANK" href="<?php echo $_SESSION['latcapplink'];?>">
						  <img src="images/download.png" alt="download APK" width="200" height="100">
						</a>
                           
                        </li>-->
						<?php }else if($_SESSION['latcutype']=='saleshead'){?>
						<li class="nav-item start ">
                            <a href="dashboard.php" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
						<li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-tasks"></i>
                                <span class="title">Master</span>
                                <span class="arrow"></span>
                            </a>
							<ul class="sub-menu">
								<li class="nav-item  ">
									<a href="user.php" class="nav-link ">
										<i class="fa fa-user"></i><span class="title"> Sales Executive </span>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item  ">
							<a href="leadalloacation.php" class="nav-link ">
								<i class="fa fa-user"></i><span class="title"> Lead Pending Allocation</span>
							</a>
						</li>
						<li class="nav-item  ">
							<a href="lead.php" class="nav-link ">
								<i class="fa fa-user"></i><span class="title"> Lead In Process</span>
							</a>
						</li>
						<li class="nav-item  ">
							<a href="leadclosed.php" class="nav-link ">
								<i class="fa fa-user"></i><span class="title"> Lead Confirmed</span>
							</a>
						</li>
						<li class="nav-item  ">
							<a href="leadnotinterested.php" class="nav-link ">
								<i class="fa fa-user"></i><span class="title"> Lead Not Interested</span>
							</a>
						</li>
						<?php }else if($_SESSION['latcutype']=='operationalhead'){ ?>
						<li class="nav-item start ">
                            <a href="dashboard.php" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
						<li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-tasks"></i>
                                <span class="title">Master</span>
                                <span class="arrow"></span>
                            </a>
							<ul class="sub-menu">
								<li class="nav-item  ">
									<a href="user.php" class="nav-link ">
										<i class="fa fa-user"></i><span class="title"> Operational Staff  </span>
									</a>
								</li>
							</ul>
						</li>
						
						<li class="nav-item  ">
							<a href="leadclosedallocation.php" class="nav-link ">
								<i class="fa fa-user"></i><span class="title"> Lead Pending </span>
							</a>
						</li>
						<li class="nav-item  ">
							<a href="ohleadinprocess.php" class="nav-link ">
								<i class="fa fa-user"></i><span class="title"> Lead In Process </span>
							</a>
						</li>
						<li class="nav-item  ">
							<a href="ohleadconfirmed.php" class="nav-link ">
								<i class="fa fa-user"></i><span class="title"> Lead Confirmed </span>
							</a>
						</li>
						<li class="nav-item  ">
							<a href="ohleadnotinterested.php" class="nav-link ">
								<i class="fa fa-user"></i><span class="title"> Lead Not Interested </span>
							</a>
						</li>
						<!--<li class="nav-item  ">
							<a href="leadclosedallocated.php" class="nav-link ">
								<i class="fa fa-user"></i><span class="title">Allocation Lead </span>
							</a>
						</li>-->
						<?php }else if($_SESSION['latcutype']=='operationalstaff'){ ?>
						<li class="nav-item start ">
                            <a href="dashboard.php" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
						
						<li class="nav-item  ">
							<a href="leadlogin.php" class="nav-link ">
								<i class="fa fa-user"></i><span class="title"> Lead </span>
							</a>
						</li>
						<li class="nav-item">
							<a href="applicant.php" class="nav-link ">
								<i class="fa fa-arrows"></i><span class="title"> Applicant </span>
							</a>
						</li>
						<li class="nav-item">
							<a href="company.php" class="nav-link ">
								<i class="fa fa-institution"></i><span class="title"> Company </span>
							</a>
						</li>
						<!--<li class="nav-item">
							<a href="loanlogin.php" class="nav-link ">
								<i class="fa fa-key"></i><span class="title"> Loan Login </span>
							</a>
						</li>-->
						<li class="nav-item">
							<a href="loanloginnew.php" class="nav-link ">
								<i class="fa fa-key"></i><span class="title"> Loan Login </span>
							</a>
						</li>
						<li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-tasks"></i>
                                <span class="title">Master</span>
                                <span class="arrow"></span>
                            </a>
							<ul class="sub-menu">
								<li class="nav-item  ">
									<a href="productnew.php" class="nav-link ">
										<i class="fa fa-th"></i><span class="title"> Manage Products </span>
									</a>
								</li>
								<li class="nav-item  ">
									<a href="country.php" class="nav-link ">
										<i class="fa fa-th"></i><span class="title"> Country </span>
									</a>
								</li>
								<li class="nav-item  ">
									<a href="state.php" class="nav-link ">
										<i class="fa fa-th"></i><span class="title"> State </span>
									</a>
								</li>
								<li class="nav-item  ">
									<a href="city.php" class="nav-link ">
										<i class="fa fa-th"></i><span class="title"> City </span>
									</a>
								</li>
								<li class="nav-item  ">
									<a href="product.php" class="nav-link ">
										<i class="fa fa-th"></i><span class="title"> Products </span>
									</a>
								</li>
								<li class="nav-item  ">
									<a href="subproduct.php" class="nav-link ">
										<i class="fa fa-th"></i><span class="title"> Sub Products </span>
									</a>
								</li>
								<li class="nav-item  ">
									<a href="document.php" class="nav-link ">
										<i class="fa fa-file"></i><span class="title"> Document </span>
									</a>
								</li>
								<li class="nav-item  ">
									<a href="checklist.php" class="nav-link ">
										<i class="fa fa-list"></i><span class="title"> Checklist </span>
									</a>
								</li>
								<li class="nav-item  ">
									<a href="bank.php" class="nav-link ">
										<i class="fa fa-bank"></i><span class="title"> Bank </span>
									</a>
								</li>
								<li class="nav-item  ">
									<a href="applicationtype.php" class="nav-link ">
										<i class="fa fa-file"></i><span class="title"> Application Type </span>
									</a>
								</li>
							</ul>
						</li>
				
						<?php }if($_SESSION['latcutype']=='telehead' || $_SESSION['latcutype']=='saleshead'){ ?>
						<li class="nav-item start ">
						<a target="_BLANK" href="<?php echo $applink; ?>">
						  <img src="images/download.png" alt="download APK" width="200" height="100">
						</a>
                           
                        </li>
						<?php } ?>
                    </ul>
                    <!-- END SIDEBAR MENU -->
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
