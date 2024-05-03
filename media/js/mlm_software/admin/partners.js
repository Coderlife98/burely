var reportMemTable = '';
$(document).ready(function () {
    let searchObj = {};
    var target = $('#target').val();
	var miId = $('#miId').val();
    reportMemTable = {printTable: function (search_data){getpaginate(search_data, '#member_list', target, 'Only For Id, Name & Mobile Number.');}}
    reportMemTable.printTable(searchObj);
	repSaleManage = {printTable:function (search_data){getpaginate(search_data, '#my_sale_list', 'mlm_software/admin/partners/sale/'+miId, 'Only For Id,Product Name.');}}
    repSaleManage.printTable(searchObj);



    

    $(".empSelectR").change(function () {
        var actNbtn = $(this).attr('id');
        var getResource = $('#base_url').val();
        if (actNbtn == 'roleAs') {
            if ($('#' + actNbtn).val() == '1') {
                $('#shpName').html('Frenchise Name');
				$('#roleIdAsRl').html('Frenchise Id'); $('#mem_code').val('F'+ $('#getMId').val());$('#securityMny').val('25000');
            } else if ($('#' + actNbtn).val() == '2') {
                $('#roleIdAsRl').html('Shopee Id.');$('#mem_code').val('S'+ $('#getMId').val());$('#securityMny').val('10000'); $('#shpName').html('Shopee Name');
            }
        } else if (actNbtn == 'statN') {
            $('#district').html('<option>Please Wait.....</option>');
            $('#district').css('color', '#00917C ');
            $.post(getResource + "super_admin/common/cityList", {
                id: $('#' + actNbtn).val()
            }, function (html) {
                $('#district').html(html);
                $('#district').css('color', 'rgb(62, 62, 62)');
            });
        }
    });
$(".shopiActn").unbind("click").click(function()
	{//https://botfiller.com/
		
		let actNbtn=$(this).attr('data-id');let actnstr=actNbtn.split('-');$('.actnData').css('color','#f56e50');
		if(actnstr[2]=='delAadhar'){$('#cnfDel_id').val(actNbtn+'/'+isCheck('shoppId'));$('.delMsg').html('<i class="bx bx-trash"></i> Delete Aadhaar Document'); $('.actnData').html('Are you want to delete aadhaar document');}
		else if(actnstr[2]=='delPan'){$('#cnfDel_id').val(actNbtn+'/'+isCheck('shoppId'));$('.delMsg').html('<i class="bx bx-trash"></i> Delete Pan Document'); $('.actnData').html('Are you want to delete pan document');}
		else if(actnstr[2]=='delBankpass'){$('#cnfDel_id').val(actNbtn+'/'+isCheck('shoppId'));$('.delMsg').html('<i class="bx bx-trash"></i> Delete Passbook Document'); $('.actnData').html('Are you want to delete passbook document');}
		else if(actnstr[0]=='midoc'){$('#shopiDocFileUpload').toggle();$('html,body').animate({ scrollTop: $("#shopiDocFileUpload").offset().top},'slow');$('#docUrlActn').html(actNbtn);}
		});

	$(".shopeeImgUploadActn").unbind("click").click(function()
	{
		var imgFile=$('#docfile').val();if(imgFile==""){toast('tst_danger','Please select profile image');}
		else
		{
		     var name = document.getElementById("docfile").files[0].name;
 			 var form_data = new FormData();
 			 var ext = name.split('.').pop().toLowerCase();
 			 if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1){toast('tst_danger','Please provide valid image format');}
			   var oFReader = new FileReader();
			   oFReader.readAsDataURL(document.getElementById("docfile").files[0]);
			   var f = document.getElementById("docfile").files[0];
			   var fsize = f.size||f.fileSize;
			   if(fsize > 2000000){toast('tst_danger','Image File Size is very big');}
				else
				{
				   let docUrlActn=$('#docUrlActn').text();
				   let target=docUrlActn.split('-');
				   let isCheckUrl=isCheck('base_url')+target[2];
				   form_data.append("file", document.getElementById('docfile').files[0]);
				   form_data.append("shoppId",isCheck('shoppId'));
				   form_data.append("miAction",isCheck('miAction'));
				   form_data.append("docType",target[1]);	
				   $.ajax({url:isCheckUrl,method:"POST",data: form_data,dataType: "JSON",contentType: false,cache: false,processData: false,beforeSend:function(){$('#Update').html('<i class="bx bx-cog bx-spin"></i> Wait....').css('padding','6px 13.2px 6px 16.5px');},   
					success:function(data)
					{
						$('#Update').css('padding','6px 10px 6px 16.7px').html('<i class="bx bx-save"></i> Upload');
						toastMultiShow(data.adClass,data.msg,data.icon);$('#docfile').val('');
						if(target[1]=='edtAadhar'){$("#adrImg").attr("src",isCheck('base_url')+data.img_loc);}
						else if(target[1]=='pancard'){$("#panImg").attr("src",isCheck('base_url')+data.img_loc);}
						else if(target[1]=='passbook'){$("#passBookImg").attr("src",isCheck('base_url')+data.img_loc);}
						else if(target[1]=='profileImg'){$("#profileImg").attr("src",isCheck('base_url')+data.img_loc);}
						}
				   });
				  }
			}
	});	


    $("#member_list").on("click", ".getAction", function () {
        let actNbtn = $(this).attr('data-id');
        let actnstr = actNbtn.split('-');
        let base_url = $('#base_url').val() + actnstr[1];
		/* $('.actnData').html(actNbtn);*/
        if (actnstr[0] == 'del_mstr') {
            $.post(base_url, {
                id: actnstr[2],
                actnMng: 'deleteMstr'
            }, function (html) {
                $('#cnfDel_id').val(actNbtn);
                $('.delMsg').html('<i class="bx bx-trash"></i> Delete designation');
                $('.actnData').html(html.text);
            }, 'json');
        }


    });

    $("#deleteCnfrMtn").click(function () {
        let actNbtn = $(this).attr('id');
        if (actNbtn == 'deleteCnfrMtn') {
            let actnstr = isCheck('cnfDel_id').split('-');

            $.post(base_url + actnstr[1], {
                id: actnstr[2],
                actnMng: 'cnfDeleteOpr'
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

    $("#getProfileImageChange").click(function () {
        $("#uploadMemberIMg").toggle();
    });
    $(".memberImgUploadActn").click(function () {
        var imgFile = $('#file').val();
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
                var NwUrl = base_url + 'mlm_software/admin/partners/upload_image';
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
                            $dtImg = '<img alt="Profile Image" class="avatar-xl img-thumbnail rounded-circle mb-3 mi_thumb" src="' + base_url + "uploads/user/" + strng[1] + '">';
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
                                title: 'Only .jpg,.png,.jpeg are accepted',
                                showConfirmButton: !1,
                                timer: 1500
                            });
                        }
                    }
                });
            }
        }
    });







	$(".memAction").unbind("click").click(function()
	{
		let getId=$(this).attr('id');
		if(getId=='getNext')
		{
			
			if(isCheck('miAction')=='1')
			{
			  $.post(isCheck('target'),
					{
						roleAs:isCheck('roleAs'),partnerName:isCheck('partnerName'),
						frTitle:isCheck('frTitle'),
						mem_code:isCheck('mem_code'),
						mem_name:isCheck('mem_name'),
						gender:isCheck('gender'),
						dob:isCheck('date_of_birth'),
						mob_nu:isCheck('mob_nu'),
						emailId:isCheck('emailId'),
						password:isCheck('password'),
						confPass:isCheck('confPass'),
						miAction:isCheck('miAction')
						},
						function(htmlAmi)
						{
							toastMultiShow(htmlAmi.adClass,htmlAmi.msg,htmlAmi.icon);
							if(htmlAmi.adClass=='tst_success') 
							{
								$('#miAction').val(htmlAmi.actn);
								$('#shoppId').val(htmlAmi.shopId);
								$('#personalInfo').hide();
			 					$('#communicationInfo,#getPrevious').show();
								$('#commDet').addClass('cmpltVzrd');
								}
								},'json');
			}
			else if(isCheck('miAction')=='2')
			{
				$.post(isCheck('target'),{address:isCheck('address'),statN:isCheck('statN'),district:isCheck('district'),zipcode:isCheck('zipcode'),pan_no:isCheck('pan_no'),aadhaar_no:isCheck('aadhaar_no'),shoppId:isCheck('shoppId'),miAction:isCheck('miAction')},function(htmlAmi){
					   toastMultiShow(htmlAmi.adClass,htmlAmi.msg,htmlAmi.icon);
					   if(htmlAmi.adClass=='tst_success')
					   {
							$('#personalInfo,#communicationInfo,#docInfo').hide();$('#getPrevious,#bankingInfo').show();
							$('#miAction').val(htmlAmi.actn);$('#bnkDet').addClass('cmpltVzrd');
					   	}},'json');
				
				}
			
			else if(isCheck('miAction')=='3')
			{
			  $.post(isCheck('target'),{bName:isCheck('bName'),bankAc:isCheck('bankAc'),bnkIFSC:isCheck('bnkIFSC'),brName:isCheck('brName'),nomiName:isCheck('nomiName'),nomineeRel:isCheck('nomineeRel'),NomAddr:isCheck('NomAddr'),miAction:isCheck('miAction'),shoppId:isCheck('shoppId')},function(htmlAmi){toastMultiShow(htmlAmi.adClass,htmlAmi.msg,htmlAmi.icon);if(htmlAmi.adClass=='tst_success'){$('#personalInfo,#bankingInfo').hide();$('#getPrevious,#docInfo').show();$('#miAction').val(htmlAmi.actn);$('#docDet').addClass('cmpltVzrd');$('#getNext').html('<i class="bx bx-save"></i> Save');}},'json');
				}
			else if(isCheck('miAction')=='4')
			{
				setTimeout(function(){window.location.reload(1);},1500);
				}

			
			}
		else if(getId=='getPrevious')
		{
		    if(isCheck('miAction')=='2')
			{$('#getPrevious,#communicationInfo,#bankingInfo').hide();$('#personalInfo').show();$('#miAction').val('1');$('#commDet').removeClass('cmpltVzrd');}
			else if(isCheck('miAction')=='3')
			{$('#personalInfo,#bankingInfo,#docInfo').hide();$('#getPrevious,#communicationInfo').show();$('#miAction').val('2');$('#bnkDet').removeClass('cmpltVzrd');}
			else if(isCheck('miAction')=='4'){$('#personalInfo,#docInfo,#communicationInfo').hide();$('#getPrevious,#bankingInfo,#getNext').show();
			$('#miAction').val('3');$('#docDet').removeClass('cmpltVzrd');$('#getNext').html('Next <i class="fas fa-arrow-right "></i>')}
			}
		
	 });





});


$('#save_partner').submit(function (e) {
    e.preventDefault();
    let target = $('#target').val();
    let base_url = $('#base_url').val() + 'mlm_software/' + target;
    $.ajax({
        url: base_url,
        type: "POST",
        data: $(this).serialize(),
        dataType: 'json',
        success: function (data) {
            popup(data);
        }
    });
});



$('#profile_data').submit(function (e) {
    e.preventDefault();
    let base_url = $('#base_url').val() + 'mlm_software/admin/partners/update';
    $.ajax({
        url: base_url,
        type: "POST",
        data: $(this).serialize(),
        dataType: 'json',
        success: function (data) {
            popup(data);
        }
    });
});

function visiblePass(str)
{
 var shw='<div class="passwrd"></div>';
/* let target = $('#target').val();
 let base_url = target.substring(0,50);
 let imgUrl= target.substring(0,22);*/
  let target = $('#base_url').val();
 $.ajax({
        url:target+'mlm_software/admin/partners/passv',
        type: "POST",
        data:{pID:str},
	  beforeSend : function() 
		{ $('#vsblPass').html('<img src="'+target+'media/images/loader.gif" style="height:10px;" >'); },
        success: function (data) {
			$('#vsblPass').css('color','rgb(87, 87, 87)').html(data);
			 setTimeout(function(){$('#vsblPass').html(shw).css('color','#d50000');}, 5000);
			}    
   		 });
	}







function toastMultiShow(adCls,msg,icon){let valid = '';let myClass="tst_success tst_warning tst_danger";let restCls=myClass.replace(adCls," ");let addonMsg='';$.each(msg,function (i,item){valid +='<li>'+item+'</li>';});$('.tst_danger').addClass('ts_dan');$('.tst_warning').addClass('ts_war');if(adCls=='tst_success'){addonMsg=icon+' <ul>'+valid+'</ul>';}else if(adCls=='tst_danger'){addonMsg=icon+' <ul>'+valid+'</ul>';}else if(adCls=='tst_warning'){addonMsg=icon+' <ul>'+valid+'</ul>';}$('.ami_toast').css('visibility','visible').html(addonMsg).addClass(adCls).removeClass(restCls);setTimeout(function(){$('.ami_toast').css('visibility','hidden')},2000);}




