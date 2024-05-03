<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?> | <?php echo config_item('company_name') ?></title>
    <!-- ==============favicon=============== -->
    <?php $this->load->view('website/includes/link'); ?>
</head>

<body>
    <!-- Preloader Start -->
    <div id="preloader">
        <div id="container" class="container-preloader">
            <div class="animation-preloader">
                <div class="spinner"></div>
            </div>
            <div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>
        </div>
    </div>
    <!-- Preloader End -->
    <div>
        <!-- header  -->
        <?php $this->load->view('website/includes/header'); ?>
        <!-- header end  -->


        <!-- #######################################main content start################################## -->


        <?php $this->load->view($layout); ?>

        <!-- ###############################main content end############################################# -->


        <!-- ========================Footer ============= -->
        <?php $this->load->view('website/includes/footer'); ?>
        <!-- ========================Footer end============= -->
    </div>
    <!-- =======================body wrapper end========= -->
    <input type="hidden" id="target" value="<?php echo base_url('site/isCheckLoggedIn'); ?>">
    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">

    </div>
    <!-- ====main wrapper end == -->

    <!-- ======script======= -->
    <!-- =====jquery===== -->

    <?php $this->load->view('website/includes/script'); ?>
    <script src="<?php echo base_url('media/website/js/script1.js'); ?>" type="text/javascript"></script>


    <script>
        $(document).ready(function() {
            $('.errMsg').fadeOut();
            $('.errCls').fadeOut();


            $(".form-control").keyup(function() {
                $('.errMsg').fadeOut();
                $('.errCls').fadeOut();
                var actNbtn = $(this).attr('id');
                if (actNbtn == 'sponsor') {
                    let isCheckUrl = isCheck('base_url') + 'site/isCheckSponsor';
                    $('#existSp').val(isCheck(actNbtn));
                    $.post(isCheckUrl, {
                        id: $('#' + actNbtn).val()
                    }, function(htmlAmi) {
                        if (htmlAmi.result == '1') {
                            $('#existSp').val('1');
                            $('#sponsorNM').val(htmlAmi.name);
                            $('#spCheck').html(htmlAmi.msg).addClass('text-success').removeClass('text-danger').fadeIn('slow');
                        } else {
                            $('#spCheck').html(htmlAmi.msg).removeClass('text-success').addClass('text-danger').fadeIn('slow');

                        }

                    }, 'json');
                }

            });


            $(".form-control").change(function() {
                $('.errMsg').fadeOut();
                $('.errCls').fadeOut();
            });

            $(".empSelectR").unbind("change").change(function() {
                var actNbtn = $(this).attr('id');
                if (actNbtn == 'state') {
                    let isCheckUrl = isCheck('base_url') + 'site/cityList';
                    $('#district').html('<option>Please Wait.....</option>');
                    $('#district').css('color', '#5f7300');
                    $.post(isCheckUrl, {
                        id: $('#' + actNbtn).val()
                    }, function(htmlAmi) {
                        $('#district').html(htmlAmi);
                        $('#district').css('color', '#4d545b');
                    });
                } else if (actNbtn == 'memGender') {
                    let fmPackage = isCheck('fmPackage').split('@@@@');
                    if (isCheck('memGender') != 'Female') {
                        $("#package option[value='" + fmPackage[0] + "']").remove();
                    } else {
                        if ($("#package").find('option[value="' + fmPackage[0] + '"]').length === 0) {
                            $("#package").append('<option value="' + fmPackage[0] + '">' + fmPackage[1] + '</option>');
                        }
                    }
                }
            });

            $(".logiN").click(function() {
                if (!isCheck('user_id')) {
                    $("#user_id").focus();
                    $('#errUser').html('Please input your member id');
                    $('#errUser').fadeIn('fast');
                    return false;
                } else if (!isCheck('password')) {
                    $("#password").focus();
                    $('#errPass').html('Please input your password');
                    $('#errPass').fadeIn('fast');
                    return false;
                } else if (!isCheck('memberTyp')) {
                    $("#memberTyp").focus();
                    $('#errMemTyp').html('Please select your member type');
                    $('#errMemTyp').fadeIn('fast');
                    return false;
                } else {
                    $('.errMsg').fadeOut();
                    $("#resultMsg").fadeIn('slow');
                    $.post(isCheck('target'), {
                        username: isCheck('user_id'),
                        passw: isCheck('password'),
                        memberTyp: isCheck('memberTyp')
                    }, function(htmlAmi) {
                        let myClass = "success warning danger";
                        let restCls = myClass.replace(htmlAmi.adCls, " ");
                        $("#resultMsg").html(htmlAmi.msg).addClass(htmlAmi.adCls).removeClass(restCls);
                        if (htmlAmi.adCls == 'success') {
                            setInterval(function() {
                                window.location = htmlAmi.locate;
                            }, 1000);
                        }
                    }, 'json');

                }



            });

            $(".visiblePass").click(function() {
                $("i", this).toggleClass("fa-eye-slash fa-eye");
                let typ = $('#password').attr('type');
                if (typ == 'password') {
                    $('#password').attr('type', 'text');
                } else {
                    $('#password').attr('type', 'password');
                }
            });







            $(".isRegister").click(function() {
                if (!isCheck('salutation')) {
                    $('#errSalution').fadeIn('fast');
                    return false;
                } else if (!isCheck('name')) {
                    $("#name").focus();
                    $('#err_name').fadeIn('fast');
                    return false;
                } else if (!isCheck('memGender')) {
                    $('#errGender').fadeIn('fast');
                    return false;
                } else if (!isCheck('mobileN')) {
                    $("#mobileN").focus();
                    $('#errMobile').fadeIn('fast');
                    return false;
                } else if (isNaN(isCheck('mobileN'))) {
                    $("#mobileN").focus();
                    $('#errMobile').html('Please input valid mobile number').fadeIn('fast');
                    return false;
                } 
                /*else if(isValidEmail(isCheck('email')) == false){$("#email").focus();$('#errEmail').html('Please input valid email id').fadeIn('fast');return false;}*/
                else if (!isCheck('address')) {
                    $("#address").focus();
                    $('#errAddress').fadeIn('fast');
                    return false;
                } else if (!isCheck('state')) {
                    $("#state").focus();
                    $('#errState').fadeIn('fast');
                    return false;
                } else if (!isCheck('district')) {
                    $("#district").focus();
                    $('#errDistrict').fadeIn('fast');
                    return false;
                } else if (!isCheck('zipcode')) {
                    $("#zipcode").focus();
                    $('#errZipcode').fadeIn('fast');
                    return false;
                } else if (!isCheck('package')) {
                    $("#package").focus();
                    $('#errPackage').fadeIn('fast');
                    return false;
                } else if (!isCheck('sponsor')) {
                    $("#sponsor").focus();
                    $('#errSponsor').fadeIn('fast');
                    return false;
                } else if (isCheck('existSp') != '1') {
                    $("#sponsor").focus().val('');
                    $('#errSponsor').html("Please provide valid sponsor id").fadeIn('fast');
                    return false;
                } else if (!isCheck('regPass')) {
                    $("#regPass").focus();
                    $('#errPassword').fadeIn('fast');
                    return false;
                } else if (!isCheck('cnfPass')) {
                    $("#cnfPass").focus();
                    $('#errCnfPass').fadeIn('fast');
                    return false;
                } else if (isCheck('cnfPass') != isCheck('regPass')) {
                    $("#cnfPass").focus();
                    $('#errCnfPass').html("Password doesn't match confirm password").fadeIn('fast');
                    return false;
                } else { //$('.errCls').fadeOut();$("#load").fadeIn('slow');	$("#load").fadeIn('slow');	
                    let target = isCheck('base_url') + 'site/createNew';
                    $('.errCls').fadeOut();
                    $("#load,#aftrSuccess").show();
                    $.post(target, {
                        salutation: isCheck('salutation'),
                        name: isCheck('name'),
                        memGender: isCheck('memGender'),
                        mobileN: isCheck('mobileN'),
                        email: isCheck('email'),
                        address: isCheck('address'),
                        state: isCheck('state'),
                        district: isCheck('district'),
                        zipcode: isCheck('zipcode'),
                        package: isCheck('package'),
                        sponsor: isCheck('sponsor'),
                        password: isCheck('regPass'),
                        cnfPass: isCheck('cnfPass')
                    }, function(htmlAmi) {
                        if (htmlAmi.result == '1') {
                            $('html,body').animate({
                                scrollTop: $("#UpdNs").offset().top
                            }, 'slow');
                            $('#resultDt,#load,#form').hide();
                            $('#regCmplt').show();
                            $('#registerN').html(htmlAmi.name);
                            $('#registrSpId').html(htmlAmi.sponsor);
                            $('#registrMemId').html(htmlAmi.username);
                        } else {
                            $('#regCmplt,#load').hide();
                            $('#resultDt').html(htmlAmi.msg).show().addClass('dgMsg').removeClass('scMsg');
                        }


                        /*$('#form').fadeOut();*/
                        /*let myClass="success warning danger";let restCls=myClass.replace(htmlAmi.adCls," ");
                        $("#resultMsg").html(htmlAmi.msg).addClass(htmlAmi.adCls).removeClass(restCls);
                        	if(htmlAmi.adCls=='success'){setInterval(function(){window.location=htmlAmi.locate;},1000);}*/
                    }, 'json');

                }



            });
        });
        /*	function isValidEmail(email)
        	{
        		let regex =/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        		if(!regex.test(email)){return false;}else{return true;}
                }	*/
        function isCheck(str) {
            var inputBx = $('#' + str).val();
            if (inputBx == "") {
                return '';
            } else {
                return inputBx;
            }
        }
    </script>


</body>

</html>