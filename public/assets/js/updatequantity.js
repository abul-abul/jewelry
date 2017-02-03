$(document).ready(function(){
	$('.quantity').click(function(){ 
		var id = $(this).data('id');
		$('.saveQuantity'+id).children('button').attr("style", "border: 1px solid #f64243; color: #f64243");
	})

	$('.update_quantity').click(function(){ 
		var item_id = $(this).data('item');
		var quantity = $(this).val();
		var new_quantity = $('#xx'+item_id).val();
		var maxquantity = $('#xx'+item_id).attr('maxquantity');
		var currency = $('.items_count').data('currency');
		if(parseInt(new_quantity) > parseInt(maxquantity)){
			$(this).val(maxquantity);
			 $('#xx'+item_id).val(maxquantity);
			return;
		}else{
			$(this).val(new_quantity);
		}
		if(!Number.isInteger(parseFloat(new_quantity)))
		{
			$('#xx'+item_id).attr('style', 'color:  #f64243'); 
			return;
		}
		if(parseInt(new_quantity) < 0)
		{
			itemquantity = $('#xx'+item_id).data('quantity');
			$('#xx'+item_id).val(itemquantity);
			return;
		}
		$(this).attr("style", "border: 1px solid #dddddd;; color: inherit;");
		var price = $('.'+item_id+'price').data('price');
		$.ajax({
			url:'/cart/update-cart/'+item_id,
			method:'GET',
			data:{quantity:quantity,item_id:item_id,new_quantity:new_quantity},
			success:function(data){					
				var count =  $('.shopping-bag').text();
				var total_count = parseInt(count) - parseInt(quantity) + parseInt(new_quantity);
				var shipping = parseInt($('#shipping_method').val());
				$('.shopping-bag').text(total_count);
				var subtotal = parseFloat(price) * parseInt(new_quantity);
				sub = parseFloat(subtotal);
				$('.'+item_id+'subtotal').text(currency+sub);
				$('.'+item_id+'subtotal').data('price', sub)
				var item_count = parseInt(new_quantity) - parseInt(quantity); 
				var amount = parseFloat(price) * parseFloat(item_count);
				var new_amount = parseFloat(amount) + parseFloat($('.sub_amount').data('amount'));
				pasrAmount = parseFloat(new_amount);
				total_amount = pasrAmount+shipping;
				$('.sub_amount').data('amount', pasrAmount)
				$('.sub_amount').text(currency+pasrAmount);
				$('.total_amount').text(currency+total_amount);

			} 
		})

	})
})
