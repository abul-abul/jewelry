$('.main_image_radio').on("click", function(e){
	e.preventDefault;
	var token = $('#main_image_token').val();
	var id = $('.article_id').attr('value'); 
	var main_image_id = $(this).val();
	$.ajax({
		url: '/admin/blog/set-main-image',
		method: 'POST',
		data: {'id': id, '_token': token, 'main_image_id': main_image_id}
	});
})