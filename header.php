<?php
    $username11=$_SESSION['cmpname'];
		$saaddress=$_SESSION['saaddress'];
		$saemailid=$_SESSION['saemailid'];
		$samobile=$_SESSION['samobile'];
		  $salogo=$_SESSION['salogo'];
		 
		if(strlen($salogo)>3)
		{
			$salogo1="<img src='./businesspanel/images/$salogo'' width='70px' height='70px'>";
		}
		else
		{
			$salogo1="<img src='images/noimage.jpg' width='70px' height='70px'>";
		}

	
?>
<header class="header-area">
            <div class="header-large-device">
          
                <div class="header-middle header-middle-padding-2 bg-gray">
                    <div class="container">
                        <div class="row align-items-center">
						<div class="col-xl-2 col-lg-2">
                                <div class="logo">
                                    <!--<a href="<?php echo $url; ?>"><img src="assets/images/logo/logo.png" alt="logo"></a>-->
									
                                    <?php echo $salogo1; ?>
                                </div>
                            </div>
                            <div class="col-xl-5">
                                <div class="main-menu main-menu-blue main-menu-padding-1 main-menu-font-size-14 main-menu-lh-5">
                                    <nav>
                                        <ul>
                                            <li><a href="<?php echo $url; ?>">HOME </a></li>
                                            <li><a href="<?php echo $_SESSION['weburl'];?>#product">PRODUCT</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="header-action header-action-flex pr-20">
                                    <div class="same-style-2 same-style-2-blue same-style-2-font-dec">
										<?php if(!isset($_SESSION['sminderweb'])){?>
                                        <a href="singup.php"><i class="icon-user"></i>  Login </a>
										<?php }else{?>
                                        <a href="myaccount.php"><i class="icon-lock"></i>  My Account</a>
										<?php }?>
                                    </div>
                                </div>
                            </div>
							  <div class="col-xl-2 col-lg-2">
                                <div class="hotline-2-wrap">
                                    <div class="hotline-2-icon">
                                        <i class="blue icon-call-end"></i>
                                    </div>
                                    <div class="hotline-2-content same-style-2-white">
                                        <span>Customer Care Number</span>
										<h5><?php echo $samobile; ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-small-device small-device-ptb-1">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <div class="mobile-logo">
                                 <a href="<?php echo $url; ?>"><?php echo $_SESSION['cmpname']; ?></a>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="header-action header-action-flex">
                                <div class="same-style-2 same-style-2-font-inc">
                                    <?php if(!isset($_SESSION['sminderweb'])){?>
                                        <a href="singup.php"><i class="icon-user"></i>  Sing Up </a>
										<?php }else{?>
                                        <a href="myaccount.php"><i class="icon-lock"></i>  My Account</a>
										<?php }?>
                                </div>
                                
                                <div class="same-style-2 main-menu-icon">
                                    <a class="mobile-header-button-active" href=""><i class="icon-menu"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- mobile header start -->
        <div class="mobile-header-active mobile-header-wrapper-style" >
            <div class="clickalbe-sidebar-wrap">
                <a class="sidebar-close"><i class="icon_close"></i></a>
                <div class="mobile-header-content-area" >
                  
                    <div class="mobile-search mobile-header-padding-border-1">
                        <form class="search-form" action="#">
                            <input type="text" placeholder="Search here…">
                            <button class="button-search"><i class="icon-magnifier"></i></button>
                        </form>
                    </div>
                    <div class="mobile-menu-wrap mobile-header-padding-border-2" >
                        <!-- mobile menu start -->
                        <nav>
                            <ul class="mobile-menu">
                               
                               <li><a href="<?php echo $url; ?>">HOME </a></li>
											<li><a href="<?php echo $_SESSION['weburl'];?>#about">ABOUT US</a></li>
                                            <li><a href="<?php echo $_SESSION['weburl'];?>#product">PRODUCT</a></li>
                                           <li><a href="contact.php">CONTACT </a></li>
                              
                               
                            </ul>
                        </nav>
                        <!-- mobile menu end -->
                    </div>
                   
                   
                    <div class="mobile-contact-info mobile-header-padding-border-4">
                        <ul>
                            <li><i class="icon-phone "></i> <?php echo $samobile; ?></li>
                            <li><i class="icon-envelope-open "></i><?php echo $saemailid; ?></li>
                            <li><i class="icon-home"></i> <?php echo $saaddress; ?></li>
                        </ul>
                    </div>
                   
                </div>
            </div>
        </div>
        <!-- mini cart start -->
       
        