$(document).ready(function(){
	var id = $('.collection').data('id');
	$('.collection').hover(function(){
		$(this).children('a').children('img').attr('style', 
			"-webkit-filter: grayscale(0%); filter: grayscale(0%);");
	}, function(){
		$(this).children('a').children('img').attr('style', 
			"-webkit-filter: grayscale(100%);filter: grayscale(100%);");
	})
})