$(document).ready(function(){
	$('.remove-from-favorites').click( function(){
		var item_id = $(this).data('item');	
		$.ajax({
			url:'/favorites/add-to-favorites',
			method: 'GET',
			data: {item_id: item_id},
			success:function(data){
				$('.remove'+item_id).remove();

				// if($('#'+item_id+'heart').attr("style") == "color:grey!important;")
				// {
				// 	$('#'+item_id+'heart').attr("style", 'color:red!important')
				// }else{
				// 	$('#'+item_id+'heart').attr("style", "color:grey!important;");
				// }
				
			}
		});
	})
})