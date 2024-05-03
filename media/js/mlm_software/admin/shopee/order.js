function initiate_value() {
    $("#punit").val('');
    $("#pstock").val('');
    $("#pprice").val('');

}


function get_product(id) {
    initiate_value()
    $.ajax({
        url: base_url + "mlm_software/admin/Partners/get_product_data",
        type: 'post',
        data: {
            'cat_id': id
        },
        dataType: "json",
        success: function (data) {

            $("#prod_id").html('');
            // var sel ='';
            $("#prod_id").append('<option>-------Select-----</option>');
            $.each(data, function (i, pro) { // sel = ;
                $("#prod_id").append('<option value=' + pro.id + '>' + pro.product_name + '</option>');
            })

        }

    });

}

function get_product_details(id) {
    initiate_value()
    $.ajax({
        url: base_url + "mlm_software/admin/Partners/get_product_details_data",
        type: 'post',
        data: {
            'prod_id': id
        },
        dataType: "json",
        success: function (data) {
            console.log(data);
			//let sprice=parseInt(data.product_price)+parseInt((data.product_price*data.productTax)/100);
            $("#punit").val(data.unit_name);
            $("#lstock").val(data.quantity);
            $("#sprice").val(data.product_price);
            $("#pprice").val(data.mrp);
            $("#discount").val(data.discount);
			$("#productBv").val(data.productBV);
		    $("#prodTax").val(data.productTax);

            $("#accu_stock").val(data.quantity);
            $("#prod_details_id").val(data.id);


            


        }

    });

}


$('#pbquantity').on('change', function () {

    let bqty = parseInt($(this).val());
    let accur_stock = parseInt($('#accu_stock').val());

    // let stock = parseInt($('#pstock').val());
    let price = parseInt($('#sprice').val());

    if (accur_stock >= bqty && bqty >= 0) {
        let total_amt = bqty * price;
        left_stock= accur_stock - bqty;
        $("#total_amount").val(total_amt);
        $("#lstock").val(left_stock);


} 


else
 {
    flashMsg('error', "Order Quantity can't be greater than stock  quantity ")
    $("#pbquantity").val('')
    $("#total_amount").val('0');

   
}});




$('#add_order').submit(function(e){
    e.preventDefault();
    $.ajax({
        url: base_url + "mlm_software/admin/partners/add_order_form_data",
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


function delete_cart_item(id)
{
    $.ajax({
        url: base_url + "mlm_software/admin/partners/delete_cart_item",
        type: 'post',
        data:{'id':id},       
        dataType: "json",
        success: function (data) {
            popup(data)
        }
    });
   
}

$('#make_payment').on('click',function(){
    let member_id=$(this).data('member_id');let pyblAmt=$('#pyblAmt').val();let recevrTyp=$('#recevrTyp').val();
    $.ajax({url: base_url + "mlm_software/admin/partners/payment",type: 'post',data:{'id':member_id,'pyblAmt':pyblAmt,'recevrTyp':recevrTyp},dataType: "json",success:function(data){popup(data)}
    });
   
});