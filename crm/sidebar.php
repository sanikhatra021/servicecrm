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
                            <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                            <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                            <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
							
							<!--
                            <form class="sidebar-search  sidebar-search-bordered" action="page_general_search_3.html" method="POST">
                                <a href="javascript:;" class="remove">
                                    <i class="icon-close"></i>
                                </a>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <a href="javascript:;" class="btn submit">
                                            <i class="icon-magnifier"></i>
                                        </a>
                                    </span>
                                </div>
                            </form>
							-->
                            <!-- END RESPONSIVE QUICK SEARCH FORM -->
                        </li>
							
                        <li class="nav-item start <?php if (basename($_SERVER['PHP_SELF'])=='dashboard.php') {echo 'current';}?>">
                            <a href="dashboard.php" class="nav-link nav-toggle">
                                <i class="fa fa-dashboard"></i>
                                <span class="title">Dashboard</span>
																										
                            </a>
							
                      <!--  </li>
                        <li class="heading">
                            <h3 class="uppercase">Manage</h3>
							</li>-->
							
						
						
							 
							
							 
								<?php if($_SESSION['lasuperadmintype']='superadmin'){ ?>
							 <li class="nav-item <?php if ((basename($_SERVER['PHP_SELF'])=='superadmin.php') || (basename($_SERVER['PHP_SELF'])=='superadminadd.php') || (basename($_SERVER['PHP_SELF'])=='superadminedit.php')|| (basename($_SERVER['PHP_SELF'])=='superadmindetail.php')) {echo 'current';}?>">	
                                     <a href="superadmin.php" class="nav-link ">
                                         <i class="fa fa-user"></i><span class="title">Business </span>
                                     </a>
							</li>
						        <?php } ?>
						
							
							
				<!--	<li class="nav-item">
                          <a href="javascript:;" class="nav-link nav-toggle">
                              <i class="fa fa-wrench"></i>
                              <span class="title">Settings</span>
                              <span class="arrow"></span>
                          </a>
							<ul class="sub-menu">
							 
								<li class="nav-item">
								  <a href="emailedit.php?id=1" class="nav-link ">
								   <i class="fa fa-envelope"></i> <span class="title"> Email Configuration</span>
								</a>
								</li>-->
								
								<!--<li class="nav-item">
                                     <a href="banner.php" class="nav-link ">
                                         <i class="fa fa-picture-o"></i><span class="title"> Banner</span>
                                     </a>
								</li> -->
							
						<!--	<li class="nav-item">
                                     <a href="aboutedit.php?id=1" class="nav-link ">
                                         <i class="fa fa-info-circle"></i><span class="title"> About Us</span>
                                     </a>
							</li> 
							
							<li class="nav-item">
                                     <a href="termsedit.php?id=1" class="nav-link ">
                                         <i class="fa fa-info-circle"></i><span class="title"> Terms & Condition</span>
                                     </a>
							</li> 
							
								
							</ul>
					</li>-->
					<!--<li class="nav-item  ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-info-circle"></i>
                                <span class="title">Report</span>
                                <span class="arrow"></span>
                            </a>
							<ul class="sub-menu">
							  <li class="nav-item">
                                     <a href="reportuser.php" class="nav-link ">
                                         <i class="fa fa-flag"></i><span class="title"> User List </span>
                                     </a>
							</li>
							
							 <li class="nav-item">
                                     <a href="reportcategoryconsultant.php" class="nav-link ">
                                         <i class="fa fa-flag"></i><span class="title"> Category Wise Consultant List</span>
                                     </a>
							</li>
							
							 <li class="nav-item">
                                     <a href="reportconsultant.php" class="nav-link ">
                                         <i class="fa fa-flag"></i><span class="title"> Consultant List </span>
                                     </a>
							</li>
					</li>-->
							
					
							
				
                    <!-- END SIDEBAR MENU -->
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
			</div>
			
		