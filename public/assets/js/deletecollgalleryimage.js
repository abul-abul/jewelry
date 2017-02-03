$('.imageId').click(function(){
	var id = $(this).data('id');
	$('.delete-gallery-image').data('id', id);
	var name = $(this).data('name');
	$('.delete-gallery-image').data('name', name);
})

$('.delete-gallery-image').on("click", function(e){
	e.preventDefault;
	window.content = $(this);
	var id = $(this).data('id');
	var name = $(this).data('name');
	var galleryId = $(this).data('gallery');
	$.ajax({
		url:'/admin/gallery/remove-coll-gallery-image',
		method: 'GET',
		data: {'id':id, 'name':name, 'galleryId':galleryId},
		success: function(data){
			$('.'+id).closest("tr").remove();
		}
	})
})