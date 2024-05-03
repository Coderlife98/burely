var reportPinTable = '';
var reportTnxTable = '';
var reportIncTable = '';
var reportPyReqTable = '';
var reportPyHoldTable = '';
var repMemWallet = '';
var repMemRewards = '';
var repEmpSal = '';
var repEmpSalDetails = '';
$(document).ready(function () {
    $("#member_table").on("click", ".getAction", function () {
        var actNbtn = $(this).attr('data-id');
        var actnstr = actNbtn.split('-');
	
        var getResource = $('#base_url').val();
        var actnUrl = '';
        // $('#defaultMsg').fadeIn();$('#defaultMsg').html(actnUrl);
        if (actnstr[0] == 'del') {
            actnUrl = getResource + actnstr[1] + 'delete';
			
        }
        $.post(actnUrl, {
            id: actnstr[2]
        }, function (html) {
            myObj = JSON.parse(html);
            $(".actnData").html(myObj.actn_dt);
            $(".delMsg").html(myObj.actn_msg);
            $("#mdlFtrBtn").html(myObj.cnfActnBtn);
            // $(".actnData").css('height','80px');
        });
    });
});
$('#save_data').submit(function (e) {
    e.preventDefault();
    var getResource = $('#base_url').val();
    $.ajax({
        url: getResource + 'mlm_software/admin/employee/save_data',
        type: "POST",
        data: $(this).serialize(),
        dataType: 'json',
        success: function (data) {
            popup(data);
        }
    });
});
$('#emp_profile_data').submit(function (e) {
    e.preventDefault();
    var getResource = $('#base_url').val();
    $.ajax({
        url: getResource + 'mlm_software/admin/employee/update',
        type: "POST",
        data: $(this).serialize(),
        dataType: 'json',
        success: function (data) {
            // console.log(data);
            if (data.icon == "error") {
                var valid = '';
                $.each(data.text, function (i, item) {
                    valid += item;
                });
                Swal.fire({
                    position: "top-end",
                    icon: data.icon,
                    html: valid,
                    showConfirmButton: !1,
                    timer: 1500
                });
            } else {
                Swal.fire({
                    position: "top-end",
                    icon: data.icon,
                    title: data.text,
                    showConfirmButton: !1,
                    timer: 1500
                });
                setTimeout(function () {
                    window.location.reload(1);
                }, 1500);
            }
        }
    });
});
// Employee List
$(document).ready(function () {
    let searchObj = {};
    var base_url = $('#base_url').val();
    var miId = $('#miId').val();
    let reportTable = {
        printTable: function (search_data) {
            getpaginate(search_data, '#member_table', 'mlm_software/admin/employee/veiw_all', 'Only For Id, Name & Mobile Number.');
        }
    }
    reportIncTable = {
        printTable: function (search_data) {
            getpaginate(search_data, '#view_earning', 'mlm_software/admin/income/earning_data', 'Only For Sponser Id');
        }
    }
    reportPyReqTable = {
        printTable: function (search_data) {
            getpaginate(search_data, '#make_pyRequest', 'mlm_software/admin/income/payment/2', 'Member Id,Amount');
        }
    }
    reportPyHoldTable = {
        printTable: function (search_data) {
            getpaginate(search_data, '#hold_pyRequest', 'mlm_software/admin/income/payment/3', 'Name To ID');
        }
    }
    reportPinTable = {
        printTable: function (search_data) {
            getpaginate(search_data, '#epin_table', 'mlm_software/admin/pin/data_list', 'Only For Member Id');
        }
    }
    repMemWallet = {
        printTable: function (search_data) {
            getpaginate(search_data, '#member_wallet', 'mlm_software/admin/ewallet/mem_ewallet', 'Only For Member Id');
        }
    }
    reportTnxTable = {
        printTable: function (search_data) {
            getpaginate(search_data, '#wall_tnx', 'mlm_software/admin/ewallet/tnx_data', 'Member Id, Amount.');
        }
    }
    repMemWallTnx = {
        printTable: function (search_data) {
            getpaginate(search_data, '#_wallet_tnx', 'mlm_software/admin/ewallet/mem_wallet_tnx/' + miId, 'Only For Tnx.Id');
        }
    }
    repMemRewards = {
        printTable: function (search_data) {
            getpaginate(search_data, '#temp_reward_table', 'mlm_software/admin/rewards/r_data', 'Only For User Id');
        }
    }

    repEmpSal = {
        printTable: function (search_data) {
            getpaginate(search_data, '#emp_salary', 'mlm_software/admin/salary/r_data', 'Only For Emp Id,Name');
        }
    }
    repEmpSal.printTable(searchObj);

    repEmpSalDetails = {
        printTable: function (search_data) {
            getpaginate(search_data, '#emp_salary_list', 'mlm_software/admin/salary/emp_sal_data/' + miId, 'Only For tnx id');
        }
    }
    repEmpSalDetails.printTable(searchObj);


    repMemWallTnx.printTable(searchObj);
    reportPyHoldTable.printTable(searchObj);
    reportPyReqTable.printTable(searchObj);
    reportIncTable.printTable(searchObj);
    reportPinTable.printTable(searchObj);
    reportTable.printTable(searchObj);
    repMemWallet.printTable(searchObj);
    reportTnxTable.printTable(searchObj);
    repMemRewards.printTable(searchObj);


    /*-----------------------Testing Payout--------------------------------*/

    /*-----------------------Testing Payout--------------------------------*/

    $('#search').submit(function (e) {
        e.preventDefault();
        $("#member_table").DataTable().clear().destroy();
        let search = $('#search').serializeArray();
        let searchObj = {};
        $.each(search, function (i, row) {
            searchObj[row.name] = row.value;
        });
        reportTable.printTable(searchObj);
        $('html,body').animate({
            scrollTop: $("#member_table").offset().top
        }, 'slow');


    });
    $("#getProfileImageChange").click(function () {
        $("#uploadMemberIMg").toggle();
    });
    $(".memberImgUploadActn").click(function () {
        var imgFile = $('#file').val();
        var getResource = $('#base_url').val();
        if (imgFile == "") {
            Swal.fire({
                position: "top-end",
                icon: 'error',
                title: 'Please Provide valid member image',
                showConfirmButton: !1,
                timer: 1500
            });
        } else {
            var name = document.getElementById("file").files[0].name;
            var form_data = new FormData();
            var ext = name.split('.').pop().toLowerCase();
            if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                Swal.fire({
                    position: "top-end",
                    icon: 'error',
                    title: 'Please Provide Valid Image Format',
                    showConfirmButton: !1,
                    timer: 1500
                });
            }
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("file").files[0]);
            var f = document.getElementById("file").files[0];
            var fsize = f.size || f.fileSize;
            if (fsize > 2000000) {
                Swal.fire({
                    position: "top-end",
                    icon: 'error',
                    title: 'Image File Size is very big',
                    showConfirmButton: !1,
                    timer: 1500
                });
            } else {
                var NwUrl = getResource + 'mlm_software/admin/employee/upload_image';
                form_data.append("file", document.getElementById('file').files[0]);
                form_data.append("id", $('#id').val());
                form_data.append("memImg", $('#memImg').val());
                $.ajax({
                    url: NwUrl,
                    method: "POST",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                        $('#Update').html('Wait...');
                    },
                    success: function (data) {
                        $('#Update').html('Update');
                        var strng = data.split("====");
                        if (strng[0] == '1') {
                            $dtImg = '<img alt="Profile Image" class="avatar-xl img-thumbnail rounded-circle mb-3" src="' + getResource + "uploads/emp/" + strng[1] + '">';
                            $('#proPic').html($dtImg);
                            Swal.fire({
                                position: "top-end",
                                icon: 'success',
                                title: 'successfully upload image',
                                showConfirmButton: !1,
                                timer: 1500
                            });
                        } else {
                            Swal.fire({
                                position: "top-end",
                                icon: 'error',
                                title: 'Some Error Occur Please Re-Update',
                                showConfirmButton: !1,
                                timer: 1500
                            });
                        }
                    }
                });
            }
        }
    });
    $(".empSelectR").change(function () {
        var actNbtn = $(this).attr('id');
        var getResource = $('#base_url').val();
        if (actNbtn == 'roleAs') {
            if ($('#' + actNbtn).val() == '1') {
                $('#empIdAsRl').html('Super Admin Id');
            } else if ($('#' + actNbtn).val() == '2') {
                $('#empIdAsRl').html('Employee Id.');
            }
        } else if (actNbtn == 'state') {
            $('#district').html('<option>Please Wait.....</option>');
            $('#district').css('color', '#D2691E');
            $.post(getResource + "mlm_software/admin/employee/cityList", {
                id: $('#' + actNbtn).val()
            }, function (html) {
                $('#district').html(html);
                $('#district').css('color', 'rgb(62, 62, 62)');
            });
        } else if (actNbtn == 'empId') {
            let empId = $("select[name=empId]").val();
            $.post(getResource + "mlm_software/admin/salary/emp_sal", {
                id: empId
            }, function (html) {
                if (html.icon == '1') {
                    $('#salaryAmt').val(html.text);
                }
            }, 'json');
        }
    });
    $(".form-select").change(function () {
        var actNbtn = $(this).attr('id');
        $('#getMsgSuccess').fadeOut();
    });
    $(".form-control").keyup(function () {
        var actNbtn = $(this).attr('id');
        $('#defaultMsg').fadeOut();
        $('#getMsgSuccess').fadeOut();
        var loader = '<img src="' + isCheck('base_url') + 'mlm/img/loader.gif" style="height:10px;margin-bottom: -5px;width: 60px;" >';
        if (actNbtn == 'userId') {
            $('#memName').html(loader);
            $('#mobileNu').html(loader);
            $.post(isCheckUrl('admin/pin/isExistUser'), {
                id: isCheck(actNbtn)
            }, function (html) {
                if (html == 'Num') {
                    flashMsg('warning', 'Only numeric value is allowed');
                    $('#userNt').fadeOut();
                } else if (html == 'dataNot') {
                    $('#userNt').html("Oooop's No Data Found For User Id : " + isCheck(actNbtn));
                    $('#userNt').fadeIn();
                } else {
                    var data = html.split('###');
                    $('#ppLanDetails').fadeIn();
                    $('#memName').html(data[0]);
                    $('#mobileNu').html(data[1]);
                    $('#userNt').fadeOut();
                }
            });
        }
    });
    $(".ActnCmdByAmi").click(function () {
        var actNbtn = $(this).attr('id');

      
        if (actNbtn == 'salePinActn') {
            if (!isCheck('pack_plan')) {
                flashMsg('error', 'Please select Package Plan');
            } else if (!isCheck('nu_pin')) {
                flashMsg('error', 'Please Input Pin Quantity');
            } else if (isNaN(isCheck('nu_pin'))) {
                flashMsg('error', 'Please Input Only Numeric Value');
            } else if (!isCheck('userId')) {
                flashMsg('error', 'Please Input Member Id');
            } else if (isNaN(isCheck('userId'))) {
                flashMsg('error', 'Please Input Only Numeric Value');
            } else {
                // flashMsg('warning','Action By Amit Kumar');
                $.ajax({
                    url: isCheckUrl('admin/pin/sale_pin'),
                    type: "POST",
                    data: {
                        pack_plan: isCheck('pack_plan'),
                        nu_pin: isCheck('nu_pin'),
                        userId: isCheck('userId')
                    },
                    dataType: 'json',
                    success: function (html) { /*popup(data);*/
                        inPagePopup(html, '#defaultMsg');
                        $('#defaultMsg').fadeIn();
                        $('#userNt').fadeOut(); // console.log(data);
                        setTimeout(function () {
                            $('#defaultMsg').fadeOut();
                        }, 1500);
                        $('#ppLanDetails').fadeOut();
                        if (html.data == '1') {
                            setTimeout(function () {
                                window.location.reload(1);
                            }, 1500);
                        }
                    }
                });
            }
        } else if (actNbtn == 'proccedPy') {
            if (!isCheck('tnx_det')) {
                flashMsg('error', 'Please Input Transaction details');
            } else if (!isCheck('file')) {
                flashMsg('error', 'Please select Transaction Pay slip image');
            } else {
                var name = document.getElementById("file").files[0].name;
                var form_data = new FormData();
                var ext = name.split('.').pop().toLowerCase();
                if (jQuery.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                    Swal.fire({
                        position: "top-end",
                        icon: 'error',
                        title: 'Please Provide Valid Image Format',
                        showConfirmButton: !1,
                        timer: 1500
                    });
                }
                var oFReader = new FileReader();
                oFReader.readAsDataURL(document.getElementById("file").files[0]);
                var f = document.getElementById("file").files[0];
                var fsize = f.size || f.fileSize;
                if (fsize > 2000000) {
                    Swal.fire({
                        position: "top-end",
                        icon: 'error',
                        title: 'Image File Size is very big',
                        showConfirmButton: !1,
                        timer: 1500
                    });
                } else {
                    var NwUrl = isCheckUrl('admin/income/payNow');
                    form_data.append("file", document.getElementById('file').files[0]);
                    form_data.append("id", isCheck('py_id'));
                    form_data.append("tnx_det", isCheck('tnx_det'));
                    $.ajax({
                        url: NwUrl,
                        method: "POST",
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        beforeSend: function () {
                            $('#proccedPy').html('<i class="bx bx-cog bx-spin"></i> Wait...');
                        },
                        success: function (data) {
                            $('#proccedPy').html('<i class="bx bx-save"></i> Proceed');
                            if (data == '1') {
                                $('#getMsgSuccess').addClass('successMsg').removeClass('dangerMsg warningMsg');
                                $('#getMsgSuccess').html('You have successfully added details');
                                $('#getMsgSuccess').fadeIn('slow');
                                if (data == '1') {
                                    setTimeout(function () {
                                        window.location.reload(1);
                                    }, 1500);
                                }
                                /*$('#firstmodal').delay(5000).fadeOut('slow');$('.modal-backdrop').delay(5000).removeClass('show'); */
                            } else if (data == '2') {
                                $('#getMsgSuccess').addClass('warningMsg').removeClass('dangerMsg successMsg');
                                $('#getMsgSuccess').html("Ooop's something went wrong while updating details");
                                $('#getMsgSuccess').fadeIn('slow');
                            } else {
                                $('#getMsgSuccess').addClass('dangerMsg').removeClass('successMsg warningMsg');
                                $('#getMsgSuccess').html(data);
                                $('#getMsgSuccess').fadeIn('slow');
                            }
                        }
                    });
                }
            }
        } else if (actNbtn == 'searchAllPayout') {
            if ($("input[name='payment_select[]']").filter(':checked').length < 1) {
                flashMsg('error', 'Please check atleast one user to pay');
                return false;
            } else {
                var checkboxes = document.getElementsByName('payment_select[]');
                var vals = "";
                for (var i = 0, n = checkboxes.length; i < n; i++) {
                    if (checkboxes[i].checked) {
                        if (vals == '') {
                            vals += checkboxes[i].value;
                        } else {
                            vals += "," + checkboxes[i].value;
                        }
                    }
                }
                $('#py_id').val(vals);
                $('#firstmodal').modal('show');
            }
        } else if (actNbtn == 'proccedPyAmiActn') {
            var actnstr = isCheck('py_id_ami').split('-');
            if (actnstr[0] == 'pYhld') {
                if (!isCheck('pYhld_det')) {
                    $('#getMsgAmiModal').html('<i class="mdi mdi-car-brake-hold"></i> Please input reason to hold payment').addClass('dangerMsg').removeClass('warningMsg successMsg');
                    return false;
                } else {
                    $.post(isCheckUrl('admin/income/pay_opration'), {
                        id: isCheck('py_id_ami'),
                        pYhld_det: isCheck('pYhld_det')
                    }, function (html) {
                        inPagePopup(html, '#getMsgAmiModal');
                    }, "json");
                    return true;
                }
            } else if (actnstr[0] == 'pYUnhld') {
                $.post(isCheckUrl('admin/income/pay_opration'), {
                    id: isCheck('py_id_ami')
                }, function (html) {
                    inPagePopup(html, '#getMsgAmiModal');
                }, "json");
            } else if (actnstr[0] == 'pYremve') {
                $.post(isCheckUrl('admin/income/pay_opration'), {
                    id: isCheck('py_id_ami')
                }, function (html) {
                    inPagePopup(html, '#getMsgAmiModal');
                    if (html.data == '1') {
                        setTimeout(function () {
                            window.location.reload(1);
                        }, 1500);
                    }
                }, "json");
            } else if (actnstr[0] == 'pYrewrds') {
                if (!isCheck('pYrwrd_det')) {
                    $('#getMsgAmiModal').html('<i class="mdi mdi-car-brake-hold"></i> Please input remarks to pay rewards').addClass('dangerMsg').removeClass('warningMsg successMsg');
                    return false;
                } else {
                    $.post(isCheckUrl('admin/rewards/pay_opration'), {
                        id: isCheck('py_id_ami'),
                        pYrwrd_det: isCheck('pYrwrd_det')
                    }, function (html) {
                        inPagePopup(html, '#getMsgAmiModal');
                        if (html.data == '1') {
                            setTimeout(function () {
                                window.location.reload(1);
                            }, 1500);
                        }
                    }, "json");
                    return true;
                }
            }
        } else if (actNbtn == 'searchPayout') {
            $.post(isCheckUrl('admin/income/search'), {
                usrId: isCheck('usrId'),
                paymntSts: isCheck('paymntSts'),
                strtPyDt: isCheck('strtPyDt'),
                endPyDt: isCheck('endPyDt')
            }, function (html) {
                if (html.data == '4') {
                    $('#searchedD').html(html.text);
                    $('#defaultMsg').addClass('successMsg').removeClass('warningMsg dangerMsg').html('<i class="bx bx-smile"></i> Thank you ! we have found member details here').delay(5000).fadeOut('slow');
                } else {
                    inPagePopup(html, '#defaultMsg');
                }
                $('#defaultMsg').show();
            }, "json");
        } else if (actNbtn == 'miPopulate') {
            if (!isCheck('userIdA')) {
                $('#userIdAErr').html('<i class="fas fa-exclamation-triangle"></i> Please Input User Id').fadeIn('slow').addClass('dangerMsg').removeClass('warningMsg successMsg');
            } else if (isNaN(isCheck('userIdA'))) {
                $('#userIdAErr').html('<i class="fas fa-exclamation-triangle"></i> Please Input Valid User Id').fadeIn('slow').addClass('warningMsg').removeClass('dangerMsg successMsg');
            } else {
                $.post(isCheckUrl('admin/ewallet/funds'), {
                    userIdA: isCheck('userIdA')
                }, function (html) {
                    if (html.data == '4') {
                        $('#userIdAErr').addClass('successMsg').removeClass('warningMsg dangerMsg').html("<i class='bx bx-smile'></i> Thank you! we have found member's details here").delay(3000).fadeOut('slow');
                        $('#ppLanDetails').fadeIn('slow');
                        $('#usrId').html(html.text.username);
                        $('#memName').html(html.text.name);
                        $('#mobileNu').html(html.text.mobile);
                        $('#walllet').html(html.text.balance);
                    } else {
                        inPagePopup(html, '#userIdAErr');
                        $('#ppLanDetails').fadeOut('slow');
                    }
                    $('#userIdAErr').show();
                }, "json");
            }
        } else if (actNbtn == 'generate_pay') {
            if (!isCheck('admnPass')) {
                $('#report_gen').addClass('ami_danger').removeClass('ami_warning ami_success ami_default').html('<i class="bx bx-cog bx-spin"></i> Please input admin password to proceed');
            } else {
                $.post(isCheckUrl('admin/payout/generate'), {
                    admnPass: isCheck('admnPass')
                }, function (html) {
                    if (html.icon == '1') {
                        $('#report_gen').html(html.text).addClass('ami_success').removeClass('ami_warning ami_danger ami_default');
                    } else if (html.icon == '2') {
                        $('#report_gen').html(html.text).addClass('ami_warning').removeClass('ami_success ami_danger ami_default');
                    } else if (html.icon == '3') {
                        $('#report_gen').html(html.text).addClass('ami_danger').removeClass('ami_success ami_warning ami_default');
                    }
                }, "json");
            }
        } else if (actNbtn == 'proccedSal') {
          

            let empID = $("select[name=empId]").val();
            let month = $("select[name=month]").val();
            let year = $("select[name=year]").val();
            if (empID == '') {
                $('#getMsgSuccess').html('<i class="bx bx-cog bx-spin"></i> Please select employee').fadeIn('slow').addClass('ami_danger').removeClass('ami_warning ami_success');
            } else if (!isCheck('salaryAmt')) {
                $('#getMsgSuccess').html('<i class="bx bx-cog bx-spin"></i> Please input salary amount').fadeIn('slow').addClass('ami_danger').removeClass('ami_warning ami_success');
            } else if (isNaN(isCheck('salaryAmt'))) {
                $('#getMsgSuccess').html('<i class="bx bx-cog bx-spin"></i> Please input valid salary amount').fadeIn('slow').addClass('ami_warning').removeClass('ami_danger ami_success');
            } else if (!isCheck('PaidDt')) {
                $('#getMsgSuccess').html('<i class="bx bx-cog bx-spin"></i> Please input payment date').fadeIn('slow').addClass('ami_danger').removeClass('ami_warning ami_success');
            } else if (month == '') {
                $('#getMsgSuccess').html('<i class="bx bx-cog bx-spin"></i> Please select month of payment').fadeIn('slow').addClass('ami_danger').removeClass('ami_warning ami_success');
            } else if (year == '') {
                $('#getMsgSuccess').html('<i class="bx bx-cog bx-spin"></i> Please select year of payment').fadeIn('slow').addClass('ami_danger').removeClass('ami_warning ami_success');
            } else {
               
                $.post(base_url+'mlm_software/admin/salary/manage', {
                    id: isCheck('py_id'),
                    empId: empID,
                    salaryAmt: isCheck('salaryAmt'),
                    month: month,
                    year: year,
                    PaidDt: isCheck('PaidDt'),
                    designActn: isCheck('miActn')
                }, function (html) {
                    if (html.icon == '2') {
                        $('#getMsgSuccess').html(html.text).addClass('ami_warning').removeClass('ami_danger ami_success').show();
                    } else if (html.icon == '1') {
                        $('#getMsgSuccess').html(html.text).addClass('ami_success').removeClass('ami_danger ami_warning').delay(2000).show();
                        setTimeout(function () {
                            window.location.reload(1);
                        }, 2100);
                        $('#py_id').val('');
                    }
                }, 'json');
            }
        }
    });
});

function mStatus(str) {
    var getResource = $('#base_url').val();
    var datastring = "getParamtr=" + str;
    $.ajax({
        method: "POST",
        url: getResource + 'mlm_software/admin/employee/cStatus',
        data: datastring,
        timeout: 100000,
        beforeSend: function () {
            $("#ms" + str).html('<i class="bx bx-cog bx-spin"></i> Wait...');
        },
        complete: function () {},
        success: function (data) {
            if (data == '1') {
                $("#ms" + str).html('<i class="fa fa-upload" aria-hidden="true"></i> Active');
                $("#ms" + str).addClass('bg-olive');
                $("#ms" + str).removeClass('bg-orange');
                $('#defaultMsg').fadeOut();
            } else if (data == '0') {
                $("#ms" + str).html('<i class="fa fa-pause" aria-hidden="true"></i> Deactive');
                $("#ms" + str).addClass('bg-orange');
                $("#ms" + str).removeClass('bg-olive');
                $('#defaultMsg').fadeOut();
            } else {
                $('#defaultMsg').fadeIn();
                $('#defaultMsg').html("Oooop's Something wrong here please refresh");
            }
        },
        error: function () {
            alert('Ooops Something wrong here please Refresh');
        }
    });
}
function popup(data) {
    if (data.icon == "error") {
        var valid = '';
        $.each(data.text, function (i, item) {
            valid += item;
        });
        Swal.fire({
            position: "top-end",
            icon: data.icon,
            html: valid,
            showConfirmButton: !1,
            timer: 1500
        });
    } else {
        Swal.fire({
            position: "top-end",
            icon: data.icon,
            title: data.text,
            showConfirmButton: !1,
            timer: 1500
        });
        setTimeout(function () {
            window.location.reload(1);
        }, 1500);
    }
}
function flashMsg(dIcon, msg) {
    Swal.fire({
        position: "top-end",
        icon: dIcon,
        title: msg,
        showConfirmButton: !1,
        timer: 1500
    });
}
function isCheck(str) {
    var inputBx = $('#' + str).val();
    if (inputBx == "") {
        return "";
    } else {
        return inputBx;
    }
}
function isCheckUrl(page) {
    return isCheck('base_url') + 'mlm_software/' + page;
}
function inPagePopup(html, id) {
    if (html.data == '1') {
        $(id).addClass('successMsg').removeClass('warningMsg dangerMsg').html(html.text);
    } else if (html.data == '2') {
        $(id).addClass('warningMsg').removeClass('successMsg dangerMsg').html(html.text);
    } else {
        $(id).addClass('dangerMsg').removeClass('warningMsg successMsg').html(html.text);
    }
    /*setTimeout(function(){window.location.reload(1);},1500);*/
}
function getPin(str) {
    var paidSt = isCheck('nu_pin') * isCheck('pack_plan');
    if (str == '1') {
        $('#ePinAmt').html(isCheck('pack_plan'));
        $('#tPinBalance').html(paidSt.toFixed(2));
    } else if (str == '2') {
        $('#noPin').html(isCheck('nu_pin'));
        $('#ePinAmt').html(isCheck('pack_plan'));
        $('#tPinBalance').html(paidSt.toFixed(2));
    }
}
function flashMsgFrCurd(str, idElemnt) {
    $(idElemnt).fadeIn();
    if (str == '1') {
        $(idElemnt).addClass('alertSuccess');
        $(idElemnt).removeClass('alertWarning');
        $(idElemnt).removeClass('alertDanger');
        $(idElemnt).html('<i class="bx bx-wink-smile"></i> You have successfully updated your record');
    } else if (str == '2') {
        $(idElemnt).addClass('alertWarning');
        $(idElemnt).removeClass('alertSuccess');
        $(idElemnt).removeClass('alertDanger');
        $(idElemnt).html("<i class='bx bx-confused'></i> Ooop's something get wrong while updatting your record");
    }

}
function flashHtml(id, data) {
    $(id).html(data);
}
/***************************inc start*****************************************/
$(document).ready(function () {
    $("#make_pyRequest,#hold_pyRequest,#temp_reward_table").on("click", ".amInc", function () {
        var actNbtn = $(this).attr('data-id');
        var actnstr = actNbtn.split('-');
        if (actnstr[0] == 'pYn') {
            $('#py_id').val(actnstr[1]);
        } else if (actnstr[0] == 'pYhld') {
            $('#py_id_ami').val(actNbtn);
            $('#amiModalTitle').html('<i class="fas fa-stop-circle fntClr"></i> Hold Payment Request');
            $('#getMsgAmiModal').html('<i class="mdi mdi-car-brake-hold"></i> Are you sure want to hold payment');
            $('#getMsgAmiModal').addClass('warningMsg').removeClass('successMsg dangerMsg');
            $('#hldPayReson').show();
            $('#hldPayReson').html('<label for="pYhld_det" class="form-label">Transaction Detail <span class="text-danger">*</span></label><textarea class="form-control" id="pYhld_det"></textarea>');
        } else if (actnstr[0] == 'pYremve') {
            $('#py_id_ami').val(actNbtn);
            $('#hldPayReson').hide();
            $('#hldPayReson').html('');
            $('#amiModalTitle').html('<i class="fas fa-trash-alt fntClr"></i> Delete Payment Request');
            $('#getMsgAmiModal').html('<i class="far fa-trash-alt"></i> Are you sure want to remove payment request ');
            $('#getMsgAmiModal').addClass('dangerMsg').removeClass('successMsg warningMsg');
        } else if (actnstr[0] == 'pYUnhld') {
            $('#py_id_ami').val(actNbtn);
            $('#hldPayReson').hide();
            $('#hldPayReson').html('');
            $('#amiModalTitle').html('<i class="far fa-play-circle fntClr"></i> Unhold Payment Request');
            $('#getMsgAmiModal').addClass('warningMsg').removeClass('successMsg dangerMsg').html('<i class="far fa-play-circle"></i> Are you sure want to unhold payment request');
        } else if (actnstr[0] == 'pYrewrds') {
            $('#py_id_ami').val(actNbtn);
            $('#hldPayReson').hide();
            $('#hldPayReson').html('');
            $('#amiModalTitle').html('<i class="bx bx-gift fntClr"></i> Pay Acheivement Rewards');
            $('#getMsgAmiModal').addClass('successMsg').removeClass('warningMsg dangerMsg').html('<i class="bx bx-gift"></i> Are you sure want to pay acheivement rewards');
            $('#hldPayReson').html('<label for="pYrwrd_det" class="form-label">Reward Detail <span class="text-danger">*</span></label><textarea class="form-control" id="pYrwrd_det"></textarea>').show();
        }
    });
    $("#emp_salary").on("click", ".getAction", function () {
        var actNbtn = $(this).attr('data-id');
        var actnstr = actNbtn.split('-');
        if (actnstr[0] == 'salaryDlt') {
            $.post(base_url + actnstr[1], {
                id: actnstr[2],
                designActn: 'deleteSalD'
            }, function (html) {
                $('#cnfDel_id').val(actNbtn);
                $('.delMsg').html('<i class="bx bx-trash"></i> Delete designation');
                $('.actnData').html(html.text);
            }, 'json');
        } else if (actnstr[0] == 'salaryEdt') {
            $('.pgTitle').html('Update Salary of Employee');
            $('#proccedSal').html('<i class="bx bx-save"></i> Update').show();
            $.post(base_url + actnstr[1], {
                id: actnstr[2],
                designActn: 'view'
            }, function (html) {
                // $('#getMsgSuccess').html(html).fadeIn();
                setSelect('#empId', html.emp_id);
                setSelect('#month', html.month);
                setSelect('#year', html.year);
                $('#PaidDt').val(html.paydate);
                $('#salaryAmt').val(html.salary);
                $('#py_id').val(html.id);
                $('.createB').show();
                $('#createBy').html(html.createdBy);
                $('#createDt').html(html.created_date);
                if (html.modifiedBy) {
                    $('.mdfy').show();
                } else {
                    $('.mdfy').hide();
                }
                $('#modifiedBy').html(html.modifiedBy);
                $('#modifyDt').html(html.modify_date);
            }, 'json');
        }
    });


    $("#toallmember").click(function () {
        $("input[name='payment_select[]']").prop("checked", $(this).prop("checked"));
    });
    $("input[name='payment_select[]']").click(function () {
        if (!$(this).prop("checked")) {
            $("#toallmember").prop("checked", false);
        }
    });
});
function getpaginate(search_data, id, page, plchldr) { // id,page,placehldr
    var base_url = $('#base_url').val();
    $(id).DataTable({
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "order": [],
        'columnDefs': [
            {
                'targets': [
                    1, 2, 3
                ],
                'orderable': true
            }
        ],
        "ajax": {
            "url": base_url + page,
            "type": "POST",
            "dataSrc": "data",
            "data": search_data
        },
        language: {
            searchPlaceholder: plchldr
        },
        // dom: 'Bfrtip',
        dom: "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        "lengthMenu": [
            [
                10,
                25,
                50,
                100,
                -1
            ],
            [
                10,
                25,
                50,
                100,
                "All"
            ]
        ],
        "buttons": ["excel", "pdf", "print"]
    });
}
let count = 0;
function userBalLoad(str) {
    var actn = '';
    if (str == '1') {
        actn = ' To Add  In Member Wallet';
    } else if (str == '2') {
        actn = ' To Revert In Member Wallet ';
    } else {
        actn = '';
    }
    if (! isCheck('manageBal')) {
        $('#userIdAErr').html('<i class="fas fa-exclamation-triangle"></i> Please Input Amount' + actn).fadeIn('slow').addClass('dangerMsg').removeClass('warningMsg successMsg');
    } else if (isNaN(isCheck('manageBal'))) {
        $('#userIdAErr').html('<i class="fas fa-exclamation-triangle"></i> Please Input Valid Amount' + actn).fadeIn('slow').addClass('warningMsg').removeClass('dangerMsg successMsg');
    } else if (! isCheck('tnxDetails')) {
        $('#userIdAErr').html('<i class="fas fa-exclamation-triangle"></i> Please Input Transaction Details').fadeIn('slow').addClass('dangerMsg').removeClass('warningMsg successMsg');
    } else {
        if (str == '1') {
            $('.svBtn').html('<i class="bx bx-cog bx-spin"></i> Add');
        } else if (str == '2') {
            $('.minsBtn').html('<i class="bx bx-cog bx-spin"></i> Revert');
        }
        ++ count;
        $.post(isCheckUrl('admin/ewallet/ciphering'), {
            userIdA: isCheck('manageBal'),
            tnxDetails: isCheck('tnxDetails'),
            usrId: $('#usrId').text(),
            str: str,
            cnt: count
        }, function (html) {
            $('html,body').animate({
                scrollTop: $('#userIdAErr').offset().top
            }, 'slow');
            if (str == '1') {
                $('.svBtn').html('<i class="fas fa-plus-square"></i> Add');
            } else if (str == '2') {
                $('.minsBtn').html('<i class="fas fa-minus-square"></i> Revert');
            }
            if (html.data == '4') {
                $('#userIdAErr').addClass('successMsg').removeClass('warningMsg dangerMsg').html(html.text).delay(5000).fadeOut('slow');
            } else {
                inPagePopup(html, '#userIdAErr');
            }
            $('#userIdAErr').show();

        }, "json");
    }

}
function visiblePass(str) {
    var base_url = $('#base_url').val();
    var shw = '<div class="showPass" onclick="visiblePass(' + str + ')" id="pass' + str + '"><div class="passwrd"></div></div>';
    $.ajax({
        url: isCheckUrl('admin/Employee/passv'),
        type: "POST",
        data: {
            pID: str
        },
        beforeSend: function () {
            $('#pass' + str).html('<img src="' + base_url + 'mlm/img/loader.gif" style="height:10px;" >');
        },
        success: function (data) {
            $('#pass' + str).css('color', 'rgb(87, 87, 87)').html(data);
            setTimeout(function () {
                $('#pass' + str).html(shw).css('color', '#d50000');
            }, 5000);
        }
    });
}

function get_search(tbactn, frmId, tbstorage) {
    $(frmId).submit(function (e) {
        e.preventDefault();
        $(tbstorage).DataTable().clear().destroy();
        let search = $(frmId).serializeArray();
        let searchObj = {};
        $.each(search, function (i, row) {
            searchObj[row.name] = row.value;
        });
        tbactn.printTable(searchObj);
        $('html,body').animate({
            scrollTop: $(tbstorage).offset().top
        }, 'slow');
    });
}

function setSelect(id, val) {
    $(id + ' option').each(function () {
        if ($(this).val() == val) {
            $(this).prop("selected", true);
        }
    });
}
/***************************inc end*****************************************/


$("#addEmpSalry,#deleteEmpSal").click(function () {
    var actNbtn = $(this).attr('id');
    if (actNbtn == 'addEmpSalry') {

       
        $('#salary_approved').modal('show');
        $('.pgTitle').html('Add Salary of Employee');
        $('#proccedSal').html('<i class="bx bx-save"></i> Save').show();
        setSelect('#empId', '');
        setSelect('#month', '');
        setSelect('#year', '');
        $('#PaidDt').val('');
        $('#salaryAmt').val('');
        $('#miActn').val('addSalaryD');
        $('.createB').hide();
        $('.mdfy').hide();

    } else if (actNbtn == 'deleteEmpSal') {
        let actnstr = isCheck('cnfDel_id').split('-');
        $.post(base_url + actnstr[1], {
            id: actnstr[2],
            designActn: 'cnfDeleteSalD'
        }, function (html) { /*$('.delMsg').html(html);*/
            $('.delMsg').html('<i class="bx bx-trash"></i> Delete designation');
            if (html.icon == '1') {
                $('.actnData').html(html.text).css('color', '#02a30c');
                setTimeout(function () {
                    window.location.reload(1);
                }, 2500);
            } else if (html.icon == '2') {
                $('.actnData').html(html.text).css('color', '#c99a00');
            } else {
                $('.actnData').html('<i class="bx bx-cog bx-spin"></i> Oops it seems you have on the wrong way ').css('color', '#a30225');
            }
        }, 'json');
    }
});
