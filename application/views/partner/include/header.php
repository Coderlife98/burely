<?php if($this->session->userdata('partner_photo'))
{	if($this->session->userdata('partner_photo')=='uploads/user/no_img.png')
	{$usrPic=base_url().'uploads/user/no_partner.png';}
		else{$usrPic=base_url().$this->session->userdata('partner_photo');}}
else{$usrPic=base_url().'uploads/user/no_partner.png';}
?>
<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="<?php echo base_url('partner/dashboard');?>" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="<?php echo base_url('media/images/'.config_item('logo_sm')); ?>" alt="logo-sm" width="85%">
                    </span>
                    <span class="logo-lg">
                        <img src="<?php echo base_url() ?>media/images/<?php echo config_item('logo_dark')?>" alt="logo-dark" width="85%">
                    </span>
                </a>

                <a href="<?php echo base_url('partner/dashboard');?>" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="<?php echo base_url() ?>media/images/<?php echo config_item('logo_sm_light')?>" alt="logo-sm-light" width="85%">
                    </span>
                    <span class="logo-lg">
                        <img src="<?php echo base_url() ?>media/images/<?php echo config_item('logo_light')?>" alt="logo-light" width="85%">
                    </span>
                </a>
            </div>

            <!-- Bars -->
            <button type="button" class="btn btn-sm px-3 font-size-16 vertinav-toggle header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <button type="button" class="btn btn-sm px-3 font-size-16 horinav-toggle header-item waves-effect waves-light" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <!-- App Search-->
         <!--   <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="mdi mdi-magnify"></span>
                </div>
            </form>-->
        </div>

        <div class="d-flex" style="padding-top: 20px;">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Toggle Full Screen -->
            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="mdi mdi-fullscreen"></i>
                </button>
            </div>

      
            <!-- User Setting -->
            <div class="dropdown d-inline-block">
                <!-- User Image -->
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" id="mi_pro_img" src="<?php echo $usrPic; ?>" alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1"><?php echo $this->session->userdata('partner_name'); ?></span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <h6 class="dropdown-header">Welcome <?php echo $this->session->userdata('partner_name'); ?>!</h6>
					
	 <a class="dropdown-item" href="<?php echo base_url().'partner/profile'; ?>"><i class="mdi mdi-account-circle text-muted font-size-16 align-middle me-1"></i> <span class="align-middle" key="t-profile">Profile</span></a>				
				
		 <a class="dropdown-item" href="<?php echo base_url().'partner/profile/change_password'; ?>"><i class="bx bx-cog text-muted font-size-16 align-middle me-1"></i> <span class="align-middle" key="t-profile">Change Password</span></a>		
				
                    <a class="dropdown-item" href="<?php echo base_url('partner/login/logout') ?>"><i class="mdi mdi-logout text-muted font-size-16 align-middle me-1"></i> <span class="align-middle" key="t-logout">Logout</span></a>
                </div>
            </div>

            <!-- Setting -->
            <div class="dropdown d-inline-block pt-2" style="padding: 0px 5px 0px 0px;">
                <a href="<?php echo base_url('partner/profile/change_password'); ?>"  class="header-item noti-icon waves-effect mt-2">
                    <i class="bx bx-cog bx-spin"></i>
                </a>
            </div>

        </div>
    </div>
</header>


		