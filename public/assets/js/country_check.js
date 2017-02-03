$(document).ready(function(){
	var countries = $('.country-check').children('option');
	var old = $('.country-check').data('old');
	var values = [];
	$.each(countries, function(i, country){
		values.push(($(this).val()));
		if($(this).val() == old)
		{
			$(this).attr('selected', 'selected');
		}
	});
	
	
})