$('.imageId').click(function(){
	var id = $(this).data('id');
	$('.delete-image').data('id', id);
	var name = $(this).data('name');
	$('.delete-image').data('name', name);
})


$('.delete-image').on("click", function(e)
	{
		e.preventDefault;
		var id = $(this).data('id');
		window.content = $('.image'+id);
		var name = $(this).data('name');
		$.ajax({
			url: '/admin/item/delete-item-image',
			method: 'GET',
			data:{'id': id, 'name': name},
			success:function(data){
				var quantity = $('.span_dropzone').text();
				var new_quantity = parseInt(quantity) - 1;
				$('.span_dropzone').text(new_quantity);
				content.remove();
			}
		})
	})

