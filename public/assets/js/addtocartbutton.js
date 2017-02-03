$(document).ready(function(){

	$(document).on('click','.formDropdown', function(){
		if($('#itemSize').val() !== '0')
		{
			$(this).attr('style', '');

		}

	});

	$('.xxxx').click(function(){
		$('.xxxx').attr('style', 'border-color: grey')
	})

	$(document).on('click','.add_cart',function(){
	var status = $(this).data('status');
			if(status == 'Coming Soon')
			{
				$('#comingSoon').modal('show');
				// $('.add_cart').attr('data-target', '#comingSoon');
				$('.add_cart').attr('style', 'background-color: white;')
				return;
			}else{
		$(this).attr('style', 'color: #fff; ');
		var id = $(this).attr('data-id'),
			quantity = $('.qty').val(),
			title = $(this).attr('data-title'),
			price = $(this).attr('data-price'),
			category = $(this).attr('data-category'),
			main_image = $(this).attr('data-image'),
			subtotal = $(this).attr('data-subtotal');
			size = $('#itemSize').val();
			var maxquantity =  $('.qty').attr('maxquantity');
			var _token = $('.token').val();
			var new_subtotal = parseFloat(quantity * price + subtotal);
			

			if(category == 'Rings' && size == "0")
				{
					$('.formDropdown').attr('style','border:solid 3px #f64243; color: #f64243; font-family:Impact');
					$('.add_cart').attr('style', 'background-color: white;')
					return ;
				}
			if(parseInt(quantity) > parseInt(maxquantity))
			{

				$('.qty').val(maxquantity);
				return;
			}
			if(Number.isInteger(parseFloat(quantity)) == false || parseFloat(quantity) < 0)
			{
				$('.xxxx').attr('style', 'border: 4px solid #f64243!important')
				$('.qty').val(1);
				return;
			}
			$.ajax({
			method: "POST",
			url: "/cart/add-to-shopping-cart", 
			data:{quantity:quantity, size:size, id:id, _token:_token},
			success:function(data){
				var count =  $('.shopping-bag').text();
				var newCount = parseInt(count) + parseInt(quantity);
				$('.shopping-bag').text(newCount);
				$('#last_item_title').text(title);
				$('#last_item_category').text(category);
				$('#last_item_price').text(price);
				$('#last_item_main_image').attr('src', main_image);
				$('#header_subtotal').text(new_subtotal);
				$('.add_cart').html('<i class="fa fa-shopping-cart"></i> Added');
$('.add_cart').attr('style', 'background-color: red; border:none!important; color:white!important; font-size: .857em;font-weight: 700; font-family: inherit;');

				$('.add_cart').children('i').attr('style', 'color:white!important;')
				$('.add_cart').attr("disabled", true);
				
				$(this).removeClass('add_cart');
				$(this).addClass('added');
			}
		})
			} 
	})
})
