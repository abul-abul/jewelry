$(document).ready(function(){
	$('.small-slides').click(function(e){
		e.preventDefault;
		var carousel = $('.owl-carousel-featured');
		// var id = $(this).data('id');
// 		// var image = $('.'+id).attr('src');
// 		// var slideId = $('.main-slides').data('id');
// 		// console.log(slideId);
// 		// $('.'+slideId).attr('src', image);
		var src = $(this).attr('src');
		var index = $(this).data('index');
		carousel.trigger("to.owl.carousel", [index, 500, true]);
	})
}) 