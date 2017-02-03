$(document).ready(function(){
	$('#category').change(function(){
		var category = $("#category option:selected").text();
		if(category == 'Rings')
		{
			$('.ring_size').attr('style', 'display:flex');
		}else{
			 $('.ring_size').attr('style', 'display:none');
		}
	 })
});