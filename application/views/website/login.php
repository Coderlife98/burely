
    <style>
        .errMsg {
            float: right;
            color: #c10000;
            margin-top: -25px;
            display: none;
        }

        .danger {
            border: 1px solid #FFB1B9;
            background-color: rgba(196, 3, 57, 0.1);
            padding: 5px 10px 5px 10px;
            color: #C80013;
            font-size: 12px;
        }

        .success {
            border: 1px solid #b0e6d6;
            background-color: rgba(0, 157, 111, 0.1);
            padding: 5px 10px 5px 10px;
            color: #037554;
            font-size: 12px;
        }

        .warning {
            border: 1px solid #ffd9a6;
            background-color: rgba(191, 144, 1, 0.1);
            padding: 5px 10px 5px 10px;
            color: #995600;
            font-size: 12px;
        }

        .default {
            border: 1px solid #DFDFDF;
            background-color: rgba(189, 189, 189, 0.1);
            padding: 5px 10px 5px 10px;
            color: #7B7B7B;
            font-size: 12px;
        }

        .mi-spin {
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }
    </style>

        <!-- dr-sidebar-information-area-start -->
        <div class="dr-sidebar-info side-info">
            <div class="dr-sidebar-logo-wrapper mb-25">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-8">
                        <div class="dr-sidebar-logo">
                            <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('media/website/assets/logo_la.png'); ?>" alt="logo-img"></a>
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
            <!-- <div class="page-banner su-login" data-background="<?php echo base_url('media/website/assets/login_1.png'); ?>">

                <div class="container">

                    <div class="row">
                        <div class="page-ban-content skull-txt-change">
                          
                            <div class="breadcrumb-list skull-q" data-aos="fade-up" data-aos-duration="1500">
                              

                            </div>
                        </div>
                    </div>

                </div>

            </div> -->
            <!-- ===================page banner end============ -->
            <!-- ===========contact============ -->
            <div class="contact cpy-6" data-aos="fade-up" data-aos-duration="1000">
                <div class="container">
                    <div class="form-wrapper inner">
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="form-inside">
                                    <div class="form-head" data-aos="fade-up" data-aos-duration="1000">
                                        <div class="section-head text-center">
                                            <span class="sm-title ">Login</span>
                                            <h2 class="sec-title">
                                                Login Here
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="contact-form pt-15" data-aos="fade-up" data-aos-duration="1500">
                                            <form action="#" method="post" id="contact-message">
                                                <div id="resultMsg" class="danger" style="display: none;"><i class="fa fa-cog mi-spin"></i> Invalid Login Details!! Please Check Username, Password</div>
                                                <div class="row">
                                                    <div class="col-md-12"> <span class="errMsg" id="errUser">&nbsp;</span>
                                                        <div class="input-group flex-nowrap mb-30">
                                                            <input type="text" class="form-control" placeholder="Your Member id *" name="user_id" id="user_id">
                                                            <span class="right-input-icon"><i class="icofont-ui-user"></i></span>

                                                        </div>

                                                    </div>
                                                    <div class="col-md-12"><span class="errMsg" id="errPass">&nbsp;</span>
                                                        <div class="input-group flex-nowrap mb-30">
                                                            <input type="password" class="form-control" placeholder="Your Member password *" name="password" id="password">
                                                            <span class="right-input-icon"><i class="icofont-gear"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12"><span class="errMsg" id="errMemTyp">&nbsp;</span>
                                                        <div class="input-group flex-nowrap mb-30">
                                                            <select id="memberTyp" class="form-control">
                                                                <option value="">---Select One---</option>
                                                                <option value="3">Member</option>
                                                                <option value="2">Shopee</option>
                                                                <option value="1">Frenchise</option>
                                                            </select>
                                                            <span class="right-input-icon"><i class="icofont-ui-user"></i></span>
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="submit-button-sec">
                                                    <button type="button" class="custom-btn logiN">Login</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 d-flex justify-content-center " data-aos="fade-up" data-aos-duration="1000">
                                <div>
                                <img src="<?php echo base_url('media/website/assets/lo_up.png'); ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
    </div>
    <!-- ====main wrapper end == -->

    <!-- ======script======= -->
    <!-- =====jquery===== -->
    <input type="hidden" id="target" value="<?php echo base_url('site/isCheckLoggedIn'); ?>">
    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
    <?php $this->load->view('website/includes/script'); ?>
   
