$('.imageId').click(function(){
	var id = $(this).data('id');
	$('.delete-article-image').data('id', id);
	var name = $(this).data('name');
	$('.delete-article-image').data('name', name);
})

$('.delete-article-image').on("click", function(e){
	e.preventDefault;
	window.content = $(this);
	var id = $(this).data('id');
	var name = $(this).data('name');
	$.ajax({
		url:'/admin/blog/delete-article-image',
		method: 'GET',
		data: {'id':id, 'name':name},
		success: function(data){
			$('.'+id).closest("tr").remove();
		}
	})
})