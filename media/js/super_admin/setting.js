// Basic Details Update
$('#basic_data').submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: base_url + 'super_admin/setting/basic_data',
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
        url: base_url + 'super_admin/setting/dark_logo_data',
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
        url: base_url + 'super_admin/setting/dark_favicon_data',
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
        url: base_url + 'super_admin/setting/light_logo_data',
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
        url: base_url + 'super_admin/setting/light_favicon_data',
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

/*--------------------------Code By @mit ---------------------------------*/
$(document).ready(function(){ 
 
    let searchObj = {};
	var base_url=$('#base_url').val();							   
	repUnitManage = {printTable:function(search_data){getpaginate(search_data,'#tbl_unit_manage','super_admin/setting/unit_data','Only For Unit Id');}}
	repUnitManage.printTable(searchObj);
	
	repCatManage = {printTable:function(search_data){getpaginate(search_data,'#category_detbl','super_admin/setting/category_data','Only For Unit Id');}}
	repCatManage.printTable(searchObj);	
	repPackageManage = {printTable:function(search_data){getpaginate(search_data,'#tbl_package_manage','super_admin/setting/package_data','Only For Unit Id');}}
	repPackageManage.printTable(searchObj);
   
	$(".ActnCmdByAmi").click(function()
	{	
	 	let actNbtn=$(this).attr('id');let py_id='';
		if(actNbtn=='proceedUnit')
		{	
			if(!isCheck('unit_name'))
			{$("#unit_name").focus();
			    $('#getMsgSuccess').html('<i class="bx bx-cog bx-spin"></i> Please input unit name').fadeIn('slow').addClass('ami_danger').removeClass('ami_warning ami_success');
				}
	else
	{
		if(isCheck('py_id')!=""){py_id=isCheck('py_id');}else{py_id="";}	
				$.post(isCheckUrlAdmn('setting/set_unit'),{id:py_id,unit_name:isCheck('unit_name'),unitActn:isCheck('miActn')},function(html)
				{	
					if(html.icon=='2'){$('#getMsgSuccess').html(html.text).addClass('ami_warning').removeClass('ami_danger ami_success').show();}
					else if(html.icon=='1'){$('#getMsgSuccess').html(html.text).addClass('ami_success').removeClass('ami_danger ami_warning').delay(2000).show();
					setTimeout(function(){$('#manage_unit').modal('hide');window.location.reload(1);},2500);$('#py_id').val('');}
					},'json');
					}		    				
			}	
		else if(actNbtn=='proceedCat')
		{
			let main_cat=$("select[name=main_cat]").val();
			if(isCheck('miCtdt')=='2' && main_cat=='')
			{
		$('#getMsgSuccess').html('<i class="bx bx-cog bx-spin"></i> Please input main category name').fadeIn('slow').addClass('ami_danger').removeClass('ami_warning ami_success');
				}
				else if(!isCheck('cat_name'))
				{$("#cat_name").focus();
			 $('#getMsgSuccess').html('<i class="bx bx-cog bx-spin"></i> Please input category name').fadeIn('slow').addClass('ami_danger').removeClass('ami_warning ami_success');
				}
				else
				{
					if(isCheck('py_id')!=""){py_id=isCheck('py_id');}else{py_id="";}	
				    $.post(isCheckUrlAdmn('setting/set_category'),
					       {id:py_id,cat_name:isCheck('cat_name'),category_typ:isCheck('miCtdt'),main_cat:isCheck('main_cat'),unitActn:isCheck('miActn')},function(html)
				    {	
					   if(html.icon=='2'){$('#getMsgSuccess').html(html.text).addClass('ami_warning').removeClass('ami_danger ami_success').show();}
					     else if(html.icon=='1'){$('#getMsgSuccess').html(html.text).addClass('ami_success').removeClass('ami_danger ami_warning').delay(2000).show();
					     setTimeout(function(){$('#manage_unit').modal('hide');window.location.reload(1);},1500);$('#py_id').val('');}
					  },'json');
		 
					}
			}
		else if(actNbtn=='proceedPackage')
		{	
			if(!isCheck('pack_name'))
			{$("#pack_name").focus();
			   $('#getMsgSuccess').html('<i class="bx bx-cog bx-spin"></i> Please input package name').fadeIn('slow').addClass('ami_danger').removeClass('ami_warning ami_success');
				}
			else if(!isCheck('pack_price'))
			{$("#pack_price").focus();
			  $('#getMsgSuccess').html('<i class="bx bx-cog bx-spin"></i> Please input package price').fadeIn('slow').addClass('ami_danger').removeClass('ami_warning ami_success');
				}
			else if(isNaN(isCheck('pack_price')))
			{$("#pack_price").focus();
		$('#getMsgSuccess').html('<i class="bx bx-cog bx-spin"></i> Please input valid package price').fadeIn('slow').addClass('ami_warning').removeClass('ami_danger ami_success');
				}
		else if(!isCheck('business_volume'))
			{$("#business_volume").focus();
			  $('#getMsgSuccess').html('<i class="bx bx-cog bx-spin"></i> Please input business volume').fadeIn('slow').addClass('ami_danger').removeClass('ami_warning ami_success');
				}
			else if(isNaN(isCheck('business_volume')))
			{$("#business_volume").focus();
	$('#getMsgSuccess').html('<i class="bx bx-cog bx-spin"></i> Please input valid business volume').fadeIn('slow').addClass('ami_warning').removeClass('ami_danger ami_success');
				}		
		else
			{
				if(isCheck('py_id')!=""){py_id=isCheck('py_id');}else{py_id="";}	
				$.post(isCheckUrlAdmn('setting/set_pack'),{id:py_id,pack_name:isCheck('pack_name'),pack_price:isCheck('pack_price'),b_vol:isCheck('business_volume'),unitActn:isCheck('miActn')},function(html)
				{	
					if(html.icon=='2'){$('#getMsgSuccess').html(html.text).addClass('ami_warning').removeClass('ami_danger ami_success').show();}
					else if(html.icon=='1'){$('#getMsgSuccess').html(html.text).addClass('ami_success').removeClass('ami_danger ami_warning').delay(2000).show();
					setTimeout(function(){$('#manage_unit').modal('hide');window.location.reload(1);},1500);$('#py_id').val('');}
					},'json');
					}		    				
			}		
			
			
	});
   $("#tbl_unit_manage,#category_detbl,#tbl_package_manage").on("click", ".getAction", function()
  {
		let actNbtn=$(this).attr('data-id');
		var actnstr=actNbtn.split('==');
		let getId=$(this).attr('id');
		if(actnstr[0]=='statusCh')
		{
			let getVal=$('#'+getId+' span').text();
			if(getVal=='Active')
			{
				$('#'+getId+' span').html('Dective');
				}
				else
				{
					$('#'+getId+' span').html('Active');
					}
			$("#"+getId).toggleClass('setBtn setBtnGr').removeClass('dctive');
		$.post(isCheckUrlAdmn('setting/unit_status'),{id:actNbtn},function(html)
	    {if(html.icon='1'){$("#"+getId).attr("data-id",html.text);}
				else{$('#setResultMsg').html(html.text).addClass('ami_warning');}
			},'json');	
		}
		else if(actnstr[0]=='vwUnitDet' || actnstr[0]=='edtUnitDet')
		{
			 	let designTitle='';let unitActn='';unitActn='view';$('#proccedDesig').html('<i class="bx bx-save"></i> Update');$('#miActn').val('edit');
				if(actnstr[0]=='vwUnitDet'){designTitle=' View Unit Details'; $('#proceedUnit').hide();}
		        else if(actnstr[0]=='edtUnitDet'){designTitle=' Edit Unit Details'; $('#proceedUnit').show();/*designActn='edit';*/}$('.pgTitle').html(designTitle);$('#py_id').val(actnstr[2]);
			$.post(base_url+actnstr[1],{id:actnstr[2],unitActn:unitActn},function(html)
			 {
				 if(html.icon=='2'){$('#setResultMsg').html(html.text).addClass('ami_warning').removeClass('ami_danger ami_success').fadeIn();}
				   else
				   {    
				        $('#setResultMsg').fadeOut();$('#unit_name').val(html.unit_name);$('#createBy').html(html.createdBy);
						$('#createDt').html(html.create_date);$('.createB').show();
						if(html.modifiedBy){$('#modifiedBy').html(html.modifiedBy);$('#modifyDt').html(html.modify_date);$('.mdfy').show();}else{$('.mdfy').hide();}
						}
			 },'json');
			
			}
		else if(actnstr[0]=='delUnitDetails')
		{    
				$.post(base_url+actnstr[1],{id:actnstr[2],unitActn:'deleteUnitDet'},function(html)
				{ $('#cnfDel_id').val(actNbtn);$('.delMsg').html('<i class="bx bx-trash"></i> Delete designation'); $('.actnData').html(html.text);},'json');
		}
		else if(actnstr[0]=='statusCat')
		{
			let getVal=$('#'+getId+' span').text();
			if(getVal=='Active')
			{
				$('#'+getId+' span').html('Dective');
				}
				else
				{
					$('#'+getId+' span').html('Active');
					}$("#"+getId).toggleClass('setBtn setBtnGr').removeClass('dctive');
					$.post(isCheckUrlAdmn('setting/unit_status'),{id:actNbtn},function(html)
					{if(html.icon='1'){$("#"+getId).attr("data-id",html.text);}
							else{$('#setResultMsg').html(html.text).addClass('ami_warning');}
						},'json');	
		}
		else if(actnstr[0]=='vwCatDet' || actnstr[0]=='edtCatDet')
		{
			 	let categoryTitle='';let unitActn='';unitActn='view';$('#proceedCat').html('<i class="bx bx-save"></i> Update');$('#miActn').val('edit');
				if(actnstr[0]=='vwCatDet'){categoryTitle=' View Category Details'; $('#proceedCat').hide();}
		        else if(actnstr[0]=='edtCatDet'){categoryTitle=' Edit Category Details'; $('#proceedCat').show();}$('.pgTitle').html(categoryTitle);$('#py_id').val(actnstr[2]);
			$.post(base_url+actnstr[1],{id:actnstr[2],unitActn:unitActn},function(html)
			 {
				 if(html.icon=='2'){$('#setResultMsg').html(html.text).addClass('ami_warning').removeClass('ami_danger ami_success').fadeIn();}
				   else
				   {    
				       if(html.catTyp=='0')
					   {$('#mnCt').hide();$("#catIds1").attr('checked', true);$("#catIds2").attr('checked', false);$('#miCtdt').val('1');setSelect('#main_cat',"");}
					   else{$('#mnCt').show();setSelect('#main_cat',html.catTyp);$("#catIds1").attr('checked', false);$("#catIds2").attr('checked', true);$('#miCtdt').val('2');}
					   $('#setResultMsg').fadeOut();$('#cat_name').val(html.category);$('#createBy').html(html.createdBy);
						$('#createDt').html(html.create_date);$('.createB').show();
						if(html.modifiedBy){$('#modifiedBy').html(html.modifiedBy);$('#modifyDt').html(html.modify_date);$('.mdfy').show();}else{$('.mdfy').hide();}
						}
			 },'json');
			
			}
		else if(actnstr[0]=='delCatDetails')
		{    
				$.post(base_url+actnstr[1],{id:actnstr[2],unitActn:'deleteCatDet'},function(html)
				{ $('#cnfDel_id').val(actNbtn);$('.delMsg').html('<i class="bx bx-trash"></i> Delete designation'); $('.actnData').html(html.text);},'json');
		}
		else if(actnstr[0]=='statusPack')
		{
			let getVal=$('#'+getId+' span').text();
			if(getVal=='Active')
			{
				$('#'+getId+' span').html('Dective');
				}
				else
				{
					$('#'+getId+' span').html('Active');
					}$("#"+getId).toggleClass('setBtn setBtnGr').removeClass('dctive');
					$.post(isCheckUrlAdmn('setting/unit_status'),{id:actNbtn},function(html)
					{if(html.icon='1'){$("#"+getId).attr("data-id",html.text);}
							else{$('#setResultMsg').html(html.text).addClass('ami_warning');}
						},'json');	
		}
		else if(actnstr[0]=='vwPackDet' || actnstr[0]=='edtPackDet')
		{
			 	let packageTitle='';let unitActn='';unitActn='view';$('#proceedPackage').html('<i class="bx bx-save"></i> Update');$('#miActn').val('edit');
				if(actnstr[0]=='vwPackDet'){packageTitle=' View Package Details'; $('#proceedPackage').hide();}
		        else if(actnstr[0]=='edtPackDet'){packageTitle=' Edit Package Details'; $('#proceedPackage').show();/*PackageActn='edit';*/}$('.pgTitle').html(packageTitle);$('#py_id').val(actnstr[2]);
			$.post(base_url+actnstr[1],{id:actnstr[2],unitActn:unitActn},function(html)
			 {
				 if(html.icon=='2'){$('#setResultMsg').html(html.text).addClass('ami_warning').removeClass('ami_danger ami_success').fadeIn();}
				   else
				   {    
				        $('#setResultMsg').fadeOut();$('#pack_name').val(html.pack_name);$('#pack_price').val(html.pack_price);$('#createBy').html(html.createdBy);
						$('#createDt').html(html.create_date);$('.createB').show();$('#business_volume').val(html.b_volume);
						if(html.modifiedBy){$('#modifiedBy').html(html.modifiedBy);$('#modifyDt').html(html.modify_date);$('.mdfy').show();}else{$('.mdfy').hide();}
						}
			 },'json');
			
			}	
		else if(actnstr[0]=='delPackDetails')
		{  $.post(base_url+actnstr[1],{id:actnstr[2],unitActn:'delPackDetails'},function(html)
			{ $('#cnfDel_id').val(actNbtn);$('.delMsg').html('<i class="bx bx-trash"></i> Delete designation'); $('.actnData').html(html.text);},'json');
		}				
	});
 
 
 
 
 $("#addUnitDetails,#deleteCnfrMtn,#addCategory,#addPackageDetails").click(function()
  {
	  	let actNbtn=$(this).attr('id');
		if(actNbtn=='addUnitDetails')
		{
			$('#manage_unit').modal('show');$('.createB,.mdfy').hide();$('#miActn').val('addUnit');$('#proceedUnit').html('<i class="bx bx-save"></i> Save').show();
			$('#unit_name').val('');$('#py_id').val('');
			}
			else if(actNbtn=='deleteCnfrMtn')
			{
				 let actnstr=isCheck('cnfDel_id').split('==');
				 $.post(base_url+actnstr[1],{id:actnstr[2],unitActn:'cnfDeleteCategory'},function(html)
			 		{
						$('.delMsg').html('<i class="bx bx-trash"></i> Delete designation');
						if(html.icon=='1'){$('.actnData').html(html.text).css('color','#02a30c');setTimeout(function(){window.location.reload(1);},2500);}
						else if(html.icon=='2'){$('.actnData').html(html.text).css('color','#c99a00');}
						else{$('.actnData').html('<i class="bx bx-cog bx-spin"></i> Oops it seems you have on the wrong way ').css('color','#a30225');}
						},'json');
				}
			else if(actNbtn=='addCategory')
			{
				$('#manage_category').modal('show');$('.createB,.mdfy').hide();$('#miActn').val('addCategory');$('#proceedUnit').html('<i class="bx bx-save"></i> Save').show();
				$('#unit_name').val('');$('#py_id').val('');
			}
			else if(actNbtn=='addPackageDetails')
		{
			$('#manage_package').modal('show');$('.createB,.mdfy').hide();$('#miActn').val('addPackage');$('#proceedPackage').html('<i class="bx bx-save"></i> Save').show();
			$('#unit_name').val('');$('#py_id').val('');
			}
	});

 $(".amiRadi").click(function()
  {
	 	let getId=$(this).attr('id');let getVal=$('#'+getId).val();if(getId=='catIds1'){$('#miCtdt').val('1');$('#mnCt').hide();$('#nmCat').html('Category Name');}
		else if(getId=='catIds2'){$('#miCtdt').val('2');$('#mnCt').show();$('#nmCat').html('Sub Category Name');}
	});
		});
/*--------------------------Code By @mit ---------------------------------*/