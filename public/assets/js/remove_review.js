$(document).ready(function(){
	$('.remove_review').click(function(){
		window.content = $(this);
		var id = $(this).data('id');
		var reviewCount = $('.review-count').text();
		$.ajax({
			url:"/item/remove-review/"+id,
			method:"GET",
			data:{id:id, reviewCount:reviewCount},
			success:function(data){
				newCount = parseInt(reviewCount)-1;
				$('.review-count').text(newCount);
				content.parent().parent().parent().remove();
			}
		})

	})
})