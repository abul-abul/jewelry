$('.add-to-favorites').on("click", function(e) {
	e.preventDefault(); 
	var item_id = $(this).data('item');
	var status = $(this).data('status');
	if(status == 1)
	{
		if($(this).hasClass('list_heart'))
		{
			$(this).children().children().text('ADD TO FAVORITES');
		}else{
			$(this).attr("style", "color:grey !important, background-color:white !important, border: 1px solid grey !important");
			$(this).html('<i class="fa fa-heart"> Add to Favorites</i>');
			$(this).removeClass('liked');
			$(this).addClass('like');
		}

		$(this).data("status", '0'); 
  		
	}else{
		if($(this).hasClass('list_heart'))
		{
			$(this).children().children().text('ADDED');
		}else{
			$(this).attr("style", "color:white!important; background-color: #f64243!important, border:none!important;");
			$(this).html('<i class="fa fa-heart"> In Favorites</i>');
			$(this).removeClass('like');
			$(this).addClass('liked');
		}
		$(this).data("status", '1');
	}
	$.ajax({
		method: 'GET',
		url: '/favorites/add-to-favorites',
		data:{item_id: item_id}
	});
})