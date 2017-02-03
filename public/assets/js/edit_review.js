$(document).ready(function(){
	$('.cancel_button').click(function(){
		var id=$(this).data('id');
		$('.postedit-comments'+id).attr('style', 'display:none');
		$('.review'+id).show();
	})

	$('.edit_review').click(function(){
		var id = $(this).data('id');
		$('.review'+id).hide();
		$('.postedit-comments'+id).attr('style', 'display:inline');
	})
})