function get_order_list(order_id)
{
    $.ajax({
        url: base_url + "mlm_software/admin/Partners/order_list",
        type: 'post',
        data:{'order_id':order_id},       
        // dataType: "json",l
        success: function (data) {
            // $('#order_list'+order_id).append()
          $('#order_list_view'+order_id).html(data)
        }
    });
}

function delete_order(order_id)
{
    $.ajax({
        url: base_url + "mlm_software/admin/Partners/cancel_order",
        type: 'post',
        data:{'order_id':order_id},  

        dataType: "json",
        success: function (data) {
            popup(data)          
           
        }
    });
    
}
