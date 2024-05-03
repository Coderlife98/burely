// Basic Details Update
$('#basic_data').submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: base_url + 'super_admin/mlm_software/setting/basic_data',
        type: "POST",
        data: $(this).serialize(),
        dataType: 'json',
        success: function (data) {
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

// Basic Details Update
$('#payout_data').submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: base_url + 'super_admin/mlm_software/setting/payout_data',
        type: "POST",
        data: $(this).serialize(),
        dataType: 'json',
        success: function (data) {
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


function incManage(str) {
  
    if (str == '1') {
      
       
        $('#edtIncActn').html('<span class="svBtn btnIncR" onclick="incManage(2)"><i class="mdi mdi-content-save-alert-outline"></i> Update</span>');
        $('#admfee').html(gethtmlTools('admfeeE', $('#admfee').text()));
        $('#cw_f').html(gethtmlTools('cw_fE', $('#cw_f').text()));
        $('#gdwf').html(gethtmlTools('gdwfE', $('#gdwf').text()));
       // $('#devclb').html(gethtmlTools('devclbE', $('#devclb').text()));
        $('#actMsal').html(gethtmlTools('actMsalE', $('#actMsal').text()));
        $('#inMsal').html(gethtmlTools('inMsalE', $('#inMsal').text()));
        $('#penF').html(gethtmlTools('penFE', $('#penF').text()));
        $('#maF').html(gethtmlTools('maFE', $('#maF').text()));

		$('#shipIn').html(gethtmlTools('shipInE', $('#shipIn').text()));
		$('#sponsorInc').html(gethtmlTools('sponsorIncE', $('#sponsorInc').text()));
        // $('#generation_income').html(gethtmlTools('generation_incomee', $('#generation_income').text()));
        $('#first_gen_incom').html(gethtmlTools('first_gen_income', $('#first_gen_incom').text()));
        $('#second_gen_incom').html(gethtmlTools('second_gen_income', $('#second_gen_incom').text()));
        $('#third_gen_incom').html(gethtmlTools('third_gen_income', $('#third_gen_incom').text()));
        $('#four_gen_incom').html(gethtmlTools('four_gen_income', $('#four_gen_incom').text()));
        

        $('#first_repurchase_incom').html(gethtmlTools('first_repurchase_income', $('#first_repurchase_incom').text()));
        $('#second_repurchase_incom').html(gethtmlTools('second_repurchase_income', $('#second_repurchase_incom').text()));
        $('#third_repurchase_incom').html(gethtmlTools('third_repurchase_income', $('#third_repurchase_incom').text()));
        $('#four_repurchase_incom').html(gethtmlTools('four_repurchase_income', $('#four_repurchase_incom').text()));




       /* $('#setTble').css('width', '94.5%');*/

    } else if (str == '2') { //
    //    alert( isCheck('generation_incomee'));
       //alert(isCheck('sponsorIncE'));
        $.post(base_url + 'super_admin/mlm_software/setting/misc_manage', {
            admfeeE: isCheck('admfeeE'),
            cw_fE: isCheck('cw_fE'),
            gdwfE: isCheck('gdwfE'),
            actMsalE: isCheck('actMsalE'),
            inMsalE: isCheck('inMsalE'),
            penFE: isCheck('penFE'),
            maFE: isCheck('maFE'),
           // devclbE: isCheck('devclbE'),
			shipInE: isCheck('shipInE'),
 			sponsorInc: isCheck('sponsorIncE'),
			
			
            generation_income: isCheck('generation_incomee'),
            first_gen_incom: isCheck('first_gen_income'),
            second_gen_incom: isCheck('second_gen_income'),
            third_gen_incom: isCheck('third_gen_income'),
            four_gen_incom: isCheck('four_gen_income'),
           

            first_repurchase_incom: isCheck('first_repurchase_income'),
            second_repurchase_incom: isCheck('second_repurchase_income'),
            third_repurchase_incom: isCheck('third_repurchase_income'),
            four_repurchase_incom: isCheck('four_repurchase_income'),


           

        }, function (html) {

            flashsweet(html.msg); //$('#incMember').html(html.text);
            if (html) {
                // console.log(html.clubI);
                $('#admfee').html(isCheck('admfeeE'));
                $('#cw_f').html(isCheck('cw_fE'));
                $('#gdwf').html(isCheck('gdwfE'));
                $('#actMsal').html(isCheck('actMsalE'));
                $('#penF').html(isCheck('penFE'));
                $('#inMsal').html(isCheck('inMsalE'));
                $('#maF').html(isCheck('maFE'));
                $('#devclb').html(isCheck('devclbE'));
				 $('#sponsorInc').html(html.clubI.sponsor_income);
				 $('#shipIn').html(isCheck('shipInE'));
               
                $('#generation_income').html(html.clubI.generation_income);
                $('#first_gen_incom').html(html.clubI.first_gen_incom);
                $('#second_gen_incom').html(html.clubI.second_gen_incom);
                $('#third_gen_incom').html(html.clubI.third_gen_incom);
                $('#four_gen_incom').html(html.clubI.four_gen_incom);
             //   $('#fifth_gen_incom').html(html.clubI.fifth_gen_incom);
				$('#repurchase_incom').html(html.clubI.repurchase_incom);        
                $('#first_repurchase_incom').html(html.clubI.first_repurchase_incom);
                $('#second_repurchase_incom').html(html.clubI.second_repurchase_incom);
                $('#third_repurchase_incom').html(html.clubI.third_repurchase_incom);
                $('#four_repurchase_incom').html(html.clubI.four_repurchase_incom);
                $('#edtIncActn').html('<span class="edtBtn btnIncR" onclick="incManage(1)"><i class="mdi mdi-comment-edit-outline"></i> Edit</span>');
            }
        }, "json");
    }

}

function gethtmlTools(str, val) {
    return '<input type="text" id="' + str + '" class="edtBltxt" value="' + val + '">';
}


// SMTP Details Update
$('#smtp_data').submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: base_url + 'super_admin/mlm_software/setting/smtp_data',
        type: "POST",
        data: $(this).serialize(),
        dataType: 'json',
        success: function (data) {
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

// Dark Logo Update
$('#dark_logo_update').submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: base_url + 'super_admin/mlm_software/setting/dark_logo_data',
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        dataType: 'json',
        success: function (data) {
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

// Dark Favicon Update
$('#dark_favicon_update').submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: base_url + 'super_admin/mlm_software/setting/dark_favicon_data',
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        dataType: 'json',
        success: function (data) {
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

// Light Logo Update
$('#light_logo_update').submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: base_url + 'super_admin/mlm_software/setting/light_logo_data',
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        dataType: 'json',
        success: function (data) {
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

// Light Favicon Update
$('#light_favicon_update').submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: base_url + 'super_admin/mlm_software/setting/light_favicon_data',
        type: "POST",
        data: new FormData(this),
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        dataType: 'json',
        success: function (data) {
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


// Advance Details Update
$('#advance_data').submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: base_url + 'super_admin/mlm_software/setting/advance_data',
        type: "POST",
        data: $(this).serialize(),
        dataType: 'json',
        success: function (data) {
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

// Module Details Update
$('#module_data').submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: base_url + 'super_admin/mlm_software/setting/module_data',
        type: "POST",
        data: $(this).serialize(),
        dataType: 'json',
        success: function (data) {
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

// Rank Manage
var repEmpDesignsn = '';
$(document).ready(function () {
    let searchObj = {};
    var base_url = $('#base_url').val();
    repEmpDesignsn = {
        printTable: function (search_data) {
            getpaginate(search_data, '#emp_position_tbl', 'super_admin/mlm_software/setting/designation_data', 'Only For User Id');
        }
    }
    repEmpDesignsn.printTable(searchObj);



    $(".actnCmd").click(function () {
        let nCmd = $(this).attr('data-id');
        let nwVal = nCmd.split('--');
        let base_url = $('#base_url').val();
        if (nwVal[0] == 'eRank') {
            $("#listTbl").hide();
            $(".rankManage").html('<i class="mdi mdi-playlist-edit"></i> Edit Rank For Permanant/Temprory Member Rank Data');
            $("#editSect").show();
            $.post(base_url + 'super_admin/mlm_software/setting/getRanks', {
                id: nwVal[1]
            }, function (html) {
                data = JSON.parse(html);
                $("#rankName").val(data.reward_name);
                $("#memberGoal").val(data.member_goal);
                $("#income").val(data.income);
                $("#otherIncome").val(data.other_reward);
                $("#monthlyReward").val(data.monthly_income);
                $("#id").val(data.id);
                $("#membershipTyp").val(data.membership_type).change();
            });
        } else if (nwVal[0] == 'eR_back') {
            $(".rankManage").html('<i class="mdi mdi-clipboard-list-outline"></i> Membership Rank List For Permanant/Temprory Member');
            $("#editSect").hide();
            $("#listTbl").show();
        } else if (nwVal[0] == 'ePanchayatM') {
            var myRange = $('#devR-' + nwVal[1]).text().split(' to ');
            $('#devR-' + nwVal[1]).html(gethtmlTools('devR' + nwVal[1], myRange[0]) + ' to ' + gethtmlTools('devRar' + nwVal[1], myRange[1]));
            $('#memInc-' + nwVal[1]).html(gethtmlTools('memInc' + nwVal[1], $('#memInc-' + nwVal[1]).text()));
            $('#pmBtn-' + nwVal[1]).html(getBtn(nwVal[1]));
        }
    });


    $(".ActnCmdByAmi").click(function () {
        var actNbtn = $(this).attr('id');
        if (actNbtn == 'edtRnkDet') {
        
            if (!isCheck('rankName')) {
                flashMsg('error', 'Please Input Rank Name');
            } else if (!isCheck('memberGoal')) {
                flashMsg('error', 'Please Input Goal Achieve Number');
            } else if (!isCheck('income')) {
                flashMsg('error', 'Please Input Income');
            }
            /*else if(!isCheck('otherIncome')){ flashMsg('error','Please Input Other Income');}	*/
            /* else if(!isCheck('monthlyReward')){ flashMsg('error','Please Input Monthly Income');}	*/ else if (!isCheck('membershipTyp')) {
                flashMsg('error', 'Please Select Member Type');
            } else {
                $.post(base_url + 'super_admin/mlm_software/setting/setRanks', {
                    id: isCheck('id'),
                    rankName: isCheck('rankName'),
                    memberGoal: isCheck('memberGoal'),
                    income: isCheck('income'),
                    otherIncome: isCheck('otherIncome'),
                    monthlyReward: isCheck('monthlyReward'),
                    membershipTyp: isCheck('membershipTyp')
                }, function (html) {
                    var mTypeD = '';
                    if (isCheck('membershipTyp') == '1') {
                        mTypeD = 'Permanent';
                    } else {
                        mTypeD = 'Temporary';
                    } 
                    flashMsgFrCurd(html, '#dataMsg');

                    flashHtml('#re-' + isCheck('id'), isCheck('rankName'));
                    flashHtml('#mg-' + isCheck('id'), isCheck('memberGoal'));
                    flashHtml('#ic-' + isCheck('id'), isCheck('income') + ' <i class="mdi mdi-percent-outline fntClr"></i>');
                    flashHtml('#othR-' + isCheck('id'), '<i class="bx bx-gift fntClr"></i>' + isCheck('otherIncome'));
                    flashHtml('#mn-' + isCheck('id'), '<i class="bx bx-rupee fntClr"></i>' + isCheck('monthlyReward'));
                    flashHtml('#mntype-' + isCheck('id'), mTypeD);
                });
            }
        } else if (actNbtn == 'edtJoiningDet') {
            if (!isCheck('joiningP')) {
                flashMsg('error', 'Please Input Joining Price');
            } else if (isNaN(isCheck('joiningP'))) {
                flashMsg('warning', 'Please Input Only Numeric Value');
            } else {
                $.post(base_url + 'super_admin/mlm_software/setting/setPmIncome', {
                    id: isCheck('joinPid'),
                    memFrom: isCheck('joiningP'),
                    minPay: isCheck('minPayout')
                }, function (html) {
                    flashsweet(html);
                }, "json");
            }
        } else if (actNbtn == 'proccedDesig') {
            if (!isCheck('designationN')) {
                $('#getMsgSuccess').html('<i class="bx bx-cog bx-spin"></i> Please Input Designation Name').fadeIn('slow').addClass('ami_danger').removeClass('ami_warning ami_success');
            } else if (!isCheck('pyscale')) {
                $('#getMsgSuccess').html('<i class="bx bx-cog bx-spin"></i> Please Input Pay Scale Amount').fadeIn('slow').addClass('ami_danger').removeClass('ami_warning ami_success');
            } else if (isNaN(isCheck('pyscale'))) {
                $('#getMsgSuccess').html('<i class="bx bx-cog bx-spin"></i> Please Input Valid Pay Scale Amount').fadeIn('slow').addClass('ami_warning').removeClass('ami_danger ami_success');
            } else {
                $.post(isCheckUrl('setting/set_designation'), {
                    id: isCheck('py_id'),
                    pyscale: isCheck('pyscale'),
                    designationN: isCheck('designationN'),
                    designActn: isCheck('miActn')
                }, function (html) {
                    if (html.icon == '2') {
                        $('#getMsgSuccess').html(html.text).addClass('ami_warning').removeClass('ami_danger ami_success').show();
                    } else if (html.icon == '1') {
                        $('#getMsgSuccess').html(html.text).addClass('ami_success').removeClass('ami_danger ami_warning').delay(2000).show();
                        setTimeout(function () { /*$('#emp_designation').modal('hide');*/
                            window.location.reload(1);
                        }, 2500);
                        $('#py_id').val('');
                    }
                }, 'json');
            }
        }

    });


    $("#emp_position_tbl").on("click", ".getAction", function () {
        var actNbtn = $(this).attr('data-id');
        var actnstr = actNbtn.split('-');
        var base_url = $('#base_url').val();
        if (actnstr[0] == 'vwDesig' || actnstr[0] == 'edtDesig') {
            let designTitle = '';
            let designActn = '';
            designActn = 'view';
            $('#proccedDesig').html('<i class="bx bx-save"></i> Update');
            $('#miActn').val('edit');
            if (actnstr[0] == 'vwDesig') {
                designTitle = ' View Designation';
                $('#proccedDesig').hide();
            } else if (actnstr[0] == 'edtDesig') {
                designTitle = ' Edit Designation';
                $('#proccedDesig').show(); /*designActn='edit';*/
            }
            $('.pgTitle').html(designTitle);
            $('#py_id').val(actnstr[2]);
            $.post(base_url + actnstr[1], {
                id: actnstr[2],
                designActn: designActn
            }, function (html) {
                if (html.icon == '2') {
                    $('#getMsgSuccess').html(html.text).addClass('ami_warning').removeClass('ami_danger ami_success').show();
                } else {
                    $('#getMsgSuccess').fadeOut();
                    $('#designationN').val(html.des_title);
                    $('#pyscale').val(html.payscale);
                    $('#createBy').html(html.createdBy);
                    $('#createDt').html(html.create_date);
                    $('.createB').show();
                    if (html.modifiedBy) {
                        $('#modifiedBy').html(html.modifiedBy);
                        $('#modifyDt').html(html.modify_date);
                        $('.mdfy').show();
                    } else {
                        $('.mdfy').hide();
                    }
                }
            }, 'json');

        } else if (actnstr[0] == 'delDesig') {
            $.post(base_url + actnstr[1], {
                id: actnstr[2],
                designActn: 'deleteDesignsn'
            }, function (html) {
                $('#cnfDel_id').val(actNbtn);
                $('.delMsg').html('<i class="bx bx-trash"></i> Delete designation');
                $('.actnData').html(html.text);
            }, 'json');
        }
    });
    $("#addDesignation,#deleteDesignsn").click(function () {
        var actNbtn = $(this).attr('id');
        if (actNbtn == 'addDesignation') {
            $('#emp_designation').modal('show');
            $('.createB,.mdfy').hide();
            $('#miActn').val('addDesignsn');
            $('#proccedDesig').html('<i class="bx bx-save"></i> Save').show();
            $('#designationN').val('');
            $('#pyscale').val('');
        } else if (actNbtn == 'deleteDesignsn') {
            let actnstr = isCheck('cnfDel_id').split('-');
            $.post(base_url + actnstr[1], {
                id: actnstr[2],
                designActn: 'cnfDeleteDesignsn'
            }, function (html) {
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


});
