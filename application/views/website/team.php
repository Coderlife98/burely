<!-- dr-sidebar-information-area-start -->
<style>
    .hero {
        background-color: #ff676d;
        height: 100vh;
        width: 100%;
        position: relative;
    }

    .slide-row {
        display: flex;
        width: 3200px;
    }

    .slide-col {
        width: 800px;
        height: 400px;
        position: relative;

    }

    .user-img {
        position: absolute;
        top: 0%;
        right: 0%;
        height: 100%;
    }

    .user-img img {
        height: 100%;
        border-radius: 10px;
    }

    .user-text {
        background-color: #243a59;
        /* width: 520px;
        height: 270px; */
        width: 335px;
    height: 205px;
        position: absolute;
        left: 0%;
        top: 50%;
        transform: translateY(-50%);
        border-radius: 10px;
        color: #d3d4d6;
        padding: 45px;
        box-sizing: border-box;
        z-index: 2;
    }

    .user-text p {
        font-size: 18px;
        line-height: 24px;
    }

    .container-set {
        width: 800px;
        height: 400px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .indicator {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        bottom: -50px;
    }

    .btn-rad {
        display: inline-block;
        height: 15px;
        width: 15px;
        margin: 4px;
        border-radius: 15px;
        background-color: white;
        transition: 0.5s;
        cursor: pointer;
    }

    .active {
        width: 45px;
    }

    .testimonials {
        width: 100%;
        height: 100%;
        overflow: hidden;
    }
</style>

<div class="dr-sidebar-info side-info">
    <div class="dr-sidebar-logo-wrapper mb-25">
        <div class="row align-items-center">
            <div class="col-xl-6 col-8">
                <div class="dr-sidebar-logo">
                    <a href="<?php echo base_url() ?>site/"><img
                            src="<?php echo base_url() ?>media/website/assets/logo_la.png" alt="logo-img"></a>
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
            <span class="sidebar-address"><i
                    class="icofont-google-map"></i><span><?php echo config_item('address'); ?></span> </span>
            <a href="tel:<?php echo config_item('mobile_number') ?>"><i
                    class="icofont-phone"></i><span><?php echo config_item('mobile_number') ?></span></a>
            <a href="mailto:<?php echo config_item('email') ?>" class="theme-3"><i
                    class="icofont-envelope-open"></i><span><span><?php echo config_item('email') ?></span></span></a>
        </div>

        <div class="dr-sidebar-social mt-40 mb-30">
            <a href="<?php echo config_item('facebook') ?>" class="facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="<?php echo config_item('twitter') ?>" class="twitter"><i class="fab fa-twitter"></i></a>
            <a href="<?php echo config_item('linkedin') ?>" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
            <a href="<?php echo config_item('youtube') ?>" class="youtube"><i class="fab fa-dribbble"></i></a>
        </div>
    </div>
</div>
<div class="offcanvas-overlay"></div>
<!-- dr-sidebar-information-area-end -->


<!-- =======================body wrapper========= -->
<div class="body-wrapper">
    <!-- ===================page banner============ -->
    <div class="page-banner" data-background="<?php echo base_url() ?>media/website/assets/team_1.png">
        <!-- container  -->
        <div class="container">
            <!-- row  -->
            <div class="row">
                <div class="page-ban-content">
                    <h1 class="page-head" data-aos="fade-up" data-aos-duration="1000">Our Team</h1>
                    <div class="breadcrumb-list" data-aos="fade-up" data-aos-duration="1500">
                        <a href="<?php echo base_url() ?>site" class="page-route-link">Home</a>
                        <span class="devider">/</span>
                        <span>Team</span>

                    </div>
                </div>
            </div>
            <!-- row end  -->
        </div>
        <!-- container end -->
    </div>
    <!-- ===================page banner end============ -->
    <!-- =========About====== -->
    <section>
        <div class="about about-1 cpy-8">
            <!-- container  -->
            <div class="container">
                <!-- row  -->
                <div class="row">
                    <div class="col-lg-6 col-md-6 mb-4 d-flex justify-content-center " data-aos="fade-right" data-aos-duration="1000">
                        <div class="about-img">
                            <img src="<?php echo base_url() ?>media/website/assets/team.png" class="set-team-op" alt="">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 mb-4" data-aos="fade-left" data-aos-duration="1000">
                        <div class="h-100 d-flex align-items-center pl-40">
                            <div class="about-details">
                                <span class="sm-title text-success">Team</span>
                                <h2 class="about-title">Our Team</h2>
                                <p class="about-des mb-4">
                                    Meet our passionate team at <b>WORLY DIGITAL MARKETING PRIVATE LIMITED</b>. Led by
                                    RAJESH KUMAR NIRALA and tea master,
                                    we're dedicated to bringing you the finest tea experiences. Our team includes expert
                                    tea specialists who source and blend the finest tea leaves from around the world,
                                    ensuring every sip is perfection. With a focus on customer satisfaction, our
                                    customer experience manager guides you through your tea journey with personalized
                                    recommendations and exceptional service. Behind the scenes, our operations
                                    coordinator keeps everything running smoothly, while our marketing coordinator
                                    spreads the word about our delicious teas through engaging campaigns and captivating
                                    content.
                                </p>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- row end  -->
            </div>
            <!-- container end  -->
        </div>
    </section>
    <!-- =========About end====== -->
   
  <!-- testimonial section start -->
  <section>
                <!-- customer  -->
                <div class="customer customer-1 cpy-8">
                    <!-- container  -->
                    <div class="container">
                        <!-- section head  -->
                        <div class="section-head text-center " data-aos="fade-up" data-aos-duration="1000">
                            <span class="sm-title ">Our Teams</span>
                            <h2 class="sec-title">
                                <!-- Our Guestbook -->
                            </h2>
                        </div>
                        <!-- section head end  -->
                        <div class="d-flex justify-content-center">
                            <div class="col-12 col-sm-12 col-md-10" data-aos="fade-up" data-aos-duration="1500">
                                <div class="swiper customer-review">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide review-item">
                                            <div class="row">
                                                
                                                <div class="col-md-12 my-2">
                                                    <div class="customer-img" style="width:400px">
                                                        <img src="<?php echo base_url()?>media/website/assets/av1.png" width="200px" alt="Image Not found">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="swiper-slide review-item">
                                            <div class="row">
                                                
                                                <div class="col-md-12 my-2">
                                                    <div class="customer-img" style="width:400px">
                                                        <img src="<?php echo base_url()?>media/website/assets/av2.png" width="200px" alt="Image Not found">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="swiper-slide review-item">
                                            <div class="row">
                                            
                                                <div class="col-md-12 my-2">
                                                    <div class="customer-img" style="width:400px">
                                                        <img src="<?php echo base_url()?>media/website/assets/av3.png" width="200px" alt="Image Not found">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="review-pagination"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- container end  -->
                </div>
                <!-- custome end  -->
            </section>
    <!-- testimonial section end -->
    