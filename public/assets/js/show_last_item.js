$(document).ready(function(){
	$('#show_last_item').click(function(){

		$.ajax({
			method: "GET",
			url: "/cart/last-item",
			success:function(data){
				$('.last_item_dropdown').addClass('dropdown-menu');
				//$('#show_last_item').parent().addClass('open');
				$('.last_item_dropdown').html(data.resource);

			}  
		})
	})
})