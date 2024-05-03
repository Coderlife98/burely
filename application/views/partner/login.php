<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title> <?php echo config_item('company_name') ?> | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo base_url() ?>media/images/mlm-logo-sm.png">
    <link href="<?php echo base_url() ?>media/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() ?>media/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() ?>media/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
<style>.errMsg{ float:right;color: #ac0606;margin-bottom: -10px;} .logiN{ float:right;}
.success{border:1px solid #b0e6d6; background-color:rgba(0, 157, 111, 0.1);padding: 10px;margin-bottom: -30px;color: #037554;font-size: 12px;}
.warning{border:1px solid #ffd9a6; background-color:rgba(191, 144, 1, 0.1);padding: 10px;margin-bottom: -30px;color: #995600;font-size: 12px;}
.danger{border:1px solid #FFB1B9; background-color:rgba(196, 3, 57, 0.1);padding: 10px;margin-bottom: -30px;color: #C80013;font-size: 12px;}
.default{border: 1px solid #DFDFDF;background-color: rgba(189, 189, 189, 0.1);padding: 10px;margin-bottom: -30px;color: #7B7B7B;font-size: 12px;}
#resultMsg{display:none;}
</style>
</head>
<body>
    <div class="account-pages">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="text-center mb-4">
						<p class="font-size-15 text-muted mt-2">Sign in to <b>start</b> your session</p>
                    </div>
                    <div class="card overflow-hidden">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="p-lg-5 p-4 bg-auth h-100 d-none d-lg-block">
                                    <div class="mi-overlay"></div>
                                </div>
                            </div>
							<div class="col-lg-6">
                                <div class="p-lg-5 p-4">

                                    <div>
                                        <h5>Welcome Back !</h5>
                                    </div>
									
									<div id="resultMsg" class="success">
									   <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
										Invalid Login Details!! Please Check Username, Password
                                    </div>
						<div class="mt-4 pt-3">
				
								<div class="mb-3">
									<label for="username" class="fw-semibold">Username</label><span class="errMsg" id="errUser">&nbsp;</span>
									<input type="email" class="form-control" name="email_id" id="email_id" placeholder="Enter Your Username">                                
									</div>
									<input type="hidden" id="target" value="<?php echo $target;?>">   
								<div class="mb-3 mb-4">
									<label for="userpassword" class="fw-semibold">Password</label><span class="errMsg" id="errPass">&nbsp;</span>
									<input type="password" class="form-control" name="password" id="password" placeholder="Enter Your Password">
								</div>
							  <div class="row align-items-center">
									<div class="col-6">
										<div class="text-end">
											<a href="auth-recoverpw.html" class="text-muted"><i class="mdi mdi-lock me-1"></i> Forgot your password?</a>
										</div>
									</div>
									<div class="col-6">
										<button class="btn btn-primary w-md waves-effect waves-light logiN" type="button">Sign In <i class="fas fa-sign-in-alt"></i></button>
									</div>
								</div>
						</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 text-center">
                        <p>© <?php echo date('Y') ?> <b><?php echo config_item('company_name') ?></b>. Crafted with <i class="mdi mdi-heart text-danger"></i> by @mit Kumar
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url() ?>media/libs/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>media/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url() ?>media/libs/metismenu/metisMenu.min.js"></script>
    <script src="<?php echo base_url() ?>media/libs/simplebar/simplebar.min.js"></script>
    <script src="<?php echo base_url() ?>media/libs/node-waves/waves.min.js"></script>
    <script src="<?php echo base_url() ?>media/js/app.js"></script>
<script>
function isCheck(str){var inputBx=$('#'+str).val();if(inputBx==""){return '';}else{return inputBx;}}function flash_msg_class(id,msg,adCls)
{let myClass="warning success danger";let restCls=myClass.replace(adCls," ");$(id).html(msg).fadeIn('slow').addClass(adCls).removeClass(restCls);}
$(document).ready(function()
{
	$(".form-control").keyup(function()
	{
		$('.errMsg').fadeOut();	
	});
	
	$(".logiN").click(function()
	{
		if(!isCheck('email_id')){$("#email_id").focus();$('#errUser').html('Please input username');$('#errUser').fadeIn('fast');return false;}
	    else if(!isCheck('password')){$("#password").focus();$('#errPass').html('Please input Password');$('#errPass').fadeIn('fast');return false;}
		else
		{$('.errMsg').fadeOut();$("#resultMsg").fadeIn('slow');		
			$.post(isCheck('target'),{username:isCheck('email_id'),passw:isCheck('password')},function(html){
			$("#resultMsg").html(isCheck('target'));
				if(html.actn=='1'){setInterval(function(){window.location=html.locate;},1000);}
					flash_msg_class("#resultMsg",html.msg,html.adCls);
					},'json');
			
			}
		
		
		
		});
	
	
});
</script>
</body>

</html>