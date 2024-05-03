
    <style>
        .set-bg-thanku{
            background-image: url("<?php echo base_url()?>media/website/assets/th_bg.png");
            background-size: cover;
            height: 450px;
        }
        @media (min-width:0px) and (max-width:576px){
           .set-bg-thanku{
            background-image: url("<?php echo base_url()?>media/website/assets/sm_bg.png");
            background-size: cover;
            height: 450px;
           }
        }
        @media (min-width:576px) and (max-width:768px){
           .set-bg-thanku{
            background-image: url("<?php echo base_url()?>media/website/assets/ch_sm.png");
            background-size: cover;
            height: 450px;
           }
        }
        .para-thanku{
            margin-top: 85px;
        }
    </style>



        <!-- dr-sidebar-information-area-start -->
        <div class="dr-sidebar-info side-info">
            <div class="dr-sidebar-logo-wrapper mb-25">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-8">
                        <div class="dr-sidebar-logo">
                            <a href="<?php echo base_url()?>site/"><img src="<?php echo base_url()?>media/website/assets/logo.png" alt="logo-img"></a>
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
        <!--Form Back Drop-->
        <div class="container-fluid set-bg-thanku">
            <div class="row">
                <div class="col-12 d-flex justify-content-center flex-column align-items-center ">
                    <div class="my-3">
                        <!-- <img src="<?php echo base_url()?>media/website/assets/cha.png" alt="message_icon"> -->
                    </div>
                  
                    <div class="para-thanku">
                    <div>
                        <!-- <h1 class="text-white text-center">THANK YOU</h1> -->
                    </div>
                        <!-- <p class="text-white text-sm-center py-3">Your Message has been sent.We'll be in touch shortly to
                            answer all your question!!</p> -->
                    </div>

                </div>
            </div>
        </div>
        <div class="form-back-drop"></div>


        <div class="container my-4">
            <div class="row">
                <div class="col-12 col-md-6 my-4 d-flex justify-content-center ">
                    <img src="<?php echo base_url()?>media/website/assets/th.jpg" height="350px" alt="left-side">
                </div>
                <div class="col-12 col-md-6 my-4 d-flex justify-content-center  align-items-center">
                    <div style="margin: 10px 20px;">

                        <?php echo $response; ?>
                    </div>
                </div>
            </div>
        </div>


