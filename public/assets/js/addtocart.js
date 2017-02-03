$(document).ready(function(){
	$('.add-to-cart-product').click(function(){ 
		if($(this).hasClass('add-to-cart-product'))
		{
			var id = $(this).attr('data-id'),
			quantity = 1,
			title = $(this).attr('data-title'), 
			price = $(this).attr('data-price'),
			category = $(this).attr('data-category'), 
			subtotal = $(this).attr('data-subtotal'),
			status = $(this).data('status'),
			size = 0;
			var _token = $('.token').val(); 
			if(status == 'Coming Soon')
			{
				$(this).attr('href', '#small');
				$('#item_page').text("This item will be in the store soon!");
				return;
			}
			if(category == "Rings")
			{
				$(this).attr('href', '#small');
				$('#item_page').text("Please visit item's page to select size! ");
				return;
			}
			var new_subtotal = parseFloat(subtotal) + parseFloat(price);
		$.ajax({
			method: "POST",
			url: "/cart/add-to-shopping-cart",
			data:{quantity:quantity, size:size, id:id, _token:_token}, 
			success:function(data){
				$('.'+id).text("");
				$('.'+id).append('<i class="fa fa-shopping-cart"></i>Added');
				var count =  $('.shopping-bag').text();
				var newCount = parseInt(count) + parseInt(quantity);
				$('.shopping-bag').text(newCount); 
				$('#header_subtotal').text(new_subtotal);
				$('.'+id).attr("disabled", true);
				$('.'+id).attr('class', 'btn btn-sm btn-icon btn-primary add-to-cart-product ' + id + ' disabled-added');
				$('.item_list'+id).html('<i class="icon icon-shop fa fa-shopping-cart"> ADDED</i>');
				$(this).attr('disabled', true);
				$('.item_list'+id).removeClass('add-to-cart-product');


			}
		})
		}

	})
})
