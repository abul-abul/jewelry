$('.review-unseen').on("click", function(e){
	e.preventDefault;
	var status = $(this).attr('data-status');
	console.log(status)
	if(status == "unseen"){
		var count = $('.unseen-reviews-count').text();
		var new_count = parseInt(count) - 1;
		if(new_count == 0){
			$('.unseen-reviews-count').remove();
		}else{
			$('.unseen-reviews-count').text("");
			$('.unseen-reviews-count').text(new_count);
		}
		$(this).parent().children('a').attr('data-status', 'seen');
	}
})