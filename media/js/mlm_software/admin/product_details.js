

var reportProTable = '';


$(document).ready(function () {
    let searchObj = {};

    reportProTable={printTable:function(search_data){getpaginate(search_data,'#product_list','mlm_software/admin/product/product_details_data','Only For Id,Product Name');}}
    reportProTable.printTable(searchObj);

    $('#search').submit(function (e) {
        e.preventDefault();
        $("#product_list").DataTable().clear().destroy();
        let search = $('#search').serializeArray();
        let searchObj = {};
        $.each(search, function (i, row) {
            searchObj[row.name] = row.value;
        });
        reportProTable.printTable(searchObj);
    });

    
});


// israel function strted from here
$("#product_details_form").submit(function (e) {
    e.preventDefault();
   
    $.ajax({
        url: base_url + "mlm_software/admin/product/add_product_data",
        type: 'post',
        data: new FormData(this),
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (data) {
            popup(data)
        }
    });
});

$('#product_details_edit_form').submit(function(e){
    e.preventDefault();
    $.ajax({
        url: base_url + "mlm_software/admin/product/update_product_details_data",
        type: 'post',
        data: new FormData(this),
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (data) {
            popup(data)
        }
    });

});



function get_cat_data(id) {
    $.ajax({
        url: base_url + "mlm_software/admin/product/get_category_data",
        type: 'post',
        data: {
            'cat_id': id
        },
        dataType: "json",
        success: function (data) {
            $("#pro_id").html('');
            // var sel ='';
            $("#pro_id").append('<option>-------Select-----</option>');
            $.each(data,function(i,pro) {
                // sel = ;
                $("#pro_id").append('<option value=' + pro.id + '>' + pro.product_name + '</option>');
            })

        }

    });

};

function view_pro(id)
{
    
  $.ajax({
    url:base_url+'mlm_software/admin/product/get_product',
    data:{'id':id},
    type:"post",
    success:function(data)
    {
        $("#view_product_details").html(data);
    }
  })
}

$('#update_image').submit(function(e){
    e.preventDefault();
    $.ajax({
        url: base_url + "mlm_software/admin/product/update_product_image",
        type: 'post',
        data: new FormData(this),
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (data) {
            popup(data)
        }
    });
});



// function exist

$("#deleteCnfrMtn").click(function ()
{

   let getIdDet = $(this).attr('id');

   
    if (getIdDet == 'deleteCnfrMtn') 
   {

       let actnstr = isCheck('cnfDel_id').split('==');
    
       $.post(base_url + actnstr[1]+'delete_product_details',
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


});



$("#product_list").on("click",".getAction", function ()
{
   let actNbtn = $(this).attr('data-id');
//    alert(actNbtn);
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

       $.post(base_url + actnstr[1]+'delete_product_details/msg', {
           id: actnstr[2],
           unitActn: 'delProDetails'
       }, function (html) {
           $('#cnfDel_id').val(actNbtn);
           $('.delMsg').html('<i class="bx bx-trash"></i> Delete Product');
           $('.actnData').html(html.text);
       }, 'json');
   }




});










