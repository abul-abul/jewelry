$(document).ready(function(){ 
	$('.view-product').click(function(){
		var slug = $(this).data('slug');
		$.ajax({
			method: "GET",
			url: "/item/item-data/"+slug,
			data:{},
			success:function(data){
				$('.product-detail').html(data.resource);
					$('.img-responsive').click(function(){ 
					var img = $(this).attr('src');
					$('.main_image').attr('src', img);
				})

			}
		})
	})
})

