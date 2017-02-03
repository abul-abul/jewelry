$(document).ready(function(){
    $("[name='true']").bootstrapSwitch();
    $('.true').click(function(){
        var item_id = $(this).attr('alt');
        var currency = $('.items_count').data('currency');
        var shippingAmount = $('.shipping').data('shipping');
        console.log(shippingAmount);
        $(this).addClass('btn-primary');
        $(this).next().addClass('default'); 
        $(this).next().removeClass('btn-danger');
        if($(this).hasClass('default')){
            $(this).removeClass('default');
            $.ajax({
                method: "GET",
                url: "/order/edit-order-status/"+item_id+"/1",
                success:function(data){
                    count = parseInt($('.items_count').html()) + 1;
                    $('.items_count').html(count);
                    subtotal = parseFloat($('.subamount').data('amount')) + parseFloat($('.' + item_id + 'price').data('price'));
                    newSubtotal = parseFloat(subtotal);
                    $('.subamount').data('amount', newSubtotal)
                    $('.subamount').text('$'+newSubtotal);
                    var total = parseInt(shippingAmount) + parseFloat(subtotal);
                    $('.total').text('$'+total);
                }
            })
        }
    }) 

    $('.false').click(function(){
        var item_id = $(this).attr('alt');
        var currency = $('.items_count').data('currency');
        var shippingAmount = $('.shipping').data('shipping');
        $(this).addClass('btn-danger');
        $(this).prev().removeClass('btn-primary');
        $(this).prev().addClass('default');
        if($(this).hasClass('default')){
            $(this).removeClass('default');
            $.ajax({
                method: "GET",
                url: "/order/edit-order-status/"+item_id+"/0",
                success:function(data){
                    count = parseInt($('.items_count').html()) - 1;
                    $('.items_count').html(count);
                    total = parseFloat($('.subamount').data('amount')) - parseFloat($('.' + item_id + 'price').data('price')) ;
                    newTotal = parseFloat(total);
                    $('.subamount').data('amount', newTotal)
                    $('.subamount').text('$'+newTotal);
                    var total = parseInt(shippingAmount) + parseFloat(total);
                    $('.total').text('$'+total);
                }
            })
        }
    })
});



