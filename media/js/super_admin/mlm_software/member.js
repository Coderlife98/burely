// Basic Details Update
$('#save_data').submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: base_url + 'super_admin/mlm_software/member/save_data',
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

$('#member_profile_data').submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: base_url + 'super_admin/mlm_software/member/update',
        type: "POST",
        data: $(this).serialize(),
        dataType: 'json',
        success: function (data) {
			//console.log(data);
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


// Member List 

$(document).ready(function () {						
    let searchObj = {};
    // Reporting Section
    let reportTable = {
        printTable: function (search_data) {
            $("#member_table").DataTable({
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "order": [],
                'columnDefs': [{
                    'targets': [1, 2, 3, 4],
                    'orderable': true
                }],
                "ajax": {
                    "url": base_url + 'super_admin/mlm_software/member/member_data',
                    "type": "POST",
                    "dataSrc": "data",
                    "data": search_data
                },
                language: {
                    searchPlaceholder: "Only For Sponser Id, Name & Mobile Number."
                },
                //dom: 'Bfrtip',
                dom: "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                "buttons": ["excel","pdf","print"/*{extend:'excel',text:'<i class="far fa-file-excel"></i>'}, {extend:'pdf',text:'<i class="fas fa-file-pdf"></i>'},{extend:'print',text:'<i class="fas fa-print"></i>'}*/]
            });
        }
    }

    reportTable.printTable(searchObj);

    $('#search').submit(function (e) {
        e.preventDefault();
        $("#member_table").DataTable().clear().destroy();
        let search = $('#search').serializeArray();
        let searchObj = {};
        $.each(search, function (i, row) {
            searchObj[row.name] = row.value;
        });
        reportTable.printTable(searchObj);
        $('html,body').animate({ scrollTop: $("#member_table").offset().top},'slow');
	
	});

	$("#getProfileImageChange").click(function()
	{
		$("#uploadMemberIMg").toggle();
  	});
	$(".memberImgUploadActn").click(function()
	{
		var imgFile=$('#file').val();
		if(imgFile=="")
		{Swal.fire({ position: "top-end", icon: 'error',title: 'Please Provide valid member image', showConfirmButton:  !1,timer: 1500 });}
		else
		{
		     var name = document.getElementById("file").files[0].name;
 			 var form_data = new FormData();
 			 var ext = name.split('.').pop().toLowerCase();
 			 if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
			 { Swal.fire({ position: "top-end", icon: 'error',title: 'Please Provide Valid Image Format', showConfirmButton:  !1,timer: 1500 });}
			   var oFReader = new FileReader();
			   oFReader.readAsDataURL(document.getElementById("file").files[0]);
			   var f = document.getElementById("file").files[0];
			   var fsize = f.size||f.fileSize;
			   if(fsize > 2000000)
			   {Swal.fire({ position: "top-end", icon: 'error',title: 'Image File Size is very big', showConfirmButton:  !1,timer: 1500 });}
				else
				{
				  var NwUrl=base_url+'super_admin/mlm_software/member/upload_image';
				   form_data.append("file", document.getElementById('file').files[0]);
				   form_data.append("id", $('#id').val());	
				   form_data.append("memImg", $('#memImg').val());
				   $.ajax({url:NwUrl,method:"POST",data: form_data,contentType: false,cache: false,processData: false,beforeSend:function(){$('#Update').html('Wait...');},   
					success:function(data)
					{$('#Update').html('Update');var strng=data.split("====");if(strng[0]=='1'){
						$dtImg='<img alt="Profile Image" class="avatar-xl img-thumbnail rounded-circle mb-3" src="'+base_url+"uploads/user/"+strng[1]+'">';
						$('#proPic').html($dtImg);Swal.fire({position: "top-end",icon: 'success',title: 'successfully upload image',showConfirmButton:!1,timer: 1500});}
						else{Swal.fire({position: "top-end",icon: 'error',title: 'Some Error Occur Please Re-Update',showConfirmButton: !1,timer: 1500});}}
				   });
				  }
			}
	});
	
    $(".empSelectR").change(function()
	{var actNbtn=$(this).attr('id');if(actNbtn=='state')
	{$('#district').html('<option>Please Wait.....</option>');$('#district').css('color','#D2691E');
    $.post(base_url+"mlm_software/admin/employee/cityList",{id:$('#'+actNbtn).val()},function(html){$('#district').html(html);$('#district').css('color','rgb(62, 62, 62)');});}
	});
	
	
	$(".getKeyUp").keyup(function()
	{
		let actNbtn=$(this).attr('id');
		if(actNbtn=='sponsor')
		{
			$.post(isCheckUrl('member/is_data_exist'),{sponsor:isCheck('sponsor')},function(html){
		    if(html=='err')
			{
				$('#spId').html('This membership id is not available').fadeIn().addClass('miMemErr').removeClass('miMemAv');
				}
				else{$('#spId').html(html).fadeIn().addClass('miMemAv').removeClass('miMemErr');}});
			}
	    else if(actNbtn=='placement')
		{
			$.post(isCheckUrl('member/is_data_exist'),{sponsor:isCheck('placement')},function(html){
		    if(html=='err')
			{
				$('#plcmntId').html('This membership id is not available').fadeIn().addClass('miMemErr').removeClass('miMemAv');
				}
				else{$('#plcmntId').html(html).fadeIn().addClass('miMemAv').removeClass('miMemErr');}});
			}
  	});
	
	
	
	
});
/*-----------------amt 21.04.23 start------------------------------*/
$(function()
{
	$(document).on('click','.getActn',function(e)
	{
		$.post(base_url + 'super_admin/mlm_software/member/get_status',
               {id:$(this).attr('data-id')},
               function(html){
			  var strng=html.split('-');
			  var stsId='#shwBtnVal-'+strng[1];
			  var btns=strng[0]+ ' <i class="mdi mdi-chevron-down"></i>';
			if(strng[0]=='Active')
			{$(stsId).html(btns);$(stsId).addClass('btn-success');$(stsId).removeClass('btn-danger');$(stsId).removeClass('btn-warning');}
			else if(strng[0]=='Block')
			{$(stsId).html(btns);$(stsId).removeClass('btn-success');$(stsId).addClass('btn-danger');$(stsId).removeClass('btn-warning');}
			else if(strng[0]=='Suspend')
			{$(stsId).html(btns);$(stsId).removeClass('btn-success');$(stsId).removeClass('btn-danger');$(stsId).addClass('btn-warning');}
			});
	});
 });

/*-----------------amt 21.04.23 end------------------------------*/
$(function () {
    $('.genealogy-tree ul').hide();
    $('.genealogy-tree>ul').show();
    $('.genealogy-tree ul.active').show();
    $('.genealogy-tree li').on('click', function (e) {
        var children = $(this).find('> ul');
        if (children.is(":visible")) children.hide('fast').removeClass('active');
        else children.show('fast').addClass('active');
        e.stopPropagation();
    });
});
/*-----------------amt 26.04.23 end------------------------------*/




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
function visiblePass(str)
{
 var shw='<div class="showPass" onclick="visiblePass('+str+')" id="pass'+str+'"><div class="passwrd"></div></div>';
 $.ajax({
        url:base_url+'super_admin/mlm_software/member/passv',
        type: "POST",
        data:{pID:str},
	  beforeSend : function() 
		{ $('#pass'+str).html('<img src="'+base_url+'mlm/img/loader.gif" style="height:10px;" >'); },
        success: function (data) {
			$('#pass'+str).css('color','rgb(87, 87, 87)').html(data);
			 setTimeout(function(){$('#pass'+str).html(shw).css('color','#d50000');}, 5000);
			}    
   		 });
	}	
	
	
	
$(document).ready(function() 
{
 	let searchObj = {};
	let actnU=$('#actnU').text();	
	let reportMngTable = {printTable:function(search_data){getpaginate(search_data,'#manage_table',actnU,'For name,mobile');}}
	reportMngTable.printTable(searchObj);

$('#search_manage').submit(function (e) {
		e.preventDefault();
		$("#manage_table").DataTable().clear().destroy();
		let search = $('#search_manage').serializeArray();
		let searchObj = {};
		$.each(search, function (i, row) {searchObj[row.name] = row.value;});
		reportMngTable.printTable(searchObj);
});


});
function isCheck(str){var inputBx=$('#'+str).val();if(inputBx==""){return "";}else{return inputBx;}}
function isCheckUrl(page){return base_url +'super_admin/mlm_software/'+page;}
function getpaginate(search_data,id,page,plchldr)
{	 
    var base_url=$('#base_url').text();	
	$(id).DataTable({"responsive": true,"processing": true,"serverSide": true,"order": [],'columnDefs': [{'targets': [1, 2, 3, 4],'orderable': true}],
                "ajax":{"url": base_url+page,"type": "POST", "dataSrc": "data","data": search_data},
                language:{searchPlaceholder:plchldr},
                dom: "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                "buttons": ["excel", "pdf", "print"]
            });
}		
function inPagePopup(html,id){
	if(html.data=='1'){$(id).addClass('ami_success').removeClass('ami_warning ami_danger').html(html.text);}else if(html.data=='2'){$(id).addClass('ami_warning').removeClass('ami_success ami_danger').html(html.text);}else{$(id).addClass('ami_danger').removeClass('ami_warning ami_success').html(html.text);}
}	
	
	
	
	
	
	
	
	
		