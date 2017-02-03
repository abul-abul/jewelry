$(document).ready(function(){
	$('.product-thumb-info').mouseover(function(){
		$(this).children('div').attr('style', 'display: block;');
		$(this).children('span').attr('style', 'display: block;');
	});

	$(".img_info:has('.old')").attr('style', 'text-align: justify!important;').addClass('justify-one');

	$('.product-thumb-info-act a').hover(function(e){
		e.preventDefault();
		$(this).parents('.product-thumb-info-image').addClass('without-red-border');
	},
	function(e){
		$('.product-thumb-info-image').removeClass('without-red-border');
	})
})