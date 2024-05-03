<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>
        <?php echo config_item('company_name') ?> | Login
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo base_url() ?>media/images/mlm-logo-sm.png">

    <!-- Bootstrap Css -->
    <link href="<?php echo base_url() ?>media/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />

    <!-- Icons Css -->
    <link href="<?php echo base_url() ?>media/css/icons.min.css" rel="stylesheet" type="text/css" />

    <!-- App Css-->
    <link href="<?php echo base_url() ?>media/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
<style>
.errMsg{ float:right;color: #ac0606;margin-bottom: -10px;}
.padd{margin:0px 0px 0px 15px;}
 .visiblePass{float: right;color: #b3b2b2;margin-top: -30px;margin-right: 10px;z-index: 5;position: relative;cursor: pointer;}  	
</style>


</head>

<body>

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->
    <div class="account-pages">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="text-center mb-4">
                       <!-- <a href="<?php echo base_url() ?>" class="auth-logo">
                            <img src="<?php echo base_url() ?>media/images/logo-dark.png" alt="Logo Dark" width="20%" class="auth-logo-dark">
                            <img src="<?php echo base_url() ?>media/images/logo-light.png" alt="Logo Light" width="20%" class="auth-logo-light">
                        </a>-->
                        <p class="font-size-15 text-muted mt-2">Sign in to <b>start</b> your session</p>
                    </div>
                    <div class="card overflow-hidden">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="p-lg-5 p-4">

                                    <div>
                                        <h5>Welcome Back !</h5>
                                    </div>
                                    <?php
                                    if ($_REQUEST['msg'] == 'invalid') {
                                        echo '<div class="alert alert-danger" style="font-size:11.7px;">
                                               <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
											    Invalid Login Details!! Please Check Username, Password
                                            </div>';
                                    }
									else if ($_REQUEST['msg'] == 'impassable') {
                                        echo '<div class="alert alert-warning" style="font-size:11.7px;">
                                               <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
											   Contact to super admin it seems account is blocked
                                            </div>';
                                    }
									
									
									elseif($this->uri->segment(2) == 'logout'){
                                        echo '<div class="alert alert-success">
                                                😎 Log Out Successfully ! 😎.
                                            </div>';
                                    }
                                    ?>
                                    <div class="mt-4 pt-3">
                                        <form action="<?php echo base_url() ?>login/auth" method="POST">

                                            <div class="mb-3">
                                                <label for="username" class="fw-semibold">Username</label>
												<span class="errMsg"><?php echo form_error('email_id') ?> </span>
                                                <input type="email" class="form-control" name="email_id" value="<?php echo set_value('email_id') ?>" placeholder="Enter Your Username">
                                            </div>
                                            

                                            <div class="mb-3 mb-4">
                                                <label for="userpassword" class="fw-semibold">Password</label>
												  <span class="errMsg"><?php echo form_error('password') ?> </span>
                                                <input type="password" class="form-control" name="password"  id="password"  value="<?php echo set_value('password') ?>" placeholder="Enter Your Password">
                                            <div class="visiblePass"> <i aria-hidden="true" class="fa fa-eye-slash"></i></div> </div>
                                          

                                            <div class="row align-items-center">
                                                <div class="col-6">
                                                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Sign In <i class="fas fa-sign-in-alt"></i></button>
                                                </div>
                                                <div class="col-6">
                                                    <div class="text-end">
                                                        <a href="auth-recoverpw.html" class="text-muted"><i class="mdi mdi-lock me-1"></i> Forgot your password?</a>
                                                    </div>
                                                </div>
												
											<!--<div class="row mt-4">	
												<div class="col-6">
                                                    <a href="<?php //echo base_url('member/login');?>" class="text-muted"><i class="bx bx-user-pin"></i> Member Login</a>
                                                </div>	
												<div class="col-6">
                                                    <span class="padd">
														<a href="<?php //echo base_url('partner/login');?>" class="text-muted"><i class="bx bx-user-pin"></i> Partner Login</a>
													</span>
                                                </div>
											</div>-->	
												
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="p-lg-5 p-4 bg-auth h-100 d-none d-lg-block">
                                    <div class="bg-overlay"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- end card -->
                    <div class="mt-4 text-center">
                        <p>© <?php echo date('Y') ?> <b><?php echo config_item('company_name') ?></b>. Crafted with <i class="mdi mdi-heart text-danger"></i> by @ Camwel Solution Pvt. Ltd.
                        </p>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end account page -->


    <!-- JAVASCRIPT -->
    <script src="<?php echo base_url() ?>media/libs/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>media/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url() ?>media/libs/metismenu/metisMenu.min.js"></script>
    <script src="<?php echo base_url() ?>media/libs/simplebar/simplebar.min.js"></script>
    <script src="<?php echo base_url() ?>media/libs/node-waves/waves.min.js"></script>

    <script src="<?php echo base_url() ?>media/js/app.js"></script>
<script>
$(function()
{
	 $(document).on('keyup','.form-control',function(e)
	 {
	 	   $('.errMsg').fadeOut();	 
			
			});
	 
});

$(document).ready(function()
{
	$(".visiblePass").click(function(){$("i", this).toggleClass("fa-eye-slash fa-eye");let typ=$('#password').attr('type');if(typ=='password'){$('#password').attr('type','text');}else{$('#password').attr('type','password');}});

});


</script>
</body>

</html>