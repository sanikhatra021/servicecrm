
<div class="md-col-12">
<footer class="footer-area">
            <div class="footer-top border-bottom-4 pb-55">
                <div class="container">
                    <div class="row">
                       <?php
													$saaddress=$_SESSION['saaddress'];
													$saemailid=$_SESSION['saemailid'];
													$samobile=$_SESSION['samobile'];
													$safullname=$_SESSION['cmpname'];
											?>
                       
                        <div class="col-sm-12 col-12">
                            <div class="footer-widget mb-40 ">
                                <h3 class="footer-title">Contact Us</h3>
								<div class="contact-info-2-content">
                                            <h2><?php echo $safullname; ?> </h2>
                                        </div>
                                <div class="contact-info-2">
                                    <div class="single-contact-info-2">
                                        <div class="contact-info-2-icon">
                                            <i class="icon-call-end"></i>
                                        </div>
										
                                        <div class="contact-info-2-content">
                                            <p>Got a question? Call us 24/7</p>
											
                                            <h3 class="blue"><?php echo $samobile; ?> </h3>
                                        </div>
                                    </div>
                                    <div class="single-contact-info-2">
                                        <div class="contact-info-2-icon">
                                            <i class="icon-cursor icons"></i>
                                        </div>
                                        <div class="contact-info-2-content">
                                            <p><?php echo $saaddress; ?> </p>
                                        </div>
										
										
                                    </div>
                                    <div class="single-contact-info-2">
                                        <div class="contact-info-2-icon">
                                            <i class="icon-envelope-open "></i>
                                        </div>
                                        <div class="contact-info-2-content">
                                            <p><?php echo  $saemailid; ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom pt-30 pb-30 ">
                <div class="container">
                    <div class="row flex-row-reverse">
                        <div class="col-lg-6 col-md-6">
                           
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="copyright copyright-center">
                                <p>Copyright © 2022 <a href="https://arthtechnology.com/">Arth Technology</a> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
		
        