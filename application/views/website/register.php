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
            <span class="sidebar-address"><i class="icofont-google-map"></i><span><?php echo config_item('address'); ?> </span> </span>
            <a href="tel:<?php echo config_item('mobile_number') ?>"><i class="icofont-phone"></i><span>+<?php echo config_item('mobile_number') ?></span></a>
            <a href="mailto:<?php echo config_item('email') ?>" class="theme-3"><i class="icofont-envelope-open"></i><span><span><?php echo config_item('email') ?></span></span></a>
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
    <div class="page-banner su-login" data-background="<?php echo base_url('media/website/assets/reg.png'); ?>">
        <!-- container  -->
        <div class="container">
            <!-- row  -->
            <div class="row">
                <div class="page-ban-content">
                    <h1 class="page-head text-danger" data-aos="fade-up" data-aos-duration="1000">Register Here</h1>
                    <div class="breadcrumb-list" data-aos="fade-up" data-aos-duration="1500">
                        <a href="<?php echo base_url() ?>site/" class="page-route-link">Home</a>
                        <span class="devider">/</span>
                        <span>Register</span>

                    </div>
                </div>
            </div>
            <!-- row end  -->
        </div>
        <!-- container end -->
    </div>
    <!-- ===================page banner end============ -->
    <!-- ===========contact============ -->
    <style>
        .container1 {
            background-color: #bbdfd582;

        }

        .tHeading {
            background: #000;
            padding: 10px;
            text-align: center;
            margin: 10px 0px;

        }

        .heading {
            background: red;
            padding: 10px 20px;
            color: white;
            margin: 20px;
            width: 300px;
            border-top-right-radius: 50%;
            border-bottom-right-radius: 50%;

        }

        .regBtn {
            float: right;
            margin-right: -15px;
        }

        .btnchi {
            background-color: #ff4c08;
            color: #FFFFFF;
            border-radius: 0px;
            padding: 6px 15px 6px 15px;
        }
    </style>

    <!-- Start Page Title Area 626571 -->
    <div class="container container1">
        <div class="tHeading" id="UpdNs"><i class="fa fa-user-plus" aria-hidden="true"></i> Register Now </div>
        <input type="hidden" id="fmPackage" value="<?php if ($fmPack) {
                                                        echo $fmPack->pack_price . '@@@@' . $fmPack->pack_name;
                                                    } ?>">
        <div class="user-form-content register-width">
            <!-- <h3 class="text-center">Create an account</h3>	-->
            <div class="loginBox" style="border:1px solid #eee;padding: 0px 15px 20px 15px;margin-bottom: 50px;">

                <?php //print_r(substr("MSD54338",3));
                ?>


                <div class="row" id="form">
                    <div>
                        <div class="heading"><i class="fa fa-user fusr"></i> Personal Details</div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Title. <span class="text-danger">*</span></label>
                            <select id="salutation" class="form-control">
                                <option value="">---Select One---</option>
                                <option value="Mr.">Mr.</option>
                                <option value="Mrs.">Mrs.</option>
                                <option value="Miss">Miss</option>
                                <option value="M/S">M/S</option>
                            </select>
                            <span id="errSalution" class="text-danger errCls" style="padding-right:20px;"> Please select salutation</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                            <span id="err_name" class="text-danger errCls"> Please input member name</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Gender <span class="text-danger">*</span></label>
                            <select id="memGender" class="form-control empSelectR">
                                <option value="">---Select One---</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Transgender">Transgender</option>
                            </select>
                            <span id="errGender" class="text-danger errCls" style="padding-right:20px;"> Please select gender</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Mobile Number <span class="text-danger">*</span></label>
                            <input type="text" id="mobileN" class="form-control" maxlength="10" placeholder="Enter Mobile Number">
                            <span id="errMobile" class="text-danger errCls"> Please input mobile number</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email </label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Id">
                            <span id="errEmail" class="text-danger errCls"> Please input member email id</span>
                        </div>
                    </div>
                    <div class="col-md-12  dvhed">
                        <div class="heading"><i class="fa fa-user fusr"></i> Communication Details</div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Address <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="address" name="address" rows="4" cols="50"></textarea>
                            <span id="errAddress" class="text-danger errCls"> Please input address details</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>State <span class="text-danger">*</span></label>
                            <select id="state" class="form-control empSelectR">
                                <option value="">---Select One---</option>
                                <?php if ($getState) {
                                    foreach ($getState as $stt) {    ?>
                                        <option value="<?php echo $stt->id; ?>"><?php echo $stt->state_cities; ?></option>
                                <?php }
                                } ?>
                            </select>



                            <span id="errState" class="text-danger errCls" style="padding-right:20px;"> Please select state</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>District <span class="text-danger">*</span></label>
                            <select id="district" class="form-control">
                                <option value="">---Select One---</option>
                            </select>
                            <span id="errDistrict" class="text-danger errCls" style="padding-right:20px;"> Please select district</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Zipcode <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Enter zipcode">
                            <span id="errZipcode" class="text-danger errCls" style="padding-right:20px;"> Please input zipcode</span>
                        </div>
                    </div>
                    <div class="col-md-12  dvhed">
                        <div class="heading"><i class="fa fa-user fusr"></i> Referral Details</div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Package <span class="text-danger">*</span></label>
                            <select id="package" class="form-control">
                                <option value="">---Select One---</option>
                                <?php if ($package) {
                                    foreach ($package as $pack) {    ?>
                                        <option value="<?php echo $pack['pack_price']; ?>"><?php echo $pack['pack_name'].'&nbsp;Price&nbsp;₹'.$pack['pack_price']; ?></option>
                                <?php }
                                } ?>
                            </select>

                            <?php //print_r($package);
                            ?>
                            <span id="errPackage" class="text-danger errCls" style="padding-right:20px;"> Please select package details</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="sponsor" class="control-label">Referral ID<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="sponsor" name="sponsor" placeholder="Enter Referral ID">

                            <input type="hidden" id="existSp">
                            <span id="errSponsor" class="text-danger errCls"> Please input referral id</span>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="sponsor" class="control-label">Sponsor Name</label>
                            <input type="text" class="form-control" id="sponsorNM" disabled="disabled" name="sponsorNM" placeholder="Sponsor name">
                            <span id="spCheck" class="text-danger miCls">Available</span>
                        </div>
                    </div>
                    <div class="col-md-12  dvhed">
                        <div class="heading"><i class="fa fa-user fusr"></i> Security Details</div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="regPass" name="regPass" placeholder="Enter Password">
                            <span id="errPassword" class="text-danger errCls">Please input password</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Retype Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="cnfPass" name="cnfPass" placeholder="Enter Retype Password">
                            <span id="errCnfPass" class="text-danger errCls">Please input confirm password</span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <p class="create logDD" style="margin-left: -15px;">Already have an account? <a data-toggle="modal" data-target="#loginModal">Log in</a></p>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btnchi btn-sm regBtn isRegister" type="button"><i class="fa fa-solid fa-plus"></i> Register</button>
                        </div>
                    </div>
                </div>
                <div id="load" style="display:none;" align="center">
                    <i class="fa fa-cog bx-spin" aria-hidden="true"></i>
                    <div>Registering...</div>
                </div>
                <div id="aftrSuccess" style="display:none;">
                    <div id="resultDt" style="margin-top: 30px;"></div>
                    <div id="regCmplt" style="display:none;">
                        <h1 class="text-center">Registration is Completed !</h1>
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-10">
                                <p class="lead">Dear <span id="registerN">Amit Kumar</span>,<br />
                                    congratulation on your first step towards a rewarding career. We <?php echo config_item('company_name') ?> team
                                    cordially invite you to our home, where we make friends to earn and learn together. Below is your detail of
                                    Registration.</p>
                                <div class="mb-5">
                                    <strong>Sponsor ID :</strong> <span id="registrSpId">79263</span><br />
                                    <strong>Membership ID :</strong> <span id="registrMemId">44142</span><br />
                                    <strong>Password :</strong> (<em>You have entered already.</em>)
                                </div>
                                <br>
                                <a href="<?php echo site_url('site/register') ?>" class="btn btnchi btn-sm regBtn" id="submit-footer">
                                    <i class="fa fa-solid fa-plus"></i> Register Another
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- End Book Area -->