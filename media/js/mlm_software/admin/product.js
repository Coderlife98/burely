var reportProTable = '';


$(document).ready(function () {
    let searchObj = {};

    reportProTable = {
        printTable: function (search_data) {
            getpaginate(search_data, '#tbl_product_manage', 'mlm_software/admin/product/product_data', 'Only For Id, Name');
        }
    }
    reportProTable.printTable(searchObj);
    $(".ActnCmdByAmi").click(function () 
	{
        let actNbtn = $(this).attr('id');
		
        let main_cat = $("select[name=main_cat]").val();

        if (main_cat == '') 
		{
            flash_msg_class('#getMsgSuccess', '<i class="bx bx-cog bx-spin"></i> Please input category name', 'ami_danger');
        } 

		else if (actNbtn == 'proceedProduct')
		 {
            if (!isCheck('product_name')) 
			{
                $("#product_name").focus();
                flash_msg_class('#getMsgSuccess', '<i class="bx bx-cog bx-spin"></i> Please input product name', 'ami_danger');
            } 
			else 
			{
                if (isCheck('py_id') != "") 
				{
                    py_id = isCheck('py_id');
                } else 
				{
                    py_id = "";
                }
                 
				
                $.post(isCheck('target'), 
				{
                    id: py_id,
                    main_cat: isCheck('main_cat'),
                    product_name: isCheck('product_name'),
                    unitActn: isCheck('miActn')
                },
				 function (html) 
				 {
                    if (html.icon == '2') 
					{
                        flash_msg_class('#getMsgSuccess', html.text, 'ami_warning');
                    } 
					else if (html.icon == '1') 
					{
                        flash_msg_class('#getMsgSuccess', html.text, 'ami_success');
                        setTimeout(function () {
                            $('#manage_product').modal('hide');
                            window.location.reload(1);
                        }, 2500);
                        $('#py_id').val('');
                    }
                }, 'json');
            }
        }


    });
    $("#addProductDetails,#deleteCnfrMtn,#miniMize").click(function ()
	 {
        let getIdDet = $(this).attr('id');
        if (getIdDet == 'addProductDetails')
		 {
            $('#manage_product').modal('show');
            $('.createB,.mdfy').hide();
            $('#miActn').val('addProduct');
            $('#proceedProduct').html('<i class="bx bx-save"></i> Save').show();
            $('#product_name').val('');
            setSelect('#main_cat', "");
            $('#py_id').val('');
        } 
		else if (getIdDet == 'deleteCnfrMtn') 
		{

            let actnstr = isCheck('cnfDel_id').split('==');
            $.post(base_url + actnstr[1],
				 {
                id: actnstr[2],
                unitActn: 'cnfDeleteProduct'
            }, function (html) {
                $('.delMsg').html('<i class="bx bx-trash"></i> Delete Product');
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
		else if(getIdDet == 'miniMize')		
		{$('#productImgUpload').toggle();$('html,body').animate({ scrollTop: $("#productImgUpload").offset().top},'slow');	}

    });

    $("#tbl_product_manage").on("click", ".getAction", function ()
	 {
        let actNbtn = $(this).attr('data-id');
        let actnstr = actNbtn.split('==');
        let getId = $(this).attr('id');
		
        let target = isCheck('base_url') + 'mlm_software/admin/product/status';

        if (actnstr[0] == 'statusCh') {

            let getVal = $('#' + getId + ' span').text();
            if (getVal == 'Active') {
                $('#' + getId + ' span').html('Dective');
            } else {
                $('#' + getId + ' span').html('Active');
            }
            $("#" + getId).toggleClass('setBtn setBtnGr').removeClass('dctive');
            $.post(target, {
                id: actNbtn
            }, function (html) {
                if (html.icon = '1') {
                    $("#" + getId).attr("data-id", html.text);
                } else {
                    $('#getMsgSuccess').html(html.text).addClass('ami_warning');
                }
            }, 'json');
        }

		
		else if (actnstr[0] == 'vwProDet' || actnstr[0] == 'edtProDet') 
		{
            let productTitle = '';
            let unitActn = '';
            unitActn = 'view';
            $('#proceedProduct').html('<i class="bx bx-save"></i> Update');
            $('#miActn').val('edit');
            if (actnstr[0] == 'vwProDet') {
                productTitle = ' View Product Details';
                $('#proceedProduct').hide();
            } else if (actnstr[0] == 'edtProDet') {
                productTitle = ' Edit Product Details';
                $('#proceedProduct').show();
            }
            $('.pgTitle').html(productTitle);
            $('#py_id').val(actnstr[2]);
            $.post(base_url + actnstr[1], {
                id: actnstr[2],
                unitActn: unitActn
            }, function (html) {
                if (html.icon == '2') {
                    $('#getMsgSuccess').html(html.text).addClass('ami_warning').removeClass('ami_danger ami_success').fadeIn();
                } else {
                    $('#getMsgSuccess').fadeOut();
                    setSelect('#main_cat', html.cat_id);
                    $('#product_name').val(html.product_name);
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

        }
		
		else if (actnstr[0] == 'delProDetails') 
		{

            $.post(base_url + actnstr[1], {
                id: actnstr[2],
                unitActn: 'delProDetails'
            }, function (html) {
                $('#cnfDel_id').val(actNbtn);
                $('.delMsg').html('<i class="bx bx-trash"></i> Delete Product');
                $('.actnData').html(html.text);
            }, 'json');
        }
		else if(actnstr[0]=='imgProDet')
		{
			let status=$('#productImgUpload').is(':visible');if(status==true){$('#productImgUpload').show();}else{$('#productImgUpload').show();}$('#arvProName').html(actnstr[3]);
			$('#proImgDv').attr("src",isCheck('base_url')+actnstr[4]);
			$('html,body').animate({ scrollTop: $("#productImgUpload").offset().top},'slow');$('#proImgUrlActn').html(actNbtn);
			/*$('#productImgUpload').toggle();*/
			}

    });
	
	$(".proImgUploadActn").unbind("click").click(function()
	{
		var imgFile=$('#proImgFile').val();if(imgFile==""){flashMsg('error','Please select profile image');}
		else
		{
		     var name = document.getElementById("proImgFile").files[0].name;
 			 var form_data = new FormData();
 			 var ext = name.split('.').pop().toLowerCase();
 			 if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1){flashMsg('error','Please provide valid image format');}
			   var oFReader = new FileReader();
			   oFReader.readAsDataURL(document.getElementById("proImgFile").files[0]);
			   var f = document.getElementById("proImgFile").files[0];
			   var fsize = f.size||f.fileSize;
			   if(fsize > 2000000){flashMsg('error','Image File Size is very big');}
				else
				{
				   let proImgUrlActn=$('#proImgUrlActn').text();
				   let target=proImgUrlActn.split('==');	
				   let isCheckUrl=isCheck('base_url')+target[1];
				   form_data.append("file", document.getElementById('proImgFile').files[0]);
				   form_data.append("pro_id", target[2]);
				   form_data.append("unitActn", target[0]);
				   $.ajax({url:isCheckUrl,method:"POST",data: form_data,dataType: "JSON",contentType: false,cache: false,processData: false,beforeSend:function(){$('#Update').html('<i class="bx bx-cog bx-spin"></i> Wait....').css('padding','6px 13.2px 6px 16.5px');},   
					success:function(data)
					{	
						$('#Update').css('padding','6px 10px 6px 16.7px').html('<i class="bx bx-save"></i> Upload');
						toast(data.class,data.text);if(data.class=='tst_success'){$("#proImgDv").attr("src",isCheck('base_url')+data.img_loc);$("#proImgFile").val("");}
						}
				   });
				  }
			}
	});	

});
