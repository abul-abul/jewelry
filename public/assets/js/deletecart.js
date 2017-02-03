$(document).ready(function(){
	$('.remove_cart').click(function(){	 
		window.content = $(this);	
		var item_id = $(this).data('item');
		var quantity = $(this).data('quantity');
		var new_quantity =  $('#xx'+item_id).val()
		var price = $('.'+item_id+'subtotal').data('price');
		var total = $('.sub_amount').data('amount');
		var currency = $('.items_count').data('currency');
		$.ajax({
			url:'/cart/delete-cart/'+item_id, 
			method:'GET',
			data:{},
			success:function(data){
				var items_count = $('.items_count').text();
				var new_count = parseInt(items_count) - 1;
				var shipping = parseInt($('#shipping_method').val());
				$('.items_count').text(new_count);
				var bag_count = $('.shopping-bag').text();
				var new_bag_count = parseInt(bag_count) - new_quantity;
				$('.shopping-bag').text(new_bag_count);
				content.parent().parent().remove();	
				var sub_amount = parseFloat(total) - parseFloat(price);
				amount =  parseFloat(sub_amount);
				total_amount = shipping + amount;
				$('.sub_amount').data('amount', amount);
				$('.sub_amount').text(currency+amount);
				$('.total_amount').text(currency+total_amount); 
			}
		})
	})
})
