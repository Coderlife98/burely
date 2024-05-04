

        <!-- dr-sidebar-information-area-start -->
        <div class="dr-sidebar-info side-info">
            <div class="dr-sidebar-logo-wrapper mb-25">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-8">
                        <div class="dr-sidebar-logo">
                            <a href="<?php echo base_url()?>site/"><img src="<?php echo base_url()?>media/website/assets/logo_la.png" alt="logo-img"></a>
                        </div>
                    </div>
                    <div class="col-xl-6 col-4">
                        <div class="dr-sidebar-close-wrapper text-end">
                            <button class="dr-sidebar-close side-info-close"><i class="icofont-close-line"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dr-sidebar-menu-wrapper fix">
                <div class="cf-header-menu"></div>
            </div>

            <div class="dr-sidebar-contact-wrapper mt-40">
                <div class="dr-sidebar-contact mb-40">
                    <h4 class="dr-sidebar-contact-title">Contact Info</h4>
                    <span class="sidebar-address"><i class="icofont-google-map"></i><span><?php echo config_item('address');?></span> </span>
                    <a href="tel:<?php echo config_item('mobile_number')?>"><i class="icofont-phone"></i><span><?php echo config_item('mobile_number')?></span></a>
                    <a href="mailto:<?php echo config_item('email')?>" class="theme-3"><i class="icofont-envelope-open"></i><span><span><?php echo config_item('email')?></span></span></a>
                </div>

                <div class="dr-sidebar-social mt-40 mb-30">
                    <a href="<?php echo config_item('facebook')?>" class="facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="<?php echo config_item('twitter')?>" class="twitter"><i class="fab fa-twitter"></i></a>
                    <a href="<?php echo config_item('linkedin')?>" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
                    <a href="<?php echo config_item('youtube')?>" class="youtube"><i class="fab fa-dribbble"></i></a>
                </div>
            </div>
        </div>
        <div class="offcanvas-overlay"></div>
        <!-- dr-sidebar-information-area-end -->

        <!-- =======================body wrapper========= -->
        <div class="body-wrapper">
            <!-- ===================page banner============ -->
            <div class="page-banner" data-background="<?php echo base_url()?>media/website/assets/con_2.png">
                <!-- container  -->
                <div class="container">
                    <!-- row  -->
                    <div class="row">
                        <div class="page-ban-content">
                            <h1 class="page-head set-skull-bg" data-aos="fade-up" data-aos-duration="1000">Contact Us</h1>
                            <div class="breadcrumb-list" data-aos="fade-up" data-aos-duration="1500">
                               <div class="set-skull-bg2">
                               <a href="<?php echo base_url()?>site" class="page-route-link ">Home</a>
                                <span class="devider ">/</span>
                                <span>Contact</span>
                               </div>

                            </div>
                        </div>
                    </div>
                    <!-- row end  -->
                </div>
                <!-- container end -->
            </div>
            <!-- ===================page banner end============ -->
            <!-- ===========contact============ -->
            <div class="contact cpy-6" data-aos="fade-up" data-aos-duration="1000">
                <div class="container">
                    <div class="form-wrapper inner">
                        <div class="row">
                            <div class="col-xl-7">
                                <div class="form-inside">
                                    <div class="form-head" data-aos="fade-up" data-aos-duration="1000">
                                        <div class="section-head text-center">
                                            <span class="sm-title ">Contact Us</span>
                                            <h2 class="sec-title">
                                                Please Get In Touch With Us
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="contact-form pt-15" data-aos="fade-up" data-aos-duration="1500">
                                            <form action="<?php echo base_url()?>site/contact_us" method="post" id="contact-message">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="input-group flex-nowrap mb-30">
                                                            <input type="text" name="name" id="name" class="form-control" placeholder="Your Name *">
                                                            <span class="right-input-icon"><i class="icofont-ui-user"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group flex-nowrap mb-30">
                                                            <input type="email" name="email" id="email" class="form-control" placeholder="Your Email *">
                                                            <span class="right-input-icon"><i class="icofont-email"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group flex-nowrap mb-30">
                                                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Your Phone *">
                                                            <span class="right-input-icon"><i class="icofont-phone"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="input-group flex-nowrap mb-30">
                                                            <input type="text" name="address" id="address" class="form-control" placeholder="Your Location *">
                                                            <span class="right-input-icon"><i class="icofont-location-pin"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <textarea name="message" id="message" class="form-control" placeholder="Comment *" rows="5"></textarea>
                                                    </div>
                                                </div>
                                                <div class="submit-button-sec mt-30">
                                                    <button type="submit" name="submit" onclick="return myvalidate()" class="custom-btn">Send
                                                        Message</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-5 d-flex  justify-content-center align-items-center " data-aos="fade-up" data-aos-duration="1000">
                               <div class="img-contact">
                                <img src="<?php echo base_url()?>media/website/assets/con-2.png" height="450px" alt="">
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           

    </div>
    <!-- ====main wrapper end == -->
<script>
function myvalidate(){
    var name = document.getElementById("name").value;
    var email=document.getElementById("email").value;
    var address =document.getElementById("address").value;
    var message = document.getElementById("message").value;
    var phone =document.getElementById("phone").value;
    var namePattern = /^[A-Za-z\s\-]+$/;
    var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    var phoneRegex = /^\d{10}$/;
    if(!name){
        alert("Enter Name");
        return false;
    }else if(!namePattern.test(name)){
        alert("Enter Valid Name");
        return false;
    }
    else if(!email){
        alert("Please Enter Email");
        return false;
    }else if(!emailRegex.test(email)){
        alert("Please Enter Valid Email");
        return false;
    }else if(!phone){
        alert("Please Enter Phone Number");
        return false;
    }else if(!phoneRegex.test(phone)){
        alert("Please Enter Valid Number");
        return false;
    }else if(!address){
        alert("Enter Address");
        return false;
    }
    else if(!message){
        alert("Please Enter Message");
        return false;
    }
}
</script>
   