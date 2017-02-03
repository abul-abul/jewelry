$('#check_all').on("change", function(){
	if($('#check_all').is(':checked')){ 
		$('.check-list').prop('checked', true);
		$('.check-list').parent().attr('class', 'checked');
	}else{
		$('.check-list').prop('checked', false);
		$('.check-list').parent().attr('class', '');
	}
	
})