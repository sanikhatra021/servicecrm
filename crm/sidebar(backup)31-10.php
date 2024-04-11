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
						
						
							<!--<li class="nav-item start ">
						<a target="_BLANK" href="<?php echo $_SESSION['appicationlink'];?>">
						  <img src="images/download.png" alt="download APK" width="200" height="100">
						</a>
                           
                        </li>-->
						
						
                        <li class="nav-item start <?php if (basename($_SERVER['PHP_SELF'])=='dashboard.php') {echo 'current';}?>">
                            <a href="dashboard.php" class="nav-link nav-toggle">
                                <i class="fa fa-dashboard"></i>
                                <span class="title">Dashboard</span>
																										
                            </a>
						</li>  
						
						<?php
if($_SESSION['utype']=='Admin'){
?>		
							<li class="nav-item <?php if ((basename($_SERVER['PHP_SELF'])=='workorder.php') || (basename($_SERVER['PHP_SELF'])=='workorderadd.php') || (basename($_SERVER['PHP_SELF'])=='workorderedit.php')|| (basename($_SERVER['PHP_SELF'])=='workorderdetail.php') ||(basename($_SERVER['PHP_SELF'])=='deliverydispatch.php') || (basename($_SERVER['PHP_SELF'])=='deliverydispatchadd.php') || (basename($_SERVER['PHP_SELF'])=='deliverydetail.php')  ) {echo 'active open';}?>">
                          <a href="javascript:;" class="nav-link nav-toggle">
                              <i class="fa fa-list"></i>
                              <span class="title">Project Management</span>
                              <span class="arrow"></span>
                          </a>
						  <ul class="sub-menu">
							 
							
							
                                     
								 	<li>
							 <a href="workorder.php" class="nav-link ">
                                         <i class="fa fa-th"></i><span class="title">Work Order</span>
                                     </a>
							</li>
							<li>
							 <a href="deliverydispatch.php" class="nav-link ">
                                         <i class="fa fa-th"></i><span class="title">Dispatch</span>
                                     </a>
							</li>
									 
							
							</ul>
							</li>
						
							<li class="nav-item <?php if ((basename($_SERVER['PHP_SELF'])=='service.php') || (basename($_SERVER['PHP_SELF'])=='serviceadd.php')  || (basename($_SERVER['PHP_SELF'])=='servicenewedit.php') || (basename($_SERVER['PHP_SELF'])=='amcedit.php')|| (basename($_SERVER['PHP_SELF'])=='complain.php') || (basename($_SERVER['PHP_SELF'])=='complainadd.php') || (basename($_SERVER['PHP_SELF'])=='complainedit.php')|| (basename($_SERVER['PHP_SELF'])=='complaindetail.php')||(basename($_SERVER['PHP_SELF'])=='completedcomplain.php') || (basename($_SERVER['PHP_SELF'])=='complainadd.php') || (basename($_SERVER['PHP_SELF'])=='complainedit.php')|| (basename($_SERVER['PHP_SELF'])=='complaindetail.php')|| (basename($_SERVER['PHP_SELF'])=='complaindetailprint.php')|| (basename($_SERVER['PHP_SELF'])=='servicedetail.php')) {echo 'active open';}?>">
                          <a href="javascript:;" class="nav-link nav-toggle">
                              <i class="fa fa-user"></i>
                              <span class="title">Service Management</span>
                              <span class="arrow"></span>
                          </a>
						  <ul class="sub-menu">
							 
								   <li class="nav-item   <?php if ((basename($_SERVER['PHP_SELF'])=='service.php') || (basename($_SERVER['PHP_SELF'])=='serviceadd.php')  || (basename($_SERVER['PHP_SELF'])=='servicenewedit.php') || (basename($_SERVER['PHP_SELF'])=='amcedit.php')) {echo 'current';}?>">
                                     <a href="service.php" class="nav-link ">
                                         <i class="fa fa-user"></i><span class="title"> Add Service (PPM)</span>
                                     </a>
							</li>
<?php  }
if($_SESSION['utype']=='Admin' || $_SESSION['utype']=='serviceengineer'){
?>	
							 <li class="nav-item <?php if ((basename($_SERVER['PHP_SELF'])=='complain.php') || (basename($_SERVER['PHP_SELF'])=='complainadd.php') || (basename($_SERVER['PHP_SELF'])=='complainedit.php')|| (basename($_SERVER['PHP_SELF'])=='complaindetail.php')|| (basename($_SERVER['PHP_SELF'])=='complaindetailprint.php')) {echo 'current';}?>">	
                                     <a href="complain.php?cstatus=All" class="nav-link ">
                                         <i class="fa fa-user-plus"></i><span class="title">Call Management </span>
                                     </a>
							</li>
								
							<li class="nav-item <?php if ((basename($_SERVER['PHP_SELF'])=='completedcomplain.php') || (basename($_SERVER['PHP_SELF'])=='complainadd.php') || (basename($_SERVER['PHP_SELF'])=='complainedit.php')|| (basename($_SERVER['PHP_SELF'])=='complaindetail.php')|| (basename($_SERVER['PHP_SELF'])=='complaindetailprint.php')) {echo 'current';}?>">	
                                     <a href="completedcomplain.php?cstatus=Completed" class="nav-link ">
                                         <i class="fa fa-user"></i><span class="title">Completed Call </span>
                                     </a>
							</li>	 
<?php } ?>
							</ul>
							</li>
                        <!--<li class="heading">
                            <h3 class="uppercase">Manage</h3>
							</li>-->
							<?php
if($_SESSION['utype']=='Admin'){
?>	
									<li class="nav-item <?php if ((basename($_SERVER['PHP_SELF'])=='reportamcalert.php') || (basename($_SERVER['PHP_SELF'])=='reportcomplaindetail.php') || (basename($_SERVER['PHP_SELF'])=='ufeedback.php') ||(basename($_SERVER['PHP_SELF'])=='ufeedbackdelete.php')  || (basename($_SERVER['PHP_SELF'])=='upcomingservicerenewal.php')|| (basename($_SERVER['PHP_SELF'])=='reportcompletedcall.php')|| (basename($_SERVER['PHP_SELF'])=='reportpendingpayment.php') ) {echo 'active open';}?>">
                          <a href="javascript:;" class="nav-link nav-toggle">
                              <i class="fa fa-bar-chart"></i>
                              <span class="title">Report</span>
                              <span class="arrow"></span>
                          </a>
						  <ul class="sub-menu">
						  
						  <!--<li class="nav-item <?php if ((basename($_SERVER['PHP_SELF'])=='complainreminder.php')   ) {echo 'current';}?>">	
                                     <a href="complainreminder.php" class="nav-link ">
                                         <i class="fa fa-user-plus"></i><span class="title">Complain Reminder</span>
                                     </a>
							</li>-->  
							<li class="nav-item <?php if ((basename($_SERVER['PHP_SELF'])=='reportcomplaindetail.php')   ) {echo 'current';}?>">	
                                     <a href="reportcomplaindetail.php" class="nav-link ">
                                         <i class="fa fa-user-plus"></i><span class="title">All Service Report  </span>
                                     </a>
							</li> 
									<li class="nav-item <?php if ((basename($_SERVER['PHP_SELF'])=='reportcompletedcall.php')   ) {echo 'current';}?>">	
                                     <a href="reportcompletedcall.php" class="nav-link ">
                                         <i class="fa fa-user-plus"></i><span class="title">Completed Service Call  </span>
                                     </a>
							</li> 
						   <!-- <li class="nav-item <?php if ((basename($_SERVER['PHP_SELF'])=='reportpendingpayment.php')   ) {echo 'current';}?>">	
                                     <a href="reportpendingpayment.php" class="nav-link ">
                                         <i class="fa fa-user-plus"></i><span class="title">Pending Payment </span>
                                     </a>
							</li>-->
							 <!--<li class="nav-item <?php if ((basename($_SERVER['PHP_SELF'])=='ufeedback.php') ) {echo 'current';}?>">	
                                     <a href="ufeedback.php" class="nav-link ">
                                         <i class="fa fa-comments-o"></i><span class="title"> Feedback </span>
                                     </a>
							</li>-->
							  <li class="nav-item <?php if ((basename($_SERVER['PHP_SELF'])=='upcomingservicerenewal.php') ) {echo 'current';}?>">	
                                     <a href="upcomingservicerenewal.php" class="nav-link ">
                                         <i class="fa fa-gear"></i><span class="title">Upcoming Service Renewal </span>
                                     </a>
							</li>
							  <li class="nav-item <?php if ((basename($_SERVER['PHP_SELF'])=='reportpendingpayment.php')   ) {echo 'current';}?>">	
                                     <a href="reportpendingpayment.php" class="nav-link ">
                                         <i class="fa fa-user-plus"></i><span class="title">Pending Payment Report</span>
                                     </a>
							</li>
							
							</ul>
							</li>
							
							
							
							<li class="nav-item <?php if ((basename($_SERVER['PHP_SELF'])=='user.php') || (basename($_SERVER['PHP_SELF'])=='useradd.php') || (basename($_SERVER['PHP_SELF'])=='useredit.php') || (basename($_SERVER['PHP_SELF'])=='userdetail.php') || (basename($_SERVER['PHP_SELF'])=='complaintype.php') || (basename($_SERVER['PHP_SELF'])=='complaintypeadd.php') || (basename($_SERVER['PHP_SELF'])=='complaintypeedit.php') || (basename($_SERVER['PHP_SELF'])=='complaintypedetail.php') || (basename($_SERVER['PHP_SELF'])=='status.php') || (basename($_SERVER['PHP_SELF'])=='statusadd.php') || (basename($_SERVER['PHP_SELF'])=='statusedit.php') || (basename($_SERVER['PHP_SELF'])=='statusdetail.php') || (basename($_SERVER['PHP_SELF'])=='product.php')  || (basename($_SERVER['PHP_SELF'])=='productadd.php') || (basename($_SERVER['PHP_SELF'])=='productedit.php') || (basename($_SERVER['PHP_SELF'])=='productdetail.php')||(basename($_SERVER['PHP_SELF'])=='company.php') || (basename($_SERVER['PHP_SELF'])=='companyadd.php') || (basename($_SERVER['PHP_SELF'])=='companyedit.php')|| (basename($_SERVER['PHP_SELF'])=='companydetail.php')||(basename($_SERVER['PHP_SELF'])=='faq.php') || (basename($_SERVER['PHP_SELF'])=='faqadd.php') || (basename($_SERVER['PHP_SELF'])=='faqedit.php')|| (basename($_SERVER['PHP_SELF'])=='faqdetails.php')||(basename($_SERVER['PHP_SELF'])=='item.php') || (basename($_SERVER['PHP_SELF'])=='itemadd.php') || (basename($_SERVER['PHP_SELF'])=='itemedit.php')|| (basename($_SERVER['PHP_SELF'])=='itemdetail.php') || (basename($_SERVER['PHP_SELF'])=='customer.php') ||(basename($_SERVER['PHP_SELF'])=='customeredit.php') || (basename($_SERVER['PHP_SELF'])=='customerdetail.php') ||  (basename($_SERVER['PHP_SELF'])=='aboutusedit.php')||  (basename($_SERVER['PHP_SELF'])=='usermeasure.php')||  (basename($_SERVER['PHP_SELF'])=='usermeasureadd.php')||  (basename($_SERVER['PHP_SELF'])=='usermeasureedit.php')||  (basename($_SERVER['PHP_SELF'])=='servicetype.php')||  (basename($_SERVER['PHP_SELF'])=='servicetypeadd.php')||  (basename($_SERVER['PHP_SELF'])=='servicetypeedit.php')||  (basename($_SERVER['PHP_SELF'])=='customeradd.php') ||  (basename($_SERVER['PHP_SELF'])=='unitmeasure.php')||  (basename($_SERVER['PHP_SELF'])=='unitmeasureadd.php')||  (basename($_SERVER['PHP_SELF'])=='problemtype.php') ||  (basename($_SERVER['PHP_SELF'])=='problemtypeedit.php')||  (basename($_SERVER['PHP_SELF'])=='problemtypeadd.php') ) {echo 'active open';}?>">
                          <a href="javascript:;" class="nav-link nav-toggle">
                              <i class="fa fa-list"></i>
                              <span class="title"> Master</span>
                              <span class="arrow"></span>
                          </a>
						  <ul class="sub-menu">
							  <li class="nav-item  <?php if ((basename($_SERVER['PHP_SELF'])=='customer.php') || (basename($_SERVER['PHP_SELF'])=='customeradd.php') || (basename($_SERVER['PHP_SELF'])=='customeredit.php')|| (basename($_SERVER['PHP_SELF'])=='customerdetail.php')) {echo 'current';}?>">
                                     <a href="customer.php" class="nav-link ">
                                         <i class="fa fa-user"></i><span class="title"> Customer Master </span>
                                     </a>
							</li>
							
							
							
							
							<li class="nav-item <?php if ((basename($_SERVER['PHP_SELF'])=='user.php') || (basename($_SERVER['PHP_SELF'])=='useradd.php') || (basename($_SERVER['PHP_SELF'])=='useredit.php')|| (basename($_SERVER['PHP_SELF'])=='userdetail.php')) {echo 'current';}?>">
                                     <a href="user.php" class="nav-link ">
                                         <i class="fa fa-certificate"></i><span class="title"> Service Engineer </span>
                                     </a>
							</li>
							<li class="nav-item <?php if ((basename($_SERVER['PHP_SELF'])=='product.php') || (basename($_SERVER['PHP_SELF'])=='productadd.php') || (basename($_SERVER['PHP_SELF'])=='productedit.php')|| (basename($_SERVER['PHP_SELF'])=='productdetail.php')) {echo 'current';}?>">						
					
                                     <a href="product.php" class="nav-link ">
                                         <i class="fa fa-bars"></i><span class="title"> Product/ Service Package</span>
                                     </a>
					       </li> 
							 <li class="nav-item <?php if ((basename($_SERVER['PHP_SELF'])=='item.php') || (basename($_SERVER['PHP_SELF'])=='itemadd.php') || (basename($_SERVER['PHP_SELF'])=='itemedit.php')|| (basename($_SERVER['PHP_SELF'])=='itemdetail.php')) {echo 'current';}?>">						
					
                                     <a href="item.php" class="nav-link ">
                                         <i class="fa fa-opencart "></i><span class="title"> Parts/ Item </span>
                                     </a>
					      </li> 
						   <li class="nav-item <?php if ((basename($_SERVER['PHP_SELF'])=='unitmeasure.php') || (basename($_SERVER['PHP_SELF'])=='unitmeasureadd.php') || (basename($_SERVER['PHP_SELF'])=='unitmeasureedit.php')) {echo 'current';}?>">						
					
                                     <a href="unitmeasure.php" class="nav-link ">
                                         <i class="fa fa-bars "></i><span class="title"> Unit Master </span>
                                     </a>
					      </li> 
						  <li class="nav-item <?php if ((basename($_SERVER['PHP_SELF'])=='problemtype.php') || (basename($_SERVER['PHP_SELF'])=='problemtypeadd.php') || (basename($_SERVER['PHP_SELF'])=='problemtypeedit.php')) {echo 'current';}?>">						
					
							<a href="problemtype.php" class="nav-link ">
							 <i class="fa fa-th"></i><span class="title"> Standard Problem </span>
							</a>
						</li>  
							<li class="nav-item <?php if ((basename($_SERVER['PHP_SELF'])=='complaintype.php') || (basename($_SERVER['PHP_SELF'])=='complaintypeadd.php') || (basename($_SERVER['PHP_SELF'])=='complaintypeedit.php')|| (basename($_SERVER['PHP_SELF'])=='complaintypedetail.php')) {echo 'current';}?>">
                                     <a href="complaintype.php" class="nav-link ">
                                         <i class="fa fa-gear"></i><span class="title"> Call Type </span>
                                     </a>
							</li>
							<li class="nav-item <?php if ((basename($_SERVER['PHP_SELF'])=='servicetype.php') || (basename($_SERVER['PHP_SELF'])=='servicetypeadd.php') || (basename($_SERVER['PHP_SELF'])=='servicetypeedit.php')) {echo 'current';}?>">
                                     <a href="servicetype.php" class="nav-link ">
                                         <i class="fa fa-gear"></i><span class="title"> Service Type </span>
                                     </a>
							</li>
							
						
					<!-- <li class="nav-item <?php //if ((basename($_SERVER['PHP_SELF'])=='company.php') || (basename($_SERVER['PHP_SELF'])=='companyadd.php') || (basename($_SERVER['PHP_SELF'])=='companyedit.php')|| (basename($_SERVER['PHP_SELF'])=='companydetail.php')) {echo 'current';}?>">						
					
                                     <a href="companyedit.php" class="nav-link ">
                                         <i class="fa fa-building-o"></i><span class="title">Company </span>
                                     </a>
					 </li> -->
					
							 </ul>
							 </li>
							 
							
							
							
							
							
							
							
							
				<!--		<li class="nav-item <?php if (basename($_SERVER['PHP_SELF'])=='aboutusedit.php') {echo 'current';}?>">	
								 <a href="aboutusedit.php" class="nav-link ">
									 <i class="fa fa-file-text"></i><span class="title"> About Us</span>
								 </a>
						</li>  -->
						
						<!--<li class="nav-item <?php if (basename($_SERVER['PHP_SELF'])=='support.php') {echo 'current';}?>">
							<a href="support.php" class="nav-link nav-toggle">
								<i class="fa fa-question-circle"></i>
								<span class="title">Support-Help</span>
							</a>
						</li>-->
							 
							 
					
							
							<li class="nav-item <?php if ((basename($_SERVER['PHP_SELF'])=='banner.php') || (basename($_SERVER['PHP_SELF'])=='banneradd.php') || (basename($_SERVER['PHP_SELF'])=='banneredit.php')|| (basename($_SERVER['PHP_SELF'])=='bannerdetail.php') ||(basename($_SERVER['PHP_SELF'])=='email.php') || (basename($_SERVER['PHP_SELF'])=='emailadd.php') || (basename($_SERVER['PHP_SELF'])=='emailedit.php') || (basename($_SERVER['PHP_SELF'])=='setting.php') || (basename($_SERVER['PHP_SELF'])=='settingedit.php')||(basename($_SERVER['PHP_SELF'])=='myprofile.php') || (basename($_SERVER['PHP_SELF'])=='emailtemplate.php') || (basename($_SERVER['PHP_SELF'])=='emailtemplateadd.php') || (basename($_SERVER['PHP_SELF'])=='watemplate.php') || (basename($_SERVER['PHP_SELF'])=='watemplateadd.php')) {echo 'active open';}?>">
                          <a href="javascript:;" class="nav-link nav-toggle">
                              <i class="fa fa-wrench"></i>
                              <span class="title">Settings</span>
                              <span class="arrow"></span>
                          </a>
						  <ul class="sub-menu">
							 
							
							<li class="nav-item <?php if ((basename($_SERVER['PHP_SELF'])=='banner.php') || (basename($_SERVER['PHP_SELF'])=='banneradd.php') || (basename($_SERVER['PHP_SELF'])=='banneredit.php')|| (basename($_SERVER['PHP_SELF'])=='bannerdetail.php') || (basename($_SERVER['PHP_SELF'])=='setting.php') || (basename($_SERVER['PHP_SELF'])=='emailtemplate.php') || (basename($_SERVER['PHP_SELF'])=='emailtemplateadd.php') || (basename($_SERVER['PHP_SELF'])=='watemplate.php') || (basename($_SERVER['PHP_SELF'])=='watemplateadd.php') ) {echo 'current';}?>">	
                                
<li class="nav-item <?php if ((basename($_SERVER['PHP_SELF'])=='setting.php') ) {echo 'current';}?>"> 
									  <a href="setting.php" class="nav-link ">
                                         <i class="fa fa-cog"></i> <span class="title">General Setting</span>
                                     </a>
								</li>		
<li class="nav-item start <?php if (basename($_SERVER['PHP_SELF'])=='myprofile.php') {echo 'current';}?>">
                            <a href="myprofile.php" class="nav-link nav-toggle">
                                <i class="fa fa-file"></i>
                                <span class="title">My Profile</span>
																										
                            </a>
						</li>								
								<li class="nav-item <?php if ((basename($_SERVER['PHP_SELF'])=='banner.php') ) {echo 'current';}?>"> 
									 <a href="banner.php" class="nav-link ">
                                         <i class="fa fa-photo"></i> <span class="title">Banner</span>
                                     </a>
									 
								</li>
									 <li class="nav-item  <?php if ((basename($_SERVER['PHP_SELF'])=='emailtemplate.php') || (basename($_SERVER['PHP_SELF'])=='emailtemplateadd.php')) {echo 'current';}?>">
									<a href="emailtemplate.php" class="nav-link ">
										<i class="fa fa-gear"></i><span class="title"> Email Template </span>
									</a>
								</li> 
								<li class="nav-item  <?php if ((basename($_SERVER['PHP_SELF'])=='watemplate.php') || (basename($_SERVER['PHP_SELF'])=='watemplateadd.php')) {echo 'current';}?>">
									<a href="watemplate.php" class="nav-link ">
										<i class="fa fa-gear"></i><span class="title"> Whatsapp Template </span>
									</a>
								</li>
									 
							</li> 
							
							</ul>
							</li>
<?php } ?>
							
							<li class="nav-item start ">
								<a target="_BLANK" href="<?php echo $_SESSION['appicationlink'];?>">
							  <img src="images/download.png" alt="Download APK" width="200" height="100">
								</a>
                           </li>
							
							
                    <!-- END SIDEBAR MENU -->
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
			</div>
			
		